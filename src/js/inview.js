// ============================================
// スクロール連動アニメーション（inview 相当）
// jQuery 不使用。IntersectionObserver で要素が画面に入ったら
// .is-inview を付与し、CSS 側でスライドイン/ふわっと表示を行う
// ============================================
(() => {
  const targets = document.querySelectorAll(".js-inview");

  // 対象が無ければ何もしない
  if (!targets.length) return;

  // IntersectionObserver 非対応環境ではアニメーションせず即表示
  if (!("IntersectionObserver" in window)) {
    targets.forEach((el) => el.classList.add("is-inview"));
    return;
  }

  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-inview");
        // 一度表示したら監視解除（再アニメーションしない）
        obs.unobserve(entry.target);
      });
    },
    {
      // 要素が少し画面内に入ったら発火
      rootMargin: "0px 0px -10% 0px",
      threshold: 0.15,
    }
  );

  targets.forEach((el) => observer.observe(el));
})();
