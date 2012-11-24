<?php

require_once 'class.cb_serializer.php';

/**
 * Base serialize helper. Does nothing.
 */
class CbSerializeRaw {
   protected $args;

   function __construct($args = array()) {
      $this->args = $args;
   }
   function name($object, $name) {return $name;}

   function value($object, $name) {
      return CbSerializer::getObjectMember($object, $name, $this->args);
   }
}