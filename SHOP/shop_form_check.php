<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注文フォーム</title>
</head>
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
  li {
    list-style: none;
    display: inline-block;
    padding-right: 15px;
  }

  ul {
    margin: 0;
    padding: 0
  }
  
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
  /*-----message時の文字サイズ-----*/
  .message {
    width: 450px;
    margin: 0 auto;
  }
  
  .message h3 {
    font-size: 15px;
    font-weight: 300;
    margin: 0;
  }
  
  .h3_left {
    float: left;
  }
  
  .h3_right {
    float: left;
  }
  
  .error {
    color: red;
    font-weight: bold;
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
  
  .cancel_but {
    background-color:rgba(244, 201, 84,1);
    transition: all 1s ease;
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
  
  .purchase:hover {
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
    text-align: center;
  }
  
  /*-----footer-----*/
  footer {
    font-size: 15px;
    color: #fff;
    width: 450px;
    height: 100px;
    line-height: 100px;
    text-align: center;
    margin: 0 auto
  }
</style>
<body>
  <nav class="navigation">
    <a href="../SHOP/shop_list.php"><img src="../images/logo.png" class="logo"></a>
    <img src="../images/logo2.png" class="company_logo">
  </nav>
  
  <?php
  require_once('../COMMON/common.php');
  $post = sanitize($_POST); //安全対策
  
  /*--------------------必須項目-----------------------*/
  $name1 = $post['name1'];
  $name2 = $post['name2'];
  $huri1 = $post['huri1'];
  $huri2 = $post['huri2'];
  $postal1 = $post['postal1'];
  $postal2 = $post['postal2'];
  $prefectures1 = $post['prefectures1'];
  $prefectures2 = $post['prefectures2'];
  $prefectures3 = $post['prefectures3'];
  $tel1 = $post['tel1'];
  $tel2 = $post['tel2'];
  $tel3 = $post['tel3'];
  $mail = $post['mail'];
  
  /*-----------------会員登録をする場合--------------------------*/
  $order = $post['order'];
  $pass = $post['pass'];
  $pass2 = $post['pass2'];
  $gender = $post['gen'];
  $year = $post['year'];
  $month = $post['month'];
  $day = $post['day'];
  $okfig = true; 
  /*---------------データのチェックをする-----------------------------*/
  /*---------------------必須項目------------------------*/?>
  
  <div class="message">
  <?php 
  if($name1 == "" || $name2 == "") { ?>
    <h3 class="error">・氏名が入力されていません。</h3>
    <?php $okfig = false;
  } else { ?>
    <h3>氏名：
    <?php print  $name1.$name2; ?></h3>
<?php }
  
  if(preg_match('/^[ァ-ヶｦ-ﾟー]+$/u',$huri1) == 0 || preg_match('/^[ァ-ヶｦ-ﾟー]+$/u',$huri2) == 0) { ?>
    <h3 class="error">・フリガナが入力されていません。</h3>
    <?php $okfig = false;
  } else { ?>
    <h3>フリガナ：
    <?php print  $huri1.$huri2; ?></h3>
<?php }
  
  if(preg_match('/\A[0-9]+\z/',$postal1) == 0 || preg_match('/\A[0-9]+\z/',$postal2) == 0) { ?>
    <h3 class="error">・郵便番号は半角で入力してください。</h3>
    <?php $okfig = false;
  } else { ?>
    <h3>郵便番号：
    <?php print  $postal1.'-'.$postal2; ?></h3>
<?php } ?>
  
<?php if($prefectures1 == '' || $prefectures2 == '' || $prefectures3 == '') { ?>
    <h3 class="error">・住所が正しく入力されていません。</h3>
    <?php $okfig = false;
  } else { ?>
    <h3>住所：
    <?php print  $prefectures1.$prefectures2.$prefectures3; ?></h3>
<?php }
    
  if(preg_match('/\A[0-9]+\z/',$tel1) == 0 || preg_match('/\A[0-9]+\z/',$tel2) == 0 || preg_match('/\A[0-9]+\z/',$tel3) == 0) { ?>
    <h3 class="error">・電話番号が正確に入力されていません。</h3>
    <?php $okfig = false;
  } else { ?>
    <h3>電話番号：
    <?php print  $tel1.'-'.$tel2.'-'.$tel3; ?></h3>
<?php }
  
  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/",$mail) == 0) { ?>
    <h3 class="error">・メールアドレスが正確に入力されていません。</h3>
    <?php $okfig = false;
  } else { ?>
    <h3>メールアドレス：
    <?php print  $mail; ?></h3>
<?php }
  
  /*------------------会員登録をする場合-----------------------*/
  if($order == 'member_registration') {
    if($pass == '') { ?>
      <h3 class="error">・パスワードが入力されていません。</h3>
      <?php $okfig = false;
    }
    
    if($pass != $pass2) { ?>
      <h3 class="error">・パスワードが一致しません。</h3>
      <?php $okfig = false;
    }
    
    if($gender == '') { ?>
      <h3 class="error">・性別を入力して下さい。</h3>
      <?php $okfig = false;
    } else { ?>
      <h3>性別：
      <?php print  $gender; ?></h3>
<?php }
    
    if($year == '' || $month == '' || $day == '') { ?>
      <h3 class="error">・生年月日を入力して下さい。</h3>
      <?php $okfig = false;
    } else { ?>
      <h3>生年月日：
      <?php print $year.'年'.$month.'月'.$day; ?>日</h3>
    </div>
<?php 
   }
  }
  if($okfig == true) { 
    print '<form method="post" action="shop_form_done.php">';
    print '<input type="hidden" name="name1" value="'.$name1.'">';
    print '<input type="hidden" name="name2" value="'.$name2.'">';
    print '<input type="hidden" name="huri1" value="'.$huri1.'">';
    print '<input type="hidden" name="huri2" value="'.$huri2.'">';
    print '<input type="hidden" name="postal1" value="'.$postal1.'">';
    print '<input type="hidden" name="postal2" value="'.$postal2.'">';
    print '<input type="hidden" name="prefectures1" value="'.$prefectures1.'">';
    print '<input type="hidden" name="prefectures2" value="'.$prefectures2.'">';
    print '<input type="hidden" name="prefectures3" value="'.$prefectures3.'">';
    print '<input type="hidden" name="tel1" value="'.$tel1.'">';
    print '<input type="hidden" name="tel2" value="'.$tel2.'">';
    print '<input type="hidden" name="tel3" value="'.$tel3.'">';
    print '<input type="hidden" name="mail" value="'.$mail.'">';
    /*-----------------------------------------------------------------*/
    print '<input type="hidden" name="order" value="'.$order.'">';
    print '<input type="hidden" name="pass" value="'.$pass.'">';
    print '<input type="hidden" name="gen" value="'.$gender.'">';
    print '<input type="hidden" name="year" value="'.$year.'">';
    print '<input type="hidden" name="month" value="'.$month.'">';
    print '<input type="hidden" name="day" value="'.$day.'">'; ?>
    <p>本当に購入しますか？</p>
   <div class="button">
    <input type="submit" value="購入する" class="purchase">
    
    <div class="cancel_but">
    <a href="../SHOP/shop_cartlook.php" class="cancel">キャンセル</a>
    </div>
   </div>
  <?php 
    print '</form>';
  } else {
    print '<form>';
    print '<input type="button" onclick="history.back()" value="入力画面に戻る" class="back_button">';
    print '</form>';
  }
  ?>
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
</body>
</html>
