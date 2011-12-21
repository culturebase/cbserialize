<?php

/**
 * Recursively translate HTML entities to plain text.
 */
class CbPropelSerializeStrReplace extends CbPropelSerializeRecursive {
   function __construct($search, $replace, $fields = array(), $args = array()) {
      parent::__construct($fields, $args);
      $this->search = $search;
      $this->replace = $replace;
   }
   
   function action(&$val, $i) {
      $val = str_replace($this->search, $this->replace, $val);
      return $val;
   }
}