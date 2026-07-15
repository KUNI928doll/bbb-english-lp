function openingAnimation() {
  // オープニング処理
}

function hideOpening() {
  gsap.set('.js-loading', { autoAlpha: 0 })
}

// まず最初に読み込まれる所
document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelectorAll('.js-loading').length) {
    // const animationPlayed = getCookie("animationPlayed");
    if (sessionStorage.getItem('visited')) {
      hideOpening();
    } else {
      openingAnimation();
      // setCookie("animationPlayed", "true", 1 / 1440);
      sessionStorage.setItem('visited', 'true');
    }
  }
});
