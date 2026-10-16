<?php
session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

require_once './common/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = 'SELECT id, name, password, postcode_a, postcode_b, address, mail
            FROM customers
            WHERE mail = :mail';

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':mail' => $email
    ]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $error = 'メールアドレスが見つかりません。';

} elseif (!password_verify($password, $user['password'])) {
    $error = 'パスワードが一致しません。';

} else {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_postcode_a'] = $user['postcode_a'];
    $_SESSION['user_postcode_b'] = $user['postcode_b'];
    $_SESSION['user_address'] = $user['address'];
    $_SESSION['user_mail'] = $user['mail'];

    header('Location: login-complete.php');
    exit;
}}
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
    <title>ログイン</title>
</head>
<body>
    <?php require_once './header.php'; ?>
<main>
    <div class="page-path">
        <a href="./index.php">
        <p>TOP</p>
        </a>
        <p>></p>
        <p>ログイン</p>
    </div>
    <div class="welcome">
        <p>ようこそ<?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>様</p>
    </div>
    <div class="headline">
        <h1>ログイン</h1>
    </div>
    
    <div class="login-form">
        <form action="login.php" method="post">

            <div class="input-container">
                <div>
                    <label for="e-mail" id="e-mail-label">メールアドレス</label>
                </div>
                <div>
                    <input type="email" name="email" id="e-mail" required>
                </div>
            </div>

            <div class="input-container">
                <div>
                    <label for="password" id="password-label">パスワード</label>
                </div>
                <div>
                    <input type="password" name="password" id="password" required>
                        <?php if ($error): ?>
                            <p style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                </div>
            </div>

            <button type="submit" class="login-button">
                ログイン
            </button>

        </form>
    </div>
    <div class="register-link">
        <a href="./register.php">会員登録はこちらから</a>
    </div>
</main>
    <?php require_once './footer.php'; ?>
</body>
</html>