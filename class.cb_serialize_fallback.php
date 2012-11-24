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
require_once 'class.cb_serialize_base.php';

/**
 * return value of fallback properties
 *
 * @author Sarah
 */
class CbSerializeFallback extends CbSerializeBase {

   function __construct(array $fallbacks, $fields = array(), $args = array())
   {
      parent::__construct($fields, $args);
      $this->fallbacks = $fallbacks;
   }

   /**
    * returns the alternative value if the original value is empty
    *
    * The method if the value given by property <name> is empty
    * the first value of the fallback name which is not empty is returned
    *
    * @param type $object
    * @param type $name
    * @return type
    */
   function value($object, $name)
   {
      $value = CbSerializer::getObjectMember($object, $name);
      if (empty($value)) {
         foreach ($this->fallbacks as $fallback) {
            $value = CbSerializer::getObjectMember($object, $fallback);
            if (!empty($value)) {
               break;
            }
         }
      }

      return $value;
   }

   protected $fallbacks = NULL;
}
