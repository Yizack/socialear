<?php
  // Language
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["lang"])) {
      switch($_GET["lang"]) {
        case "es": require("strings/spanish.php"); break;
        case "it": require("strings/italian.php"); break;
        case "pt": require("strings/portuguese.php"); break;
        case "fr": require("strings/french.php"); break;
        case "de": require("strings/german.php"); break;
        case "nl": require("strings/dutch.php"); break;
        default: require("strings/english.php"); break;
      }
    }
    else {
      require("strings/english.php");
    }
  }
  // Youtube Functions
  require "functions/youtube.php";
?>
<!DOCTYPE html>
<html lang="<?php e($code) ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php e($sitename) ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div>
      <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
        <div class="container">
          <a class="navbar-brand" href="<?php if ($code !== "en"){e("/".$code);} else{echo "/";} ?>"><?php e($sitename) ?> <span class="badge badge-secondary">Beta</span></a>
        </div>
      </nav>
    </div>
    <section class="video_download text-white">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-1">
            <div class="text-center p-5">
              <h2><?php e($video_youtube) ?></h2>
              <div id="video_image">
<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["URL"]) && ((strpos($_GET["URL"], 'youtube.com') !== false) || (strpos($_GET["URL"], 'youtu.be') !== false))) {
      $url = $_GET["URL"];
      $title = "TODO";
      $thumbnail = "TODO";
      $video_array = getVideoInfo($url);
      echo '              <a href="'.$url.'" target="_blank">'."\n";
      echo '                <img class="img-fluid d-inline" src="'.$thumbnail.'" alt="'.$title.'" title="'.$title.'" />'."\n";
      echo '              </a>'."\n";
?>
              </div>
            </div>
          </div>
          <div class="col-lg-6 order-lg-2">
            <div class="mx-auto p-5">
              <p class="text-left" id="video_title"><?php echo $title ?></p>
              <div class="mx-auto" id="video_options">
                <p class="text-left"><?php e($options) ?></p><?php
      foreach ($video_array as $x => $val) {
        switch($val['itag']){
          case "160":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "133": 
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "134":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "135":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "298":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "136":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "299":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
          case "137":
            $video = $video_array[$x]['url'];
            $size = $video_array[$x]['quality_label'];
            writeOption($size, $video, $download);
            break;
        }
      }
    echo "\n";
    }
  }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h2 class="text-center p-5"><?php e($more_youtube) ?></h2>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="<?php if ($code !== "en"){e("/".$code);} ?>/twitter" method="get">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <div class="input-group">
                    <input class="form-control form-control" type="text" id="URL" placeholder="https://youtube.com/watch?v=afP4aEV66Nw" name="URL">
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <button class="btn btn-success btn-block" type="submit"><?php e($download) ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer class="py-5">
      <div class="container">
        <p class="text-center text-muted m-0 small">© <?php e($sitename) ?> 2019. <?php e($copyright) ?>.</p>
      </div>
    </footer>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/cc91b92ca8.js"></script>
  </body>
</html>
<?php
  function writeOption($size, $video, $download) {
    $htmlstring = '				<div class="input-group m-3"><div class="input-group-prepend"><span class="input-group-text text-monospace like-pre"><script>document.write(("'.$size.'").padStart(7))</script></span></div><div class="input-group-append"><a class="btn btn-primary" href="'.$video.'" role="button"><i class="fas fa-download fa-fw"></i> '.$download.'</a></div></div>';
      echo "\n".''.$htmlstring;
  }
?>