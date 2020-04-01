<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ 削除</title> 
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
  
  .div_form {
    width: 810px;
    height: auto;
    margin-top: 113px;
  }
  
  .form {
    width: 320px;
    display: block;
    margin: 0 auto;
    color: #000;
  }
  
  .form h2 {
    font-size: 15px;
    font-weight: 300;
  }
  
  .code,.staff,.position {
    margin: 0;
    font-size: 18px;
  }
  
  .button {
    margin: 0 auto;
    width: 320px;
    height: 35px;
    text-align: center;
  }
  
  .delete_button {
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
      /*選択されたスタッフコード*/
      $staff_code = $_GET['staffcode'];
      
      /*データベースに接続*/
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sql = 'select staffname,position from staff where staffcode=?';
      /*スタッフコードで絞り込む。1件のレコードになるまで絞り込む。*/
      $stmt = $dbh->prepare($sql);
      $date[] = $staff_code;
      $stmt->execute($date);
      
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $staff_name = $rec['staffname'];
      $staff_position = $rec['position'];
      
      $dbh = null;
    }
     catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
  ?>
  
  <form method="post" action="staff_delete_done.php" class="div_form">
    <div class="form">
      <h2 class="code">スタッフコード：<?php print $staff_code; ?></h2>
      <h2 class="staff">スタッフ名：<?php print $staff_name; ?></h2>
      <h2 class="position">役職名：<?php print $staff_position; ?></h2>
      <p>このスタッフを本当に削除していいですか？</p>
    </div>
    <div class="button">
      <input type="hidden" name="code" value="<?php print $staff_code; ?>">
      <input type="submit" value="削除" class="delete_button">
      <input type="button" onclick="history.back()" value="キャンセル" class="cancel_button">
    </div>
  </form>
  </main>
</body>
</html>