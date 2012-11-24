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