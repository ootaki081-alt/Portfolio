'use strict'; 

// 「TOPへ戻る」ボタンの要素を取得
const pageTop = document.querySelector(".pageTop");

// 画面をスクロールしたときに実行される処理
window.addEventListener("scroll", function(){

    // 現在のスクロール量が「1画面分の高さ」を超えたかどうかを判定
    // window.scrollY：今どれだけスクロールしたか
    // window.innerHeight：画面の高さ
    if(window.scrollY > window.innerHeight){

        // 1画面以上スクロールしたら「表示用のクラス」を付ける
        pageTop.classList.add("show");

    }else{

        // 1画面未満なら「表示用のクラス」を外して非表示にする
        pageTop.classList.remove("show");

    }

});

// 「TOPへ戻る」ボタンをクリックしたときの処理
pageTop.addEventListener("click", function(e){

    // aタグのデフォルトの動作（ページ遷移）を止める
    e.preventDefault();

    // ページの一番上までゆっくりスクロールする
    window.scrollTo({
        top: 0,          // スクロール先（ページ最上部）
        behavior: "smooth"  // スムーズスクロール
    });

});
