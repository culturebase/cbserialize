<?php

require_once 'class.cb_serialize_recursive.php';

/**
 * Recursively translate the value using ML.
 */
class CbSerializeMl extends CbSerializeRecursive {
   protected $prefix;

   protected function action(&$val, $i) {
      $val = ml($this->prefix.$val);
      return $val;
   }

   function __construct($prefix = '', $fields = array(), $args = array()) {
      parent::__construct($fields, $args);
      $this->prefix = $prefix;
   }
}