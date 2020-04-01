<?php
session_start();
session_regenerate_id(true); //session_idを盗まれないように毎回送る言葉を変更。
if(isset($_SESSION['login']) == false) {
  header('Location: ../STAFF/staff_login.html');
  exit(); 

} else {
  print $_SESSION['staff_name'];
  print 'さんログイン中<br>';
}
?>

<body>
  <?php
    try {
      /*選択されたスタッフコード*/
      $staff_code = $_GET['staffcode'];
      
      /*データベースに接続*/
      $dsn = 'mysql:dbname=kamiguchi;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sql = 'select staffname,position from staff where staffcode=?';
      /*スタッフコードで絞り込む。1件のレコードになるまで絞り込む。*/
      $stmt = $dbh->prepare($sql);
      $date[] = $staff_code;
      $stmt->execute($date);
      
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $staff_name = $rec['staffname'];
      $staff_position = $rec['position'];
      
      $dbh = null;
    }
     catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
  }
  ?>
  
  スタッフ参照<br>
  スタッフコード：
  <?php print $staff_code; ?><br>
  スタッフ名：
  <?php print $staff_name; ?><br>
  役職名：
  <?php print $staff_position; ?><br>
  
  
  <input type="button" onclick="history.back()" value="戻る">
    
</body>