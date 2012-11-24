<?php

require_once 'lib/cms/functions.misc.php';
require_once 'class.cb_serialize_recursive.php';

/**
 * Recursively translate URLs and replace newlines with <br> in the value.
 */
class CbSerializeToHtml extends CbSerializeRecursive {
   function action(&$val, $i) {
      $val = nl2br(makeUrl($val));
      return $val;
   }
}