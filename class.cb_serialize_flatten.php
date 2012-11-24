<?php
/* This file is part of cbserialize.
 * Copyright © 2011-2012 stiftung kulturserver.de ggmbh <github@culturebase.org>
 *
 * cbserialize is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * cbserialize is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with cbserialize.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'class.cb_serialize_base.php';

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
class CbSerializeFlatten extends CbSerializeBase {

   protected $num_levels;
   protected $strip;

   const STRIP_NONE =       0;
   const STRIP_KEYS =       1;
   const STRIP_LAST_LEVEL = 2;
   const STRIP_BOTH =       3;

   /**
    * Create a flattening serializer.
    * @param num_levels How many levels of arrays shall be stripped.
    * @param strip Strip mode:
    *    STRIP_KEYS       means all array keys are dropped.
    *    STRIP_LAST_LEVEL means on the last level values are added up instead of
    *                     array-merged. This is useful for values where the last
    *                     array consists of only one value.
    */
   function __construct($num_levels = 1, $strip = self::STRIP_KEYS,
         $fields = array(), $args = array()) {
      parent::__construct($fields, $args);
      $this->num_levels = $num_levels;
      $this->strip = $strip;
   }

   function value($object, $name) {
      $result = parent::value($object, $name);
      for ($level = 0; $level < $this->num_levels; ++$level) {
         $old_result = $result;
         $do_strip = ($level == $this->num_levels - 1 &&
               ($this->strip & self::STRIP_LAST_LEVEL) != 0);
         $result = $do_strip ? NULL : array();
         if ($old_result === NULL) continue;
         foreach ($old_result as $key => $obj) {
            if ($do_strip) {
               if ($result === NULL) {
                  $result = $obj;
               } else {
                  $result += $obj;
               }
            } else {
               if (is_int($key)) {
                  if (is_array($obj)) {
                     $result = array_merge($result,
                           ($this->strip & self::STRIP_KEYS) != 0 ?
                           array_values($obj) : $obj);
                  }
               } else {
                  $result[] = $obj;
               }
            }
         }
      }
      return $result;
   }
}
