<?php

session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

$userName = trim($_POST['user_name'] ?? '');

require_once './common/db.php';

$id = $_GET['id'] ?? 0;

$sql = 'SELECT id, image, name, introduction, price
        FROM products
        WHERE id = :id';

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/reset.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./common/header.css">
    <link rel="stylesheet" href="./common/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./header.php">
    <link rel="stylesheet" href="./footer.php">
    <title>
        <?= $product
            ? htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') . ' - 商品詳細'
            : '商品が見つかりません' ?>
    </title>
</head>
<body>
    <?php require_once './header.php'; ?>
    <main>
        <?php if (!$product): ?>

            <div class="product-not-found">
                <h1>商品が見つかりません</h1>
                <p>お探しの商品は存在しないか、削除された可能性があります。</p>
                <a href="./product-list.php">商品一覧に戻る</a>
            </div>

        <?php else: ?>
                <!-- パンくずリスト -->

        <div class="page-path">
            <a href="./index.php">
                <p>TOP</p>
            </a>
            <p>></p>
            <a href="./product-list.php">
                <p>商品一覧</p>
            </a>
            <p>></p>
            <p><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div class="welcome">
            <p>ようこそ<?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>様</p>
        </div>

        <!-- 商品詳細 -->

    <div class="product-detail">

        <!-- 左：画像 -->
        <div class="product-image">
            <img
                src="./images/donuts/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>"
                alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
            >
        </div>


        <!-- 右：商品情報 -->
        <div class="product-info">

            <!-- 商品名 -->
            <h1>
                <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
            </h1>

            <!-- 商品説明 -->
            <p class="introduction">
                <?= nl2br(htmlspecialchars($product['introduction'], ENT_QUOTES, 'UTF-8')) ?>
            </p>

            <!-- 価格 -->
            <p class="price">
                税込 ￥<?= number_format($product['price']) ?>円
            </p>

            <!-- カートボタン -->
            <form action="cart.php" method="post" class="cart-area">

                <input type="hidden" name="product_id"
                    value="<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?>">

                <input type="number" name="quantity"
                    value="1" min="1" class="quantity">

                <span class="quantity-unit">個</span>

                <div class="detail-cart">
                    <button type="submit" name="add_cart" class="cart-button">
                        カートに入れる
                    </button>
                </div>

            </form>

            <!-- お気に入りボタン -->
            <form action="favorite.php" method="post" class="favorite-area">

                <input type="hidden" name="product_id" 
                value="<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?>">

                <button type="submit" name="add_favorite" class="favorite-button">
                    <div class="heart"></div>
                </button>
            </form>

    </div>
    <?php endif; ?>
    </main>
    <?php require_once './footer.php'; ?>
</body>
</html>