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
 * Alias for Base serialize helper to make it look nicer if no fields are given.
 */
class CbSerializeWithArgs extends CbSerializeBase {
   function __construct($fields = array(), $args = array()) {
      if (!is_array($fields)) $fields = array($fields);
      if (!is_array($args)) $args = array($args);
      if (empty($args) && !empty($fields)) {
         parent::__construct($args, $fields);
      } else {
         parent::__construct($fields, $args);
      }
   }
}