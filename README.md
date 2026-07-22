# BBB 英会話スクール LP

英会話スクール BBB のランディングページ。素の HTML / SCSS / JavaScript で構築（Gulp・WordPress 不使用）。

## 動作環境

- Node.js 18 以上（開発時は 24.x で確認）
- npm 9 以上
- macOS / Linux 想定（`rsync` / `cwebp` を利用）
- WebP 生成には `cwebp` が必要（macOS: `brew install webp`）

## セットアップ

```bash
npm install
```

## 開発

```bash
npm run dev
```

- `http://localhost:3000` で開発サーバー起動
- SCSS / HTML / JS / 画像の変更を監視し、`dist/` に自動出力 & ブラウザリロード

## 本番ビルド

```bash
npm run build
```

`dist/` に納品用ファイル一式が生成されます。

## ディレクトリ構成

```
src/
├── html/
│   └── index.html          # メインの HTML
├── sass/
│   ├── global/             # 変数・関数・mixin
│   ├── common/             # 全ページ共通
│   │   ├── foundation/     # リセット・ベース・フォント
│   │   ├── layout/         # ヘッダー・フッター
│   │   └── conpornent/     # 再利用 UI パーツ
│   ├── page/               # ページ固有スタイル
│   ├── fv-style/           # FV 専用スタイル
│   ├── style.scss          # メインエントリー
│   └── fv.scss             # FV 専用エントリー
├── js/
│   ├── fv.js               # FV アニメーション
│   ├── inview.js           # スクロール連動（IntersectionObserver）
│   └── script.js           # ドロワーメニュー等
├── img/                    # 画像ソース（PNG / JPG / SVG）
└── copy/                   # dist 直下へコピーするファイル（favicon 等）

dist/                       # ビルド出力
├── index.html
└── assets/
    ├── css/                # style.css / style.min.css / fv.css / fv.min.css
    ├── js/                 # fv.js / other.js / app/gsap.min.js 等
    └── images/             # WebP フォールバック付きで書き出し
```

## SCSS ガイドライン概要

- **基準フォントサイズ**: 10px（`rem(16)` = 16px）
- **リキッドレイアウト**: `_common.scss` で html font-size を vw スケーリング
  - SP（〜768px）: 375px 基準
  - smpc（769〜1440px）: 1440px 基準
  - xlpc（1441px〜）: 62.5% 固定
- **メディアクエリ**: `@include mq(sp / pc / smpc / xlpc)` に統一
- **命名**: BEM（`block__element--modifier`）、ネストは 3 階層まで
- **変数**: 色・フォント名は `global/_valiables.scss` に集約

## 使用ライブラリ

- [GSAP + ScrollTrigger](https://gsap.com/) — アニメーション（ローカル同梱）
- [browser-sync](https://browsersync.io/) — 開発サーバー
- [sass](https://sass-lang.com/) — SCSS コンパイル
- [chokidar-cli](https://github.com/open-cli-tools/chokidar-cli) — ファイル監視
- [concurrently](https://github.com/open-cli-tools/concurrently) — 並列プロセス実行

## 主な機能

- ハンバーガーメニュー（フェードで全画面表示・背景スクロールロック）
- FV のクロスフェード（3 枚を CSS アニメーションで切替）
- スクロール連動アニメーション（IntersectionObserver ベース）
- スムーズスクロール（`prefers-reduced-motion` 尊重）
- WebP フォールバック付き `<picture>`

## ブラウザ対応

Chrome / Firefox / Safari / Edge の最新版
