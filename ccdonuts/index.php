
<?php
session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

require_once './common/db.php';

// 新商品を1件取得（is_new = 1 の中でIDが最大）
$sql = 'SELECT id, image, name
        FROM products
        WHERE is_new = 1
        ORDER BY id DESC
        LIMIT 1';

$stmt = $pdo->query($sql);
$newProduct = $stmt->fetch(PDO::FETCH_ASSOC);

// ランキング用の商品を6件取得
$sql = 'SELECT id, image, name, price
        FROM products
        ORDER BY id
        LIMIT 6';

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
    <title>ドーナッツトップページ</title>
</head>
<body>
    <?php require_once './header.php'; ?>
<main>
    <div class="welcome">
        <p>ようこそ<?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>様</p>
    </div>
    <section id="section1" class="section1">
        <!-- 内容 -->
         <img src="./images/main/hero.jpg">
    </section>

    <section id="section2" class="section2">
        <!-- 内容 -->
        <div class="container">
            <div class="image-layout">

                <?php if ($newProduct): ?>
                    <a href="./product-detail.php?id=<?= (int)$newProduct['id'] ?>">
                        <img
                            src="./images/donuts/<?= htmlspecialchars($newProduct['image'], ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($newProduct['name'], ENT_QUOTES, 'UTF-8') ?>"
                        >
                    </a>
                <?php endif; ?>

                <a>
                    <img src="./images/main/donuts-life.jpg" alt="ドーナッツ人生">
                </a>

                <a href="./product-list.php?id=3">
                    <img src="./images/main/donuts-list.jpg" alt="商品一覧ページ">
                </a>

            </div>
        </div>
    </section>

    <section id="section3" class="section3">
        <!-- 内容 -->
         <img src="./images/main/shop-content.jpg">
    </section>

    <section id="section4" class="section4">
        <!-- 内容 -->
        
        <div class="ranking">

            <?php $rank = 1; ?>

            <?php foreach ($products as $product): ?>

                <div class="ranking-item">

                    <!-- 順位 -->
                    <p class="rank">
                        <?= $rank ?>位
                    </p>

                    <!-- 画像 -->
                    <a href="./product-list.php?id=3">
                    <img
                        src="./images/donuts/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
                    >
                    </a>

                    <!-- 商品名 -->
                    <h3>
                        <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>

                    <!-- 値段 -->
                    <p class="price">
                        税込 ￥<?= number_format($product['price']) ?>円
                    </p>

                    <!-- カートボタン -->
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

                <?php $rank++; ?>

            <?php endforeach; ?>

        </div>
    </section>
</main>
    <?php require_once './footer.php'; ?>
</body>
</html>