<?php
if(isset($_POST["submit"])) {
  if(move_uploaded_file($_FILES['input_video']['tmp_name'] , basename($_FILES['input_video']['name'])) && move_uploaded_file($_FILES['input_audio']['tmp_name'] , basename($_FILES['input_audio']['name']))) {
    $cmd = "ffmpeg -y -i ".basename($_FILES['input_video']['name'])." -i ".basename($_FILES['input_audio']['name'])." -c copy -map 0:v -map 1:a output.mp4";
    echo "<script>console.log('Debug Objects: " . $cmd . "' );</script>";
    system($cmd);
  }
  else{
    echo "error uploading";
  }
}
?>
<html>
  <body>
    <form action="/functions/combine" method="POST" enctype="multipart/form-data">
      <input type="file" name="input_video" placeholder="video"><br><br>
      <input type="file" name="input_audio" placeholder="audio"><br><br>
      <input type="submit" name="submit">
    </form>
  </body>
</html>