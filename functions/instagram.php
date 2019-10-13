<?php
require("vendor/autoload.php");
use PHPHtmlParser\Dom;

function str_get_html($string) {
    $dom = new Dom;
    $dom->load($string);
    return $dom;
}
?>