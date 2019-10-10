<?php
  require("functions/global.php"); // Global functions
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
  // Twitter Functions
  require "functions/twitter.php";
  use Abraham\TwitterOAuth\TwitterOAuth;

  $consumer_key = getenv('CONSUMER_KEY');
  $consumer_secret_key = getenv('CONSUMER_SECRET_KEY');

  $access_token = getenv('ACCESS_TOKEN');
  $access_token_secret = getenv('ACCESS_TOKEN_SECRET');

  $connection = new TwitterOAuth($consumer_key, $consumer_secret_key, $access_token, $access_token_secret);
  $content = $connection->get("account/verify_credentials");
?>
<!DOCTYPE html>
<html lang="<?= $code; ?>">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
    <title><?= $sitename; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <link rel="stylesheet" href="https://afeld.github.io/emoji-css/emoji.css"/> <!-- https://afeld.github.io/emoji-css/ -->
  </head>
  <body class="bg-light">
    <div>
      <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
        <div class="container">
          <a class="navbar-brand" href="<?php if ($code !== "en"){e("/".$code);} else{e("/");} ?>"><?= $sitename; ?> <span class="badge badge-secondary">Beta</span></a>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $language; ?>: <?= "$flag ".strtoupper($code); ?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?= replace_lang("en", isset($_GET["lang"])); ?>"><i class="em-svg em-us"></i> English</a>
                <a class="dropdown-item" href="<?= replace_lang("es", isset($_GET["lang"])); ?>"><i class="em-svg em-es"></i> Español</a>
                <!--<a class="dropdown-item" href="/it"><i class="em-svg em-it"></i> Italiano</a>-->
                <!--<a class="dropdown-item" href="/pt"><i class="em-svg em-flag-pt"></i> Português</a>-->
                <!--<a class="dropdown-item" href="/fr"><i class="em-svg em-fr"></i> Français</a>-->
                <!--<a class="dropdown-item" href="/de"><i class="em-svg em-de"></i> Deutsch</a>-->
                <!--<a class="dropdown-item" href="/nl"><i class="em-svg em-flag-nl"></i> Nederlands</a>-->
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <section class="video_download text-white">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-1">
            <div class="text-center p-5">
              <h2><?= $video_twitter; ?></h2>
              <div id="video_image">
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["URL"]) && strpos($_GET["URL"], 'twitter.com') !== false) {
    $url = $_GET["URL"];
    $arr_url = explode("/", $url);
    $tweet_id = end($arr_url); 
    $tweet = getTweetInfo($connection,$tweet_id);
    $title = getTweetText($tweet);
    $title = str_replace("\r", "", $title);
    $title = str_replace("\n", "", $title);
    $thumbnail = getTweetImage($tweet);
    $video_array = getTweetVideo($tweet);
?>
                <a href="<?= $url ?>" target="_blank">
                  <img class="img-fluid d-inline" src="<?= $thumbnail ?>" alt="<?= $title ?>" title="<?= $title ?>" />
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 order-lg-2">
            <div class="mx-auto p-5">
              <p class="text-left" id="video_title"><?= $title; ?></p>
              <div class="mx-auto" id="video_options">
                <p class="text-left"><?= $options; ?>:</p>
<?php
for ($x = 0; $x < count($video_array); $x++) {
  $video = $video_array[$x]['url'];
  $last = explode("/", $video, substr_count($video, "/"));
  $txt = trim(end($last));
  $size[$x] = strstr($txt, '/', true);
?>
                <div class="input-group m-3"><div class="input-group-prepend"><span class="input-group-text text-monospace like-pre"><script>document.write(("'.$size[$x].'").padStart(9))</script></span></div><div class="input-group-append"><a class="btn btn-primary" href="'.$video.'" role="button"><i class="fas fa-download fa-fw"></i> '.$download.'</a></div></div>';
<?php
  }
    }
  }
?>
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
            <h2 class="text-center p-5"><?= $more_twitter; ?></h2>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="<?php if ($code !== "en"){e("/".$code);} ?>/twitter" method="get">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <div class="input-group">
                    <input class="form-control form-control" type="text" id="URL" placeholder="https://twitter.com/EstrellaOnline/status/1138052818017947648" name="URL">
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <button class="btn btn-success btn-block" type="submit"><?= $download; ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer class="py-5">
      <div class="container">
        <p class="text-center text-muted m-0 small">© <?= $sitename; ?> 2019. <?= $copyright; ?>.</p>
      </div>
    </footer>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/cc91b92ca8.js"></script>
  </body>
</html>