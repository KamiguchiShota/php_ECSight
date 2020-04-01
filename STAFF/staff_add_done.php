<?php
session_start();
session_regenerate_id(true); 
//session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ追加完了</title>
</head>
<style>
/*-----管理者画面全て統一項目-----*/
  body {
    width: 1040px;
    background-color: #eff0f4;
    margin: 0 auto;
    position: relative;
    color: #000;
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
    color: #fff;
  }
    
/*-----必要事項(overall)-----*/
  .overall {
    width: 1040px;
    height: auto;
    display: flex;
    flex-direction:row
  }
  
/*------左側にあるnavigation-----*/
  .leftmenu {
    width: 230px;
    height: 400px;
  }
  
  .leftmenu ul li {
    border: solid 1px #d8d8e5;
    width: 190px;
  }
  
  .leftmenu ul {
    padding: 0;
    position: fixed;
    top: 105px;
  }
  
  .empty {
    width: 190px;
    height: 250px;
  }
  
  .leftmenu li {
    list-style: none;
    padding: 2px 3px 0px 10px;
  }

  .leftmenu h3 {
    font-size: 18px;
    color: #000;
    font-weight: 300;
    margin-top: 75px;
    margin-left: 10px;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
    
  /*-----*/
  .div_staff_add_done {
    width: 810px;
    height: auto;
    display: block;
    margin-top: 117px;
  }
    
  .staff_add_done {
    width: 320px;
    display: block;
    margin: 0 auto;
  }
    
  .staff_add_done h4{
    margin-top: 0;
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: 300;
  }

  .staff_add_done p{
    width: 250px;
    display: block;
    margin: 0 auto;
    margin-bottom: 10px;
    margin-top: 10px;
    font-size: 13px;
    font-weight: 300;
  }
    
  .staff_top {
    width: 90px;
    height: 28px;
    margin: 0 auto;
    text-align: center;
    background-color: #f0f0f0;
    border: 1px solid #d8d8e5;
    padding-top: 4px;
  }
    
  .staff_top a {
    text-align: center;
  }
    
  .staff_top:hover {
    background-color: rgba(255,255,255,.8)
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
    <h3>従業員登録</h3>
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
    //データベースサーバーの障害対策。エラートラップ（データベースerror）
    require_once('../COMMON/common.php'); //安全対策(別ファイルに記載)
    //①xssを防ぐ②htmlの入力で正しく入力させる。
    $post = sanitize($_POST);
    $staff_name = $post['name'];
    $staff_pass = $post['pass'];
    $staff_position = $post['position'];
    $staff_time = $post['time'];
    /*データベースに接続*/
    $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    /*SQLを使ってスタッフを追加*/
    $sql = 'insert into staff(staffname,staffpass,position,date) values (?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $date[] = $staff_name;  /*スタッフ名*/
    $date[] = $staff_pass;  /*パスワード*/
    $date[] = $staff_position;  /*役職*/
    $date[] = $staff_time;  /*登録日*/
    $stmt->execute($date);
        
    $dbh = null;
    /*データベース切断*/
?>
  <div class="div_staff_add_done">
    <div class="staff_add_done">
    <h4><?php print $staff_name; ?>さんを追加完了しました。</h4>
    <p>次回からはログインコードとパスワード<br>を入力してログインをして下さい。</p>
    </div>
<?php }
  catch(Exception $e) {
    print 'ただいま故障によりご迷惑をお掛けしております。';
    exit();
    /*データベースエラーのとき表示*/
  }
?>
    <div class="staff_top">
      <a href="staff_list.php">戻る</a>
    </div>
  </div>
  </main>
</body>
</html>