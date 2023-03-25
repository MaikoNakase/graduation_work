<?php
// confirm.phpの中身は、ほとんどpost.phpに似ています。
session_start();
require_once('funcs.php');
// loginCheck();

// post受け取る
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$category = $_POST['category'];
$location = $_POST['location'];
$_SESSION['post']['name'] = $_POST['name'];
$_SESSION['post']['quantity'] = $_POST['quantity'];
$_SESSION['post']['category'] = $_POST['category'];
$_SESSION['post']['location'] = $_POST['location'];

// if (isset($_FILES['img']['name'])) {
    if ($_FILES['img']['name'] !== "") {
        $file_name = $_SESSION['post']['file_name'] = $_FILES['img']['name'];
        $image_data = $_SESSION['post']['image_data'] = file_get_contents($_FILES['img']['tmp_name']);
        $image_type = $_SESSION['post']['image_type'] = exif_imagetype($_FILES['img']['tmp_name']);
    } else {
        $file_name = $_SESSION['post']['file_name'] = '';
        $image_data = $_SESSION['post']['image_data'] = '';
        $image_type = $_SESSION['post']['image_type'] = '';
    }
    
// 簡単なバリデーション処理。
if (trim($name) === '' || trim($quantity) === '' || trim($category) === '' || trim($location) === '') {
    redirect('post.php?error');
}

// imgある場合

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Mochimono</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Homeへ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="post.php">登録する</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">商品一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- errorを受け取ったら、エラー文出力。 -->

    <form method="POST" action="register.php" enctype="multipart/form-data" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input type="hidden"name="name" value="<?= $name ?>">
            <p><?= $name ?></p>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">個数</label>
            <input type="hidden"name="quantity" value="<?= $quantity ?>">
            <div><?= nl2br($quantity) ?></div>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">カテゴリー</label>
            <input type="hidden"name="category" value="<?= $category ?>">
            <div><?= nl2br($category) ?></div>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">保管場所</label>
            <input type="hidden"name="location" value="<?= $location ?>">
            <div><?= nl2br($location) ?></div>
        </div>

        <?php if ($image_data) :?>
            <!-- 写真を表示してください。 -->
            <div class="mb-3">
                <img src="image.php">
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>

    <a href="post.php?re-register=true">前の画面に戻る</a>
</body>
</html>