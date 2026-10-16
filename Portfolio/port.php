<?php
$isLocal = in_array(
    $_SERVER['HTTP_HOST'] ?? '',
    ['localhost', '127.0.0.1'],
    true
);

if ($isLocal) {
    // ローカル環境
    $ccdonutsUrl = 'http://localhost/ccdonuts/index.php';
} else {
    // Web環境（XREA）
    $ccdonutsUrl = 'https://ss1.xrea.com/ootaki.s325.xrea.com/Portfolio/ccdonuts/index.php';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<title>ootakiPortfolio</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./styles/reset.css">
<link rel="stylesheet" href="./styles/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
</head>
<header>
    <div class="container">
        <h1>大瀧のポートフォリオ</h1>

        <!-- ハンバーガーボタン -->
        <button class="hamburger" id="hamburger" aria-label="メニューを開く">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav>
            <ul class="navbar" id="navbar">
                <li>
                    <a class="navList" href="#PROFILE">PROFILE</a>
                </li>
                <li>
                    <a class="navList" href="#SKILL">SKILL</a>
                </li>
                <li>
                    <a class="navList" href="#WORKS">WORKS</a>
                </li>
                <li>
                    <a class="navList" href="#CONTACT">CONTACT</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<body>
<section class="section1">
    <h1 id="PROFILE">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
        PROFILE
    </h1>
    <div>
        <p class="name">Ootaki Kaito</p>
        <p>
        <svg xmlns="http://www.w3.org/2000/svg" 
            width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
        </svg>
        japan , chiba
        </p>
    </div>
    <div class="pro-text">

        <div class="interest-item">
            <div class="interest">
            <p>関心</p>
            <span class="tap-guide">TAP TO OPEN</span>
            </div>
            <div class="interest-text">
            <p>　ゲームが好きだったことをきっかけに、ゲームやデザインに興味を持ち、大学ではデザインを学んでいました。</p>
            </div>
        </div>

        <div class="interest-item">
            <div class="interest">
                <p>過去</p>
                <span class="tap-guide">TAP TO OPEN</span>
            </div>
            <div class="interest-text">
                <p>　大学ではプログラミングにも触れる機会がありましたが、当時は十分に理解できないまま学習を終えてしまいました。</p>
            </div>
        </div>

        <div class="interest-item">
            <div class="interest">
                <p>気持ち</p>
                <span class="tap-guide">TAP TO OPEN</span>
            </div>
            <div class="interest-text">
                <p>　自分が本当に興味を持っていることや、これから身につけたいスキルについて改めて考えるようになり、以前は理解できなかったプログラミングをもう一度基礎から学び始めました。</p>
            </div>
        </div>

        <div class="interest-item current">
            <div class="interest">
                <p>現在</p>
                <span class="tap-guide">TAP TO OPEN</span>
            </div>
            <div class="interest-text">
                <p>　現在はHTML、CSS、JavaScriptなどを中心に、Web制作を通してプログラミングを学んでいます。</p>
                <p>デザインを学んだ経験も活かしながら、見た目だけでなく、使いやすさやユーザー目線も意識したWebサイトを制作できるようになることを目指しています。</p>
                <p>一度理解できなかったことでも、改めて挑戦することで少しずつできることが増えていくことに楽しさを感じています。</p>
                <p>これからも試行錯誤を重ねながら、デザインとプログラミングの両方を活かせる制作者を目指していきたいと考えています。</p>
            </p>
            </div>
        </div>

    </div>
    
</section>
<section class="section2">
    <h1 id="SKILL" class="title-skill">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" color="white" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
        <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
        </svg>
        SKILL
    </h1>
    <div class="card">
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>レベル</th>
                        <th>説明</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>★★★★★</th>
                        <td>なんでも来い</td>
                    </tr>
                    <tr>
                        <th>★★★★☆</th>
                        <td>自信がある</td>
                    </tr>
                    <tr>
                        <th>★★★☆☆</th>
                        <td>理解している</td>
                    </tr>
                    <tr>
                        <th>★★☆☆☆</th>
                        <td>少し理解している</td>
                    </tr>
                    <tr>
                        <th>★☆☆☆☆</th>
                        <td>触れたことがある</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div>
            <h2 class="white">Programming</h2>
            <table class="Programming-table">
                <thead>
                    <tr>
                        <th class="white">type</th>
                        <th class="white">年数</th>
                        <th class="white">レベル</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-tr1">
                        <th class="white">HTML</th>
                        <td class="white">5ヶ月</td>
                        <td class="white">★★★★☆</td>
                    </tr>
                    <tr>
                        <th class="white">CSS</th>
                        <td class="white">5ヶ月</td>
                        <td class="white">★★★☆☆</td>
                    </tr>
                    <tr class="table-tr1">
                        <th class="white">JavaScript</th>
                        <td class="white">2ヶ月</td>
                        <td class="white">★☆☆☆☆</td>
                    </tr>
                    <tr class="table-tr1">
                        <th class="white">PHP</th>
                        <td class="white">1ヶ月</td>
                        <td class="white">★★☆☆☆</td>
                    </tr>
                    <tr class="table-tr1">
                        <th class="white">SQL</th>
                        <td class="white">1ヶ月</td>
                        <td class="white">★☆☆☆☆</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h3 class="white">取得した資格</h3>
            <ul class="qualification">
                <li class="white">クレーン特別教育(2023年3月取得)</li>
                <li class="white">玉掛け技能講習修了(2023年3月取得)</li>
                <li class="white">日商PC文書3級(2018年8月取得)</li>
                <li class="white">普通自動車第一種運転免許(AT限定)(2018年9月取得)</li>
            </ul>
        </div>
    </div>
    <!-- html,css,javascript,スキル箇条書き -->
    <div>
        <div>
            <h4 class="white"></h4>
                <ul>
                    <li class="white"></li>
                </ul>
        </div>
    </div>
</section>

<section class="section3">

    <h1 id="works">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="80"
            height="80"
            fill="currentColor"
            class="section-title__icon"
            viewBox="0 0 16 16"
            aria-hidden="true"
        >
            <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
        </svg>

        <span>WORKS</span>
    </h1>

    <div class="works-list">

        <!-- 作品1 -->
        <article class="work-card">
            <a
                class="work-card_link"
                href="./root directory/html.html"
            >
                <img
                    class="work-card_image"
                    src="./images/kagu.png"
                    alt="施工会社ホームページの画面"
                    loading="lazy"
                >

                <div class="work-card_content">
                    <h2 class="work-card_title">
                        施工会社ホームページ
                    </h2>

                    <p class="work-card_status">
                        制作状況：個人製作
                    </p>

                    <p class="work-card_p-language">
                        使用言語：HTML,CSS
                    </p>

                    <p class="work-card_duration">
                        制作時間：60時間
                    </p>
                </div>
            </a>
        </article>

        <!-- 作品2 -->
        <article class="work-card">
            <a
                class="work-card_link"
                href="./taipei/index.html"
            >
                <img
                    class="work-card_image"
                    src="./images/taipei.jpg"
                    alt="台北観光ホームページの画面"
                    loading="lazy"
                >

                <div class="work-card_content">
                    <h2 class="work-card_title">
                        台北観光ホームページ
                    </h2>

                    <p class="work-card_status">
                        制作状況：グループ制作
                    </p>

                    <p class="work-card_p-language">
                        使用言語：HTML,CSS,JavaScript
                    </p>

                    <p class="work-card_duration">
                        制作時間：60時間
                    </p>
                </div>
            </a>
        </article>

         <!-- 作品3 -->
        <article class="work-card">
            <a
                class="work-card_link"
                href="<?= htmlspecialchars($ccdonutsUrl, ENT_QUOTES, 'UTF-8') ?>"
            >
                <img
                    class="work-card_image"
                    src="./images/donuts.jpg"
                    alt="ドーナッツ商品ページの画面"
                    loading="lazy"
                >

                <div class="work-card_content">
                    <h2 class="work-card__title">
                        ドーナッツ商品ページ
                    </h2>

                    <p class="work-card_status">
                        制作状況：個人製作
                    </p>

                    <p class="work-card_p-language">
                        使用言語：HTML,CSS,JavaScript,PHP,SQL
                    </p>

                    <p class="work-card_duration">
                        制作時間：60時間
                    </p>
                </div>
            </a>
        </article>

         <!-- 作品4 -->
        <article class="work-card">
            <a
                class="work-card_link"
                href="./shooting/shooting.html"
            >
                <img
                    class="work-card_image"
                    src="./images/shooting.png"
                    alt="シューティングゲームの画面"
                    loading="lazy"
                >

                <div class="work-card_content">
                    <h2 class="work-card_title">
                        シューティングゲームのページ
                    </h2>

                    <p class="work-card_status">
                        制作状況：個人製作
                    </p>

                    <p class="work-card_p-language">
                        使用言語：HTML,CSS,JavaScript
                    </p>

                    <p class="work-card_duration">
                        制作時間：
                    </p>
                </div>
            </a>
        </article>
    </div>
</section>

<footer>
<!-- contact -->
    <h1 id="CONTACT">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
        </svg>
        <a href="https://github.com/ootaki081-alt/Portfolio/tree/main/Portfolio">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
        </svg>
        </a>
    </h1>
</footer>
</body>
<script>

//ハンバーガーメニュー 

const hamburger = document.getElementById("hamburger");
const navbar = document.getElementById("navbar");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navbar.classList.toggle("active");
});


// ブレイクポイント768px以下の場合開閉式

const interests = document.querySelectorAll('.interest');

interests.forEach(interest => {
    interest.addEventListener('click', () => {
        // 768px以下の場合だけ動作

            const item = interest.parentElement;

            item.classList.toggle('open');

             const guide = interest.querySelector('.tap-guide');

            if (item.classList.contains('open')) {
                guide.textContent = 'TAP TO CLOSE';
            } else {
                guide.textContent = 'TAP TO OPEN';
        }
    });
});

</script>
</html>