<?php
session_start();
session_regenerate_id(true);
//session_idを盗まれないように毎回送る言葉を変更。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ追加</title>
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
    color: #000;
    font-weight: 300;
    margin-top: 75px;
    margin-left: 10px;
  }
  
  a {
    text-decoration: none;
    color: #000;
  }
  
  form {
    background-color: #fff;
    width: 400px;
    height: 500px;
    margin: 0 auto;
    margin-top: 116px;
  }
  
  form h4 {
    margin: 0;
    font-size: 14px;
    color: #000;
    margin-left: 50px;
  }
  
  .nameh4 {
      margin-top: 50px;
    }
  
  .name,.pass,.pass2,.position {
    width: 300px;
    height: 33px;
    margin-bottom: 15px;
    margin-left: 50px;
    background-color: #f3f4f6;
  }

  .year {
    margin-left: 50px;
  }
  .year,.month,.day {
    width: 96px;
    height: 33px;
    margin-bottom: 30px;
    background-color: #f3f4f6;
  }
    
/*-----追加button-----*/
  .add_submit {
    width: 80px;
    height: 35px;
    margin-left: 160px;
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

    <form method="post" action="staff_add_check.php">
      <h4 class="nameh4">スタッフ名</h4>
      <!--placeholder inputに薄く例を書く-->
      <input type="text" name="name" class="name" placeholder="（例）ハル太郎"><br>
      <h4>パスワード</h4>
      <input type="password" name="pass" class="pass"><br>
      <h4>確認パスワード</h4>
      <input type="password" name="pass2" class="pass2"><br>
      <h4>役職名</h4>
      <input type="text" name="position" class="position" placeholder="（例）販売員"><br>
      <h4>登録日</h4>
      <select name="year" class="year">
        <option value="" style="display: none;" name=""></option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
      </select>

      <select name="month" class="month">
        <option value="" style="display: none;" name=""></option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>

      <select name="day" class="day">
        <option value="" style="display: none;" name=""></option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
      <input type="submit" value="追加" class="add_submit">
    </form>
  </main>
</body>
</html>