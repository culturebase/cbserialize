<?php

require_once 'lib/cms/functions.misc.php';

/**
 * Recursively translate URLs and replace newlines with <br> in the value.
 */
class CbPropelSerializeToHtml extends CbPropelSerializeRecursive {
   function action(&$val, $i) {
      $val = nl2br(makeUrl($val));
      return $val;
   }
}