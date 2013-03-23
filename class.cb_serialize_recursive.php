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
 * Translate the value using some action. If the value is in fact an array,
 * do this to all leaves of the array tree.
 */
abstract class CbSerializeRecursive extends CbSerializeBase {

   protected abstract function action(&$val, $i);

   function value($object, $name) {
      $val = parent::value($object, $name);
      if (is_array($val)) {
         return array_walk_recursive($val, array($this, 'action'));
      } else {
         return $this->action($val, 0);
      }
   }
}