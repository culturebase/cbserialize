<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';

/**
 * Flatten some levels of arrays in the value, optionally discarding the keys. e.g.:
 *
 * array("genres" => array(
 *    array("genre" => "genre_1"),
 *    array("genre" => "genre_5"),
 *    array("genre" => "genre_12")
 * )
 *
 * becomes:
 *
 * array("genres" => array("genre_1", "genre_5", "genre_12"))
 */
class CbPropelSerializeFlatten extends CbPropelSerializeNoop {

   protected $num_levels;
   protected $strip_keys;

   function __construct($num_levels = 1, $strip_keys = true, $fields = array()) {
      parent::__construct($fields);
      $this->num_levels = $num_levels;
      $this->strip_keys = $strip_keys;
   }

   function value($object, $name) {
      $result = parent::value($object, $name);
      for ($level = 0; $level < $this->num_levels; $level++) {
         $old_result = $result;
         $result = array();
         foreach ($old_result as $key => $obj) {
            if (is_int($key)) {
               if (is_array($obj)) $result = array_merge($result,
                       ($this->strip_keys ? array_values($obj) : $obj));
            } else {
               $result[] = $obj;
            }
         }
      }
      return $result;
   }
}