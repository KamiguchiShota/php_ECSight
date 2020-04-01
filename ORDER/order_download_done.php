<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフログイン</title> 
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
    left: 175px;
    color: #000;
    font-weight: 300;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
  
  .div_download {
    width: 810px;
    margin-top: 110px;
  }
  
  .download {
    width: 200px;
    height: 77px;
    padding: 30px;
    background-color: rgba(255,255,255,.3);
    display: block;
    margin: 0 auto
  }
  
  .download a:hover {
    color: #2e4c51;
    font-weight: bold;
  }
  
  .download h4 {
    margin: 0;
    color: #000;
    font-weight: 300;
  }
  
  .download h4:hover {
    color: #2e4c51;
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
  try {
    //require_once('../COMMON/common.php');
    /*データベースに接続*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    /*一覧取得*/
    $sql = 'select staffcode,staffname from staff where 1'; //スタッフ名、スタッフコード取得
    //where 1 = その列を全て表示
    /*スタッフ名情報取得*/
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //execute() の中に全てのデータが入っている。
    
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    
    $sql = '
    select
      data_sales.code,
      data_sales.date,
      data_sales.code_member,
      data_sales.name1 as data_sales_name1,
      data_sales.name2 as data_sales_name2,
      data_sales.huri1 as data_sales_huri1,
      data_sales.huri2 as data_sales_huri2,
      data_sales.mail,
      data_sales.postal1,
      data_sales.postal2,
      data_sales.prefectures1,
      data_sales.prefectures2,
      data_sales.prefectures3,
      data_sales.tel1,
      data_sales.tel2,
      data_sales.tel3,
      data_sales_product.code,
      product.productname as data_product_name,
      data_sales_product.price,
      data_sales_product.quantity
    from
      data_sales,product,data_sales_product
    where
      data_sales.code=data_sales_product.code_sales
      AND data_sales_product.code_product=product.productcode
      AND substr(data_sales.date,1,4)=?
      AND substr(data_sales.date,6,2)=?
      AND substr(data_sales.date,9,2)=?
      ';
    $stmt = $dbh->prepare($sql);
    $data[] = $year;
    $data[] = $month;
    $data[] = $day;
    $stmt->execute($data);
    
    $dbh = null;
    
    $csv = '注文コード,注文日時,会員番号,名前,フリガナ,メール,郵便番号,住所,電話番号,商品コード,商品名,価格,数量';
    $csv = "\n";
    while(true) {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if($rec == false) {
        break;
      }
      $csv .= $rec['code'];
      $csv .= ',';
      
      $csv .= $rec['date'];
      $csv .= ',';
      
      $csv .= $rec['code_member'];
      $csv .= ',';
      
      $csv .= $rec['data_sales_name1'].$rec['data_sales_name2'];
      $csv .= ',';
      
      $csv .= $rec['data_sales_huri1'].$rec['data_sales_huri2'];
      $csv .= ',';
      
      $csv .= $rec['mail'];
      $csv .= ',';
      
      $csv .= $rec['postal1'].'-'.$rec['postal2'];
      $csv .= ',';
      
      $csv .= $rec['prefectures1'].$rec['prefectures2'].$rec['prefectures3'];
      $csv .= ',';
      
      $csv .= $rec['tel1'].'-'.$rec['tel2'].'-'.$rec['tel3'];
      $csv .= ',';
      
      $csv .= $rec['code_product'];
      $csv .= ',';
      
      $csv .= $rec['data_product_name'];
      $csv .= ',';
      
      $csv .= $rec['price'];
      $csv .= ',';
      
      $csv .= $rec['quantity'];
      $csv .= "\n";
      
    }
    print '<br>';
    
    $file = fopen('./chumon.csv','w');
    $csv = mb_convert_encoding($csv,'SJIS','UTF-8');
    fputs($file,$csv);
    fclose($file);
  }
  
  catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
  }
?>
    <div class="div_download">
      <div class="download">
      <h4><a href="chumon.csv">注文データのダウンロード</a></h4>
      <h4><a href="order_download.php">日付選択へ</a></h4>
      <h4><a href="../STAFF/staff_top.php">トップメニュー</a></h4>
      </div>
    </div>
  </main>
</body>
</html>