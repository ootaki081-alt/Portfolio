<?php
session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

$userName = trim($_POST['user_name'] ?? '');

require_once './common/db.php';

$sql = 'SELECT id, image, name, price
        FROM products
        ORDER BY id
        LIMIT 12';

$stmt = $pdo->query($sql);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>商品一覧</title>
</head>
<body>
    <?php require_once './header.php'; ?>
    <main>
        <!-- パンくずリスト -->

        <div class="page-path">
            <a href="./index.php">
                <p>TOP</p>
            </a>
            <p>></p>
            <a href="./product-list.php">
                <p>商品一覧</p>
            </a>
        </div>

        <div class="welcome">
            <p>ようこそ<?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>様</p>
        </div>
        <div class="headline">
            <h1>商品一覧</h1>
        </div>
        <section class="product-section">
            <h3>メインメニュー</h3>

                <div class="product-list">

                    <?php for ($i = 0; $i < 6; $i++): ?>

                    <?php $product = $products[$i]; ?>

                        <div class="product-item">

                            <a href="./product-detail.php?id=<?= $product['id'] ?>">
                                <img src="./images/donuts/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">
                            </a>

                            <h3>
                                <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>

                            <p>
                                <?= number_format($product['price']) ?>円
                            </p>

                            <form action="cart.php" method="post">

                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="<?= $product['id'] ?>"
                                >

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button type="submit" name="add_cart" class="cart-button">
                                    カートに入れる
                                </button>

                            </form>

                        </div>

                    <?php endfor; ?>

                </div>

            </section>

                <!-- セット商品 -->
            <section class="product-section">

                <h3>セット商品</h3>

                <div class="product-list">

                    <?php for ($i = 6; $i < 12; $i++): ?>

                        <?php $product = $products[$i]; ?>

                        <div class="product-item">

                            <a href="./product-detail.php?id=<?= $product['id'] ?>">
                                <img
                                    src="./images/donuts/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
                                >
                            </a>

                            <h3>
                                <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>

                            <p>
                                税込 ￥<?= number_format($product['price']) ?>円
                            </p>

                            <form action="cart.php" method="post">

                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="<?= $product['id'] ?>"
                                >

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button type="submit" name="add_cart" class="cart-button">
                                    カートに入れる
                                </button>

                            </form>

                        </div>

                    <?php endfor; ?>

                </div>

            </section>
    </main>
    <?php require_once './footer.php'; ?>
</body>
</html>
