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
?>
<!DOCTYPE html>
<html lang="<?php e($code) ?>">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
    <title><?php e($sitename) ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic"/>
    <link rel="stylesheet" href="https://afeld.github.io/emoji-css/emoji.css"/> <!-- https://afeld.github.io/emoji-css/ -->
    <style>
      .pointer{
        cursor: pointer;
      }
      .pointer:active{
        background: #dfe4e7;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
      <div class="container">
        <a class="navbar-brand" href="#"><?php e($sitename) ?> <span class="badge badge-secondary">Beta</span></a>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php e($language) ?>: <?php e("$flag ".strtoupper($code)) ?></a>
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
    <header class="masthead text-white text-center" style="background:#343a40;">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5"><?php e($sitename) ?></h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="<?php if ($code !== "en"){e("/".$code);} ?>/instagram" method="get">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="social_dropdown" type="button">Instagram</button>
                      <div class="dropdown-menu"role="menu">
                        <a onclick="instagram_form()" class="dropdown-item pointer" id="Instagram">Instagram</a>
                        <a onclick="twitter_form()" class="dropdown-item pointer" id="Twitter">Twitter</a>
                        <a onclick="facebook_form()" class="dropdown-item pointer" id="Facebook">Facebook</a>
                        <a onclick="youtube_form()" class="dropdown-item pointer" id="Youtube">Youtube</a>
                      </div>
                    </div>
                    <input class="form-control form-control" type="text" id="URL" placeholder="https://instagram.com/p/B0qVP-4ncRi/" name="URL">
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
    </header>
    <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <p><?php e($associated) ?></p>
      </div>
    </div>
    </div>
  </section>
    <script>
      function social_form(social){
        document.getElementById("social_dropdown").innerHTML = social;
      }
      function instagram_form(){
        social_form(document.getElementById("Instagram").text);
        $("#URL").attr("placeholder", "https://instagram.com/p/B0qVP-4ncRi");
        $("form").attr("action", "<?php if ($code !== "en"){e("/".$code);} ?>/instagram");
      }
      function twitter_form(){
        social_form(document.getElementById("Twitter").text);
        $("#URL").attr("placeholder", "https://twitter.com/EstrellaOnline/status/1138052818017947648");
        $("form").attr("action", "<?php if ($code !== "en"){e("/".$code);} ?>/twitter");
      }
      function youtube_form(){
        social_form(document.getElementById("Youtube").text);
        $("#URL").attr("placeholder", "https://youtube.com/watch?v=afP4aEV66Nw");
        $("form").attr("action", "<?php if ($code !== "en"){e("/".$code);} ?>/youtube");
      }
    function facebook_form(){
        social_form(document.getElementById("Facebook").text);
        $("#URL").attr("placeholder", "https://www.facebook.com/321960231808748/videos/1987908671310955");
        $("form").attr("action", "<?php if ($code !== "en"){e("/".$code);} ?>/facebook");
      }
    </script>
    <footer class="footer" style="background:#fff;">
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
  </body>
</html>
