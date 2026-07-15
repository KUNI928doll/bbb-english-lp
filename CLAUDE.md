# bbb-english-lp

Codejump 応用編：英会話スクールBBBのランディングページ（CSSアニメーション）。
デザイン: https://code-jump.com/lp-menu/

## 案件タイプ

**独自ルール案件** — クライアント指定の SCSS ガイドラインを適用する。
`~/docs/coding-rules.md`（いつものルール）は適用しない。

@coding-rules-custom.md

## ビルド環境

- Gulp（`~/gulp-templates/latest` ベース）/ システム Node 24 で動作確認済み
- `npm run dev` — 開発サーバー（browser-sync）＋ watch
- `npm run build` — 本番ビルド
- SCSS: `src/sass/` → `dist/assets/css/`（style.css / style.min.css / fv.css / fv.min.css を出力）
- HTML: `src/html/` → `dist/`
- JS: `src/js/fv.js` → `dist/assets/js/fv.js`（単体）、その他 `src/js/*.js` は結合して `dist/assets/js/other.js`
- 画像: `src/img/`（common / pc / sp）→ `dist/assets/images/`
- ライブラリ: Splide.js・GSAP は node_modules から `dist/assets/js/app/` へコピーされる
- 納品時は SCSS ソースも `assets/scss/` として同梱する（全体ガイドライン参照）
