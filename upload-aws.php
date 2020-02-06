<?php
require('vendor/autoload.php');
// AWS ini
$bucket = getenv('AWS_BUCKET');
$s3 = new Aws\S3\S3Client([
    'version'  => 'latest',
    'region'   => 'us-east-2',
    'credentials' => [
	    'key'    => getenv('AWS_KEY'),
	    'secret' => getenv('AWS_SECRET')
	]
]);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $location ="file";
  $url = $_POST['url'];
  $title = $_POST['title'];
  function download($location, $url){
      $fp = fopen($location, "w+");
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_exec($ch);
      curl_close($ch);
      fclose($fp);
      return 'done';
  }
  if(download($location, $url) === 'done'){
    $upload_video = $s3->upload($bucket, "file-$token", fopen($location, 'rb'), 'public-read');
    header("Location: http://socialear.yizack.com/force?title=$title&token=$token");
    die();
  }
}
?>