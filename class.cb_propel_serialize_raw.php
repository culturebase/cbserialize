<?php

require_once 'lib/framework/class.cb_propel_serializer.php';

/**
 * Base serialize helper. Does nothing.
 */
class CbPropelSerializeRaw {
   protected $args;

   function __construct($args = array()) {
      $this->args = $args;
   }

   function name($object, $name) {return $name;}

   function value($object, $name) {
      $val = CbPropelSerializer::getObjectMember($object, $name, $this->args);
      var_dump($val);
   }
}