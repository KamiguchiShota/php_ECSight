<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>login_check</title>
</head>
  
<script>
  function Focus(){
    document.myform.mail.focus()
  }
</script>
  
<style>
  * {
    box-sizing: border-box;
  }
  
  body {
    background: url(../images/background006.png)no-repeat fixed; 
    background-size: cover;
    width: 1040px;
    height: 620px;
    margin: 0 auto;
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    color: #111;
  }
  
/*------logo------*/
  .logo_top {
    width: 1040px;
    height: auto;
    text-align: center;
    margin: 15px 0;
  }
  
  .logo {
    width: 130px;
    height: auto;
  }
  
/*-----注意文-----*/
  
  .writing {
    width: 290px;
    height: 85px;
    border: solid 1px red;
    background-color: rgba(255,255,255,.7);
    padding: 14px 18px 14px 10px;
    margin: 0 auto;
    margin-bottom: 20px;
    
  }
  
  h4 {
    font-size: 13px;
    margin: 0;
    padding-left: 10px;
    font-weight: 400;
    line-height: 19px;
    color: #111;
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    float: left;
  }
  
  h4 span{
    font-weight: 400;
    font-size: 17px;
    line-height: 1.255;
    color: red;
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    margin-bottom: 4px;
  }
  
  .error {
    width: 29px;
    height: auto;
    z-index: 999;
    float: left;
  }
  
/*-----form-----*/
  form {
    width: 300px;
    height: 220px;
    margin: 0 auto;
    border: solid 1px #d8d8e5;
    padding: 20px 26px;
    background-color: rgba(255,255,255,.7);
    box-sizing: content-box;
  }
  
  .h1 {
    font-weight: 400;
    font-size: 28px;
    line-height: 1.2;
    margin: 0;
    margin-bottom: 10px;
  }
  
  h2 {
    font-size: 14px;
    margin: 0;
  }
  
  .mail,.pass {
    width: 278px;
    height: 20px;
    padding: 3px 7px;
    margin-bottom: 20px;
    box-sizing: content-box;
  }
  
  .submit {
    width: 296px;
    height: 30px;
    padding: 1px 6px;
    background-color: #2886bf;
  }
  
/*-----footer-----*/
  
  footer {
    font-size: 14px;
    color: #fff;
    margin: 0 auto;
    width: 1040px;
    height: 100px;
    line-height: 100px;
    text-align: center;
  }
</style>
<?php 
  try {
    require_once('../COMMON/common.php');
    $post = sanitize($_POST);
    $member_mail = $post['mail'];
    $member_pass = $post['pass'];
    //$staff_pass = md5($staff_pass); 

    /*データベースに接続*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'select code,name1,name2 from data_member where mail=? and password=?';
    $stmt = $dbh->prepare($sql);
    $date[] = $member_mail;
    $date[] = $member_pass;
    $stmt->execute($date);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false) { 
?>
  <div class="logo_top">
    <a href="../SHOP/shop_list.php"><img src="../images/logo.png" class="logo"></a>
  </div>
  
  <div class="writing">
    <img src="../images/error.png" class="error">
    <h4><span>問題が発生しました。</span><br>メールアドレス、パスワードの入力に<br>誤りがあるか登録されていません。</h4>
  </div>
  
<?php
    } else {
      $_SESSION['member_login'] = 1;
      $_SESSION['member_code'] = $rec['code'];
      $_SESSION['member_name1'] = $rec['name1'];
      $_SESSION['member_name2'] = $rec['name2'];
      header('Location: ../SHOP/shop_list.php');
      exit();
    }
  }
    catch(Exception $e) {
      print 'ただいま故障によりご迷惑をお掛けしております。';
      exit();
    }
?>
  <body onload="Focus()">
  <form method="post" action="member_login_check.php" name="myform">
    <h1 class="h1">ログイン</h1>
    <h2>メールアドレス</h2>
    <input type="text" name="mail" class="mail"><br>
    <h2>パスワード</h2>
    <input type="password" name="pass" class="pass"><br>
    <input type="submit" value="ログイン" class="submit">
  </form>
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
  
  </body>
  </html>