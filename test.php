<?php
require_once('getMac.php');
$clientMac = getMac($_SERVER['REMOTE_ADDR']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img src="https://bonychops.com/favicon.ico" width="12%">Bony_LAB</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <?php if($clientMac !== FALSE){?>
      <br><br>
      <h1 class="header center orange-text">Welcome to Bony_LAB!</h1>
      <div class="row center">
        <h5 class="header col s12 light">ネットワークを利用するには、Bony_AUTHによる認証が必要です。</h5>
      </div>
      <div class="row center">
        <h5 class="header col s12 light">MAC: <?= $clientMac?></h5>
      </div>
      <div class="row center">
        <a href="vscode://" id="download-button" class="btn-large waves-effect waves-light orange">LOGIN</a>
      </div>
      <div class="row center">
        Bony_AUTHをPCにインストールする必要があります。<br><a href="./">Bony_AUTHをPCにインストール</a>
      </div>
      <br><br>
      <?php }else{ ?>
        <br><br>
      <h1 class="header center orange-text">ERROR</h1>
      <div class="row center">
        <h5 class="header col s12 light">この端末のMacアドレスが取得できないため、登録することができません。:(</h5>
      </div>
      <br><br>
      <?php } ?>
    </div>
  </div>


  



  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
