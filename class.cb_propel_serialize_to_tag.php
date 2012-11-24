<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';

class CbPropelSerializeToTag extends CbPropelSerializeNoop
{
  
  function value($object, $name)
  {
    $value = parent::value($object, $name);
   
    $result = "<div>".$value."</div>";
    return $result;
  }
}
?>
