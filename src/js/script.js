// ============================================
// ハンバーガーメニュー（フェードで全画面表示）
// jQuery不使用。開閉トグル・aria更新・背面スクロール固定
// ============================================
(() => {
  const hamburger = document.querySelector(".js-hamburger");
  const drawer = document.querySelector(".js-drawer");

  // 要素が無ければ何もしない（他ページでの読み込みエラー防止）
  if (!hamburger || !drawer) return;

  const ACTIVE_CLASS = "is-active";
  const BODY_LOCK_CLASS = "is-drawer-open";

  // メニューを開閉する
  const toggleMenu = (isOpen) => {
    hamburger.classList.toggle(ACTIVE_CLASS, isOpen);
    drawer.classList.toggle(ACTIVE_CLASS, isOpen);
    document.body.classList.toggle(BODY_LOCK_CLASS, isOpen);
    hamburger.setAttribute("aria-expanded", String(isOpen));
    hamburger.setAttribute("aria-label", isOpen ? "メニューを閉じる" : "メニューを開く");
  };

  // ハンバーガー押下でトグル
  hamburger.addEventListener("click", () => {
    const isOpen = !hamburger.classList.contains(ACTIVE_CLASS);
    toggleMenu(isOpen);
  });

  // メニュー内リンク押下で閉じる（アンカー遷移を邪魔しない）
  drawer.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => toggleMenu(false));
  });

  // Escキーで閉じる
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && hamburger.classList.contains(ACTIVE_CLASS)) {
      toggleMenu(false);
    }
  });
})();
