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
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    background: url(../images/shop_background.png)no-repeat fixed; 
    background-size: cover;
    color: #fff;
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
/*ゲスト*/
  .login_name {
    width: 255px;
    height: 46px;
    float: right;
    padding-right: 70px;
    padding-top: 72px;
  }
  
/*ログイン中*/
  .login_name2 {
    width: 255px;
    height: 46px;
    float: right;
    padding-right: 75px;
    padding-top: 72px;
  }
  
/*---------カートに同じ商品が入っている場合----------------*/
  .error p {
    width: 420px;
    color: #fff;
    padding: 15px 10px 15px 10px;
    background-color: rgba(255,255,255,0.1);
    border: solid #fff 1px;
    margin: 0 auto;
  }
  
  .payment_shop_list_button {
    width: 1040px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    margin-top: 30px;
  }
  
  .payment {
    display: inline-block;
    width: 150px;
    height: 30px;
    line-height: 30px;
    background-color: rgba(40,153,191,0.8);
    margin-right: 10px
  }
  
  .payment img {
    width: 22px;
    padding-right: 5px;
    line-height: 30px;
    height: auto;
  }
  
  .payment:hover{
    background-color: rgba(40,153,191,1);
    transition: all 1s ease;
  }
  
  .payment a:hover {
    color: #fff;
  }
  
  .shop_list {
    display: inline-block;
    width: 150px;
    height: 30px;
    line-height: 30px;
    background-color:rgba(244, 201, 84,.8);
  }
  
  .shop_list li {
    padding: 0;
  }
  
  .shop_list:hover {
    background-color:rgba(244, 201, 84,1);
    transition: all 1s ease;
  }
  
  .shop_list a:hover {
    color: #fff;
  }
  
  span a{
    display:inline-block;
    font-size: 18px;
    font-weight: 300;
    margin-top: 5px;
    color: #2886bf;
  }
  
  span a:hover {
    color: #2886bf;
    font-weight: bold;
  }
  
  .product_img {
    width: 200px;
    height: auto;
  }
  
  .purchasegoods {
    width: 500px;
    margin: 0 auto;
    height: auto;
  }
  
  .purchasegoods img {
    width: 100px;
    height: auto;
  }
  
  th {
    padding: 4px;
  }
  
  td {
    padding: 10px;
  }
  
  h1 {
    font-size: 23px;
    font-weight: 300;
    margin-top: 0;
  }
  
  h1,p {
    margin-left: 310px;
  }
  
  
   .payment_shop_list_button2 {
    width: 1040px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    margin-top: 30px;
  }
  
  .payment2 {
    display: inline-block;
    width: 150px;
    height: 30px;
    line-height: 30px;
    background-color: rgba(40,153,191,0.8);
    margin-right: 10px
  }
  
  .payment2 img {
    width: 22px;
    padding-right: 5px;
    line-height: 30px;
    height: auto;
  }
  
  .payment2:hover{
    background-color: rgba(40,153,191,1);
    transition: all 1s ease;
  }
  
  .payment2 a:hover {
    color: #fff;
  }
  
  
  .shop_list2 {
    display: inline-block;
    width: 150px;
    height: 30px;
    line-height: 30px;
    background-color:rgba(244, 201, 84,.8);
  }
  
  .shop_list2 li {
    padding: 0;
  }
  
  .shop_list2:hover {
    background-color:rgba(244, 201, 84,1);
    transition: all 1s ease;
  }
  
  .shop_list2 a:hover {
    color: #fff;
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
    try {
      $pro_productcode = $_GET['productcode'];
      
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
      $sql = 'select product.productcode,productname,price,img,hand,position,Images1,Images1s,Images2,Images2s,Images3,Images3s from product '.
        'left outer join glove on product.productcode = glove.productcode where product.productcode=?';
      /*スタッフコードで絞り込む。1件のレコードになるまで絞り込む。*/
      $stmt = $dbh->prepare($sql);
      $date[] = $pro_productcode;
      $stmt->execute($date);
      
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $pro_productname = $rec['productname'];
      $pro_price = $rec['price'];
      $pro_gazou_name = $rec['img'];
      $pro_posi = $rec['position'];
      $pro_hand = $rec['hand'];
      
      $pro_Images1 = $rec['Images1'];
      $pro_Images1s = $rec['Images1s'];
      
      $pro_Images2 = $rec['Images2'];
      $pro_Images2s = $rec['Images2s'];
      
      $pro_Images3 = $rec['Images3'];
      $pro_Images3s = $rec['Images3s'];
      
      
      $dbh = null;
      
      if(isset($_SESSION['cart']) == true) { //もしSESSIONが入っていれば
      $cart = $_SESSION['cart']; //現在のカートの中身をコピーする
      $kazu = $_SESSION['kazu']; 
  
  /*---------------------もしも同じ商品がある場合----------------------------------------*/
      if(in_array($pro_productcode,$cart) == true) {
  ?>
      <div class="error">
          <p>その商品は既にカートに入っています。<br>他に買い物を続ける場合は、買い物を続けるを押して下さい。<br>カートに入っている商品を<br>購入される方はお支払いを押してして下さい。</p>
      </div>

      <div class="payment_shop_list_button">
      <ul>
        <div class="payment"><li><a href="../SHOP/shop_cartlook.php"><img src="../images/cart2.png">お支払いへ</a></li></div>
        <div class="shop_list"><li><a href="shop_list.php">買い物を続ける</a></li></div>
      </ul>
      </div>
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
  <?php
          exit();
        }
  /*----------------------------------------------------------------------------------*/

      }
      $cart[] = $pro_productcode;/*カートに追加*/
      $kazu[] = 1;
      $_SESSION['cart'] = $cart;/*SESSIONにカートを保存する*/
      $_SESSION['kazu'] = $kazu;/*後ほど取り出す*/
      
    }
      
     catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
  ?>
  <h1><img src="../images/cart2.png">ショッピングカート</h1>
  <p>カートに追加しました。</p>
<!--カートに入っていないものをいれたとき-->
  <div class="purchasegoods">
    <table border="1">
    <tr>
    <th>画像商品</th>
    <th>商品番号</th>
    <th>商品名</th>
    <th>値段</th>
    </tr>
      
    <tr>
    <td><img src="../images/<?php print($pro_Images1); ?>.png"></td>
    <td><?php print($pro_productcode); ?></td>
    <td><?php print($pro_productname); ?></td>
    <td><?php print number_format($pro_price); ?>円</td>
    </tr>
    </table>
  </div>
  
    <div class="payment_shop_list_button2">
      <ul>
        <div class="payment2"><li><a href="../SHOP/shop_cartlook.php"><img src="../images/cart2.png">お支払いへ</a></li></div>
        <div class="shop_list2"><li><a href="shop_list.php">買い物を続ける</a></li></div>
      </ul>
    </div>
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
</body>
</html>
