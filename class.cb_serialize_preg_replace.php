<?php

require 'class.cb_serialize_str_replace.php';

class CbSerializePregReplace extends CbSerializeStrReplace {
   function action(&$val, $i) {
      return ($val = preg_replace($this->search, $this->replace, $val));
   }
}