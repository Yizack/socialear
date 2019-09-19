<?php
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