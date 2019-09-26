<?php
    # itag list for videos and audio this project will use

    # for 144p
    #   160 144p mp4 (video only)

    # for 240p
    #   133 240p mp4 (video only)

    # for 360p
    #   134 360p mp4 (video only)

    # for 480p
    #   135 480p mp4 (video only)

    # for 720p
    #   298 1080p60 mp4 (video only) <- 60fps
    #   136 1080p mp4 (video only)

    # for 1080p
    #   299 1080p60 mp4 (video only) <- 60fps
    #   137 1080p mp4 (video only)

    # for Audio
    #   140 128kps 44100Hz mp4a (audio only)

    // Return video ID
    function getID($url) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $id = $match[1];
        return $id;
    }

    // Return video info array
    function getVideoInfo($url) {
        $id = getID($url);
        $data = file_get_contents("http://youtube.com/get_video_info?video_id=$id");
        $output = array();
        parse_str($data , $details);
        foreach (explode(',' , $details['adaptive_fmts']) AS $quality) {
            parse_str($quality , $video);
            $output[] = $video;
        }
        return $output;
    }
   
    // Return thumbnail
    function getThumbnail($url) {
        $id = getID($url);
        $thumbnail = "http://img.youtube.com/vi/$id/maxresdefault.jpg";
        return $thumbnail;
    }

    function getTitle($url) {
        $id = getID($url);
        $json = file_get_contents("http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$id&format=json"); //get JSON video details
        $details = json_decode($json, true); //parse the JSON into an array
        return $details['title']; //return the video title
    }

    // Return match itag index
    function foritag($itag, $array) {
        foreach ($array as $index => $val) {
            if ($val['itag'] === $itag) {
                return $index;
            }
        }
        return null;
    }

    // Return value from parameter inside of an array matching itag
    function getValue($itag, $array, $parameter) {
        $index = foritag($itag, $array);
        return $array[$index][$parameter];
    }
?>
