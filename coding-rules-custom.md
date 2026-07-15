# SCSS コーディングガイドライン（クライアント指定・独自ルール）

出典: https://app.notion.com/p/SCSS-3983c9f712bb806ea4b1c2e6a2c589d5
本プロジェクトの SCSS は「フォルダ分割」と「vw リキッドレイアウト」が前提。style.scss に全スタイルを書かず、下記ルールに沿って実装する。

## まず押さえる12のポイント

1. スタイルは global/ common/ page/ などフォルダ単位で分割する
2. style.scss は @forward のみ。スタイル本体は書かない
3. 数値は原則 rem()（基準 10px）。px 直書き禁止 ※場合による
4. html の font-size は vw 可変（_common.scss 定義）。各ファイルで書き換えない
5. メディアクエリは @include mq(sp / pc / smpc / xlpc) を使う
6. ブレークポイントは HTML / CSS / JS で統一（900px など独自定義しない）
7. 769px〜1440px の中間サイズでも必ず表示確認する
8. 色・フォントは global/_valiables.scss の変数を使う
9. 各ファイル先頭に `@use "../../global/" as *;` を書く（page 配下は `../global/`）
10. クラス名は BEM（block__element--modifier）。ネスト3階層まで
11. 新規ファイルは _index.scss に @forward を追記する
12. モバイルファースト、プロパティはアルファベット順 ※場合による

## フォルダ構成

```
src/sass/                ※ガイドラインの assets/scss/ に相当（Gulp が dist/assets/css/ に出力）
├── global/              # 変数・関数・mixin（編集は最小限）
│   ├── _index.scss
│   ├── _mixins.scss     # rem / mq / px-to-vw など
│   └── _valiables.scss  # カラー・フォント変数
├── common/              # 全ページ共通スタイル
│   ├── _index.scss
│   ├── foundation/      # リセット・ベース・フォント
│   │   ├── _index.scss
│   │   ├── _reset.scss
│   │   ├── _common.scss # html の vw スケーリング
│   │   └── _font.scss
│   ├── layout/          # ヘッダー・フッターなど
│   │   ├── _index.scss
│   │   ├── _header.scss
│   │   └── _footer.scss
│   └── conpornent/      # 再利用 UI パーツ（※クライアント指定の綴りをそのまま使用）
│       ├── _index.scss
│       └── _btn.scss
├── page/                # ページ固有スタイル
│   ├── _index.scss
│   └── _top.scss
└── style.scss           # エントリー（@forward のみ）
```

FV専用エントリー（fv-style/ ＋ fv.scss）は必要になった場合に追加する。

## グローバル設定

### rem()（基準 10px）

```scss
// ✅ 正しい
font-size: rem(16);
padding: rem(20) rem(40);
gap: rem(12);

// ❌ 避ける
font-size: 16px;
padding: 20px 40px;
```

定義（global/_mixins.scss）:

```scss
$baseFontSize: 10;

@function rem($pixels) {
  @return math.div($pixels, $baseFontSize) * 1rem;
}
```

### vw リキッドレイアウト（common/foundation/_common.scss 定義済み・書き換え禁止）

| 画面幅 | html font-size |
|---|---|
| SP 〜768px | 375px 基準の vw |
| 中間（smpc）769〜1440px | 1440px 基準の vw |
| 大画面（xlpc）1441px〜 | 62.5%（= 10px 固定） |

```scss
html {
  font-size: 62.5%;

  @include mq(sp) {
    font-size: calc(10 / (375 / 100) * 1vw);
  }
  @include mq(smpc) {
    font-size: calc(10 / (1440 / 100) * 1vw);
  }
  @include mq(xlpc) {
    font-size: 62.5%;
  }
}
```

px 直書きだと vw スケーリングの恩恵を受けられない。SP / PC の2値切り替えだけでは不十分で、769〜1440px も必ず確認する。

### ブレークポイント（mq mixin）

@media 直書き禁止。プロジェクト独自の px 値（900px 等）を新規定義しない。

```scss
$breakpoints: (
  sp: "screen and (max-width: 768px)",
  pc: "screen and (min-width: 769px)",
  smpc: "screen and (max-width: 1440px) and (min-width: 769px)",
  xlpc: "screen and (min-width: 1441px)",
);
```

```scss
// ✅ 正しい
.element {
  font-size: rem(14);
  @include mq(pc) {
    font-size: rem(16);
  }
}

// ❌ 避ける
@media screen and (min-width: 900px) { ... }
```

HTML の `<picture>` 切り替え、CSS の mq、JavaScript の画面判定で別々のブレークポイントを使わない。

### 変数

色・フォントは global/_valiables.scss にまとめる。カラーコード・フォント名の直書き禁止。増える場合はまず _valiables.scss（または :root）に追加してから使う。

### グローバル関数一覧

| 関数 | 用途 | 例 |
|---|---|---|
| rem($px) | px → rem（基準 10px） | rem(24) |
| em($px, $fontSize) | 相対 em 変換 | em(8, 16) |
| px-to-vw($px, $base-vw) | px → vw 変換 | px-to-vw(100, 1920) |
| lts-em($ls, $fs) | letter-spacing を em 換算 | lts-em(1.6, 16) |

## コンポーネント・レイアウトの記述ルール

### ファイル先頭の import（必須）

```scss
@use "../../global/" as *; // common 配下
@use "../global/" as *;    // page 配下
```

### どのファイルに何を書くか

| 書く内容 | 置く場所 |
|---|---|
| ヘッダー・フッター・ドロワー | common/layout/_header.scss など |
| ボタン・CTA・共通パーツ | common/conpornent/_btn.scss など |
| トップページの各セクション | page/_top.scss または分割 |
| 変数・mixin の追加 | global/ |
| 全体の読み込み | style.scss（@forward のみ） |

### BEM 命名

| 種類 | 書き方 | 例 |
|---|---|---|
| Block | 独立コンポーネント | .header .news |
| Element | __ で区切る | .header__nav |
| Modifier | -- で区切る | .button--large |

- クラス名は英語・小文字・ハイフン区切り
- ネストは 3階層まで

```scss
// ✅ 正しい
.news {
  &__title { }
  &__list { }
  &--featured { }
}

// ❌ 避ける
.news-title { }
.top-news { }
```

### レスポンシブの書き方

- モバイルファーストで記述
- SP 上書き → @include mq(sp)
- PC 以上 → @include mq(pc) / mq(smpc) / mq(xlpc) を使い分け
- 改行位置は `<br>` 頼みにせず CSS で組む

### プロパティの書き方

- プロパティはアルファベット順
- カラーは変数を使用
- 単位は rem() 基本、px 直書き禁止
- mixin / 変数の再定義はしない

## やってはいけないこと

| NG | 理由 |
|---|---|
| style.scss に全スタイルを1ファイルで書く | 保守性低下・社内ルールと乖離 |
| px 直書き・独自ブレークポイント（900px 等） | vw リキッドが効かず中間サイズで崩れる |
| common/layout/ 等を空ファイルのまま | フォルダ構成の意味がなくなる |
| HTML / CSS / JS で BP をバラバラにする | 900〜1199px 付近で不整合 |
| カラーコード・フォント名の直書き | 変数管理できず修正コスト増 |
| 読み込み構造が @forward のみで不十分 | グローバル設定が CSS に出力されない |

## 納品前チェックリスト

- [ ] スタイルは適切なフォルダのパーシャルに分割されている
- [ ] 各ファイル先頭に `@use "../../global/" as *;` がある
- [ ] 数値指定は rem() を使っている（px 直書きなし）
- [ ] ブレークポイントは mq(sp / pc / smpc / xlpc) に統一
- [ ] 769px〜1440px で DevTools 確認済み
- [ ] 色・フォントは global/_valiables.scss の変数を使用
- [ ] BEM 命名になっている
- [ ] 新規ファイルを _index.scss に @forward 済み

---

# 本案件のコーディング仕様（Codejump 応用編 LP）

デザイン: https://code-jump.com/lp-menu/ （英会話スクールBBBのLP・CSSアニメーション）

- フォント: 游ゴシック（$yugothic 変数を使用）
- コンテンツ幅: 860px（$content-width → rem(860)）
- ハンバーガーメニュー: フェードで全画面表示
- メインビジュアル: 3枚の画像を CSS アニメーションでフェード切替（5〜7秒）。「無料体験はこちら」ボタンを画像に重ね、ホバーで少し拡大
- BBBが選ばれる理由: 「オンライン対応」左から / 「講師はネイティブ」右からスライドイン
- 受講生の声: 非表示から少しずつ大きくふわっと表示。ふきだしは CSS で作り、PC / SP で向きを切替
- スクールの概要: ドット柄背景を右上→左下へ繰り返し流す
- 「無料体験に申し込む」ボタン: ホバー時は赤枠線の白いボタン
- スクロール連動アニメーション: jQuery プラグイン inview（jquery.inview.min.js）を使用

## ⚠️ ブレークポイントの注意

デザイン側のコーディング仕様は「ブレークポイント 900px」だが、クライアントの SCSS ガイドラインでは 900px などの独自ブレークポイントは明示的に NG。
**本案件ではガイドラインの mq(sp: 〜768px / pc: 769px〜) を優先する**（要クライアント確認事項として記録）。

---

# 全体コーディングガイドライン（クライアント指定・2枚目）

出典: https://app.notion.com/p/28b3c9f712bb81359a52dbfeb6bc87fc

## 開発環境

- 言語: HTML5, CSS3, JavaScript (ES6+)
- CSS: Sass/SCSS（コンパイル後CSSも納品）
- ライブラリ: Splide.js（スライダー）、GSAP（アニメーション）、jQuery 3.6.4
- 画像形式: WebP（優先）、PNG（フォールバック）
- フォント: Google Fonts（**CDN ではなくダウンロードして self-host する**）

## 納品ディレクトリ構造

```
/
├── index.html
└── assets/
    ├── css/       # コンパイル済みCSS（style.css / style.min.css / fv.css / fv.min.css）
    ├── scss/      # SCSSソース一式も納品に含める
    ├── js/        # fv.js（FV用・単体）/ other.js（その他）
    └── images/    # common/（共通アイコン）, pc/（PC用）, sp/（スマホ用）
```

## 命名規則

- ファイル名: すべて kebab-case（SCSS はアンダースコアプレフィックス）。画像例: `fv-img01.webp`, `about-visual.webp`
- 変数・関数: camelCase / 定数: UPPER_SNAKE_CASE
- CSSクラス: BEM記法

## HTML規約（必須）

- HTML5 セマンティックタグ（main / section / article 等）
- アクセシビリティ属性（alt, aria-*, role 等）を適切に設定。装飾用 `<br>` には `aria-hidden="true"`
- BEM記法によるクラス命名
- 画像には `loading="lazy"`、`decoding="async"` を設定
- インデントは2スペース
- 自己完結型タグは `/>` で閉じる

## JavaScript規約（必須）

- **jQuery は極力使用しない**形で実装
- Splide.js・GSAP 等を適切に使用
- 適切なエラーハンドリング。コンソールエラーを残さない
- コメントは日本語で記述
- インデントは2スペース

## パフォーマンス要件

- WebP 優先・PC/SP 別画像の提供
- 画像の遅延読み込み（loading="lazy"）
- Google Fonts の preload 設定（self-host）

## 納品物

1. ソースコード: index.html / assets/scss 全ファイル / コンパイル済み assets/css / assets/js / assets/images
2. ドキュメント: README.md（セットアップ・SCSSコンパイル手順）、デプロイ手順書、画像仕様書（PC/SP別サイズ・形式）
3. 動作確認: 各ブラウザ（Chrome / Firefox / Safari / Edge）・レスポンシブ・アニメーション

## 注意事項（原文）

- 指示書にない技術判断が必要な場合は事前に相談
- 仕様変更・追加要件は必ず承認を得てから実装
- セキュリティに関わる実装は特に注意

## ⚠️ 2つのガイドライン間の食い違い（要クライアント確認）

| 項目 | SCSSガイドライン（詳細版） | 全体ガイドライン | 本案件の採用 |
|---|---|---|---|
| 変数ファイル名 | `_valiables.scss` | `_variables.scss` | `_valiables.scss`（詳細版に従う） |
| `_font.scss` の場所 | `common/foundation/` | `global/` | `common/foundation/` |
| `foundation/` フォルダ | あり（_reset/_common/_font） | なし（common直下） | あり |
| FV用フォルダ | `fv-style/` | `fv/` | `fv-style/` |
| メディアクエリ | `@include mq()` 必須 | 例は `@media` 直書き | `mq()` 必須 |
| jQuery | 言及なし | ライブラリに含むが極力不使用 | 極力不使用（inview は IntersectionObserver か GSAP ScrollTrigger で代替） |

方針: **SCSS の構造・書き方は詳細版（SCSSガイドライン）を優先**し、納品物・HTML/JS規約・画像/フォント運用は全体ガイドラインに従う。
