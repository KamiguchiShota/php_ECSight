<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
if(isset($_SESSION['login']) == false) {
  header('Location: ../STAFF/staff_login.html');
  exit(); 

} else {
  print '<div class="login_name">';
  print '<h1>S.Kbaseball野球工房</h1>';
  print '<h2>';
  print $_SESSION['staff_name'];
  print 'さんログイン中<br>';
  print '</h2>';
  print '</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>DB</title>
</head>
  <style>
    
/*-----------------------------管理者画面全て統一項目-------------------------------------*/
body {
      width: 1040px;
      background-color: #eff0f4;
      margin: 0 auto;
      position: relative;
    }
    
    .login_name h2 {
      padding-left: 10px;
    }
  
  .leftmenu {
    position: fixed;
      width: 230px;
      height: auto;
    }

    .leftmenu h3 {
      position: fixed;
      top: 74px;
      margin: 0;
      font-size: 18px;
      padding-left: 10px;
    }
    
  
    
    .leftmenu ul {
      margin: 0;
      padding: 0;
      width: 210px;
      position: absolute;
      top: 125px;
      left: 0px;
      z-index: 0;
      
      
    }
  
  
    .staff1,.staff2,.staff3,.staff4,.staff5,.staff6,.staff7 {
      margin-bottom: -25px;
      width: 200px;
      height: 30px;
      background-color: #f3f4f6;
      border: solid 1px #d8d8e5;
      display: flex; /*flexboxはまず最初にdisplay:flexをする*/
      /*justify-content: center;*/ /*幅を真ん中*/
      align-items: center; /*上下を真ん中*/
      list-style: none;
      padding-left: 10px;
    }
    
    .staff1:hover {
      background-color: #fff;
      
    }
    .staff2:hover {
      background-color: #fff;
    }
    .staff3:hover {
      background-color: #fff;
    }
    .staff4:hover {
      background-color: #fff;
    }
    .staff5:hover {
      background-color: #fff;
    }
    .staff6:hover {
      background-color: #fff;
    }
    .staff7:hover {
      background-color: #fff;
    }
    a {
      text-decoration: none;
      color: #000;
      
    }
    
    
    .enpty {
      position: fixed;
      height: 500px;
      width: 210px;
      border: solid 1px #d8d8e5;
      margin-left: 0px;
      top: 125px;
      z-index: -100;
      
    }
    
/*----------------------------------------------------------------------*/
    
    
/*-------------------共通部分・上の紺色のところ------------------------*/
    .login_name {
      width: 1040px;
      height: 50px;
      background-color: #2e4c51;
      display: flex; /*flexboxはまず最初にdisplay:flexをする*/
      /*justify-content: center;*/ /*幅を真ん中*/
      align-items: center; /*上下を真ん中*/
      z-index: 999;
    }
    
    .login_name h1 {
      float: left;
      padding-left: 10px;
      margin: 0;
      font-size: 20px;
      width: 1000px;
    }
    
    .login_name h2 {
      width: 300px;
      padding-right: 10px;
      margin: 0;
      font-size: 18px;
      text-align: right;
      
    }
    
    /*ログイン中の名前を表示*/
    .login_name {
      color: #fff;
      position: fixed;
    }
    
/*------------------------------------------------------------*/
    
    form {
      position: absolute;
      top: 20%;
      left: 40%;
    }

</style>
<body>
  
  <div class="leftmenu">
    <h3>商品詳細</h3>
    <ul>
      <li class="staff1"><a href="../STAFF/staff_top.php">トップ</a></li><br>
      <li class="staff2"><a href="../STAFF/staff_list.php">スタッフ管理</a></li><br>
      <li class="staff3"><a href="../STAFF/staff_add.php">スタッフ追加</a></li><br>
      <li class="staff4"><a href="../PRODUCT/pro_list.php">商品管理</a></li><br>
      <li class="staff5"><a href="../STAFF/staff_member_list.php">お客様情報</a></li><br>
      <li class="staff6"><a href="../ORDER/order_download.php">注文ダウウンロード</a></li><br>
      <li class="staff7"><a href="../STAFF/staff_logout.php">ログアウト</a></li><br>
    </ul>
    <div class="enpty"></div>
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
      $pro_gazou_name = $rec['img'];
      
      $dbh = null;
      
      if($pro_gazou_name == '') {
        $disp_gazou='';
        
      } else {
        $disp_gazou ='<img src="../images/'.$pro_gazou_name.'">';
      }
      
    }
     catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
  ?>
  
  商品情報参照<br>
  商品コード<br>
  <form>
  <?php print $pro_productcode; ?><br>
  
  商品名<br>
  <?php print '『'.$pro_productname.'』'; ?><br>
  
  価格<br>
  <?php print $pro_price; ?>円<br>
    
  <?php print $disp_gazou; ?><br>
  
  
  <input type="button" onclick="history.back()" value="戻る">
  </form>
</body>