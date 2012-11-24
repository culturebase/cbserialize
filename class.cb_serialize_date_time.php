<?php

require_once 'class.cb_serialize_rename.php';

class CbSerializeDateTime extends CbSerializeRename
{
  public function __construct($name, $format)
  {
    parent::__construct($name);
    $this->args = array($format);
  }

  public function value($object, $name)
  {
    return parent::value($object, $name);
  }
}
