<?php
session_start();
session_regenerate_id(true);
//session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ追加確認画面</title> 
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
    padding-top: -20px;
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
    top: 120px;
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
  
  /*-----全て入力されている場合-----*/
  .div_add_check {
    width: 810px;
    display: block;
    margin:  0 auto;
    margin-top: 120px;
  }
  
  .add_check {
    width: 270px;
    height: auto;
    margin: 0 auto;
  }
  
  .add_check h2 {
    font-size: 15px;
    font-weight: 270;
    display: block;
    margin: 0 auto;
  }
  
  p {
    font-size: 13px;
    text-align: center;
  }
  
  /*-----error-----*/
  .add_check .error {
    font-size: 15px;
    font-weight: 300;
    color: red;
    display: block;
    margin: 0 auto;
  }
  
  .div_error_button {
    width: 810px;
    display: block;
    text-align: center;
    margin-top: 20px;
  }

  .error_button {
    width: 90px;
    height: 32px;
    margin: 0 auto;
  }
  
  /*-----form button、submit-----*/
  .div_add_submit {
    width: 810px;
    text-align: center;
  }
  
  .add_submit {
    width: 90px;
    height: 32px;
  }
  
  .cancel_button {
    width: 90px;
    height: 32px;
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
    require_once('../COMMON/common.php'); //安全対策(別ファイルに記載)
    //①xssを防ぐ②htmlの入力で正しく入力させる。
    $post = sanitize($_POST);
    $staff_name = $post['name'];
    $staff_pass = $post['pass'];
    $staff_pass2 = $post['pass2'];
    $staff_position = $post['position'];
    $staff_year = $post['year'];
    $staff_month = $post['month'];
    $staff_day = $post['day'];
    $staff_time = $staff_year.'-'.$staff_month.'-'.$staff_day; 
?>
    <div class="div_add_check">
      <div class="add_check">
  <?php if ($staff_name == '') { ?>
        <h2 class="error">・スタッフ名が入力されていません。</h2>
  <?php } else { ?>
        <h2>スタッフ名：<?php print $staff_name; ?></h2>
  <?php }

        if($staff_pass == '') { ?>
        <h2 class="error">・パスワードが入力されていません。</h2>
  <?php }

        if($staff_pass != $staff_pass2) { ?>
        <h2 class="error">・確認パスワードが一致しません。</h2>
  <?php }

      if($staff_position == '') { ?>
        <h2 class="error">・役職名が入力されていません。</h2>
  <?php } else { ?>
        <h2>役職名：<?php print $staff_position; ?></h2>
  <?php }

      if($staff_time == '--') { ?>
        <h2 class="error">・登録日が入力されていません。</h2>
  <?php } else { ?>
        <h2>登録日：<?php print $staff_time; ?></h2>
  <?php } ?>
    </div>
<?php
    if($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2 ||$staff_position == '' || $staff_time == '') { ?>
      <?php //問題がある場合は「戻る」ボタンを表示する。 ?>
      <div class="div_error_button">
        <input type="button" onclick="history.back()" value="戻る" class="error_button">
      </div>
    </div>
<?php } else { 
      //しっかりと入力されている場合は「OK」「戻る」を表示する。
      //OKを押した場合は、staff_add_done.phpに飛ばす。
      //$staff_pass = md5($staff_pass); //md5暗号化にする
      ?>
      <form method="post" action="staff_add_done.php">
        <p>下記の内容で送信してもよろしいですか？<br>よろしければ追加をクリックして下さい。</p>
        <input type="hidden" name="name" value="<?php print $staff_name; ?>">
        <input type="hidden" name="pass" value="<?php print $staff_pass; ?>">
        <input type="hidden" name="position" value="<?php print $staff_position; ?>">
        <input type="hidden" name="time" value="<?php print $staff_time; ?>">
        <!--input type="hidden" 非表示データを送信する-->
        <div class="div_add_submit">
          <input type="submit" value="追加" class="add_submit">
          <input type="button" onclick="history.back()" value="キャンセル" class="cancel_button">
        </div>
      </form>
<?php } ?> 
    </main>
  </body>
</html>