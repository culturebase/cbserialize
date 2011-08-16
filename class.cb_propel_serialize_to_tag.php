<?php

class CbPropelSerializeToTag extends CbPropelSerializeNoop
{
  
  function value($object, $name)
  {
    $value = parent::value($object, $name);
   
    $result = "<div".$value."</value";
    return $result;
  }
}
?>
