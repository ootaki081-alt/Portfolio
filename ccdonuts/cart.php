<?php
session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

$userName = trim($_POST['user_name'] ?? '');

require_once './common/db.php';

// ============================
// カートに商品を追加
// ============================

if (isset($_POST['add_cart'])) {

    $productId = (int)($_POST['product_id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);

    // 個数が1未満なら1個にする
    if ($quantity < 1) {
        $quantity = 1;
    }

    // 商品IDが正しいか確認
    if ($productId > 0) {

        // カートが存在しない場合
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // すでにカートにある場合
        if (isset($_SESSION['cart'][$productId])) {

            $_SESSION['cart'][$productId] += $quantity;

        } else {

            // 初めて追加する場合
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    // カートページへ移動
    header('Location: cart.php');
    exit;
}

// ============================
// カートの商品数を変更
// ============================

if (isset($_POST['recalculate'])) {

    $productId = (int)($_POST['product_id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);

    if ($productId > 0 && isset($_SESSION['cart'][$productId])) {

        if ($quantity < 1) {
            $quantity = 1;
        }

        $_SESSION['cart'][$productId] = $quantity;
    }

    header('Location: cart.php');
    exit;
}


// ============================
// カートから商品を削除
// ============================

if (isset($_POST['delete'])) {

    $productId = (int)($_POST['product_id'] ?? 0);

    if ($productId > 0) {
        unset($_SESSION['cart'][$productId]);
    }

    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];

$products = [];

// ============================
// DBから商品情報を取得
// ============================

if (!empty($cart)) {

    $ids = array_keys($cart);

    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "SELECT id, image, name, price
            FROM products
            WHERE id IN ($placeholders)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 合計個数
$totalQuantity = 0;

// 合計金額
$totalPrice = 0;

foreach ($products as $product) {

    $quantity = $cart[$product['id']];

    $totalQuantity += $quantity;

    $totalPrice += $product['price'] * $quantity;
}

if (isset($_POST['purchase'])) {

    if (!isset($_SESSION['user_name'])) {
        $loginMessage = '購入するにはログインしてください。';
    } else {
        // 購入処理
        header('Location: cart-confirm.php');
        exit;
    }
}

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
    <title>カート</title>
</head>
<body>
    <?php require_once './header.php'; ?>
        <div class="page-path">
            <a href="./index.php">
                <p>TOP</p>
            </a>
            <p>></p>
                <p>カート</p>
        </div>

        <div class="welcome">
            <p>ようこそ<?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>様</p>
        </div>

        <main class="cart">

            <!-- カート情報 -->
            <div class="cart-summary">

                <p>
                    現在 商品
                    <span><?= $totalQuantity ?></span>点
                </p>

                <p>
                    ご注文小計 税込
                    <span>￥<?= number_format($totalPrice) ?></span>
                </p>

                <!-- 購入フォーム -->
                <form action="cart.php" method="post" class="cart-buy-button-form">
                    <button type="submit" name="purchase" class="cart-buy-button">
                        購入確認へ進む
                    </button>
                </form>

                <!-- ログインメッセージ -->

                <?php if (isset($loginMessage)): ?>

                    <div class="login-message">
                        <p>
                            <?= htmlspecialchars($loginMessage, ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <a href="login.php">
                            ログインする
                        </a>
                    </div>

                <?php endif; ?>

            </div>


            <!-- 商品一覧 -->
            <div class="cart-products">

                <?php if (empty($products)): ?>

                    <p>カートに商品がありません。</p>

                <?php endif; ?>

                <?php foreach ($products as $product): ?>

                    <?php
                    $quantity = $cart[$product['id']];
                    $subtotal = $product['price'] * $quantity;
                    ?>

                    <div class="cart-product">

                        <!-- 左：画像30% -->
                        <div class="cart-product-image">

                            <img
                                src="./images/donuts/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
                            >

                        </div>


                        <!-- 右：商品情報70% -->
                        <div class="cart-product-info">
                            <div class="cart-product-name">
                                <h2>
                                        <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                                </h2>
                            </div>
                            <div class="cart-product-price">

                                <p>
                                    税込 ￥
                                    <?= number_format($product['price']) ?>円
                                </p>

                                <form action="cart.php" method="post">

                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="<?= (int)$product['id'] ?>"
                                    >

                                    <label>
                                        個数：
                                        <input
                                            type="number"
                                            name="quantity"
                                            value="<?= (int)$quantity ?>"
                                            min="1"
                                        >
                                        個
                                    </label>

                            </div>

                                <button type="submit" name="recalculate" class="recalculate-button">
                                        再計算
                                </button>

                                </form>
                            
                            <form action="cart.php" method="post" class="delete-form">

                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="<?= $product['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    name="delete"
                                >
                                    削除
                                </button>

                            </form>

                            <div class=cart-product-border></div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

                        <!-- カート情報 -->
            <div class="cart-summary">

                <p>
                    カートに入っている商品：
                    <span><?= $totalQuantity ?></span>点
                </p>

                <p>
                    合計金額：
                    <span><?= number_format($totalPrice) ?></span>円
                </p>

                <!-- 購入フォーム -->
                <form action="cart.php" method="post" class="cart-buy-button-form">
                    <button type="submit" name="purchase" class="cart-buy-button">
                        購入確認へ進む
                    </button>
                </form>

            </div>

            <div class="cart-back-container">
                <div class="cart-back">
                    <a href="./product-list.php">
                        買い物を続ける
                    </a>
                </div>
            </div>

        </main>
    <?php require_once './footer.php'; ?>
</body>
</html>