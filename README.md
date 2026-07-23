# BBB 英会話スクール LP

英会話スクール BBB のランディングページ。素の HTML / SCSS / JavaScript で構築。
**Node.js は不使用**（npm / Gulp / バンドラーなし）。ルート直下がそのまま公開・納品物です。

## 動作環境

- SCSS コンパイラ（どちらか）
  - **Live Sass Compile**（VS Code 拡張・GUI）
  - **dart-sass**（スタンドアロン CLI。macOS: `brew install sass`）
- WebP を再生成する場合のみ `cwebp`（macOS: `brew install webp`）

> `npm install` は不要です。GSAP などのライブラリは `assets/js/app/` に静的同梱済み。

## セットアップ

クローンして VS Code で開くだけ。ビルド工程はありません。
静的サイトなので `index.html` をブラウザで直接開くか、任意の静的サーバー（例: VS Code の Live Server 拡張、`python3 -m http.server`）で配信します。

## SCSS のコンパイル

### 方法 A: Live Sass Compile（推奨・GUI）

1. VS Code 拡張「Live Sass Compiler」をインストール
2. リポジトリを開く（`.vscode/settings.json` に出力設定を同梱済み）
3. ステータスバーの **Watch Sass** をクリック

`assets/scss/style.scss` / `fv.scss` を編集・保存すると、`assets/css/` に
`style.css` / `style.min.css` / `fv.css` / `fv.min.css` が自動出力されます。

### 方法 B: dart-sass CLI（手動）

```bash
# 展開版
sass --load-path=assets/scss --style=expanded --no-source-map \
  assets/scss/style.scss:assets/css/style.css \
  assets/scss/fv.scss:assets/css/fv.css

# 圧縮版
sass --load-path=assets/scss --style=compressed --no-source-map \
  assets/scss/style.scss:assets/css/style.min.css \
  assets/scss/fv.scss:assets/css/fv.min.css
```

監視する場合は `--watch` を付与します。

## WebP の再生成（任意）

画像を差し替えたときのみ。`cwebp`（非 Node）で `.jpg` / `.png` から生成します。

```bash
cd assets/images
find . -type f \( -iname '*.jpg' -o -iname '*.png' \) \
  | while read f; do cwebp -quiet -q 82 "$f" -o "${f%.*}.webp"; done
```

## ディレクトリ構成

```
/  （ルート直下がそのまま納品物）
├── index.html
├── favicon.ico / apple-touch-icon.png / android-chrome-256x256.png
├── .vscode/
│   └── settings.json          # Live Sass Compile 設定
└── assets/
    ├── scss/                  # SCSS ソース
    │   ├── global/            # 変数・関数・mixin
    │   ├── common/            # 全ページ共通
    │   │   ├── foundation/    # リセット・ベース・フォント
    │   │   ├── layout/        # ヘッダー・フッター
    │   │   └── conpornent/    # 再利用 UI パーツ
    │   ├── page/              # ページ固有スタイル
    │   ├── fv-style/          # FV 専用スタイル
    │   ├── style.scss         # メインエントリー
    │   └── fv.scss            # FV 専用エントリー
    ├── css/                   # コンパイル出力（style.css / style.min.css / fv.css / fv.min.css）
    ├── js/
    │   ├── other.js           # inview（IntersectionObserver）＋ ドロワー等を統合
    │   └── app/               # gsap.min.js / ScrollTrigger.min.js（静的同梱）
    └── images/                # common/ pc/ sp/（PNG・JPG・SVG ＋ WebP）
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

- [GSAP + ScrollTrigger](https://gsap.com/) — アニメーション（`assets/js/app/` に静的同梱）

## 主な機能

- ハンバーガーメニュー（フェードで全画面表示・背景スクロールロック）
- FV のクロスフェード（3 枚を CSS アニメーションで切替）
- スクロール連動アニメーション（IntersectionObserver ベース）
- スムーズスクロール（`prefers-reduced-motion` 尊重）
- WebP フォールバック付き `<picture>`

## ブラウザ対応

Chrome / Firefox / Safari / Edge の最新版
