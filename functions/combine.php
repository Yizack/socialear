<?php

        $filename = "turnstodust.mp4";
        $video = "https://r4---sn-t0a7ln7d.googlevideo.com/videoplayback?expire=1568608007&ei=p7p-XavkK5Wphgbd-bagAw&ip=54.173.67.124&id=o-AHF_-EsxPRBY3tF9zPmALPBOFJRK7g0W2aIOYo3cjsvS&itag=137&aitags=133,134,135,136,137,160,242,243,244,247,248,278&source=youtube&requiressl=yes&mm=31,26&mn=sn-t0a7ln7d,sn-vgqskne6&ms=au,onr&mv=u&mvi=3&pl=24&mime=video/mp4&gir=yes&clen=191740876&dur=857.356&lmt=1568584161400394&mt=1568586199&fvip=4&keepalive=yes&fexp=23842631&c=WEB&txp=4535432&sparams=expire,ei,ip,id,aitags,source,requiressl,mime,gir,clen,dur,lmt&sig=ALgxI2wwRgIhAIPZxWKhl4wygafik31JuCISNBpU71byULDiEdr9TXtPAiEA2rbLKbIXTg3UDdNtuXQUVDuRng3y9jA9iZLZVcJ8VLE=&lsparams=mm,mn,ms,mv,mvi,pl&lsig=AHylml4wRQIgK5yRAR21DJIh-euTgJy2CUcIWL1-7RU0_oZQOLe0Sv8CIQDC8mzsVD1q5rkert37b_YZ7bZFiuabHUt7mFlF3zJwqg==";
        $audio = "https://r6---sn-aigzrney.googlevideo.com/videoplayback?expire=1568602969&ei=-aZ-XeGTJY7YVLLRg9AB&ip=185.27.134.184&id=o-AE7anyoIkLdDBsHeAP_lx0OCSPVQ8aWT8TbnLKh-cEXD&itag=140&source=youtube&requiressl=yes&mm=31,29&mn=sn-aigzrney,sn-aigl6nl7&ms=au,rdu&mv=m&mvi=5&pl=23&initcwndbps=1757500&mime=audio/mp4&gir=yes&clen=4403871&dur=272.068&lmt=1563399989370285&mt=1568581299&fvip=1&keepalive=yes&c=WEB&txp=2201222&sparams=expire,ei,ip,id,itag,source,requiressl,mime,gir,clen,dur,lmt&sig=ALgxI2wwRQIhAPL20LnKk3VK_CsagooBHQCyzmNeGxeJUhjyizQ0uA-BAiBK0cNBrxnXVy7QTIt_yci0zN-s758ZJswmQg1JtXu-nQ==&lsparams=mm,mn,ms,mv,mvi,pl,initcwndbps&lsig=AHylml4wRQIhALF8OyQpjrTZqBFMCBc2AupZDalZkQm6Jh_tBqfe_t4sAiBKXpnuONiBQN9FMzFC3ZCbg9iId2XP07_6UUbZxXNnqA==";
        $cmd = "ffmpeg -y -i ".$video." -i ".$audio." -c copy -map 0:v -map 1:a ".$filename;
        system($cmd);
        header("Content-Type: video/mp4");
        header('Content-disposition: attachment; filename='.$filename.'');
        readfile($filename);
        ignore_user_abort(true);
        if (file_exists($filename)) {
            unlink($filename);
        }

?>