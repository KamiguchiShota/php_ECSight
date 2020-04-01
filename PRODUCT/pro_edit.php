<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<html>
<head>
<meta charset="utf-8">
<title>商品情報変更</title>
</head>
<style>
  /*-----管理者画面全て統一項目-----*/
  body {
    width: 1040px;
    background-color: #eff0f4;
    margin: 0 auto;
    position: relative;
    color: #000;
  }
/*-----navigation-----*/
  .navigation {
    width: 1040px;
    height: 60px;
    top: 0;
    position: fixed;
    line-height: 60px;
    background-color: #2e4c51;
    display: flex;
    justify-content:space-between;
  }
  
  .navigation img {
    padding-top: 15px;
    margin-left: 20px;
  }
  
  .navigation h2 {
    font-size: 18px;
    font-weight: 300;
    margin: 0;
    margin-right: 20px;
    color: #fff;
  }
    
/*-----必要事項(overall)-----*/
  .overall {
    width: 1040px;
    height: auto;
    display: flex;
    flex-direction:row
  }
  
/*------左側にあるnavigation-----*/
  .leftmenu {
    width: 230px;
    height: 400px;
  }
  
  .leftmenu ul li {
    border: solid 1px #d8d8e5;
    width: 190px;
  }
  
  .leftmenu ul {
    padding: 0;
    position: fixed;
    top: 105px;
  }
  
  .empty {
    width: 190px;
    height: 250px;
  }
  
  .leftmenu li {
    list-style: none;
    padding: 2px 3px 0px 10px;
  }

  .leftmenu h3 {
    font-size: 18px;
    position: fixed;
    top: 58px;
    left: 175px;
    color: #000;
    font-weight: 300;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
  
    .div_form {
    width: 810px;
    margin-top: 117px;
  }
  
  .form {
    display: block;
    margin: 0 auto;
    width: 312px;
    height: 476px;
    padding: 45px;
    background-color: #fff;
  }
    
  .form h4 {
    margin: 0;
    font-size: 14px;
    font-weight: 300;
    color: #000;
  }
    
  .productcode,.productname,.price {
    width: 300px;
    height: 33px;
    margin-bottom: 15px;
    background-color: #f3f4f6;
  }
    
  .gazou {
    width: 300px;
    height: 33px;
    margin-bottom: 15px;
    color: #000;
  }
  
  .button {
    width: 200px;
    display: block;
    margin: 0 auto;
  }
  
  .update_button {
    width: 80px;
    height: 35px;
  }
      
  .cancel_button {
    width: 80px;
    height: 35px;
  }
</style>
<body>
  <?php
    if(isset($_SESSION['login']) == false) {
    header('Location: ../STAFF/staff_login.html');
    exit(); 
  } else { ?>
  <nav class="navigation">
    <a href="../STAFF/staff_top.php"><img src="../images/logo2.png"></a>
    <h2><?php print $_SESSION['staff_name']; ?>さんログイン中</h2>
  </nav>
<?php } ?>
    
  <main class="overall">
    <div class="leftmenu">
    <h3>商品修正</h3>
    <ul>
      <li><a href="../STAFF/staff_top.php">トップ</a></li>
      <li><a href="../STAFF/staff_list.php">スタッフ管理</a></li>
      <li><a href="../STAFF/staff_add.php">スタッフ追加</a></li>
      <li><a href="../PRODUCT/pro_list.php">商品管理</a></li>
      <li><a href="../ORDER/order_download.php">注文ダウウンロード</a></li>
      <li><a href="../STAFF/staff_logout.php">ログアウト</a></li>
      <li class="empty"></li>
    </ul>
  </div>
  <?php
    try {
      /*選択されたスタッフコード*/
      $pro_productcode = $_GET['productcode'];
      
      /*データベースに接続*/
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sql = 'select productname,price,img from product where productcode=?';
      /*スタッフコードで絞り込む。1件のレコードになるまで絞り込む。*/
      $stmt = $dbh->prepare($sql);
      $date[] = $pro_productcode;
      $stmt->execute($date);
      
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $pro_productname = $rec['productname'];
      $pro_price = $rec['price'];
      $pro_gazou_name_old = $rec['img'];
      
      $dbh = null;
      
      if($pro_gazou_name_old == '') {
        $disp_gazou ='';
        
      } else {
        $disp_gazou = '<img src="../images/'.$pro_gazou_name_old.'">';
      }
      
    }
     catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
  ?>
  
  商品修正<br>
<!--
  商品コード<br>
  <?php print $pro_productcode; ?>
-->
  <br>
  <form method="post" action="pro_edit_check.php" enctype="multipart/form-data" class="div_form">
    <div class="form">
    <input type="hidden" name="productcode" value="<?php print $pro_productcode; ?>">
    <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">

    <h4>商品番号</h4>
      <input type="text" name="productcode" class="productcode" value="<?php print $pro_productcode ?>"><br>

      <h4>商品名</h4>
      <input type="text" name="productname"  class="productname" value="<?php print $pro_productname ?>"><br>

      <h4>価格</h4>
    <input type="text" name="price" class="price"><br>

    <?php print $disp_gazou; ?><br>
      <h4>画像</h4>
      <input type="file" name="gazou" style="width:400px" class="gazou"><br>
    

  <div class="button">
    <input type="submit" value="修正" class="update_button">
    <input type="button" onclick="history.back()" value="キャンセル" class="cancel_button">
  </div>
  </div>
    
  </form>
  </main>
</body>
</html>