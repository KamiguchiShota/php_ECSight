<?php
  session_start();
  session_regenerate_id(true);
if(isset($_SESSION['member_login']) == false) {
  print 'ログインされていません。<br>';
  print '<a href="shop_list.php">商品一覧へ</a>';
  exit();
}
?>
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
  
  /*-----メール-----*/
  .order_mail {
    width: 450px;
    margin: 0 auto;
  }
  
  .order_mail p {
    margin: 0;
  }
  .order_mail h1 {
    font-size: 22px;
  }
  
  /*-----トップに戻るボタン-----*/
  .top {
    margin-left: 460px;
    margin-top: 20px;
    width: 120px;
    height: 26px;
    background-color:rgba(244, 201, 84,.8);
    text-align: center;
    padding-top: 4px;
  }
  
  .top:hover {
    background-color:rgba(244, 201, 84,1);
    transition: all 1s ease;
  }
  
  .top a {
    color: #fff;
    text-decoration: none;
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
<body>
  <nav class="navigation">
    <img src="../images/logo.png" class="logo">
    <img src="../images/logo2.png" class="company_logo">
  </nav>
<?php
try{
    require_once('../COMMON/common.php');
    $post = sanitize($_POST); //安全対策
  
    $name1 = $post['name1'];
    $name2 = $post['name2'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $prefectures1 = $post['prefectures1'];
    $prefectures2 = $post['prefectures2'];
    $prefectures3 = $post['prefectures3'];
    $tel1 = $post['tel1'];
    $tel2 = $post['tel2'];
    $tel3 = $post['tel3'];
    $mail = $post['mail'];
  
/*-----------------メールに購入情報を通知---------------------*/ ?>
  <div class="order_mail">
    <h1>ご注文ありがとうございます。</h1>
    <p><?php print $name1.$name2; ?>様</p>
    <p><?php print $mail; ?>にメールを送りましたのでご確認下さい。</p>
    <p>商品は以下の住所に発送させて頂きます。</p>
    <p><?php print $postal1.'-'.$postal2; ?></p>
    <p><?php print $prefectures1.$prefectures2.$prefectures3; ?></p>
    <p><?php print $tel1.'-'.$tel2.'-'.$tel3; ?></p>
  </div>
  <?php
    $honbun = "";
    $honbun .= $name1.$name2."様\n\nこのたびはご注文ありがとうございます。\n";
    $honbun .= "\n";
    $honbun .= "ご注文商品\n";
    $honbun .= "--------------------------------------------\n";
    
    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
    $max = count($cart);

    /*--------------------データベース接続-------------------------*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    for($i=0; $i<$max; $i++) {
      $sql = 'select productname,price,img from product where productcode=?';
      $stmt = $dbh->prepare($sql);
      $data[0] = $cart[$i];
      $stmt->execute($data);
      
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      
      $productname = $rec['productname'];
      $price = $rec['price'];
      $kakaku[] = $price;
      $suryo = $kazu[$i];
      $tax = 1.1;
      $shokei = $price * $suryo * $tax;
      
      $honbun .= $productname.'<br>';
      $honbun .= $price.'円（税抜） ×';
      print '';
      $honbun .= $suryo.'個 =';
      $honbun .= $shokei."円(税込) \n";
      
  }
      /*他の人のアクセスに待ったをかける。*/
      $sql = 'LOCK TABLES data_sales write,data_sales_product write,data_member write';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
  
  /*DB data_member追加*/
  $lastmembercode = $_SESSION['member_code'];

      /*data_salesに追加*/
      $sql = 'insert into data_sales(code_member,name1,name2,postal1,postal2,prefectures1,prefectures2,prefectures3,tel1,tel2,tel3,mail) values(?,?,?,?,?,?,?,?,?,?,?,?)';
  
      $stmt = $dbh->prepare($sql);
      $date = array(); //配列を空にする。
      $date[] = $lastmembercode;
      $date[] = $name1;
      $date[] = $name2;
      $date[] = $postal1;
      $date[] = $postal2;
      $date[] = $prefectures1;
      $date[] = $prefectures2;
      $date[] = $prefectures3;
      $date[] = $tel1;
      $date[] = $tel2;
      $date[] = $tel3;
      $date[] = $mail;
      $stmt->execute($date);
  
      $sql = 'SELECT LAST_INSERT_ID()';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastmembercode = $rec['LAST_INSERT_ID()'];
  
      $sql = 'SELECT LAST_INSERT_ID()'; //SELECT LAST_INSERT_ID()最新番号をsqlで取得する。
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastcode = $rec['LAST_INSERT_ID()'];
  
    /*data_sales_product追加*/
      for($i=0; $i<$max; $i++) {
        $sql = 'insert into data_sales_product(code_sales,code_product,price,quantity) values(?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $date = array();
        $date[] = $lastcode;
        $date[] = $cart[$i];
        $date[] = $kakaku[$i];
        $date[] = $kazu[$i];
        $stmt->execute($date);
      }
      
      /*同時に購入アクセスをできないようにする。コードを終了する合図 :UNLOCK TABLES*/
      $sql = 'UNLOCK TABLES';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
  
      /*DB切断*/
      $dbh = null;
/*-----------------メールに購入情報を通知---------------------*/
      $honbun .= "送料は無料です。\n";
      $honbun .= "------------------------------------------------------------------------------------------------\n";
      $honbun .= "\n";
      $honbun .= "代金は以下の口座にお振込下さい。\n";
      $honbun .= "HAL銀行東京支店 普通口座11292929\n";
      $honbun .= "入金確認が取れ次第、梱包、発送させて頂きます。\n";
      $honbun .= "\n";
  
      $honbun .= "□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□\n";
      $honbun .= "～S.K_baseball工房～\n";
      $honbun .= "\n";
      $honbun .= "東京都世田谷区北沢３丁目\n";
      $honbun .= "電話番号 03-1129-5555\n";
      $honbun .= "メール S.K_baseball@com\n";
      $honbun .= "□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□\n";
  /*-----------------客側に連絡-----------------------------*/
//    $title = 'ご注文ありがとうございます。';
//    $header = 'From: S.K_baseball@com';
//    $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
//    mb_language('Japanese');
//    mb_internal_encoding('UTF-8');
//    mb_send_mail($mail,$title,$honbun,$header);
  
  /*----------------------店側に連絡-----------------------------*/
  /*------------レンタルサバ―が無いとエラーが起きる-------------------*/
//Failed to connect to mailserver at "localhost" port 25, verify your "SMTP" and "smtp_port" setting in php.ini or use ini_set() in 
    //$title = 'お客様からご注文がありました。';
    //$header = 'From: S.K_baseball@com';
    //$honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    //mb_language('Japanese');
    //mb_internal_encoding('UTF-8');
    //mb_send_mail('S.K_baseball@com',$title,$honbun,$header);
  }
  catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
  }
  
  ?>
  <div class="top">
  <a href="cart_cart.php">商品画面へ</a>
  </div>
  
  <footer>
    <span>© 2020 SHOTA KAMIGUCHI</span>
  </footer>
</body>
</html>