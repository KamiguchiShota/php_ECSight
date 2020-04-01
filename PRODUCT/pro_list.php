<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理者側商品一覧</title>
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
    z-index: 999;
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
    flex-direction:row;
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
  
  .div_form {
    width: 680px;
    height: auto;
    margin-top: 115px;
    margin-bottom: 95px;
  }
  
  .form {
    width: 600px;
    display: block;
    margin: 0 auto;
    color: #000;
    font-weight: 300;
    font-size: 15px;
  }
  
  table {
    z-index: 0;
    width: 100%;
    height: auto;
    text-align: center;
    border-collapse:collapse;
    
  }
  
  table .choice {
    width: 7%;
    height: auto;
    
  }
  
  table .code {
    width: 16%;
    height: auto;
    font-weight: bold;
  }
  
  td code {
    color: red;
  }
  
  table .name {
    width: 24%;
    height: auto;
    
  }
  
  table .price {
    width: 15%;
    height: auto;
    
  }
  
  table .images {
    width: 25%;
    height: auto;
    
  }
  
  th.choice,th.code,th.name,th.price,th.images {
    background-color: #2e4c51;
    color: #fff;
    font-weight: 300;
  }
  
  td,th {
    padding: 0;
    border-collapse:collapse;
    border:solid 1px #d8d8e5;
    padding: 3px;
    background-color: #fff;
  }
  
  th {
    background-color: #f4f6ef;
  }

  img {
    padding: 5px;
  }
  
  .background {
    width: 1040px;
    margin: 0;
    padding: 0;
  }
  
  td img {
    width: 114px;
  }
  
  .input {
    position: fixed;
    top: 18.5%;
    right: 12.5%;
    width: 100px;
    float: right;
  }
  
  .input_button {
    width: 75px;
    height: 28px;
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
    <h3>商品一覧</h3>
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
  $num = 1;
  try {
    /*データベースに接続*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    /*一覧取得*/
    //$sql = 'select product.productname,price,img,productcode,position,hand from product INNER JOIN glove on product.productcode = glove.productcode where 1';
    $sql = 'select product.productcode,productname,price,img,hand,position,Images1,Images1s,Images2,Images2s,Images3,Images3s from product '.
        'left outer join glove on product.productcode = glove.productcode where 1';
    //where 1 = その列を全て表示
    /*スタッフ名情報取得*/
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //execute() の中に全てのデータが入っている。
    
    $dbh = null;
  ?>
  <form method="post" action="pro_branch.php" class="div_form">
    <div class="form">
      <table border="1">
        <tr class="title">
          <th class="choice">選択</th>
          <th class="code">商品番号</th>
          <th class="name">商品名</th>
          <th class="price">値段</th>
          <th class="images">画像</th>
        </tr>
      </table>
<?php while(true) {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      //$stmtから1レコード取り出す。
    if($rec == false) {
      break; //全てのレコードを取り出したら終了。
    }
 ?>
      <table>
        <tr>
          <td class="choice choice<?php print $num; ?>">
          <input type="radio" name="productcode" value="<?php print $rec['productcode']; ?>">
          </td>
          <td class="code code<?php print $num; ?>"><?php print $rec['productcode']; ?></td>
          <td class="name name<?php print $num; ?>"><?php print $rec['productname']; ?></td>
          <td class="price price<?php print $num; ?>"><?php print number_format($rec['price']); ?>円</td>
          <td class="images images<?php print $num; ?>"><img src="../images/<?php print $rec['img']; ?>"></td>
          <?php $num += 1; ?>
        </tr>
      </table>
  <?php } ?>
      <div class="input">
        <input type="submit" name="add" value="追加" class="input_button">
        <input type="submit" name="edit" value="修正" class="input_button">
        <input type="submit" name="delete" value="削除" class="input_button">
      </div>
    </div>
  </form>
<?php }
  catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
  }
?>
  </main>
</body>
</html>