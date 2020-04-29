<?php
require_once('getMac.php');
$clientMac = getMac($_SERVER['REMOTE_ADDR']);
if(isset($_GET['dev'])) $clientMac = 'FF:FF:FF:FF:FF:FF';

function ua_smt(){
  //ユーザーエージェントを取得
  $ua = $_SERVER['HTTP_USER_AGENT'];
  //スマホと判定する文字リスト
  $ua_list = array('iPhone','iPad','iPod','Android');
   foreach ($ua_list as $ua_smt) {
  //ユーザーエージェントに文字リストの単語を含む場合はTRUE、それ以外はFALSE
    if (strpos($ua, $ua_smt) !== false) {
     return true;
    }
  } return false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Bony_LAB</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img src="https://bonychops.com/favicon.ico" width="12%">Bony_LAB</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="https://bonychops.com">Bony_Chops</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="https://bonychops.com">Bony_Chops</a></li>
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
        <h5 class="header col s12 light">IP: <?= $_SERVER['REMOTE_ADDR']?></h5>
      </div>
      <div class="row center">
        <h5 class="header col s12 light">MAC: <?= $clientMac?></h5>
      </div>
      <?php if(!ua_smt()){ ?>
        <div class="row center">
        <a href="javascript: startLogin()" id="download-button" class="btn-large waves-effect waves-light orange">Bony_AUTH で自動認証</a>
      </div>
      <div class="row center">
        <a href="javascript: getTest()" id="download-button" class="btn-large waves-effect waves-light orange">TEST</a>
      </div>
      <div class="row center">
        Bony_AUTHをPCにインストールする必要があります。<br><a href="./">Bony_AUTHをPCにインストール</a>
      </div>
      <div class="row center">
        または、<a href="./">手動で認証する</a>
      </div>
      <br><br>
      <?php }else{ ?>
        <div class="row center">
        <a href="javascript: startLogin()" id="download-button" class="btn-large waves-effect waves-light orange">認証する</a>
      </div>
      <?php } ?>
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
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/jquery-2.1.1.min.js"></script>
  <script>
  function startLogin(){
    $(".section").children(".container").html(`
      <br><br>
      <div class="row center">
        <h5 class="header col s12 light">認証しています...</h5>
      </div>
      <div class="progress">
        <div class="indeterminate"></div>
      </div>`);
  }

  function getTest(){
    $.get("jsGetTest.php",
      {"cd":"100", "name":"Taro"}, function( data ) {
        alert(data);
    } );
  }
  window.onload = function(){
    $.get("jsGetTest.php",
      {"cd":"100", "name":"Taro"}, function( data ) {
        if (data == "True") startLogin();
    } );
  }
  </script>
  </body>
</html>
