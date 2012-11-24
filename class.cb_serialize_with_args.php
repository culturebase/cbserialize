<?php

require_once 'class.cb_serialize_base.php';

/**
 * Alias for Base serialize helper to make it look nicer if no fields are given.
 */
class CbSerializeWithArgs extends CbSerializeBase {
   function __construct($fields = array(), $args = array()) {
      if (!is_array($fields)) $fields = array($fields);
      if (!is_array($args)) $args = array($args);
      if (empty($args) && !empty($fields)) {
         parent::__construct($args, $fields);
      } else {
         parent::__construct($fields, $args);
      }
   }
}