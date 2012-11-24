<?php

require_once 'class.cb_serializer.php';
require_once 'class.cb_serialize_base.php';

class CbSerializeArray extends CbSerializeBase {
   function value($object, $name) {
      $ret = array();
      foreach (CbSerializer::getObjectMember($object, $name, $this->args) as $child) {
         $ret[] = CbSerializer::childrenToArray($child, $this->fields);
      };
      return $ret;
   }
}