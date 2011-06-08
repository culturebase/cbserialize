<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';

/**
 *
 */
class CbPropelSerializeRename extends CbPropelSerializeNoop {
   protected $name;
   protected $fields;

   function __construct($name, $fields = null) {
      $this->name = $name;
      $this->fields = $fields;
   }

   function name($object, $name) {
      return $this->name;
   }
}