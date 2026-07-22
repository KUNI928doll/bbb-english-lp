# bbb-english-lp

Codejump 応用編：英会話スクールBBBのランディングページ（CSSアニメーション）。
デザイン: https://code-jump.com/lp-menu/

## 案件タイプ

**独自ルール案件** — クライアント指定の SCSS ガイドラインを適用する。
`~/docs/coding-rules.md`（いつものルール）は適用しない。

@coding-rules-custom.md

## ビルド環境

Gulp は使わない（クライアント独自ルールに合わせて撤去済み）。素の npm scripts + sass CLI で回す。

- `npm run build` — 本番ビルド一発（clean → css → html → js → img → webp → copy）
- `npm run dev` — build 後、`sass --watch` と `browser-sync` を `concurrently` で並列起動（http://localhost:3000）
- SCSS: `sass` CLI で `src/sass/style.scss` / `src/sass/fv.scss` → `dist/assets/css/*.{css,min.css}`（style.css / style.min.css / fv.css / fv.min.css）
- HTML: `cp src/html/index.html dist/`
- JS: `src/js/fv.js` → `dist/assets/js/fv.js`（単体）、`src/js/inview.js` + `src/js/script.js` を `cat` で結合し `dist/assets/js/other.js`
- 画像: `rsync -a src/img/ dist/assets/images/`（`.gitkeep` は除外）
- WebP: `cwebp -q 82` で `.jpg/.jpeg/.png` から `.webp` を生成
- ライブラリ: GSAP・ScrollTrigger は `node_modules/gsap/dist/*.min.js` を `dist/assets/js/app/` に `cp`
- 納品時は SCSS ソースも `assets/scss/` として同梱する（全体ガイドライン参照）
