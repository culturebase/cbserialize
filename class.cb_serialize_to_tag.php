<?php

require_once 'class.cb_serialize_base.php';

class CbSerializeToTag extends CbSerializeBase
{
  function value($object, $name)
  {
    return "<div>".parent::value($object, $name)."</div>";
  }
}
