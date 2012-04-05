<?php


/**
 * return value of fallback properties
 *
 * @author Sarah
 */
class CbPropelSerializeFallback extends CbPropelSerializeNoop
{
  function __construct(array $a_aFallbacks, $fields = array(), $args = array()) {
    parent::__construct($fields, $args);
    $this->myFallbacks = $a_aFallbacks;
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
    error_log(__CLASS__." class = ".get_class($object).", name = ".$name);
    $l_sValue = parent::value($object, $name);
    if ( empty($l_sValue) )
      {
        foreach ( $this->myFallbacks as $l_sFallbackName )
          {
            $l_sValue = parent::value($object, $l_sFallbackName);
            if ( ! empty ($l_sValue) )
              {
                break;
              }
          }
      }
    
    return $l_sValue;
  }
  
  protected $myFallbacks = NULL;
}
?>
