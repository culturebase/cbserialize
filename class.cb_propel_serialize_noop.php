<?php

require_once 'lib/framework/class.cb_propel_serializer.php';

/**
 * Base serialize helper. Does nothing.
 */
class CbPropelSerializeNoop {
   protected $fields;

   function __construct($fields = array()) {
      $this->fields = $fields;
   }

   function name($object, $name) {return $name;}

   function value($object, $name) {
      return CbPropelSerializer::childrenToArray(
              CbPropelSerializer::getObjectMember($object, $name), $this->fields);
   }
}