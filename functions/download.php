  <?php
    $filename = $_GET['filename'];  
    $url = $_GET['url'];
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"".$filename."\""); 
    readfile($url);
?>