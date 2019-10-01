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

if(isset($_POST["submit"]) && isset($_FILES['input_video']) && isset($_FILES['input_audio'])) {
    $token = bin2hex(random_bytes(8));
    $ext_audio = pathinfo($_FILES["input_audio"]["name"], PATHINFO_EXTENSION);
    $mimetype_video = mime_content_type($_FILES['input_video']['tmp_name']);
    if (in_array($mimetype_video, array('video/mp4', 'video/x-m4v')) && $ext_audio === "mp3" || $ext_audio === "m4a") {
        try {
            $upload_video = $s3->upload($bucket, "video-$token.mp4", fopen($_FILES['input_video']['tmp_name'], 'rb'), 'public-read');
            $upload_audio = $s3->upload($bucket, "video-$token.mp3", fopen($_FILES['input_audio']['tmp_name'], 'rb'), 'public-read');
            file_get_contents("https://socialear.yizack.com/ffmpeg/merge?token=$token");
            $s3->deleteObject([
                'Bucket' => $bucket,
                'Key'    => "video-$token.mp4"
            ]);
            $s3->deleteObject([
                'Bucket' => $bucket,
                'Key'    => "video-$token.mp3"
            ]);
            header("Location: https://socialear.yizack.com/merge?token=$token");
            exit();
        }
        catch(Exception $e){
            header("Location: https://socialear.yizack.com/merge?error=upload");
            exit();
        }
    }
    else {
        header("Location: https://socialear.yizack.com/merge?error=format");
        exit();
    }
}
else {
    echo "No uploaded files found, use <b>Merge</b> tool at: <a href='https://socialear.yizack.com/merge'>https://socialear.yizack.com/merge</a>";
}
?>