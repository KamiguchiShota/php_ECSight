<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフログイン</title> 
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
    color: #000;
    font-weight: 300;
    margin-top: 75px;
    margin-left: 10px;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
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

  <div class="leftmenu">
    <h3>管理者トップメニュー</h3>
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
  </body>
</html>