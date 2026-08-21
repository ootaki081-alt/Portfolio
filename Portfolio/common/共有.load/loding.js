'use strict';

/* ==========================================
    既存のjavascriptの一番下にここから追記  loding画面
    ========================================== */


   // ページ内の画像・CSS・JSなど、すべての読み込みが完了したら実行される
window.addEventListener('load', () => {

  // id="loading" の要素を取得（ローディング画面）
  const loading = document.querySelector('#loading');

  // 1.5秒（1500ミリ秒）後に実行する処理を予約する
  setTimeout(() => {

    // #loading に "loaded" クラスを追加
    // → CSS側で loaded が付いたらフェードアウト・非表示などの演出を行う
    loading.classList.add('loaded');

  }, 1500); // 1500ms = 1.5秒
});
