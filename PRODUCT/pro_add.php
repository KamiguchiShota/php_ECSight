<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>商品追加</title> 
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
    
  .div_form {
    width: 810px;
    margin-top: 117px;
  }
  
  .form {
    display: block;
    margin: 0 auto;
    width: 312px;
    height: 330px;
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
    
  .add_button {
    width: 80px;
    height: 35px;
    margin-left: 70px;
    margin-right: 5px;
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
    
  <form method="post" action="pro_add_check.php" enctype="multipart/form-data" class="div_form">
    <div class="form">
        <h4>商品番号</h4>
        <input type="text" name="productcode" class="productcode" placeholder="（例）GLOVE000"><br>
        <h4>商品名</h4>
        <input type="text" name="productname" class="productname" placeholder="（例）〇〇〇モデル"><br>
        <h4>価格</h4>
        <input type="text" name="price" class="price" placeholder="（例）30000"><br>
        <h4>画像</h4>
        <input type="file" name="gazou" class="gazou"><br>
        <!--fileを取り込むことができる-->
          <div class="button">
            <input type="submit" value="追加" class="add_button">
            <input type="button" onclick="history.back()" value="キャンセル" class="cancel_button">
          </div>
      </div>
  </form>
  </main>
</body>
</html>