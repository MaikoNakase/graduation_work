<?php
session_start();
require_once('funcs.php');
// loginCheck();

$name = $_POST['name'];
$quantity  = $_POST['quantity'];
$category  = $_POST['category'];
$location  = $_POST['location'];
$img = '';

// 簡単なバリデーション処理追加。
if (trim($name) === '' || trim($quantity) === '' || trim($category) === '' || trim($location) === '') {
    redirect('post.php?error');
}

// ★★★★Macはimagesフォルダの書き込み権限を変更してください。★★★★
if ($_SESSION['post']['image_data'] !== "")  {
    echo 'test';
    $img = date('YmdHis') . '_' . $_SESSION['post']['file_name'];
    file_put_contents("../images/$img", $_SESSION['post']['image_data']);
}

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table(
                            name, quantity, category, location, img, date, update_time
                        )VALUES(
                            :name, :quantity, :category, :location, :img, sysdate(), sysdate()
                        )');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue('quantity', $quantity, PDO::PARAM_INT);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':location', $location, PDO::PARAM_STR);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    $_SESSION['post'] = [] ;
    redirect('index.php');
}