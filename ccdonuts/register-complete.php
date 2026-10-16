<?php
session_start();

require_once './common/db.php';

if (!isset($_SESSION['register_data'])) {
    header('Location: register.php');
    exit;
}

$data = $_SESSION['register_data'];

$userName = $data['user_name'];
$kana = $data['kana'];

$postalCode1 = $data['postal_code1'];
$postalCode2 = $data['postal_code2'];

$address = $data['address'];

$email = $data['email'];
$password = $data['password'];


// メールアドレス重複チェック
$sql = 'SELECT id
        FROM customers
        WHERE mail = :mail';

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':mail' => $email
]);

$existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existingUser) {
    $_SESSION['register_error'] =
        'このメールアドレスはすでに登録されています。';

    header('Location: register.php');
    exit;
}


// パスワードをハッシュ化
$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// customersテーブルへ登録
$sql = 'INSERT INTO customers
        (name, furigana, postcode_a, postcode_b, address, mail, password)
        VALUES
        (:name, :furigana, :postcode_a, :postcode_b, :address, :mail, :password)';

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':name' => $userName,
    ':furigana' => $kana,
    ':postcode_a' => $postalCode1,
    ':postcode_b' => $postalCode2,
    ':address' => $address,
    ':mail' => $email,
    ':password' => $hashedPassword
]);


// 登録データを削除
unset($_SESSION['register_data']);
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
        <title>会員登録確認</title>
    </head>

    <body>

        <?php require_once './header.php'; ?>

        <main>

            <div class="page-path">
                    <a href="./index.php">TOP</a>
                    <p>></p>
                    <a href="./login.php">ログイン</a>
                    <p>></p>
                    <a href="./register.php">会員登録</a>
                    <p>></p>
                    <p>登録確認</p>
            </div>
            <div class="welcome">
                    <p>ようこそ<?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>様</p>
            </div>

            <div class="headline">
                    <h1>会員登録完了</h1>
            </div>

            <div class="complete-container">

                <h2>会員登録が完了しました</h2>

                <a href="./login.php">
                        ログインページへお進みください。
                </a>

            </div>

            <div class="card-guide">
                <a href="">
                    クレジットカード登録へすすむ
                </a>
            </div>
            <div class="cart-guide">
                <a href="./cart-confirm.php">
                    購入確認ページへすすむ
                </a>
            </div>

        </main>

        <?php require_once './footer.php'; ?>

    </body>
</html>