<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフリスト一覧</title> 
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

/*-----form-----*/
  .form_list {
    width: 810px;
    height: auto;
    margin-top: 115px;
  }
  
/*-----table-----*/
  table {
    width: 660px;
    color: #000;
    display: block;
    margin: 0 auto;
    border-collapse:collapse;
    text-align: center;
  }
  
  th {
    background-color: rgba(46,76,81,.8);
    color: #fff;
  }
  td {
    background-color: #fff;
  }
  
  th,td {
    border: solid 1px #000;
    font-size: 14px;
    font-weight: 300;
  }
  
  th .choice {
    width: 80px;
  }
  .choice {
    width: 80px;
    height: 26px;
    padding: 3px;
  }
  
  th .staff_code {
    width: 20px;
    padding: 0;
  }
  .staff_code {
    width: 80px;
    height: 26px;
    padding: 3px;
  }

  .staff_name {
    width: 175px;
    height: 26px;
    padding: 3px;
  }
  
  .staff_posi {
    width: 180px;
    height: 26px;
    padding: 3px;
  }
  .registration_date {
    width: 150px;
    height: 26px;
    padding: 3px;
  }
  
/*------削除と変更リンクボタン------*/
  .botton {
    width: 810px;
    height: auto;
    margin-top: 20px;
    text-align: center;
    margin-bottom: 20px;
  }
  
  .update_button {
    width: 90px;
    height: 32px;
  }
  
  .delete_button {
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
      <h3>従業員一覧</h3>
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
    /*データベースに接続*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    /*一覧取得*/
    $sql = 'select staffcode,staffname,position,date from staff where 1';
    /*スタッフ名を取得 where 1 = その列を全て表示*/
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    /*execute() の中に全てのデータが入っている。*/
    
    $dbh = null;
  ?>
  <form method="post" action="staff_branch.php" class="form_list">
    <table>
      <tr>
        <th class="choice">選択</th>
        <th class="staff_code">コード</th>
        <th class="staff_name">スタッフ名</th>
        <th class="staff_posi">役職名</th>
        <th class="registration_date">登録日</th>
      </tr>
    </table>
  <?php
    while(true) {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      /*$stmtから1レコード取り出す。*/
    if($rec == false) {
      break; 
      /*全てのレコードを取り出したら終了。*/
    } 
  ?>
    <table>
      <tr>
        <td class="choice">
        <input type="radio" name="staffcode" value="<?php print $rec['staffcode']; ?>">
        </td>
        <td class="staff_code"><?php print $rec['staffcode']; ?></td>
        <?php //DBのスタッフ（テーブル名）の中の列名（code）を表示?>
        <td class="staff_name"><?php print $rec['staffname']; ?></td> 
        <?php //DBのスタッフ（テーブル名）の中の列名（name）を表示?>
        <td class="staff_posi"><?php print $rec['position']; ?></td> 
        <?php //DBのスタッフ（テーブル名）の中の列名（position）を表示?>
        <td class="registration_date"><?php print $rec['date']; ?></td> 
        <?php //DBのスタッフ（テーブル名）の中の列名（date）を表示?>
      </tr>
    </table>
  <?php } ?>
      
    <div class="botton">
      <input type="submit" name="edit" value="修正" class="update_button">
      <input type="submit" name="delete" value="削除" class="delete_button">
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