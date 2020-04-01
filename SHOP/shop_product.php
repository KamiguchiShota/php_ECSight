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
  
<script>
  function chimg(imgpath){
    console.log(imgpath);
    document.lsize.src=imgpath
  }
</script>
  
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
  }
  
  body {
    width: 1040px;
    height: auto;
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
    margin: 25px 0 10px 0;
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
  

/*-------------------------*/
  .productimg_flex {
    display: flex;
    flex-wrap: wrap;
    width: 300px;
    height: auto;
    justify-content: space-between;
    float: left;
    margin-top: 50px;
  }
  
  .bigimg img {
    width: 400px;
    height: 400px;
    object-fit: contain;
  }
  
  .productimg_flex ul smallimg {
    width: 33%;
    height: auto;
  }
  
  .productimg_flex ul .bigimg {
    width: 100%;
    height: auto;
  }
  
  .productimg_flex ul .bigimg img {
    max-width: 100%;
  }
  
  .productimg_flex ul smallimg img {
    max-width: 100%;
  }
  
  h4 {
    color: #fff;
    font-size: 15px;
  }
  
  .product_list {
    width: 650px;
    height:100vh;
    margin: 0 auto;
  }
  
  .right_product {
    width: 300px;
    height: auto;
    float: left;
    margin: 160px 0 25px 40px;
  }
  
  .right_product h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 300;
  }
  
  .cart_back {
    width: 185px;
    font-size: 15px;
    padding: 10px 15px 5px 10px;
    color: #fff;
    background-color: rgba(40,134,191,.7);
    margin-left: 40px;
  }
  
  .cart_back img {
    margin-right: 25px;
    padding-left: 3px;
  }
  
  .cart_back:hover {
    color: #fff;
    background-color: rgba(40,134,191,1.0);
    transition: all 1s ease;
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
  
  <?php
    try {
      $pro_productcode = $_GET['code'];
      
      /*データベースに接続*/
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
      //var_dump($rec);
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
      
      if($pro_gazou_name == '') {
        $disp_gazou='';
        
      } else {
        $disp_gazou ='<img src="../PRODUCT/images/'.$pro_gazou_name.'">';
      }
      ?>
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
  <div class="product_list">
  <div class="productimg_flex">
    <ul>
      <li class="bigimg"><?php print '<img src="../images/'.$pro_Images1.'.png" name="lsize">'; ?></li>
      <li class="smallimg"><img src="../images/<?php print($pro_Images1s); ?>.png" onMouseOver="chimg('../images/<?php print($pro_Images1); ?>.png')">
      <li class="smallimg"><img src="../images/<?php print($pro_Images2s); ?>.png" onMouseOver="chimg('../images/<?php print($pro_Images2); ?>.png')">
      <li class="smallimg"><img src="../images/<?php print($pro_Images3s); ?>.png" onMouseOver="chimg('../images/<?php print($pro_Images3); ?>.png')">
    </ul>
    </div>
    
  <div class="right_product">
    <h4>商品コード：<span><?php print $pro_productcode; ?></span></h4>
    <h4>商品名：<span><?php print $pro_productname; ?></span></h4>
    <h4>価格：<span><?php print number_format($pro_price); ?>円</span></h4>
    <h4>ポジション：<span><?php print $pro_posi; ?></span></h4>
    <h4>利き手：<span><?php print $pro_hand; ?></span></h4>
  </div>
<?php
    print '<a href="shop_cartin.php?productcode='.$pro_productcode.'" class="cart_back"><img src="../images/cart2.png">カートに入れる</a>'; ?>
  </div>
<?php
  }
    catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
?>
  <footer>
    <small>© 2020 SHOTA KAMIGUCHI</small>
  </footer>
  
</body>
</html>