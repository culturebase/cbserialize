<?php

class CbPropelSerializeDateTime extends CbPropelSerializeRename
{
  public function __construct($a_sName, $a_sFormat)
  {
    parent::__construct($a_sName);
    $this->args = array($a_sFormat);
  }
  
  public function value($object, $name)
  {
    return parent::value($object, $name);
  }
  
  protected $myForamt = null;
}
?>
