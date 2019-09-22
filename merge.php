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
<!DOCTYPE html>
<html lang="<?php e($code) ?>">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
    <title><?php e($sitename) ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"/>
    <link rel="stylesheet" href="https://afeld.github.io/emoji-css/emoji.css"/> <!-- https://afeld.github.io/emoji-css/ -->
  </head>
  <body>
  <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
      <div class="container">
        <a class="navbar-brand" href="#">Socialear <span class="badge badge-secondary">Beta</span></a>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language: <i class="em-svg em-us"></i> EN</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/en"><i class="em-svg em-us"></i> English</a>
              <a class="dropdown-item" href="/es"><i class="em-svg em-es"></i> Español</a>
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
    <header class="text-white text-center" style="background:#343a40;">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto mt-5 mb-5">
            <h1 class="mb-5">Merge video and audio</h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto text-left">
            <?php
              if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["token"])) {
                  $token = $_GET["token"];
                  e("            <div class='alert alert-success'>\n");
                  e("            <strong>Success!</strong> Here is your converted video: <a href='/ffmpeg/output/video-$token.mp4'>video-$token.mp4</a>\n");
                  e("            </div>\n");
                }
                else if(isset($_GET["error"])) {
                  switch($_GET["error"]) {
                    case "format":
                      e("            <div class='alert alert-danger'>\n");
                      e("            <strong>Error:</strong> Invalid file format.\n");
                      e("            </div>\n");
                      break;
                    case "upload":
                      e("            <div class='alert alert-danger'>\n");
                      e("            <strong>Error:</strong> Uploading error.\n");
                      e("            </div>\n");
                      break;
                  }
                }
              }
            ?>
            <h2>Choose your files</h2>
            <form action="http://socialearytapi.epizy.com/" method="POST" enctype="multipart/form-data">
              <p>Video:</p>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="input_video" name="input_video" accept="video/mp4" required>
                <label class="custom-file-label" for="input_video" >Choose <b>video</b> file</label>
              </div>
              <p>Audio:</p>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="input_audio" name="input_audio" accept="audio/mp3, audio/x-m4a" required>
                <label class="custom-file-label" for="input_audio">Choose <b>audio</b> file</label>
              </div>
              <div class="mt-3 mb-5">
                <button class="btn btn-success btn-block" id="submit" name="submit" type="submit" onclick="loading();">Merge</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </header>
    <section>
      <div class="container mt-5 mb-5" id="how-to-use">
        <div class="text-center text-dark">
          <h3>How to use Merge</h3>
        </div>
        <div class="text-left text-dark">
          <h3><small>Step 1</small></h3>
          <p>Have downloaded a <b>"video-only"</b> and an <b>"audio-only"</b> files at <a href="/youtube" target="_blank">https://socialear.yizack.com/youtube</a>.</p>
          <h3><small>Step 2</small></h3>
          <p>Choose your <b>"video-only"</b> file.</p>
          <h3><small>Step 3</small></h3>
          <p>Choose your <b>"audio-only"</b> file.</p>
          <h3><small>Step 4</small></h3>
          <p>Click on <b>"Merge"</b> button and wait for files to upload.</p>
          <h3><small>Step 5</small></h3>
          <p>A link to your temporary merged video will appear with a unique identifier.</p>
          <p><span class="badge badge-secondary">Note 1:</span> Your merged video will be deleted from our servers in 10 minutes.</p>
          <h3><small>Step 6</small></h3>
          <p>Click on your link, then download it or <b>"Right Click"</b> on your link then click <b>"Save link as..."</b> to download.</p>
        </div>
      </div>
    </section>
    <footer class="footer" style="background:#343a40;">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 my-auto h-100 text-center text-lg-left">
            <ul class="list-inline mb-2">
              <li class="list-inline-item"><a href="#"><?php e($about) ?></a></li>
              <li class="list-inline-item"><span>⋅</span></li>
              <li class="list-inline-item"><a href="#"><?php e($contact) ?></a></li>
              <li class="list-inline-item"><span>⋅</span></li>
              <li class="list-inline-item"><a href="#"><?php e($terms) ?></a></li>
              <li class="list-inline-item"><span>⋅</span></li>
              <li class="list-inline-item"><a href="#"><?php e($privacy) ?></a></li>
            </ul>
            <p class="text-muted small mb-4 mb-lg-0">© <?php e($sitename) ?> 2019. <?php e($copyright) ?>.</p>
          </div>
          <div class="col-lg-6 my-auto h-100 text-center text-lg-right">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-fw facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw twitter"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-fw instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/cc91b92ca8.js"></script>
    <script> 
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        function loading(){
            $("#submit").html('<span class="spinner-border spinner-border-sm"></span> Uploading...');
        }
    </script>
  </body>
</html>