<?php
session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

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
$emailConfirmation = $data['email_confirmation'] ?? '';

$password = $data['password'];
$passwordConfirmation = $data['password_confirmation'] ?? '';

$postalCode = $postalCode1 . '-' . $postalCode2;
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
        <h1>入力確認</h1>
    </div>


    <div class="register-confirm">

        <!-- 名前 -->
        <div class="confirm-item">
            <p class="confirm-label">
                名前
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>


        <!-- フリガナ -->
        <div class="confirm-item">
            <p class="confirm-label">
                お名前（フリガナ）
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($kana, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>


        <!-- 郵便番号 -->
        <div class="confirm-item">
            <p class="confirm-label">
                郵便番号
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($postalCode, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>


        <!-- 住所 -->
        <div class="confirm-item">
            <p class="confirm-label">
                住所
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>


        <!-- メールアドレス -->
        <div class="confirm-item">
            <p class="confirm-label">
                メールアドレス
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>

        <!-- メールアドレス確認用 -->
        <div class="confirm-item">
            <p class="confirm-label">
                メールアドレス確認用
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($emailConfirmation, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>

        <!-- パスワード -->
        <div class="confirm-item">
            <p class="confirm-label">
                パスワード
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>

        <!-- パスワード確認用 -->
        <div class="confirm-item">
            <p class="confirm-label">
                パスワード確認用
            </p>

            <p class="confirm-user">
                <?= htmlspecialchars($passwordConfirmation, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>

         <!-- ボタン -->
        <div class="confirm-buttons">

            <!-- 登録する -->
            <form action="register-complete.php" method="post">

                <button type="submit" class="register-button">
                    登録する
                </button>

            </form>

        </div>

    </div>

</main>

<?php require_once './footer.php'; ?>

</body>
</html>