<?php

// LANGUAGE CHANGE
function replace_lang($code, $isset_lang){
    $var = array();
    if(!$isset_lang) {
            $uri = $_SERVER['REQUEST_URI'];
            $var = preg_split("#/#", $uri); 
            $var[0] = "/$code";
    }
    else {
            $uri = $_SERVER['REQUEST_URI'];
            $var = preg_split("#/#", $uri); 
            $var[1] = $code;
    }
    e(join("/",$var));
}

// SHORT echo FUNCTION
function e($text) {
    echo $text;
}

// HTML BOLD
function bold($string) {
    return "<b>$string</b>";
}

// HTML QUOTATION
function quotation($string) {
    return '"'.$string.'"';
}

?>