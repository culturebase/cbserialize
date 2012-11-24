<?php

require_once 'class.cb_serialize_base.php';

/**
 * Injects verbatim value into the array
 */
class CbSerializeInject extends CbSerializeBase {

   function value($object, $name) {
      return $this->fields;
   }
}