<?php
  session_start();
  session_regenerate_id(true);

  require_once('../COMMON/common.php');

$post = sanitize($_POST);

$cart = $_SESSION['cart'];
$max = $post['max'];
for($i=$max; 0<=$i; $i--) {
  if(isset($_POST['delete'.$i]) == true) {
    //『array_splice()』 配列の一部の配列要素を、削除、または、新たな配列要素に置き換える、組み込み関数。
    array_splice($cart,$i,1);
    array_splice($kazu,$i,1);
  }
}

for($i=0; $i<$max; $i++) {
  if(preg_match("/\A[0-9]+\z/",$post['kazu'.$i]) == 0) {
    print'数量に誤りがあります。<br><br>';
    print '<a href="shop_list.php">商品一覧へ戻る。</a>';
    exit();
  } else {
    if($post['kazu'.$i] < 1 || 10 < $post['kazu'.$i]) {
      print '数量は必ず1～10個までとなっております。<br><br>';
      print '<a href="shop_cartlook.php">カートを見る</a>';
      
      exit();
  }
  }
  $kazu[] = $post['kazu'.$i];
}

$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

header('Location: shop_cartlook.php');
exit();
?>

<!--
1.sessionを開始 session_start();
2.require_once 読み込む
3.sanitizeで$_POSTに安全対策を施して$postにコピー
4.商品の種類の数を$postから$maxにコピー
5.商品の数だけ回るforループを組む
6.ループの中で、前の画面で入力された数量を配列に入れていく。
7.$_SESSIONに$kazuを保管する。
8.
9.
10.






-->