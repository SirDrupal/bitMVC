<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file
 *
 * @author lautarorosales
 */
class File_helper {
    static function read_dir($dir, $array = array()){
        $dh = opendir($dir);
        $files = array();
        while (($file = readdir($dh)) !== false) {
            $flag = false;
            if($file !== '.' && $file !== '..' && !in_array($file, $array)) {
                $files[] = $file;
            }
        }
    return $files;
    }
}

?>
