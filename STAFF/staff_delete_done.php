<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ削除完了</title> 
</head>
<style>
/*-----管理者画面全て統一項目-----*/
  body {
    width: 1040px;
    background-color: #eff0f4;
    margin: 0 auto;
    position: relative;
    color: #fff;
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
  }

/*ログインname*/
  .login_name h2 {
    padding-left: 10px;
  }
    
/*-----必要事項(overall)-----*/
  .overall {
    width: 1040px;
    height: auto;
    display: flex;
    flex-direction:row
  }
  
/*------左側にあるnavigation-----*/
  /*------左側にあるnavigation-----*/
  .leftmenu {
    width: 230px;
    height: 400px;
  }
  
  .leftmenu ul li {
    border: solid 1px #d8d8e5;
    width: 190px;
  }
  
  .leftmenu li:hover {
    background-color: #fff;
  }
  
  .leftmenu ul {
    padding: 0;
    position: fixed;
    top: 100px;
  }
  
  .empty {
    width: 190px;
    height: 250px;
  }
  .leftmenu .empty:hover{
    background-color: #eff0f4;
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
  
.div_top_back {
    width: 780px;
    height: auto;
    margin-top: 98px;
  }
  
  .top_back {
    width: 150px;
    display: block;
    margin: 0 auto;
  }
  
  .div_top_back p {
    font-size: 15px;
    font-weight: 300;
    color: #000;
  }
  
  button {
    width: 80px;
    height: 35px;
    margin-left: 30px;
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
      <h3>従業員修正</h3>
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
      $staff_code = $_POST['code'];
      /*データベース接続*/
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      /*削除*/
      $sql = 'delete from staff where staffcode=?';
      $stmt = $dbh->prepare($sql);
      $date[] = $staff_code;
      $stmt->execute($date);

      $dbh = null;
    }
    catch(Exception $e) {
      print 'ただいま故障によりご迷惑をお掛けしております。';
      exit();
    }
  ?>
    <div class="div_top_back">
      <div class="top_back">
      <p>削除完了しました。</p>
      <a href="staff_list.php"><button>戻る</button></a>
      </div>
    </div>
  </main>
</body>
</html>