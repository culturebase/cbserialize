<?php

require_once 'lib/framework/class.cb_propel_serializer.php';

/**
 * Injects verbatim value into the array
 */
class CbPropelSerializeInject extends CbPropelSerializeNoop {

   function value($object, $value) {
      return $value;
   }
}