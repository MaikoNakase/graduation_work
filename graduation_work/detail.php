<?php
session_start();
require_once('funcs.php');
// loginCheck();

$id = $_GET['id'];
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_an_table WHERE id=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
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
                </ul>
            </div>
        </nav>
    </header>
    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger">記入内容を確認してください</p>
    <?php endif;?>
    <form method="POST" action="update.php" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="<?= $row["name"] ?>">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">個数</label>
            <input type="text" class="form-control" name="quantity" id="quantity" aria-describedby="quantity" value="<?= $row["quantity"] ?>">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">カテゴリー</label>
            <input type="text" class="form-control" name="category" id="category" aria-describedby="category" value="<?= $row["category"] ?>">
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">保管場所</label>
            <input type="text" class="form-control" name="location" id="location" aria-describedby="location" value="<?= $row["location"] ?>">
        </div>

        <input type="hidden" name="id" id="id" aria-describedby="id" value="<?= $row["id"] ?>">
        <button type="submit" class="btn btn-primary">修正</button>
    </form>
    <form method="POST" action="delete.php?id=<?= $row['id'] ?>" class="mb-3">
        <button type="submit" class="btn btn-danger">削除</button>
    </form>
</body>

</html>
