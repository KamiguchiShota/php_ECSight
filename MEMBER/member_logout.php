<?php
  session_start();
  $_SESSION = array();

  if(isset($_COOKIE[session_name()]) == true) { //中身を空にする
    setcookie(session_name(),'',time()-42000,'/'); //PC側のsession_IDをクッキーから削除。
  }
  session_destroy(); //サーバーとPCを切断。
?>

<?php header('location: ../MEMBER/member_login.html'); ?>