<?php
    $video = "http://socialearytapi.epizy.com/videoplayback.mp4";
    $audio = "http://socialearytapi.epizy.com/videoplayback.m4a";
    $cmd = "ffmpeg -y -i ".$video." -i ".$audio." -c copy -map 0:v -map 1:a output.mp4";
    system($cmd);
?>
<html>
  <body>
    <form action="/functions/combine" method="POST" enctype="multipart/form-data">
      <input type="file" name="input_video" id="input_video" placeholder="video"><br><br>
      <input type="file" name="input_audio" id="input_audio" placeholder="audio"><br><br>
      <button type="submit" name="submit">Combinar</button>
    </form>
  </body>
</html>