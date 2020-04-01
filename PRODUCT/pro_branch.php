<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false) {
  print 'ログインされていません。<br>';
  print '<a href="../STAFF/staff_login.html">ログイン画面へ戻る</a>';
}
?>
<?php

/*----------------参照-------------------*/

  if(isset($_POST['disp']) == true) {
    if(isset($_POST['productcode']) == false) {
      header('Location: pro_ng.php');
      exit();
    } else {
      $pro_productcode = $_POST['productcode'];
    //スタッフ修正画面へ飛ばす。
    header('location: pro_disp.php?productcode='.$pro_productcode); 
    exit();
    }
  }

/*----------------追加-------------------*/

  if(isset($_POST['add']) == true) {
    header('Location: pro_add.php');
    exit();
  }

/*----------------修正-------------------*/

  if(isset($_POST['edit']) == true) {
    if(isset($_POST['productcode']) == false) { //何も選択されていない場合はfalse
      header('Location: pro_ng.php');
      exit();
    }else{ //選択さてている場合
    $pro_productcode = $_POST['productcode'];
    //スタッフ修正画面へ飛ばす。
    header('location: pro_edit.php?productcode='.$pro_productcode); 
    exit();
    }
  }

/*-----------------削除------------------*/

  if(isset($_POST['delete']) == true) {
    if(isset($_POST['productcode']) == false) { //何も選択されていない場合はfalse
      header('Location: pro_ng.php');
      exit();
    } else {
    $pro_productcode = $_POST['productcode'];
    //スタッフ削除画面へ飛ばす。
    header('location: pro_delete.php?productcode='.$pro_productcode); 
    exit();
  }
  }
?>