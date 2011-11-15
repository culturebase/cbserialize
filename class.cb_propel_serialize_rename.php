<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';

/**
 *
 */
class CbPropelSerializeRename extends CbPropelSerializeNoop {
   protected $name;

   function __construct($name, $fields = null, $args = array()) {
      parent::__construct($fields, $args);
      $this->name = $name;
   }

   function name($object, $name) {
      return $this->name;
   }
}