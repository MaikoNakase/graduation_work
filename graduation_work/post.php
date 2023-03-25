<?php
session_start();
require_once('funcs.php');
// loginCheck();

$name = '';
$quantity = '';
$category = '';
$location = '';

if (isset($_SESSION['post']['name'])) {
    $title = $_SESSION['post']['name'];
}

if (isset($_SESSION['post']['quantity'])) {
    $content = $_SESSION['post']['quantity'];
}

if (isset($_SESSION['post']['category'])) {
    $content = $_SESSION['post']['category'];
}

if (isset($_SESSION['post']['location'])) {
    $content = $_SESSION['post']['location'];
}
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
                    <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">ログアウト</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>

    <!-- // もしURLパラメータがある場合 -->
    <?php if (isset($_GET['error'])) : ?>
        <p class='text-danger'>記入内容を確認してください。</p>
    <?php endif ?>

    <form method="POST" action="confirm.php" enctype="multipart/form-data">   
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input type="text" class="form-control" name="name"
            id="name" aria-describedby="name"
            value="<?= $name ?>">
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">個数</label>
            <input type="text" class="form-control" name="quantity"
            id="quantity" aria-describedby="quantity"
            value="<?= $quantity ?>">
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">カテゴリー</label>
            <input type="text" class="form-control" name="category"
            id="category" aria-describedby="category"
            value="<?= $category ?>">
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">保管場所</label>
            <input type="text" class="form-control" name="location"
            id="location" aria-describedby="location"
            value="<?= $location ?>">
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        
        <div class="mb-3">
            <label for="name" class="form-label">画像</label>
            <input type="file" name="img">  
        </div> 

        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
</body>
</html>