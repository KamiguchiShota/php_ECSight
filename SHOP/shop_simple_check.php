<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) == false) {
  print 'ログインされていません。';
  print '<a href="shop_list.php">商品一覧へ</a>';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注文フォーム</title>
  <style>
    body {
    width: 1040px;
    height: auto;
    margin: 0 auto;
    color: #fff;
    font-size: 15px;
    font-family: "Hiragino Kaku Gothic Pro W3","Hiragino Kaku Gothic ProN",Meiryo,sans-serif;
    background: url(../images/shop_background.png)no-repeat fixed; 
    background-size: cover;
    
  }
  
  /*-----navigation全体-----*/
  .navigation {
    width: 1040px;
    height: 120px;
    z-index: 999;
    color: #fff;
    margin: 25px 0 50px 0;
  }
  
  .navigation a {
    color: #fff;
    text-decoration: none;
  }
  
  .navigation a:hover {
    color: #2886bf;
  }
  
/*------navigation タイトル名・logo、login_name-----*/
  .logo {
    width: 120px;
    height: auto;
    float: left;
  }
  
  .company_logo {
    width: 270px;
    z-index: 999;
    float: left;
    padding-top: 80px;
  }
    
  /*-----member_purchase-----*/
    .member_purchase {
      width: 450px;
      height: auto;
      margin: 0 auto;
    }
    
    .member_purchase h3 {
      font-size: 15px;
      font-weight: 300;
      margin: 0;
    }
    
  /*-----バックbutton-----*/ 
  .back_button {
    width: 200px;
  }
  
  .cancel_but {
    width: 120px;
    height: 27px;
    padding-top: 3px;
    text-align: center;
    background-color:rgba(244, 201, 84,.8);

  }
  .cancel_but a {
    text-decoration: none;
    color: #fff;
  }
  
  .purchase {
    width: 120px;
    height: 30px;
    background-color: rgba(40,153,191,0.8);
    text-align: center;
    color: #fff;
    margin-right: 10px;
    border: 0;
  }
    
  .purchase {
    background-color: rgba(40,153,191,1);
    transition: all 1s ease;
  }
  
  .button {
    width: 450px;
    display: flex;
    justify-content:center;
  }
  
  .back_button {
    width: 150px;
    height: 30px;
    background-color:rgba(244, 201, 84,.8);
    border: 0;
    color: #fff;
    margin-top: 20px;
    margin-left: 150px;
  }
  
  .back_button:hover {
    background-color:rgba(244, 201, 84,1);
    transition: all 1s ease;
  }
  form {
    width: 450px;
    margin: 0 auto;
  }
    
  form p {
    width: 450px;
    text-align: center;
  }
 /*-----footer-----*/
  footer {
    font-size: 15px;
    color: #fff;
    width: 1040px;
    height: 100px;
    line-height: 100px;
    text-align: center;
  }
  </style>
</head>
<body>
  <nav class="navigation">
    <img src="../images/logo.png" class="logo">
    <img src="../images/logo2.png" class="company_logo">
  </nav>
  <?php
    $code = $_SESSION['member_code'];
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
    $sql = 'select name1,name2,huri1,huri2,postal1,postal2,prefectures1,prefectures2,prefectures3,tel1,tel2,tel3,mail from data_member where code=?';
  
    $stmt = $dbh->prepare($sql);
    $date[] = $code;
    $stmt->execute($date);
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $dbh = null;
  
    $name1 = $rec['name1'];
    $name2 = $rec['name2'];
    $huri1 = $rec['huri1'];
    $huri2 = $rec['huri2'];
    $postal1 = $rec['postal1'];
    $postal2 = $rec['postal2'];
    $prefectures1 = $rec['prefectures1'];
    $prefectures2 = $rec['prefectures2'];
    $prefectures3 = $rec['prefectures3'];
    $tel1 = $rec['tel1'];
    $tel2 = $rec['tel2'];
    $tel3 = $rec['tel3'];
    $mail = $rec['mail'];
  ?>

  <div class="member_purchase">
  <h3>氏名：<?php print $name1.$name2; ?> </h3>
  <h3>フリガナ：<?php print $huri1.$huri2; ?></h3>
  <h3>メールアドレス：<?php print $mail; ?></h3>
  <h3>郵便番号：<?php print $postal1.$postal2; ?></h3>
  <h3>住所：<?php print $prefectures1.$prefectures2.$prefectures3; ?></h3>
  <h3>電話番号：<?php print $tel1.'-'.$tel2.'-'.$tel3; ?></h3>
  </div>
  
  
    <form method="post" action="shop_simple_done.php">
  <?php
    print '<input type="hidden" name="name1" value="'.$name1.'">';
    print '<input type="hidden" name="name2" value="'.$name2.'">';
    print '<input type="hidden" name="postal1" value="'.$postal1.'">';
    print '<input type="hidden" name="postal2" value="'.$postal2.'">';
    print '<input type="hidden" name="prefectures1" value="'.$prefectures1.'">';
    print '<input type="hidden" name="prefectures2" value="'.$prefectures2.'">';
    print '<input type="hidden" name="prefectures3" value="'.$prefectures3.'">';
    print '<input type="hidden" name="tel1" value="'.$tel1.'">';
    print '<input type="hidden" name="tel2" value="'.$tel2.'">';
    print '<input type="hidden" name="tel3" value="'.$tel3.'">';
    print '<input type="hidden" name="mail" value="'.$mail.'">'; 
    /*-----------------------------------------------------------------*/?>
  <p>本当に購入しますか？</p>
  <div class="button">
    <input type="submit" value="購入する" class="purchase">
    <div class="cancel_but">
    <a href="../SHOP/shop_cartlook.php" class="cancel">キャンセル</a>
    </div>
   </div>
  </form>
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
</body>
</html>
