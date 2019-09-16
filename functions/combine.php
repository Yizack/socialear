<?php
if(isset($_POST["submit"])) {
  $cmd = "ffmpeg -y -i ".basename($_FILES['input_video']['name'])." -i ".basename($_FILES['input_audio']['name'])." -c copy -map 0:v -map 1:a output.mp4";
}
 /*   $filename = $_POST['filename'];  
    $url = $_POST['url'];
    header('Content-Type: video/mp4');
    header("Content-disposition: attachment; filename=\"".$filename."\""); 
    readfile($url);
*/

?>
<html>
  <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
      <input type="file" name="input_video" placeholder="video"><br><br>
      <input type="file" name="input_audio" placeholder="audio"><br><br>
      <input type="submit" name="submit">
    </form>
  </body>
</html>