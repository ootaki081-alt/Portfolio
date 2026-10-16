<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userName = $_SESSION['user_name'];
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
                    <p>ログイン完了</p>
            </div>
            <div class="welcome">
                    <p>ようこそ<?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>様</p>
            </div>

            <div class="headline">
                    <h1>ログイン完了</h1>
            </div>

            <div class="complete-container">

                <h2>ログインが完了しました</h2>

                <h3>引き続きお楽しみください。</h3>

            </div>

            <div class="card-guide">
                <a href="./cart-confirm.php">
                    購入確認ページへすすむ
                </a>
            </div>
            <div class="cart-guide">
                <a href="./index.php">
                    TOPページへもどる
                </a>
            </div>

        </main>

        <?php require_once './footer.php'; ?>

    </body>
</html>