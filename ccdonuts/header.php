<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<header>

    <div class="header-inner">

        <!-- ハンバーガーボタン -->
        <button class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- ヘッダーアイコン -->
        <h1>
            <img src="./images/header/main-rog.png">
        </h1>

        <!-- ログインボタン -->
        <h2>
            <?php if (isset($_SESSION['user_id'])): ?>

                <a href="./logout.php"
                onclick="return confirm('ログアウトしますか？');">
                    <img src="./images/header/login.png">
                    <span>ログアウト</span>
                </a>

            <?php else: ?>

                <a href="./login.php">
                    <img src="./images/header/login.png">
                    <span>ログイン</span>
                </a>

            <?php endif; ?>
        </h2>


        <!-- カートボタン -->
        <h3>
            <a href="./cart.php">
                <img src="./images/header/cart.png">
                <span>カート</span>
            </a>
        </h3>
    </div>
    <div class="search">
        <button><img src="./images/header/search.png"></button>
        <input type="text" placeholder="検索" id="search">
    </div>
</header>
<!-- ドロワーメニュー -->
<nav class="drawer" id="drawer">

        <div class="drawer-header">
            <a href="">
                <img src="./images/header/main-rog.png">
            </a>
        <button class="drawer-close" id="drawer-close">
            ×
        </button>
        </div>
    <ul>
        <li><a href="https://ss1.xrea.com/ootaki.s325.xrea.com/Portfolio/port.php">TOP</a></li>
        <li><a href="./product-list.php">商品一覧</a></li>
        <li><a href="#">よくある質問</a></li>
        <li><a href="#">問い合わせ</a></li>
        <li><a href="#">当サイトのポリシー</a></li>
    </ul>
</nav>

<script>
const hamburger = document.getElementById("hamburger");
const drawer = document.getElementById("drawer");
const drawerClose = document.getElementById("drawer-close");


// ハンバーガーをクリック
hamburger.addEventListener("click", function () {

    drawer.classList.add("is-open");

});


// ×ボタンをクリック
drawerClose.addEventListener("click", function () {

    drawer.classList.remove("is-open");

});


// 背景をクリック
drawerOverlay.addEventListener("click", function () {

    drawer.classList.remove("is-open");

});
</script>