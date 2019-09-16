  <?php
    $filename = $_POST['filename'];  
    $url = $_POST['url'];
    header('Content-Type: video/mp4');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"".$filename."\""); 
    readfile($url);
?>