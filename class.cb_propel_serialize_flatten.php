<?php

require_once 'lib/framework/class.cb_propel_serialize_noop.php';

/**
 * Flatten one level of arrays in the value, discarding one level of keys. e.g.:
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

   function value($object, $name) {
      $result = array();
      foreach (parent::value($object, $name) as $obj) {
         $result = array_merge($result, array_values($obj));
      }
      return $result;
   }
}