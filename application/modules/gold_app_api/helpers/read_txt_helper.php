<?php

class ReadTxt {

    static function readkey(){
        $myfile = fopen(__DIR__ ."/../assets/jwt_key.txt", "r") or die("Unable to open file!");
        $key = fread($myfile,filesize(__DIR__ ."/../assets/jwt_key.txt"));
        fclose($myfile);
        return $key;
    }
}

?>