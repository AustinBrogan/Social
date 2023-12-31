<?php
session_start();
if (isset($_COOKIE['token']) && !isset($_SESSION['userId']) && !isset($_GET['token'])) {
  header("Location: inc/autologin.php?login");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Suplike social website</title>
  <meta name="description" content="suplike social is a website for friends and family to share" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://bethro.alwaysdata.net" />
  <meta property="og:title" content="join in and meet with others" />
  <meta property="og:site_name" content="suplike social website">
  <meta property="og:description" content="suplike social is a website for friends and family to share" />
  <meta property="og:image" content="https://bethro.alwaysdata.net/img/graphic.png" />
  <link itemprop="thumbnailUrl" href="https://bethro.alwaysdata.net/img/graphic.png" />
  <meta property="og:image:width" content="300">
  <meta property="og:image:height" content="150">
  <!-- No need to change anything here -->
  <meta property="og:type" content="website" />
  <meta property="og:image:type" content="image/jpeg">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:url" content="https://bethro.alwaysdata.net" />
  <meta property="twitter:title" content="suplike social" />
  <meta property="twitter:description" content="suplike social is a website for friends and family to share" />
  <meta property="twitter:image" content="https://bethro.alwaysdata.net/img/graphic.png" />

  <meta name="theme-color" content="#6c5ce7">
  <link rel="apple-touch-icon" href="img/icon/apple-touch-icon.png" />
  <link rel="shortcut icon" href="img/icon/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="lib/font-awesome/css/all.min.css" defer>
  <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="manifest" href="manifest.json">
  <link rel="stylesheet" href="./lib/lightbox/lightbox.min.css">
  <script type="text/javascript" src="./lib/jquery/jquery.js"></script>
  <script src="lib/lazyload/jquery.lazyload-any.js" defer></script>
  <script src="./js/online.js" defer></script>
  <script src="registerSW.js"></script>
  <script>
    // load css if localstorage  theme = dark
    let theme = localStorage.getItem('theme') || null;
    if (theme === 'dark') {
      let css = `:root{--bg:#1f1f1f;--co:#fff;--ho:#a89ef5;--option:grey;--light:#333;--dark:#f6f6f6;--white:#333;--icon-dark:var(--icon-light);--card:#6c757d;--tab:#343a40;--muted-text:#dbdbdb;--purple:#a29bfe;--pink:#fd79a8;--yellow:#ffeaa7;--teal:#81ecec;--blue: #74b9ff; }`;
      let style = document.createElement('style');
      style.type = 'text/css';
      style.appendChild(document.createTextNode(css));
      document.head.appendChild(style);
    }
  </script>
</head>

<body>
  <div class="loader">
    <progress-ring stroke="4" radius="60" progress="0"></progress-ring>
    <h2>suplike</h2>
  </div>
  <script src="js/loader.js"></script>
  <header style="position: sticky;top: 0;z-index: 20;">
    <nav class="navbar sticky-top nav-hide navbar-expand-md p-1">
      <a href="./">
        <img title="logo" src="img/logo.png" alt="logo">
      </a>
      <button class="navbar-toggler collapsed" style="outline: none; border: none;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="navbar-collapse justify-content-right collapse" id="navbarSupportedContent">
        <?php
        // repeat but a better readable code
        if (isset($_SESSION['userId'])) {
        ?>
          <ul class="navbar-nav ml-auto mr-1">
            <a href="home"><i title="home" class="fa fa-home fa-2x"></i></a>
            <?php
            if ($_SESSION['isAdmin'] === 1) {
              echo '<div id="header-addons">';
              echo '<a href="./dashboard/"><i title="dashboard" class="fas fa-user-shield fa-2x"></i></a> ';
              echo '</div>';
            }
            ?>

            <a href="social.php"><i title="friends" class="fa fa-users fa-2x"></i></a>
            <a href="message.php"><i title="direct inbox" class="fa fa-envelope fa-2x"></i></a>
            <a href="notification.php"><i title="notification" class="fa fa-bell fa-2x"></i></a>
            <a href="search.php"><i title="search for users or post" class="fa fa-search fa-2x"></i></a>
            <a href="settings.php?profile"><i title="settings" class="fa fa-cog fa-2x"></i></a>
            <a href="inc/logout.inc.php"><i id="logout" title="logout" class="fa fa-sign-in-alt fa-2x"></i></a>
          </ul>
        <?php
        } ?>
      </div>
    </nav>

  </header>
  <?php
  if (isset($_SESSION['userId'])) {
  ?>
    <div class="text-right w-100 h4 nav-show px-1 mx-0">
      <div class="w-100 text-right">
        <?php
        $pages_array = ['settings', 'post', 'comment'];
        $pages_array_2 = ['home'];
        $pages_array_3 = ['social', 'message', 'notification', 'search'];
        $pages_array_4 = ['profile'];
        $current_page = basename($_SERVER['PHP_SELF']);
        $current_page = str_replace('.php', '', $current_page);
        // if current page is in the array
        ?>

        <?php
        if (in_array($current_page, $pages_array)) {

        ?>

          <a href="home">
            <i class="fa fa-home"></i>
          </a>

        <?php
        } else if (in_array($current_page, $pages_array_2)) {
        ?>
          <a href="post.php"><i class="fas fa-plus mx-1"></i></a>
          <?php
          if ($_SESSION['isAdmin'] === 1) {
          ?>
            <a href="./dashboard/">
              <i class="fas fa-user-shield"></i>
            </a>
          <?php
          }
          ?>
          <a href="message" class="no-style"><i class="fas fa-envelope mx-1"></i></a>
        <?php
        } else if (in_array($current_page, $pages_array_3)) {
        ?>
          <a href='<?= $_SERVER['HTTP_REFERER'] ?? '#' ?>' id="back">
            <i class="fas fa-arrow-left"></i>
          </a>
        <?php
        }else if (in_array($current_page, $pages_array_4)) {
        ?>
        <a href="settings" class="no-style"><i class="fas fa-cog mx-1"></i></a>
      <a href="inc/logout.inc.php" class="no-style"><i class="fas fa-sign-in-alt mx-1"></i></a>
        <?php
        }
          ?>
      </div>
    </div>
  <?php
  }
  ?>