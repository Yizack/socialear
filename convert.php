<?php
$files = glob("ffmpeg/output/*");
$now   = time();
foreach ($files as $file) {
	if (is_file($file)) {
      if ($now - filemtime($file) >= 60 * 10) { // 10 min
    	unlink($file);
    	}
    }
}
?>
<html>
  <body>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      if (isset($_GET["token"])) {
        $token = $_GET["token"];
        echo "    <p>Here is your converted video: <a href='/ffmpeg/output/video-$token.mp4'>video-$token.mp4</a></p>\n";
        echo "    <p>Note: You have 10 minutes to download, then it will be deleted.</p>\n";
      }
    }
  ?>
    <form action="http://socialearytapi.epizy.com/" method="POST" enctype="multipart/form-data">
      VIDEO<input type="file" name="input_video" placeholder="video"><br><br>
      AUDIO<input type="file" name="input_audio" placeholder="audio"><br><br>
      <input type="submit" name="submit">
    </form>
  </body>
</html>