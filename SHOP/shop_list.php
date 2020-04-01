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
  
  * {
    box-sizing: border-box;
  }
  
  html {
    width: 1040px;
    height: auto;
    margin: 0 auto;
    position: relative;
    font-size: 15px;
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    background: url(../images/shop_background.png)no-repeat fixed; 
    background-size: cover;
  }
  
  body {
    width: 1040px;
    margin: 0 auto;
  }

  a {
    color: #fff;
    text-decoration: none;
  }
  
  a:hover {
    color: #2886bf;
  }
  
/*-----navigation全体-----*/
  .navigation {
    width: 1040px;
    height: 120px;
    z-index: 999;
    color: #fff;
    margin: 25px 0 50px 0;
  }
  
  .navigation a {
    color: #fff;
    text-decoration: none;
  }
  
  .navigation a:hover {
    color: #2886bf;
  }
  
/*------navigation タイトル名・logo、login_name-----*/
  .logo {
    width: 120px;
    height: auto;
    float: left;
  }
  
  .company_logo {
    width: 270px;
    z-index: 999;
    float: left;
    padding-top: 80px;
  }
  
/*-----ul li -----*/
  ul {
    width: 365px;
    float: right;
    padding-top: 60px;
  }
  
  li {
    display: inline-block;
    list-style: none;
    margin-right: 10px;
  }
  
/*-----navigation ログイン名前-----*/
/*ゲスト*/
  
/*ログイン中*/

  
/*-----navigation 購入履歴 cart一覧-----*/
  .cartimg {
    width: 85px;
    height: auto;
    position: absolute;
    top: 10%;
    right: 0.5%;
    z-index: 999;
  }
  
  .cartimg:hover{
    color: #2886bf;
  }
  
/*-----------グローブを並べる棚--------------*/
  .box_background img {
    width: 1040px;
    height: auto;
    z-index: -999;
  }
/*-----グローブ商品一覧-----*/
  
/*一列目*/
  .itemBoxFlex{
    background-image: url("../images/backbround4.png");
    background-size: cover;
    display: flex;
    flex-wrap: wrap;
    height: 885px;
    margin: 0 auto;
    padding: 33px 22px 15px;
    width: 1041px; 
  }
  
  .itemFlex {
    height: auto;
    margin-top: 20px;
    width: 16.5%;
  }
  
  .itemFlex img {
    display: block;
    height: auto;
    margin: 0 auto 0 30px;
    max-width: 95px;
  }
  

  .itemFlex:nth-child(3) img, .itemFlex:nth-child(7) img, .itemFlex:nth-child(8) img, .itemFlex:nth-child(9) img, .itemFlex:nth-child(11) img{
    max-width: 105px;
  }
  
  .itemFlex:nth-child(3) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(6) img {
    margin: 0 auto 0 50px;
    max-width: 90px;
  }
  
  .itemFlex:nth-child(7) img {
    margin: -10px auto 0 40px;
    max-width: 100px;
  }
  
  .itemFlex:nth-child(8) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(9) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(10) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(11) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(12) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(13) img {
    margin: 0 auto 0 30px;
    max-width: 96px;
  }
  
  .itemFlex:nth-child(14) img {
    margin: 0 auto 0 30px;
    max-width: 100px;
  }
  
  .itemFlex:nth-child(15) img {
    margin: 0 auto 0 35px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(16) img {
    margin: 0 auto 0 35px;
    max-width: 98px;
  }
  
  .itemFlex:nth-child(17) img {
    margin: 0 auto 0 35px;
    max-width: 102px;
  }
  
  .itemFlex:nth-child(18) img {
    margin: 0 auto 0 40px;
    max-width: 100px;
  }
  
  .itemFlex:nth-child(19) img {
    margin: 0 auto 0 25px;
    max-width: 100px;
  }
  
  .itemFlex:nth-child(20) img {
    margin: 0 auto 0 25px;
    max-width: 102px;
  }
  
  .itemFlex:nth-child(21) img {
    margin: 0 auto 0 35px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(22) img {
    margin: 0 auto 0 45px;
    max-width: 90px;
  }
  
  .itemFlex:nth-child(23) img {
    margin: 0 auto 0 50px;
    max-width: 95px;
  }

  .itemFlex:nth-child(24) img {
    margin: 0 auto 0 50px;
    max-width: 90px;
  }
  
  .itemFlex:nth-child(25) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
  .itemFlex:nth-child(26) img {
    margin: 0 auto 0 40px;
    max-width: 90px;
  }
  .itemFlex:nth-child(27) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  .itemFlex:nth-child(28) img {
    margin: 0 auto 0 40px;
    max-width: 93px;
  }
  .itemFlex:nth-child(29) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  .itemFlex:nth-child(30) img {
    margin: 0 auto 0 40px;
    max-width: 95px;
  }
  
/*-----------copyright--------------*/
  footer {
    width: 1040px;
    height: 100px;
    line-height: 100px;
    text-align: center;
    color: #fff;
  }
/*-------------------------*/
  
</style>
<body>
  <nav class="navigation">
    <a href="#"><img src="../images/logo.png" class="logo"></a>
    <img src="../images/logo2.png" class="company_logo">
  <!--session_idを盗まれないように毎回送る言葉を変更。-->
  <div class="div_ul">
  <?php if(isset($_SESSION['member_login']) == false) { ?>
  <ul class="login_name">
    <li>こんにちは<br>ようこそゲスト様</li>
    <li><a href="../MEMBER/member_login.html">会員ログイン</a></li>
  </ul>
<?php } else { ?>
  <ul>
    <li>こんにちは<br>ようこそ 
  <?php print $_SESSION['member_name1']; ?>
  <?php print $_SESSION['member_name2']; ?>様
    </li>
    <li class="login_name2_li"><a href="../MEMBER/member_logout.php">ログアウト</a></li>
  </ul>
  </div>
<?php } ?>
  </nav>
  <div class="itemBoxFlex">
<?php
  $num = 1; 
  try {
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
    print '<div class="itemFlex"><a href="shop_product.php?code='.$rec['productcode'].'">'; //配列[]で取得
      $num += 1;
    print '<img src="../images/'.$rec['img'].'">';
    print '</a></div>';
  }
    print '<a href="shop_cartlook.php?code='.$rec['productcode'].'" class="cartimg"><img src="../images/cart.png">カート</a>';
    //<img src="../images/cart.png" class="cartimg">
}
  
  catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
  }
?>
    </div>
  
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
  
</body>
</html>