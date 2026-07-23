// スクロール連動アニメーション（.js-inview に .is-inview を付与）
(() => {
  const targets = document.querySelectorAll(".js-inview");
  if (!targets.length) return;

  if (!("IntersectionObserver" in window)) {
    targets.forEach((el) => el.classList.add("is-inview"));
    return;
  }

  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-inview");
        obs.unobserve(entry.target);
      });
    },
    {
      rootMargin: "0px 0px -10% 0px",
      threshold: 0.15,
    }
  );

  targets.forEach((el) => observer.observe(el));
})();
// ハンバーガーメニュー（全画面フェード表示・ESC/リンククリックで閉じる）
(() => {
  const hamburger = document.querySelector(".js-hamburger");
  const drawer = document.querySelector(".js-drawer");
  if (!hamburger || !drawer) return;

  const ACTIVE_CLASS = "is-active";
  const BODY_LOCK_CLASS = "is-drawer-open";

  const toggleMenu = (isOpen) => {
    hamburger.classList.toggle(ACTIVE_CLASS, isOpen);
    drawer.classList.toggle(ACTIVE_CLASS, isOpen);
    document.body.classList.toggle(BODY_LOCK_CLASS, isOpen);
    hamburger.setAttribute("aria-expanded", String(isOpen));
    hamburger.setAttribute("aria-label", isOpen ? "メニューを閉じる" : "メニューを開く");
  };

  hamburger.addEventListener("click", () => {
    const isOpen = !hamburger.classList.contains(ACTIVE_CLASS);
    toggleMenu(isOpen);
  });

  drawer.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => toggleMenu(false));
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && hamburger.classList.contains(ACTIVE_CLASS)) {
      toggleMenu(false);
    }
  });
})();
