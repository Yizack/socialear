<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["token"])) {
		$token = $_GET["token"];
		$user = getenv('FTP_USER');
		$password = getenv('FTP_PASSWORD');
		$host = getenv('FTP_HOST');
		$port = getenv('FTP_PORT');
		$path = getenv('FTP_PATH');
		$ftp = "ftp://$user:$password@$host:$port/$path";

		$video = "$ftp/video-$token.mp4";
		$audio = "$ftp/video-$token.mp3";
		unlink("video-9e8e030673600415.mp4");
		system("cd output");
		$cmd = "ffmpeg -y -i $video -i $audio -c copy -map 0:v -map 1:a video-$token.mp4";
		system($cmd);
	}
}
?>