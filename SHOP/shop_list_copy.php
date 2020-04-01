<?php 
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注文フォーム</title>
</head>
<style>
  
  html {
    width: 1040px;
    height: 1150px;
    margin: 0 auto;
    position: relative;
    font-size: 15px;
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    background: url(../images/shop_background.png)no-repeat fixed; 
    background-size: cover;
    top: 20px;
  }
  
  
  body {
    width: 1040px;
    margin: 0 auto;
  }

/*-----navigation全体-----*/
  
  .navigation {
    position: absolute;
    margin-top: 40px;
    top: 0px;
    width: 1040px;
    height: 120px;
    z-index: 999;
    color: #fff;
  }
  
  .navigation a {
    color: #fff;
    text-decoration: none;
  }
  
/*------navigation タイトル名・logo-----*/
  
  .logo {
    width: 120px;
    height: auto;
    position: absolute;
    top: 0%;
    left: 1%;
    z-index: 0;
  }
  
  .h1 {
    position: absolute;
    top: 50%;
    left: 13%;
    width: 270px;
    z-index: 999;
    margin: 0;
  }
  
/*-----li ul-----*/
  
  li {
    list-style: none;
    display: inline-block;
    padding-right: 15px;
  }
  
  
  ul {
    margin: 0;
    padding: 0
  }
  
/*-----navigation ログイン名前-----*/
  .login_name {
    position: absolute;
    width: 255px;
    height: 46px;
    top: 43%;
    right: 7.5%;
    
  }
  
  .login {
    z-index: 999;
  }
  
  a:hover {
    color: #2886bf;
  }
  
/*-----navigation 購入履歴 cart一覧-----*/
  
   a {
    color: #fff;
    text-decoration: none;
  }
  
  .cartimg {
    width: 85px;
    height: auto;
    position: absolute;
    top: 9.6%;
    right: 0.5%;
    z-index: 999;
  }
  
  .cartimg:hover{
    color: #2886bf;
  }
  
/*------------------------------------*/
  
  
/*-----------グローブを並べる棚--------------*/
  .box_background {
    width: 1040px;
    height: auto;
    position: absolute;
    top: 220px;
    z-index: -999;
  }
  
  
/*-----グローブ商品一覧-----*/
  
/*一列目*/
  .link1 {
    position: absolute;
    top: 13.5%;
    left: 5.8%;
  }
  
  .link1 img {
    width: 100px;
    height: auto;
  }
  
  .link2 {
    position: absolute;
    top: 14%;
    left: 22.2%;
  }
  
  .link2 img {
    width: 100px;
    height: auto;
  }
  
  .link3 {
    position: absolute;
    top: 13.2%;
    left: 37.5%;
  }
  
  .link3 img {
    width: 120px;
    height: auto;
  }
  
  .link4 {
    position: absolute;
    top: 13.8%;
    left: 54%;
  }
  
  .link4 img {
    width: 100px;
    height: auto;
  }
  
  .link5 {
    position: absolute;
    top: 14%;
    left: 70%;
  }
  
  .link5 img {
    width: 100px;
    height: auto;
  }
  
  .link6 {
    position: absolute;
    top: 13.8%;
    left: 87%;
  }
  
  .link6 img {
    width: 100px;
    height: auto;
  }
  
  /*二列目*/
  .link7 {
    position: absolute;
    top: 30.2%;
    left: 5%;
  }
  
  .link7 img {
    width: 125px;
    height: auto;
  }
  
  .link8 {
    position: absolute;
    top: 30.2%;
    left: 21%;
  }
  
  .link8 img {
    width: 125px;
    height: auto;
  }
  
  .link9 {
    position: absolute;
    top: 30.5%;
    left: 37%;
  }
  
  .link9 img {
    width: 125px;
    height: auto;
  }
  
  .link10 {
    position: absolute;
    top: 31%;
    left: 54%;
  }
  
  .link10 img {
    width: 112px;
    height: auto;
  }
  
  .link11 {
    position: absolute;
    top: 31%;
    left: 69%;
  }
  
  .link11 img {
    width: 125px;
    height: auto;
  }
  
  .link12 {
    position: absolute;
    top: 30.5%;
    left: 85.3%;
  }
  
  .link12 img {
    width: 115px;
    height: auto;
  }
  
  
    /*三列目*/
  .link13 {
    position: absolute;
    top: 48%;
    left: 5.5%;
  }
  
  .link13 img {
    width: 100px;
    height: auto;
  }
  
  .link14 {
    position: absolute;
    top: 47.8%;
    left: 21.5%;
  }
  
  .link14 img {
    width: 110px;
    height: auto;
  }
  
  .link15 {
    position: absolute;
    top: 48%;
    left: 38%;
  }
  
  .link15 img {
    width: 100px;
    height: auto;
  }
  
  .link16 {
    position: absolute;
    top: 48%;
    left: 53%;
  }
  
  .link16 img {
    width: 100px;
    height: auto;
  }
  
  .link17 {
    position: absolute;
    top: 48%;
    left: 70%;
  }
  
  .link17 img {
    width: 100px;
    height: auto;
  }
  
  .link18 {
    position: absolute;
    top: 48%;
    left: 85%;
  }
  
  .link18 img {
    width: 100px;
    height: auto;
  }
  
      /*四列目*/
  .link19 {
    position: absolute;
    top: 65%;
    left: 4.5%;
  }
  
  .link19 img {
    width: 100px;
    height: auto;
  }
  
  .link20 {
    position: absolute;
    top: 65%;
    left: 20%;
  }
  
  .link20 img {
    width: 100px;
    height: auto;
  }
  
  .link21 {
    position: absolute;
    top: 65%;
    left: 38%;
  }
  
  .link21 img {
    width: 100px;
    height: auto;
  }
  
  .link22 {
    position: absolute;
    top: 65%;
    left: 53%;
  }
  
  .link22 img {
    width: 100px;
    height: auto;
  }
  
  .link23 {
    position: absolute;
    top: 65%;
    left: 70%;
  }
  
  .link23 img {
    width: 100px;
    height: auto;
  }
  
  .link24 {
    position: absolute;
    top: 65%;
    left: 85%;
  }
  
  .link24 img {
    width: 100px;
    height: auto;
  }
  
        /*四列目*/
  .link25 {
    position: absolute;
    top: 82%;
    left: 4.5%;
  }
  
  .link25 img {
    width: 100px;
    height: auto;
  }
  
  .link26 {
    position: absolute;
    top: 82%;
    left: 20%;
  }
  
  .link26 img {
    width: 100px;
    height: auto;
  }
  
  .link27 {
    position: absolute;
    top: 82%;
    left: 38%;
  }
  
  .link27 img {
    width: 100px;
    height: auto;
  }
  
  .link28 {
    position: absolute;
    top: 82%;
    left: 53%;
  }
  
  .link28 img {
    width: 100px;
    height: auto;
  }
  
  .link29 {
    position: absolute;
    top: 82%;
    left: 70%;
  }
  
  .link29 img {
    width: 100px;
    height: auto;
  }
  
  .link30 {
    position: absolute;
    top: 82%;
    left: 85%;
  }
  
  .link30 img {
    width: 100px;
    height: auto;
  }
  
  
/*-------------------------*/
  
/*-----------copyright--------------*/
  footer p {
    position: absolute;
    top: 100%;
    left: 40%;
    padding-bottom: 50px;
    color: #fff;
  }
/*-------------------------*/
  
</style>
<body>
  
<nav class="navigation">
    <a href="#"><img src="../images/logo.png" class="logo"></a>
    <img src="../images/logo2.png" class="h1">
  <?php
   //session_idを盗まれないように毎回送る言葉を変更。
  if(isset($_SESSION['member_login']) == false) {
  print '<ul class="login_name">';
  print '<li>こんにちは<br>ようこそゲスト様</li>';
  print '<li><a href="../MEMBER/member_login.html">会員ログイン</a></li>';
  print '</ul>';
  
} else {
  print '<ul class="login_name">';
  print '<li>こんにちは<br>ようこそ ';
  print $_SESSION['member_name1'];
  print $_SESSION['member_name2'];
  print ' 様</li>';
  print '<li><a href="../MEMBER/member_logout.php">ログアウト</a></li>';
  print '</ul>';
}
?>
    
</nav>
  
<?php
  $num = 1;
  
  //try {
    /*データベースに接続*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    /*一覧取得*/
    $sql = 'select productcode,productname,price,img from product where 1';
    //where 1 = その列を全て表示
    /*スタッフ名情報取得*/
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //execute() の中に全てのデータが入っている。
    
    $dbh = null;
    
    while(true) {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      
      //$stmtから1レコード取り出す。
    if($rec == false) {
      break; //全てのレコードを取り出したら終了。
    }
    print '<a class=link'.$num.' href="shop_product.php?code='.$rec['productcode'].'">'; //配列[]で取得
      $num += 1;
    //print $rec['productname'];
    //print $rec['price'].'円';
    //print '<div class="pglove">';
    print '<img src="../images/'.$rec['img'].'">';
    //print '</div>';
    print '</a>';
       
    
  }
    print '<a href="shop_cartlook.php?code='.$rec['productcode'].'" class="cartimg"><img src="../images/cart.png">カート</a>';
    //<img src="../images/cart.png" class="cartimg">
  
//}
?>
 <img src="../images/backbround4.png" class="box_background">
  
  <footer>
    <p>© 2020 SHOTA KAMIGUCHI</p>
  </footer>
  
</body>
</html>