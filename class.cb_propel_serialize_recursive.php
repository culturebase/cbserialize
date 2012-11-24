<?php

/**
 * Translate the value using some action. If the value is in fact an array,
 * do this to all leafs of the object tree.
 */
abstract class CbPropelSerializeRecursive extends CbPropelSerializeNoop {

   protected abstract function action(&$val, $i);

   function value($object, $name) {
      $val = parent::value($object, $name);
      if (is_array($val)) {
         return array_walk_recursive($val, array($this, 'action'));
      } else {
         return $this->action($val, 0);
      }
   }
}