<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>商品追加完了</title>
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
    color: #000;
    display: flex;
    top: 100px;
    left: 200px;
    font-weight: 300;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
  
  /*-----button-----*/
  .top_back {
    width: 185px;
    height: auto;
    margin: 0 auto;
    margin-top: 107px;
  }
  
  .top_back p {
    font-size: 15px;
    font-weight: 300;
    
  }
  
  button {
    width: 75px;
    height: 35px;
    display: block;
    margin: 0 auto;
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
      <h3>従業員登録</h3>
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
    //安全対策
    require_once('../COMMON/common.php');
      $post = sanitize($_POST);
      $pro_productcode = $post['productcode'];
      $pro_productname = $post['productname'];
      $pro_price = $post['price'];
      $pro_gazou_name = $post['gazou_name'];
    
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql = 'insert into product(productcode,ProductName,Price,IMG) values (?,?,?,?)';

      $stmt = $dbh->prepare($sql);
      $date[] = $pro_productcode;
      $date[] = $pro_productname;
      $date[] = $pro_price;
      $date[] = $pro_gazou_name;
      $stmt->execute($date);

      $dbh = null;
  }
    catch(Exception $e) {
      print 'ただいま故障によりご迷惑をお掛けしております。';
      exit();
    }
  ?>
  
    <div class="top_back">
      <p>商品の追加完了しました。<br>一覧で確認して下さい。</p>
      <a href="pro_list.php"><button>戻る</button></a>
    </div>
  </main>
</body>
</html>