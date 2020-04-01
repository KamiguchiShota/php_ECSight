<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false) {
  header('Location: ../STAFF/staff_login.html');
  exit(); 
}
?>
<?php
/*----------------参照-------------------*/
  if(isset($_POST['disp']) == true) {
    if(isset($_POST['staffcode']) == false) {
      header('Location: staff_ng.php');
      exit();
    } else {
      $staff_code = $_POST['staffcode'];
    //スタッフ修正画面へ飛ばす。
    header('location: staff_disp.php?staffcode='.$staff_code); //$staff_code = $_POST['code'];を使う 
    exit();
    }
  }
/*----------------追加-------------------*/
  if(isset($_POST['add']) == true) {
    header('Location: staff_add.php');
    exit();
  }
/*----------------修正-------------------*/
  if(isset($_POST['edit']) == true) {
    if(isset($_POST['staffcode']) == false) { //何も選択されていない場合はfalse
      header('Location: staff_ng.php');
      exit();
    }else{ //選択さてている場合
    $staff_code = $_POST['staffcode'];
    //スタッフ修正画面へ飛ばす。
    header('location: staff_edit.php?staffcode='.$staff_code); //$staff_code = $_POST['code'];を使う 
    exit();
  }
}
/*-----------------削除------------------*/
  if(isset($_POST['delete']) == true) {
    if(isset($_POST['staffcode']) == false) { //何も選択されていない場合はfalse
      header('Location: staff_ng.php');
      exit();
    } else {
    $staff_code = $_POST['staffcode'];
    //スタッフ削除画面へ飛ばす。
    header('location: staff_delete.php?staffcode='.$staff_code); 
    exit();
  }
}

?>