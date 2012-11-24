<?php

require_once 'class.cb_serialize_recursive.php';

/**
 * Recursively translate strings.
 */
class CbSerializeStrReplace extends CbSerializeRecursive {
   function __construct($search, $replace, $fields = array(), $args = array()) {
      parent::__construct($fields, $args);
      $this->search = $search;
      $this->replace = $replace;
   }

   function action(&$val, $i) {
      return ($val = str_replace($this->search, $this->replace, $val));
   }
}