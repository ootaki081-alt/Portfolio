<?php
session_start();

require_once './common/db.php';


// ============================
// ログイン確認
// ============================

if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit;
}

$loginUserName = $_SESSION['user_name'];


// ============================
// カート取得
// ============================

$cart = $_SESSION['cart'] ?? [];

$products = [];


// ============================
// カートの商品情報を取得
// ============================

if (!empty($cart)) {

    $ids = array_keys($cart);

    $placeholders = implode(
        ',',
        array_fill(0, count($ids), '?')
    );

    $sql = "SELECT id, image, name, price
            FROM products
            WHERE id IN ($placeholders)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ============================
// 合計金額
// ============================

$totalQuantity = 0;
$totalPrice = 0;

foreach ($products as $product) {

    $quantity = $cart[$product['id']];

    $totalQuantity += $quantity;

    $totalPrice += $product['price'] * $quantity;
}


// ============================
// お届け先を取得
// ============================

$sql = "SELECT name, postcode_a, postcode_b, address
        FROM customers
        WHERE name = ?
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->execute([$loginUserName]);

$customer = $stmt->fetch(PDO::FETCH_ASSOC);


// 見つからない場合
if (!$customer) {
    $customer = [
        'name' => $loginUserName,
        'postcode_a,postcode_b' => '',
        'address' => ''
    ];
}

?>

<!DOCTYPE html>
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
    <title>購入確認</title>

</head>

<body>

<?php require_once './header.php'; ?>


<!-- パンくず -->

<div class="page-path">

    <a href="./index.php">
        <p>TOP</p>
    </a>

    <p>></p>

    <a href="./cart.php">
        <p>カート</p>
    </a>

    <p>></p>

    <p>購入確認</p>

</div>


<!-- ようこそ -->

<div class="welcome">

    <p>
        ようこそ
        <?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>
        様
    </p>

</div>


<main class="headline">

    <h1>購入確認</h1>


    <!-- =================================
         購入品
    ================================== -->

    <section class="purchase-section">

        <h2>ご購入商品</h2>


        <?php foreach ($products as $product): ?>

            <?php
            $quantity = $cart[$product['id']];
            $subtotal = $product['price'] * $quantity;
            ?>


            <div class="purchase-item">

                <div class="purchase-item-info">

                    <div class="purchase-row">
                        <p class="purchase-label">商品名</p>
                        <p class="purchase-value">
                            <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>

                    <div class="purchase-row">
                        <p class="purchase-label">数量</p>
                        <p class="purchase-value">
                            <?= $quantity ?>個
                        </p>
                    </div>

                    <div class="purchase-row">
                        <p class="purchase-label">金額</p>
                        <p class="purchase-value">
                            税込 ￥<?= number_format($subtotal) ?>
                        </p>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </section>


    <!-- =================================
         合計金額
    ================================== -->

    <section class="purchase-total">

        <div class="total-row">

            <p class="purchase-label">商品数</p>
            <p class="purchase-value">
                <?= $totalQuantity ?>点
            </p>

        </div>

        <div class="total-row">

            <p class="purchase-label">合計</p>
            <p class="purchase-value">
                税込 ￥<?= number_format($totalPrice) ?>
            </p>

        </div>

    </section>


    <!-- =================================
         お届け先
    ================================== -->

    <h2>お届け先</h2>
    <section class="delivery-section">

        <div class="delivery-row">

            <p class="purchase-label">お名前</p>
            <p class="purchase-value">
                <?= htmlspecialchars(
                    $customer['name'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        
        </div>

        <div class="delivery-row">

            <p class="purchase-label">郵便番号</p>
            <p class="purchase-value">
                <?= htmlspecialchars($customer['postcode_a'], ENT_QUOTES, 'UTF-8') ?>-
                <?= htmlspecialchars($customer['postcode_b'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        
        </div>

        <div class="delivery-row">

            <p class="purchase-label">住所</p>
            <p class="purchase-value">  
              <?= htmlspecialchars(
                    $customer['address'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

        </div>

    </section>

    <!-- =================================
        カード登録
    ================================== -->    

    <h2>お支払い情報</h2>

    <section class="card-section">

        <div class="card-register-button">
            <a href="">
                カード情報登録する
            </a>
        </div>
        <p class="card-text">
        カード情報登録がまだのお客様はこちらへお進みください。
        </p>

    </section>

</main>


<?php require_once './footer.php'; ?>

</body>
</html>