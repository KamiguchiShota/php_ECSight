<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>DB</title> 
</head>
<style>
  
  html {
    width: 1040px;
    height: auto;
    margin: 0 auto;
    position: relative;
    font-size: 15px;
    color: #fff;
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
  li {
    list-style: none;
    display: inline-block;
    padding-right: 15px;
  }

  ul {
    margin: 0;
    padding: 0
  }
  
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
  
/*-----navigation ログイン名前-----*/
/*---ゲスト---*/
  .login_name {
    width: 255px;
    height: 46px;
    float: right;
    padding-right: 70px;
    padding-top: 72px;
  }
  
/*---ログイン中---*/
  .login_name2 {
    width: 255px;
    height: 46px;
    float: right;
    padding-right: 75px;
    padding-top: 72px;
  }
  
/*-----error-----*/
  .error {
    width: 270px;
    height: 68px;
    padding: 10px 8px 6px 15px;
    border: solid 1px #fff;
    background-color: rgba(0,0,0,.3);
    font-weight: 200;
    margin: 0 auto
  }
  
  .error p {
    margin: 0;
    color: #fff;
  }
  
/*-----買い物続けるbutton-----*/
  .continue_shopping {
    width: 150px;
    height: 30px;
    background-color: rgba(40,153,191,.8);
    text-align: center;
    line-height: 30px;
    margin: 0 auto;
    margin-top: 30px;
  }
  
  .continue_shopping a:hover {
    color: #fff;
    
  }
  
  .continue_shopping:hover {
    background-color: rgba(40,153,191,1);
    transition: all 1s ease;
  }

/*----------form---------------*/
  form {
    width: 1040px;
    display: block;
    margin: 0 auto;
  }
  
  /*-----table-----*/
  .table_list {
    width: 732px;
    height: 100%;
  }
  
  .table_list h1 {
    font-size: 23px;
    width: 732px;
    font-weight: 300;
    margin-left: 80px;
    margin-bottom: 25px;
    
  }
  
  table {
    margin: 0 auto;
  }
  
  /*------td・th商品リスト------*/
  
  th {
    font-size: 18px;
    padding: 4px;
    font-weight: 600;
    color: #fff;
  }
  
  th img {
    height: 180px;
  }
  
  th img:nth-child(6) img {
    width: 50px;
  }
  
  .td_img {
    text-align: center;
  }
  
  td {
    padding: 10px;
    text-align: center;
    color: #fff;
  } 
  
  .checkinput {
    margin: 0;
  }
  
/*------change_quantity・cart_new大元-----*/
  .change_quantity_cart_new {
    width: 300px;
    height: 100px;
    text-align: center;
    padding-top: 77px;
  }

  
  /*-----change_quantity（数量変更）------*/
  .change_quantity {
    width: 200px;
    height: 35px;
    padding: 4px;
    background-color: rgba(255,255,255,.8);
    color: #000;
    border: 0;
    cursor : pointer;
  }
  
  .change_quantity:hover {
    background-color: rgba(255,255,255,1);
    transition: all 1s ease;
  }
  
  /*-----会員ログイン時購入------*/
  .cart_member {
    display: inline-block;
    width: 200px;
    height: 30px;
    line-height: 30px;
    padding-top: 5px;
    margin: 0;
    background-color: rgba(40,153,191,.8);
  }
  
  .cart_member a:hover {
    color: #fff;
  }
  
  .cart_member:hover {
    background-color: rgba(40,153,191,1);
  }
  
  .cart_new {
    display: inline-block;
    width: 200px;
    height: 30px;
    line-height: 30px;
    padding-top: 5px;
    margin: 0;
    background-color: rgba(40,153,191,.8);
  }
  
  .cart_new:hover {
    background-color: rgba(40,153,191,1);
  }
  
  .cart_new a:hover {
    color: #fff;
  }
  
  .cart_new img {
    width: 22px;
  }
  
/*-----------copyright--------------*/
  footer {
    width: 1040px;
    height: 100px;
    line-height: 100px;
    text-align: center;
    color: #fff;
    z-index: 999;
  }
  
  
  main {
    width: 1040px;
    display: flex;
  }
  
</style>
<body>
  
  <nav class="navigation">
     <a href="../SHOP/shop_list.php"><img src="../images/logo.png" class="logo"></a>
    <img src="../images/logo2.png" class="company_logo">
  <?php
   //session_idを盗まれないように毎回送る言葉を変更。
      if(isset($_SESSION['member_login']) == false) {
      print '<ul class="login_name">';
      print '<li>こんにちは<br>ようこそゲスト様</li>';
      print '<li><a href="../MEMBER/member_login.html">会員ログイン</a></li>';
      print '</ul>';

    } else {
      print '<ul class="login_name2">';
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
    try {
  /*-----------------カートの中身が無い場合------------------------------*/
      if(isset($_SESSION['cart']) == true) {
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
        $max = count($cart);
      } else {
        $max = 0;
      }
  /*存在する場合コピーをする。存在しない場合コピーをしないでmax=0で下記を表示。*/
      
  ?>
  <?php
      if($max == 0) { ?>
  <div class="error">
    <p>買い物かごには商品が入っていません。<br>是非お買い物をお楽しみください。<br>ご利用をお待ちしております。</p>
  </div>
  
  <div class="continue_shopping">
  <a href="shop_list.php">買い物を続ける</a>
  </div>
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
  
  <?php exit();
      }
  /*------------------------------------------------------------------*/
      /*データベースに接続*/
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      foreach($cart as $key => $val) {
        $sql = 'select productcode,productname,price,img from product where productcode=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $val; /*0にしないとループするたびに1、2、3にならないように*/
        $stmt->execute($data);
        
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $pro_productname[] = $rec['productname'];
        $pro_price[] = $rec['price'];
        if($rec['img'] == '') {
          $pro_gazou[] = '';
        } else {
          $pro_gazou[] = '<img src="../images/'.$rec['img'].'">';
        }
      }
      $dbh = null;
      
  }
  
     catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
  ?>
  
  <!-----------------カートの中身について------------------------------>
  <form method="post" action="kazu_change.php">
    
  <main>
    
  <div class="table_list">
  <h1><img src="../images/cart2.png">ショッピングカート</h1>
  <table border="1">
    <tr>
      <th>商品名</th>
      <th>画像</th>
      <th>価格</th>
      <th>数量</th>
      <th>小計</th>
      <th>削除</th>
    </tr>
  <?php for($i=0; $i < $max; $i++) { ?>
  <tr>
    <td><?php print $pro_productname[$i]; ?></td>
    <td class="td_img"><?php print $pro_gazou[$i]; ?></td>
    <td><?php print number_format($pro_price[$i]); ?>円</td> <!--number_format()で3桁以上になったら,をうつ-->
    <?php //print $kazu[$i]; ?>
    <td><input type="text" style="width:50px" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
    <td><?php print number_format($pro_price[$i] * $kazu[$i]); ?>円</td>
    <td><input type="checkbox" name="delete<?php print $i; ?>" class="checkinput"></td>
  </tr>
    
  <?php } ?>
  </table>
  </div>
    <input type="hidden" name="max" value="<?php print $max ?>">
    
    <div class="change_quantity_cart_new">
    <input type="submit" value="数量変更" class="change_quantity">
    <?php if(isset($_SESSION['member_login']) == true) { ?>
  <div class="cart_member">
  <a href="../SHOP/shop_simple_check.php"><img src="../images/cart2.png">会員注文へ進む</a>
  </div>
  
  <?php } else { ?>
  <div class="cart_new">
  <a href="shop_form.html"><img src="../images/cart2.png">ご購入手続き</a>
  </div>
      
  </div>
  <?php } ?>
    
  </main>
    
  </form>
  <!------------------注文フォーム画面----------------------------->
  
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
</body>
</html>