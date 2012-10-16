<?php

require_once 'lib/framework/class.cb_propel_serializer.php';

class CbPropelSerializeArray extends CbPropelSerializeNoop {
   function value($object, $name) {
      $ret = array();
      foreach (CbPropelSerializer::getObjectMember($object, $name, $this->args) as $child) {
         $ret[] = CbPropelSerializer::childrenToArray($child, $this->fields);
      };
      return $ret;
   }
}