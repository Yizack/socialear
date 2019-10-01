<?php
require('vendor/autoload.php');
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
		$bucket = getenv('AWS_SECRET');
		$token = $_GET["token"];
		$video  = $s3->getObject([
			'Bucket' => $bucket,
			'Key'    => "video-$token.mp4"
		]);
		$audio  = $s3->getObject([
			'Bucket' => $bucket,
			'Key'    => "video-$token.mp3"
		]);
		$cmd = "ffmpeg -y -i $video -i $audio -c copy -map 0:v -map 1:a output/video-$token.mp4";
		system($cmd);
	}
}
?>