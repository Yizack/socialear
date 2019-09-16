<?php 
    $cmd = "ffmpeg -y -i video_input.mp4 -i audio_input.mp3 -c copy -map 0:v -map 1:a output.mp4";
    system($cmd);
?>