<?php
session_start();
$_SESSION = array();

if(isset($_COOKIE[session_name()]) == true) { //中身を空にする
  setcookie(session_name(),'',time()-42000,'/'); //PC側のsession_IDをクッキーから削除。
}
  session_destroy(); //サーバーとPCを切断。
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフログイン</title> 
</head>
  <style>
    body {
      width: 1040px;
      background: url(../images/staff_login.png)no-repeat fixed; 
      background-size: cover;
      
    }
    
    .div_logo {
      margin-top: 15px;
      margin-left: 10px;
    }
    
    .logo {
      width: 100px;
      height: auto;
    }
    
    .form {
      width: 225px;
      height: 400x;
      padding: 20px;
      margin-left: 160px;
      margin-top: 70px;
      background-color: rgba(255,255,255,.9);
    } 
    
    .login_h1 h1 {
      font-size: 28px;
      font-weight: 400;
      color: #000;
      margin-top: 0;
    }
    
    
    .code h2 {
      font-size: 16px;
      font-weight: 300;
      color: #000;
      margin: 0;
    }
    
    .code input {
      width: 220px;
      height: 24px;
    }
    
    .pass h2 {
      font-size: 16px;
      font-weight: 300;
      color: #000;
      margin: 0;
    }
    
    .pass input {
      width: 220px;
      height: 24px;
    }
    
    .button {
      width: 225px;
      text-align: center;
    }
    
    .login_button {
      width: 95px;
      height: 28px;
      padding: 2px;
    }
    
  </style>
  <body>
    <div class="div_logo">
    <img src="../images/logo.png" class="logo">
    <img src="../images/logo2.png" class="logo2">
    </div>
    <form method="post" action="staff_login_check.php" class="form">
    <div class="login_h1">
    <h1>管理画面ログイン</h1>
    </div>
    <div class="code">
    <h2>スタッフコード</h2>
    <input type="text" name="code">
    </div>
    <br>
      
    <div class="pass">
    <h2>パスワード</h2>
    <input type="password" name="pass">
    </div>
    <br>
      
    <div class="button">
    <input type="submit" value="ログイン" class="login_button">
    </div>
    
    </form>
</body>
</html>