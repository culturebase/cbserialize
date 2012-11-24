<?php

/**
 * Handle name and value by different sub-serializers.
 */
class CbSerializeComposite {
   protected $name_helper;
   protected $value_helper;

   function __construct($name_helper, $value_helper) {
      $this->name_helper = $name_helper;
      $this->value_helper = $value_helper;
   }

   function name($object, $name) {
      return $this->name_helper->name($object, $name);
   }

   function value($object, $name) {
      return $this->value_helper->value($object, $name);
   }

}