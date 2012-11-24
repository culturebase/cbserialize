<?php

require_once 'lib/framework/class.cb_propel_serializer.php';

/**
 * Base serialize helper. Does nothing.
 */
class CbPropelSerializeNoop {
   protected $fields;
   protected $args;

   function __construct($fields = array(), $args = array()) {
      $this->fields = $fields;
      $this->args = $args;
   }

   function name($object, $name) {return $name;}

   function value($object, $name) {
      return CbPropelSerializer::childrenToArray(
              CbPropelSerializer::getObjectMember($object, $name, $this->args), $this->fields);
   }
}