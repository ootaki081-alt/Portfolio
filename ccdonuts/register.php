<?php
session_start();

$loginUserName = $_SESSION['user_name'] ?? 'ゲスト';

require_once './common/db.php';

$error = '';

// セッションに保存されている入力内容を取得
$registerData = $_SESSION['register_data'] ?? [];

$userName = $registerData['user_name'] ?? '';
$kana = $registerData['kana'] ?? '';

$postalCode1 = $registerData['postal_code1'] ?? '';
$postalCode2 = $registerData['postal_code2'] ?? '';

$address = $registerData['address'] ?? '';

$email = $registerData['email'] ?? '';
$emailConfirmation = $registerData['email_confirmation'] ?? '';

$password = $registerData['password'] ?? '';
$passwordConfirmation = $registerData['password_confirmation'] ?? '';

// POSTされた場合

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ============================
    // 入力値を取得
    // ============================

    $userName = trim($_POST['user_name'] ?? '');
    $kana = trim($_POST['kana'] ?? '');

    $postalCode1 = trim($_POST['postal_code1'] ?? '');
    $postalCode2 = trim($_POST['postal_code2'] ?? '');

    $address = trim($_POST['address'] ?? '');

    $email = trim($_POST['email'] ?? '');
    $emailConfirmation = trim($_POST['email_confirmation'] ?? '');

    $password = $_POST['password'] ?? '';
    $passwordConfirmation = $_POST['password_confirmation'] ?? '';


    // ============================
    // 入力チェック
    // ============================

    if ($userName === '') {

        $error = '名前を入力してください。';

    } elseif ($kana === '') {

        $error = 'お名前（フリガナ）を入力してください。';

    } elseif ($postalCode1 === '' || $postalCode2 === '') {

        $error = '郵便番号を入力してください。';

    } elseif ($address === '') {

        $error = '住所を入力してください。';

    } elseif ($email === '') {

        $error = 'メールアドレスを入力してください。';

    } elseif ($emailConfirmation === '') {

        $error = 'メールアドレス確認用を入力してください。';

    } elseif ($password === '') {

        $error = 'パスワードを入力してください。';

    } elseif ($passwordConfirmation === '') {

        $error = 'パスワード確認用を入力してください。';

    // パスワード形式
    } elseif (!preg_match('/^[A-Za-z0-9]{8,20}$/', $password)) {

        $error =
            '半角英数字8文字以上20文字以内で入力してください。'
            . '※記号の使用はできません';

    // パスワード一致
    } elseif ($password !== $passwordConfirmation) {

        $error =
            'パスワードとパスワード確認用が一致していません。';

    // メールアドレス一致
    } elseif ($email !== $emailConfirmation) {

        $error =
            'メールアドレスとメールアドレス確認用が一致していません。';

    // 郵便番号
    } elseif (!preg_match('/^[0-9]{3}$/', $postalCode1)) {

        $error = '郵便番号前半は3桁の数字で入力してください。';

    } elseif (!preg_match('/^[0-9]{4}$/', $postalCode2)) {

        $error = '郵便番号後半は4桁の数字で入力してください。';

    } else {

        // ============================
        // メールアドレス重複チェック
        // ============================

        $sql = 'SELECT id
                FROM customers
                WHERE mail = :mail';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':mail' => $email
        ]);

        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {

            $error =
                'このメールアドレスはすでに登録されています。';
        }
    }


    // ============================
    // エラーがなければ確認ページへ
    // ============================

    if ($error === '') {

        // 確認ページで使用するためセッションに保存
        $_SESSION['register_data'] = [
            'user_name' => $userName,
            'kana' => $kana,
            'postal_code1' => $postalCode1,
            'postal_code2' => $postalCode2,
            'address' => $address,
            'email' => $email,
            'email_confirmation' => $emailConfirmation,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation
        ];

        header('Location: register-confirm.php');
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
    <title>ログイン</title>
</head>
<body>
    <?php require_once './header.php'; ?>
<main>
    <div class="page-path">
        <a href="./index.php">TOP</a>
        <p>></p>
        <a href="./login.php">ログイン</a>
        <p>></p>
        <p>会員登録</p>
    </div>
    <div class="welcome">
        <p>ようこそ<?= htmlspecialchars($loginUserName, ENT_QUOTES, 'UTF-8') ?>様</p>
    </div>
    <div class="headline">
        <h1>会員登録</h1>
    </div>

        <div class="register-form">

        <form action="register.php" method="post">

            <!-- 名前 -->
            <div class="input-container">

                <div>
                    <label for="user-name">
                        名前 <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <input
                        type="text"
                        name="user_name"
                        id="user-name"
                        value="<?= htmlspecialchars($userName ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

            </div>

                        <div class="input-container">

                <div>
                    <label for="user-name">
                        お名前 (フリガナ) <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <input
                        type="text"
                        name="kana"
                        id="kana"
                        value="<?= htmlspecialchars($kana ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

            </div>


            <!-- 郵便番号 -->
            <div class="input-container">

                <div>
                    <label for="postal-code">
                        郵便番号 <span>(必須)</span>
                    </label>
                </div>

                <div class="postal-code-area">
                    <input
                        type="text"
                        name="postal_code1"
                        id="postal-code1"
                        maxlength="3"
                        inputmode="numeric"
                        value="<?= htmlspecialchars($postalCode1 ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >

                    <input
                        type="text"
                        name="postal_code2"
                        id="postal-code2"
                        maxlength="4"
                        inputmode="numeric"
                        value="<?= htmlspecialchars($postalCode2 ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

            </div>


            <!-- 住所 -->
            <div class="input-container">

                <div>
                    <label for="address">
                        住所 <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <input
                        type="text"
                        name="address"
                        id="address"
                        value="<?= htmlspecialchars($address ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

            </div>


            <!-- メールアドレス -->
            <div class="input-container">

                <div>
                    <label for="e-mail">
                        メールアドレス <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <input
                        type="email"
                        name="email"
                        id="e-mail"
                        value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

            </div>

                        <div class="input-container">

                <div>
                    <label for="e-mail">
                        メールアドレス確認用 <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <input
                        type="email"
                        name="email_confirmation"
                        id="email_confirmation"
                        value="<?= htmlspecialchars($emailConfirmation ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

            </div>

            <!-- パスワード -->
            <div class="input-container">

                <div>
                    <label for="password">
                        パスワード <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <span>半角英数字8文字以上20文字以内で入力してください。※記号の使用はできません</span>
                </div>

                <div>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        minlength="8"
                        maxlength="20"
                        pattern="[A-Za-z0-9]{8,20}"
                        value="<?= htmlspecialchars($password ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                    <label class="password-eye">
                        <input type="checkbox" id="show-password">
                        パスワードを表示
                    </label>
                </div>
                <?php if ($error): ?>
                    <p class="error-message">
                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </p>

                <?php endif; ?>
            </div>

                        <div class="input-container">

                <div>
                    <label for="password">
                        パスワード確認用 <span>(必須)</span>
                    </label>
                </div>

                <div>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        minlength="8"
                        maxlength="20"
                        pattern="[A-Za-z0-9]{8,20}"
                        value="<?= htmlspecialchars($passwordConfirmation ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                    <label class="password-eye">
                        <input type="checkbox" id="show-password">
                        パスワードを表示
                    </label>
                </div>
                <?php if ($error): ?>
                    <p class="error-message">
                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </p>

                <?php endif; ?>
            </div>

                <!-- ここに入力欄 -->

                <button type="submit" class="register-button">
                    入力確認する
                </button>

        </form>

    </div>
</main>
    <?php require_once './footer.php'; ?>
</body>
<script>
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const showPassword = document.getElementById('show-password');

    if (showPassword && password && passwordConfirmation) {
    showPassword.addEventListener('change', function () {
        if (this.checked) {
            password.type = 'text';
            passwordConfirmation.type = 'text' ;
        } else {
            password.type = 'password';
            passwordConfirmation.type = 'password';
        }
    });
    }
</script>
</html>