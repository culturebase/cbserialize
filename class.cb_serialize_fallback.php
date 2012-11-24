<?php

require_once 'class.cb_serializer.php';
require_once 'class.cb_serialize_base.php';

/**
 * return value of fallback properties
 *
 * @author Sarah
 */
class CbSerializeFallback extends CbSerializeBase {

   function __construct(array $fallbacks, $fields = array(), $args = array())
   {
      parent::__construct($fields, $args);
      $this->fallbacks = $fallbacks;
   }

   /**
    * returns the alternative value if the original value is empty
    *
    * The method if the value given by property <name> is empty
    * the first value of the fallback name which is not empty is returned
    *
    * @param type $object
    * @param type $name
    * @return type
    */
   function value($object, $name)
   {
      $value = CbSerializer::getObjectMember($object, $name);
      if (empty($value)) {
         foreach ($this->fallbacks as $fallback) {
            $value = CbSerializer::getObjectMember($object, $fallback);
            if (!empty($value)) {
               break;
            }
         }
      }

      return $value;
   }

   protected $fallbacks = NULL;
}
