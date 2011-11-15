<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';

/**
 * Alias for Base serialize helper to make it look nicer if no fields are given.
 */
class CbPropelSerializeWithArgs extends CbPropelSerializeNoop {
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