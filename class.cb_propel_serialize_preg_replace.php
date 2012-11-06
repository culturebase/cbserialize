<?php

class CbPropelSerializePregReplace extends CbPropelSerializeStrReplace {
   function action(&$val, $i) {
      return ($val = preg_replace($this->search, $this->replace, $val));
   }
}