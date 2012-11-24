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

require_once 'class.cb_serializer.php';

/**
 * Base serialize helper. Does nothing special.
 */
class CbSerializeBase {
   protected $fields;
   protected $args;

   function __construct($fields = array(), $args = array()) {
      $this->fields = $fields;
      $this->args = $args;
   }

   function name($object, $name) {return $name;}

   function value($object, $name) {
      return CbSerializer::childrenToArray(
           CbSerializer::getObjectMember($object, $name, $this->args), $this->fields);
   }
}