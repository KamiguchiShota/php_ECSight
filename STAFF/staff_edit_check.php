<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ修正チェック</title> 
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
    left: 55px;
    color: #000;
    font-weight: 300;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
  
  /*-----入力に不備-----*/
  .staff_edit_check {
    width: 810px;
    margin: 0 auto;
  }
  
  .check {
    width: 350px;
    display: block;
    margin: 0 auto;
    margin-top: 110px;
  }
  
  .check h2 {
    color: #000;
    font-weight: 300;
    font-size: 15px;
    margin: 0;
  }
  
  .div_back_button {
    width: 380px;
    display: block;
    margin: 0 auto;
  }
  .div_back_button p {
    font-size: 15px;
    color: #000;
  }
  
  .back_button {
    width: 85px;
    height: 35px;
    display: block;
    margin: 0 auto;
  }
  
  .staff_edit_check .error {
    font-size: 15px;
    font-weight: 300;
    margin: 0;
    color: red;
  }
  
  /*-----正しく入力-----*/
  .div_form {
    width: 350px;
    color: #000;
    margin: 0 auto;
  }
  .button {
    width: 80px;
    height: 35px;
    margin-left: 135px;
  }
  
  .button1 {
    width: 80px;
    height: 35px;
    
  }
  
  .submit1 {
    width: 80px;
    height: 35px;
    margin-right: 10px;
    margin-left: 75px;
  }
  
</style>
</head>
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
    //安全対策
    require_once('../COMMON/common.php');
      $post = sanitize($_POST);
      $staff_name = $post['name'];
      $staff_pass = $post['pass'];
      $staff_pass2 = $post['pass2'];
      $staff_position = $post['position'];
      $staff_code = $post['code'];
      $staff_year = $post['year'];
      $staff_month = $post['month'];
      $staff_day = $post['day'];
      $staff_time = $staff_year.'-'.$staff_month.'-'.$staff_day;
  ?>
  <div class="staff_edit_check">
    <div class="check">
  <?php if ($staff_name == '') { ?>
      <h2 class="error">スタッフ名が入力されていません。</h2>
  <?php } else { ?>
      <h2>スタッフ名：<?php print $staff_name; ?></h2>
  <?php } 
      
      if($staff_pass == '') { ?>
        <h2 class="error">パスワードが入力して下さい。</h2>
  <?php } 
      
      if($staff_pass != $staff_pass2) { ?>
        <h2 class="error">パスワードが一致しません。</h2>
  <?php }
      
      if($staff_position == '') { ?>
        <h2 class="error">役職名が入力されていません。</h2>
  <?php } else { ?>
        <h2>役職：<?php print $staff_position; ?></h2>
  <?php }
    if($staff_time == '--') { ?>
        <h2 class="error">登録日を入力して下さい。</h2>
  <?php } else { ?>
         <h2>登録日：<?php print $staff_time; ?></h2>
  <?php } ?>
    </div>
  <?php 
    if($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2 || $staff_position == '' || $staff_time == '--') {
  ?>
    <div class="div_back_button">
      <p>※入力に誤りがあります。再度入力をし直して下さい。</p>
      <input type="button" onclick="history.back()" value="戻る" class="back_button">
      <!--問題がある場合は「戻る」ボタンを表示する。-->
    </div>
    
  <?php } else { ?>
     <!-- しっかりと入力されている場合は「OK」「キャンセル」を表示する。-->
    <div class="div_form">
      <form method="post" action="staff_edit_done.php">
        <p>上記の内容に変更します。よろしいですか？</p>
        <!--input type="hidden" 非表示データを送信する-->
        <input type="hidden" name="code" value='<?php print $staff_code; ?>'>
        <input type="hidden" name="name" value='<?php print $staff_name; ?>'>
        <input type="hidden" name="pass" value='<?php print $staff_pass; ?>'>
        <input type="hidden" name="position" value='<?php print $staff_position; ?>'>
        <input type="hidden" name="time" value='<?php print $staff_time; ?>'>
        <input type="submit" value="修正" class="submit1">
        <input type="button" onclick="history.back()" value="戻る" class="button1">
        <!--onclick="history.back()一つ前の画面に戻る-->
  <?php } ?>
      </form>
    </div>
  </div>
  </main>
</body>
</html>