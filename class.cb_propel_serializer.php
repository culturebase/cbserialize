<?php

/**
 * Array serializer for propel objects. It works recursively and only serializes
 * the fields given in the description. It can also work with virtual fields
 * or virtual "joins" (e.g. CbFilmFilm.CbFilmGenres).
 */
class CbPropelSerializer {
   function __call($name, $arguments)
   {
      $class = new ReflectionClass('CbPropelSerialize'.CbCaseConverter::camelize($name));
      return $class->newInstanceArgs($arguments);
   }

   /**
    * Serializes a PropelObjectCollection.
    * @param PropelObjectCollection $collection The objects to be serialized.
    * @param array $fields Array of fields to be serialized. Only fields
    *    given here will be serialized. You can use relations here. In that case
    *    use the Propel method name without "get" as key and a further array of
    *    fields as value, e.g.:
    *    array('Firstname', 'Cb3Taccounts' => array('Account', 'Email'))
    *    Furthermore, if the second array has only a single member you can
    *    specify that literally, as string, e.g.:
    *    array('Firstname', 'Cb3Taccounts' => 'Account')
    * @return array Nested array with the given fields as keys and the
    *    corresponding members of objects from the given collection as values. 
    */
   static function collectionToArray($collection, $fields)
   {
      $result = array();
      if (!is_array($fields)) $fields = array($fields);
      foreach ($collection as $object) {
         $result[] = self::objectToArray($object, $fields);
      }
      return $result;
   }

   /**
    * Same as @see collectionToArray , only with a single Propel object.
    * @param BaseObject $object The object to be serialized.
    * @param array $fields Fields to be serialized.
    * @return array Requested fields from the given object.
    */
   static function objectToArray($object, $fields)
   {
      if (!$object) return array();
      $result = array();
      if (!is_array($fields)) $fields = array($fields);
      foreach ($fields as $name => $value) {
         if (is_numeric($name)) {
            $name = $value;
            $value = null;
         }

         $children = '';
         if (is_object($value)) {
            $children = $value->value($object, $name);
            $name = $value->name($object, $name);
         } else {
            $children = self::childrenToArray(self::getObjectMember($object, $name), $value);
         }

         if (!is_object($children)) { //don't serialize if nothing is specified
            $result[$name] = $children;
         }
      }
      return $result;
   }

   static function childrenToArray($children, $fields)
   {
      if ($fields) {
         if ($children instanceof PropelObjectCollection || is_array($children)) {
            return self::collectionToArray($children, $fields);
         } else if ($children instanceof BaseObject) {
            return self::objectToArray($children, $fields);
         }
      } else {
         return $children;
      }
   }

   static function getObjectMember($object, $name, $args = array())
   {
     if ( FALSE === strpos($name, "::") )
       {
         $method = 'get' . $name;
       }
     else
       {
         $l_aMethods = explode("::",$name,2);
         $method = 'get'.$l_aMethods[0];
         $recursion = $l_aMethods[1];
       }
    // error_log(__CLASS__." class = ".get_class($object).", method = ".$method);
     $returnValue = call_user_func_array(array($object, $method), $args);
     if ( ! empty($recursion) )
       {
         $returnValue = self::getObjectMember($returnValue, $recursion, array());
       }
     
     return $returnValue;
   }

   /**
    * TODO: implement
    * Updates the given object with values from an array.
    * @param BaseObject $object Object to be updated.
    * @param array $data Data to be inserted.
    */
   static function objectFromArray($object, $data)
   {
      
   }

}