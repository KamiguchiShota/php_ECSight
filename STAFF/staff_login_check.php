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
    
    p {
      font-size: 12px;
      color: red;
      margin: 0;
    }
    
  </style>
<body>
  <div class="div_logo">
    <img src="../images/logo.png" class="logo">
    <img src="../images/logo2.png" class="logo2">
    </div>
</body>
<?php
try {
  require_once('../COMMON/common.php');
  $post = sanitize($_POST);
  $staff_code = $post['code'];
  $staff_pass = $post['pass'];
  
  //$staff_pass = md5($staff_pass); 
  
  /*データベースに接続*/
  $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  $sql = 'select staffname from staff where staffcode=? and staffpass=?';
  $stmt = $dbh->prepare($sql);
  $date[] = $staff_code;
  $date[] = $staff_pass;
  $stmt->execute($date);
  
  $dbh = null;
  
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($rec == false) { ?>
    <form method="post" action="staff_login_check.php" class="form">
    <div class="login_h1">
    <h1>管理画面ログイン</h1>
    </div>
    <p>※コード又はパスワード違います。</p>
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
<?php } else {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['staff_code'] = $staff_code;
    $_SESSION['staff_name'] = $rec['staffname'];
    header('Location: staff_top.php');
    exit();
  }
}

  catch(Exception $e) {
    print 'ただいま故障によりご迷惑をお掛けしております。';
    exit();
  }

?>