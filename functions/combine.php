<?php
    ftp://[user[:password]@]server[:port]/path/to/remote/resource.mpeg
    $user = getenv('FTP_USER');
    $password = getenv('FTP_PASSWORD');
    $host = getenv('FTP_HOST');
    $port = getenv('FTP_PORT');
    $path = getenv('FTP_PATH');
    $ftp = "ftp://$user:$password@$host:$port/$path";

    $video = "$ftp/videoplayback.mp4";
    $audio = "$ftp/videoplayback.mp3";
    $cmd = "ffmpeg -y -i $video -i $audio -c copy -map 0:v -map 1:a output.mp4";

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