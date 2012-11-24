<?php

require_once 'class.cb_serialize_base.php';

class CbSerializeRename extends CbSerializeBase {
   protected $name;

   function __construct($name, $fields = null, $args = array()) {
      parent::__construct($fields, $args);
      $this->name = $name;
   }

   function name($object, $name) {
      return $this->name;
   }
}