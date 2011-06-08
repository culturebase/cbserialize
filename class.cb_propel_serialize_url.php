<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';
require_once 'lib/cms/functions.misc.php';

/**
 * Recursively translate URLs in the value.
 */
class CbPropelSerializeUrl extends CbPropelSerializeRecursive {
   function action(&$val, $i) {
      $val = makeUrl($val);
      return $val;
   }
}