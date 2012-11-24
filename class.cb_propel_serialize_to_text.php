<?php

/**
 * Recursively translate HTML entities to plain text.
 */
class CbPropelSerializeToText extends CbPropelSerializeRecursive {
   function action(&$val, $i) {
      $val = html_entity_decode($val, ENT_QUOTES, "UTF-8");
      return $val;
   }
}