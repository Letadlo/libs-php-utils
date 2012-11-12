<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataType
 *
 * @author opravil.jan
 */
namespace Femoz\Utils;

class DataType extends \Nette\Object {

    //put your code here
    
    private static $accepStringBool = false;

    public static function setAcceptStringBool($value){
        self::$accepStringBool = $value;
    }
    
    public static function isStringBool($value){
       $value = \Nette\Utils\Strings::trim(\Nette\Utils\Strings::normalize(\Nette\Utils\Strings::upper(\Nette\Utils\Strings::fixEncoding($value))));
       $result = \Nette\Utils\Strings::match($value, "/TRUE|FALSE/");
       if ($result !== null){
           return true;
       }
       return false;
    }
    
    private static function fixStringBool($value){
       $value = \Nette\Utils\Strings::trim(\Nette\Utils\Strings::normalize(\Nette\Utils\Strings::upper(\Nette\Utils\Strings::fixEncoding($value))));
       switch ($value){
           case "TRUE" :
               return true;
               break;
           case "FALSE" :
               return false;
               break;
       }
    }

    public static function isBool($value) {
        if (is_bool($value) === true) {
            return true;
        }
        return false;
    }

    public static function isInt($value) {
        if (is_numeric($value) === true) {
            if (ctype_digit($value) === true) {
                return true;
            }
        }
        return false;
    }

    public static function isFloat($value) {
        if (is_numeric($value) === true) {
            if (ctype_digit($value) === false) {
                return true;
            }
        }
        return false;
    }

    public static function isHexadecimal($value) {
        if (ctype_xdigit($value) === true) {
            return true;
        }
        return false;
    }
    
    public static function isArray($value) {
        if (is_array($value) === true) {
            return true;
        }
        return false;
    }
    
    public static function isString($value) {
        if (is_string($value) === true) {
            return true;
        }
        return false;
    }
    
    public static function fixDataType($value){
        if (self::$accepStringBool === true){
            if (self::isStringBool($value) === true){
                return self::fixStringBool($value);
            }
        } 
        if(self::isBool($value) === true){
            return (bool) $value;
        } elseif (self::isInt($value) === true){
            return (int) $value;
        } elseif(self::isFloat($value)){
            return (float) $value;
        } elseif (self::isArray($value) === true){
            return $value;
        } elseif(self::isString($value)){
            return \Nette\Utils\Strings::fixEncoding(\Nette\Utils\Strings::trim(\Nette\Utils\Strings::normalize($value)));
        } 
        return $value; 
    }
}

?>
