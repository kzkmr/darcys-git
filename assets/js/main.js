/**
* Template Name: WeBuild - v4.1.0
* Template URL: https://bootstrapmade.com/free-bootstrap-coming-soon-template-countdwon/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }
  
  // 最初に、ビューポートの高さを取得し、0.01を掛けて1%の値を算出して、vh単位の値を取得
let vh = window.innerHeight * 0.01;
// カスタム変数--vhの値をドキュメントのルートに設定
document.documentElement.style.setProperty('--vh', `${vh}px`);


  /**
   * Countdown timer
   */

  let countdown = select('.countdown');

  const countDownDate = function() {
    let timeleft = new Date(countdown.getAttribute('data-count')).getTime() - new Date().getTime();

    let weeks = Math.floor(timeleft / (1000 * 60 * 60 * 24 * 7));
    let days = Math.floor(timeleft / (1000 * 60 * 60 * 24) % 7);
    let hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

    let output = countdown.getAttribute('data-template');
    output = output.replace('%w', weeks).replace('%d', days).replace('%h', hours).replace('%m', minutes).replace('%s', seconds);
    countdown.innerHTML = output;
  }
  countDownDate();
  setInterval(countDownDate, 1000);

})()