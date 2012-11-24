<?php

require_once 'class.cb_serializer.php';

/**
 * Base serialize helper. Does nothing special.
 */
class CbSerializeBase {
   protected $fields;
   protected $args;

   function __construct($fields = array(), $args = array()) {
      $this->fields = $fields;
      $this->args = $args;
   }

   function name($object, $name) {return $name;}

   function value($object, $name) {
      return CbSerializer::childrenToArray(
           CbSerializer::getObjectMember($object, $name, $this->args), $this->fields);
   }
}