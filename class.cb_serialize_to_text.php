<?php

require_once 'class.cb_serialize_recursive.php';

/**
 * Recursively translate HTML entities to plain text.
 */
class CbSerializeToText extends CbSerializeRecursive {
   function action(&$val, $i) {
      $val = html_entity_decode($val, ENT_QUOTES, "UTF-8");
      return $val;
   }
}