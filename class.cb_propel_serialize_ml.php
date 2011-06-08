<?php

/**
 * Recursively translate the value using ML.
 */
class CbPropelSerializeMl extends CbPropelSerializeRecursive {
   protected $prefix;

   protected function action(&$val, $i) {
      $val = ml($this->prefix.$val);
      return $val;
   }

   function __construct($prefix = '', $fields = array()) {
      parent::__construct($fields);
      $this->prefix = $prefix;
   }
}