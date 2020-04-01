<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>商品変更確認</title> 
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
    left: 55px;
    color: #000;
    font-weight: 300;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
  
  .div_edit {
    width: 810px;
    height: auto;
    color: #000;
    margin-top: 115px;
  }
  
  .edit {
    width: 230px;
    display: block;
    margin: 0 auto;
  }
  
  .edit h2 {
    font-size: 15px;
    font-weight: 300;
    margin: 0;
  }
  
  .edit p {
    margin: 0;
  }
  .glove_img {
    width: 160px;
    height: auto;
  }
  
  /*-----入力ミス-----*/
  .error {
    color: red;
  }
  
  .div_back_buuton {
    width: 100px;
    display: block;
    margin: 0 auto;
    margin-top: 15px;
  }
  
  .back_buuton {
    width: 75px;
    height: 30px;
    
  }
  
  /*-----button-----*/
  .buttion {
    width: 200px;
    text-align: center;
  }
  
  .cancel_button {
    width: 80px;
    height: 32px;
  }
  
  .update_button {
    width: 80px;
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
    //安全対策
    require_once('../COMMON/common.php');
      $post = sanitize($_POST);
      $pro_productcode = $post['productcode'];
      $pro_productname = $post['productname'];
      $pro_price = $post['price'];
      $pro_gazou_name_old = $post['gazou_name_old'];
      $pro_gazou = $_FILES['gazou'];
?>
  <div class="div_edit">
    <div class="edit">
    <h2>商品番号：<?php print $pro_productcode; ?></h2>
<?php
      if ($pro_productname == '') { ?>
        <h2 class="error">商品名が入力されていません。</h2>
<?php } else { ?>
        <h2>商品名：<?php print $pro_productname; ?></h2>
<?php }
    
      if(preg_match('/\A[0-9]+\z/',$pro_price) == 0) { ?>
        <h2 class="error">価格を入力して下さい。</h2>
<?php } else { ?>
        <h2>価格：<?php print $pro_price; ?>円</h2>
<?php }
    
      if($pro_gazou['size'] > 0) {
        if($pro_gazou['size'] > 1000000) { ?>
        <h2 class="error">画像が大き過ぎます</h2>
<?php } else { 
          move_uploaded_file($pro_gazou['tmp_name'],'../images/'.$pro_gazou['name']);
          print'<img src="../images/'.$pro_gazou['name'].'" class="glove_img"><br>';
          print '<br>';
        }
      }
       
    
    if($pro_productname  == '' || preg_match('/\A[0-9]+\z/',$pro_price) == 0 || $pro_gazou['size'] > 1000000) { ?>
      <!--問題がある場合は「戻る」ボタンを表示する。-->
      <div class="div_back_buuton">
      <input type="button" onclick="history.back()" value="戻る" class="back_buuton">
      </div>
      </div>
<?php } else { ?>
      <!--しっかりと入力されている場合は「OK」「戻る」を表示する。-->
      <!--//OKを押した場合は、staff_add_done.phpに飛ばす。-->
      <p>上記の用に変更します。</p>
      <form method="post" action="pro_edit_done.php">
        <input type="hidden" name="productcode" value="<?php print $pro_productcode; ?>">
        <input type="hidden" name="productname" value="<?php print $pro_productname; ?>">
        <input type="hidden" name="price" value="<?php print $pro_price; ?>">
        <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
        <input type="hidden" name="gazou_name" value="<?php print $pro_gazou['name'];?>">
        <!--input type="hidden" 非表示データを送信する-->
        <br>
        <input type="submit" value="修正" class="update_button">
        <input type="button" onclick="history.back()" value="キャンセル" class="cancel_button">
        <!--onclick="history.back()一つ前の画面に戻る-->
      </form>
    </div>
<?php } ?>
  </main>
  </body>
</html>




