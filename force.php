<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $bucket = getenv('AWS_BUCKET');
	$token = $_GET["token"];
	$aws = "https://s3.us-east-2.amazonaws.com";
    $location = "$aws/$bucket/file-$token";
    $title = $_GET['title'];
    header("Pragma: public");
    header('Expires: 0');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
    header("Cache-Control: public");    
    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$title\"");
    // Force the download           
    header("Content-Transfer-Encoding: binary");            
    readfile($location);
    exit;
}
?>