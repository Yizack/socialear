<?php

function downloadInput($url, $fileName){
    $downloadedFileContents = file_get_contents($url);

    if($downloadedFileContents === false){
        throw new Exception('Failed to download file at: ' . $url);
    }

    $save = file_put_contents($fileName, $downloadedFileContents);

    if($save === false){
        throw new Exception('Failed to save file to: ' , $fileName);
    }
}

        $filename = "turnstodust.mp4";
        $video = "https://r6---sn-aigzrney.googlevideo.com/videoplayback?expire=1568602969&ei=-aZ-XeGTJY7YVLLRg9AB&ip=185.27.134.184&id=o-AE7anyoIkLdDBsHeAP_lx0OCSPVQ8aWT8TbnLKh-cEXD&itag=136&aitags=133%2C134%2C135%2C136%2C137%2C160%2C242%2C243%2C244%2C247%2C248%2C278%2C298%2C299%2C302%2C303&source=youtube&requiressl=yes&mm=31%2C29&mn=sn-aigzrney%2Csn-aigl6nl7&ms=au%2Crdu&mv=m&mvi=5&pl=23&initcwndbps=1757500&mime=video%2Fmp4&gir=yes&clen=10203688&dur=271.999&lmt=1563400037840114&mt=1568581299&fvip=1&keepalive=yes&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=ALgxI2wwRAIgFZ_eVLBPmaNA373s5B_W0_86z_D8lDBobVGeU0vUrL4CIBwMX1QBoLn5W495Rr7bOMMpMYWsPaf2-E7OUjU9pN-o&lsparams=mm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AHylml4wRQIhALF8OyQpjrTZqBFMCBc2AupZDalZkQm6Jh_tBqfe_t4sAiBKXpnuONiBQN9FMzFC3ZCbg9iId2XP07_6UUbZxXNnqA%3D%3D";
        $audio = "https://r6---sn-aigzrney.googlevideo.com/videoplayback?expire=1568602969&ei=-aZ-XeGTJY7YVLLRg9AB&ip=185.27.134.184&id=o-AE7anyoIkLdDBsHeAP_lx0OCSPVQ8aWT8TbnLKh-cEXD&itag=140&source=youtube&requiressl=yes&mm=31%2C29&mn=sn-aigzrney%2Csn-aigl6nl7&ms=au%2Crdu&mv=m&mvi=5&pl=23&initcwndbps=1757500&mime=audio%2Fmp4&gir=yes&clen=4403871&dur=272.068&lmt=1563399989370285&mt=1568581299&fvip=1&keepalive=yes&c=WEB&txp=2201222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=ALgxI2wwRQIhAPL20LnKk3VK_CsagooBHQCyzmNeGxeJUhjyizQ0uA-BAiBK0cNBrxnXVy7QTIt_yci0zN-s758ZJswmQg1JtXu-nQ%3D%3D&lsparams=mm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AHylml4wRQIhALF8OyQpjrTZqBFMCBc2AupZDalZkQm6Jh_tBqfe_t4sAiBKXpnuONiBQN9FMzFC3ZCbg9iId2XP07_6UUbZxXNnqA%3D%3D";
        downloadInput($video,"video_input.mp4");
        downloadInput($audio,"audio_input.mp3");
        $cmd = "ffmpeg -y -i video_input.mp4 -i audio_input.mp3 -c copy -map 0:v -map 1:a $filename";
        system($cmd);
        header("Content-Type: video/mp4");
        header('Content-disposition: attachment; filename='.$filename.'');
        readfile($filename);
        ignore_user_abort(true);
        if (file_exists($filename)) {
            unlink($filename);
        }
        if (file_exists("video_input.mp4")) {
            unlink("video_input.mp4");
        }
        if (file_exists("audio_input.mp3")) {
            unlink("audio_input.mp3");
        }

?>