<?php
/* This file is part of cbserialize.
 * Copyright © 2011-2012 stiftung kulturserver.de ggmbh <github@culturebase.org>
 *
 * cbserialize is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * cbserialize is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with cbserialize.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Array serializer for propel objects. It works recursively and only serializes
 * the fields given in the description. It can also work with virtual fields
 * or virtual "joins" (e.g. CbFilmFilm.CbFilmGenres).
 */
class CbSerializer {
   function __call($name, $arguments)
   {
      $class_name = 'CbSerialize'.CbCaseConverter::camelize($name);
      if (!class_exists($class_name)) {
         require_once 'class.'.CbCaseConverter::snakeify($class_name).'.php';
      }
      $class = new ReflectionClass($class_name);
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
         if ($children instanceof PropelCollection || is_array($children)) {

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
      if (!is_array($args)) $args = array($args);
      if (false === strpos($name, "::")) {
         $method = 'get' . $name;
      } else {
         $methods = explode("::", $name, 2);
         $method = 'get' . $methods[0];
         $recursion = $methods[1];
      }
      $returnValue = call_user_func_array(array($object, $method), $args);
      if (is_object($returnValue) && !empty($recursion)) {
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