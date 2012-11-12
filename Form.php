<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author opravil.jan
 */

namespace Femoz\Utils;

class Form extends \Nette\Object {

    //put your code here

    public static function cleanValues($values) {
        foreach ($values->getIterator() as $key => $temp) {
            $value = $values->offsetGet($key);
            if (is_bool($value) !== true) {
                if (is_numeric($value) !== true) {
                    if (($value instanceof \Nette\Http\FileUpload) !== true) {
                        $temp = \Nette\Utils\Strings::trim(\Nette\Utils\Strings::normalize($temp));
                        $values->offsetSet($key, $temp);
                    }
                    if ($values->offsetGet($key) === "") {
                        $values->offsetSet($key, null);
                    }
                } else {
                        $values->offsetSet($key, DataType::fixDataType($value));
                }
            } else {
                $values->offsetSet($key, DataType::fixDataType($value));
            }
        }
        return $values;
    }
}

?>
