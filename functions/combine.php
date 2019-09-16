<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET["video"]) && isset($_GET["audio"]) && isset($_GET["name"])){
        $filename = $_GET["name"].".mp4";
        $video = $_GET["video"];
        $audio = $_GET["audio"];
        $cmd = "ffmpeg -y -i ".$video." -i ".$audio." -c copy -map 0:v -map 1:a ".$filename;
        system($cmd);
        header("Content-Type: video/mp4");
        header('Content-disposition: attachment; filename='.$filename.'');
        readfile($filename);
        ignore_user_abort(true);
        if (file_exists($filename)) {
            unlink($filename);
        }
    }
}
?>