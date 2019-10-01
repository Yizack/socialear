<?php
require('../vendor/autoload.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["token"])) {
		$s3 = new Aws\S3\S3Client([
			'version'  => 'latest',
			'region'   => 'us-east-2',
			'credentials' => [
				'key'    => getenv('AWS_KEY'),
				'secret' => getenv('AWS_SECRET')
			]
		]);
		$bucket = getenv('AWS_BUCKET');
		$token = $_GET["token"];
		$aws = "http://s3.us-east-2.amazonaws.com";
		$video  = "$aws/$bucket/video-$token.mp4";
		$audio  = "$aws/$bucket/video-$token.mp3";
		$cmd = "ffmpeg -y -i $video -i $audio -c copy -map 0:v -map 1:a output/video-$token.mp4";
		system($cmd);
	}
}
?>