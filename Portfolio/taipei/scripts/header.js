'use strict';

const hamburger = document.querySelector('.hamburger');
const nav = document.querySelector('.nav');

hamburger.addEventListener('click', function () {

    hamburger.classList.toggle('active');

    nav.classList.toggle('open');

    document.body.classList.toggle('no-scroll'); // ←追加

});