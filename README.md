# 伴走サポート HTML WP template

node version：18._._
npm version：10.8.2
gulp version：4.0.2

## How to use

`npm install`
`npx gulp` or `gulp`

### 静的サイトと WordPress サイトに対応

`--wp`のオプションを指定することで WordPress サイトとしてのビルド実施。  
静的サイトを開発する場合：`npx gulp`  
WordPress サイトを開発する場合：`npx gulp --wp`  
※ただし WordPress の場合は gulpfile からテーマ名、出力するパスを確認のこと


## 開発前準備
### 静的サイトの開発前準備
- gulpfile.js設定
  81-82行目：EJSを使用するかHTMLを使用するかを決定する（ `isMarkupEjs` がtrueの場合はEJS、 falseの場合はHTMLとなる）

### WordPressサイトの開発前準備
- gulpfile.jsの設定
  106行目：出力するテーマフォルダ名を設定
  107行目：ブラウザで表示する時のURLドメインを設定
- src/php/style.css
  4-8行目：テーマ名その他説明、バージョン、作成者など必要に応じて設定
- src/php/init/setting.php
  43行目：テーマ特有の識別子に設定

#### 自動デプロイ機能を使う場合の追加設定
gulpfile.jsのテーマディレクトリ名（106行目）を変更した場合は、以下のGitHub Actionsファイル内の `theme_dir` も同じ名前に変更してください：
- `.github/workflows/build-wp.yml.sample`
- `.github/workflows/deploy-wp-staging.yml.sample`  
- `.github/workflows/deploy-wp.yml.sample`

例：gulpfile.jsで `const themesDir = "my-theme";` とした場合、各ワークフローファイル内の `theme_dir` を `my-theme` に変更

## 自動デプロイ機能について

このテンプレートには、コードを自動でサーバーにアップロード（デプロイ）する機能が付いています。  
この機能を使うと、コードをGitHubにプッシュするだけで、自動的にサーバーにファイルがアップロードされます。

### 自動デプロイ機能を使うには

`.github/workflows/` フォルダの中に、自動デプロイ用の設定ファイルが入っています。  
これらのファイルには最初 `.sample` という文字が付いているので、使いたいものから `.sample` を削除してください。

**やり方：**
1. `.github/workflows/` フォルダを開く
2. 使いたいファイルを見つける
3. ファイル名の最後にある `.sample` を削除する

例：`build.yml.sample` → `build.yml` に変更

### どんな自動デプロイが使えるか

#### 静的サイト（HTML/CSS/JSのみ）の場合
- `build.yml.sample` - コードをビルド（圧縮・最適化）する
- `deploy-staging.yml.sample` - テスト用サーバーにアップロード
- `deploy.yml.sample` - 本番用サーバーにアップロード

#### WordPress用の場合
- `build-wp.yml.sample` - WordPressテーマをビルドする
- `deploy-wp-staging.yml.sample` - テスト用WordPressサーバーにアップロード
- `deploy-wp.yml.sample` - 本番用WordPressサーバーにアップロード

### サーバー情報の設定が必要

自動デプロイを使うには、GitHubにサーバーの接続情報を登録する必要があります。

**設定手順：**
1. GitHubのリポジトリページを開く
2. 「Settings」タブをクリック
3. 左メニューから「Secrets and variables」→「Actions」をクリック
4. 「New repository secret」ボタンから以下の情報を登録

#### テスト用サーバーの情報
- `STAGING_FTP_SERVER` - テスト用サーバーのアドレス
- `STAGING_FTP_USERNAME` - テスト用サーバーのユーザー名
- `STAGING_FTP_PASSWORD` - テスト用サーバーのパスワード
- `STAGING_FTP_SERVER_DIR` - サーバー内のアップロード先フォルダ
- `STAGING_WP_THEME_DIR` - WordPressテーマのフォルダ（WordPress用のみ）

#### 本番用サーバーの情報
- `PRODUCTION_FTP_SERVER` - 本番用サーバーのアドレス
- `PRODUCTION_FTP_USERNAME` - 本番用サーバーのユーザー名
- `PRODUCTION_FTP_PASSWORD` - 本番用サーバーのパスワード
- `PRODUCTION_FTP_SERVER_DIR` - サーバー内のアップロード先フォルダ
- `PRODUCTION_WP_THEME_DIR` - WordPressテーマのフォルダ（WordPress用のみ）

#### ⚠️ FTPパスの設定について（重要）

レンタルサーバーによって、FTPクライアントで表示されるパスと実際のFTPサーバー上のパスが異なることがあります。

**主要レンタルサーバーでの設定例：**

```
【XSERVER】
FTPクライアント表示: /home/username/example.com/public_html/
実際の設定値: /example.com/public_html/

【ロリポップ！】
FTPクライアント表示: /web/lolipop.jp-dp12345678/
実際の設定値: /

【さくらのレンタルサーバ】
FTPクライアント表示: /home/username/www/
実際の設定値: /www/

【ConoHa WING】
FTPクライアント表示: /home/username/public_html/example.com/
実際の設定値: /public_html/example.com/

【mixhost】
FTPクライアント表示: /home/username/public_html/
実際の設定値: /public_html/
```

**WordPressテーマディレクトリの設定：**
WordPressの場合、`STAGING_WP_THEME_DIR`と`PRODUCTION_WP_THEME_DIR`には、テーマ名まで含めたフルパスを指定してください。

```
例：/public_html/wp-content/themes/your-theme-name
```

**確認方法：**
1. 最初はFTPクライアントで表示されるパスをそのまま設定
2. GitHub Actionsでテストデプロイを実行
3. ファイルが正しい場所に配置されない場合は、ホームディレクトリ部分（`/home/username/`など）を省略して再試行

### 自動デプロイの仕組み
- **developブランチ**にコードをプッシュ → テスト用サーバーに自動アップロード
- **mainブランチ**にコードをプッシュ → 本番用サーバーに自動アップロード

つまり、開発中はdevelopブランチで作業し、完成したらmainブランチにマージすることで、自動的に本番サイトに反映されます。

## 解説

src フォルダで開発を進める。  
静的サイトの場合、生成物は dist フォルダに生成される。（dist フォルダがなければ作成される）  
dist フォルダは直接編集しても上書きされる。  
また、gulp を走らせた時に最初に削除される

### WP サイトの場合

local での開発を前提とする。  
local で作成されたフォルダ直下、app, conf, logs などのフォルダと同階層にこのフォルダを設置する。  
以下の図の「開発用フォルダ」をこのフォルダとする

```
localにより生成したフォルダ
  ┗ app ━━━━━━━━━━ public ━ wp-content ━ themes ━ 出力先テーマフォルダ
  ┃              ┗ sql
  ┗ conf ━━━━━━━━━ ...
  ┗ logs ━━━━━━━━━ ...
  ┗ 開発用フォルダ ━ src ━ ..
                 ┗ gulpfile
                 ┗ ...
```

### HTML テンプレートエンジン

HTML のテンプレートエンジンは ejs を使用する。  
ただし素の HTML も使用可能。（gulpfile にて isMarkupEjs の値を変更する）

### css

css は scss の記法で src>sass フォルダ内で記述。

### Javascript

src/js フォルダ直下にある js ファイルはビルド後は結合されて一つの js ファイルになる

### image

画像ファイルは圧縮する。  
同時に webp への変換、svg sprite の変換も行う。  
svg sprite に変換する場合は src/img/sprite フォルダに入れる

### copy フォルダ

copy フォルダはそのまま dist や WordPress の場合はテーマフォルダに出力する  
何も処理しないが、サイト用のデータとしては必要なものを入れておく  
例）PDF, 動画、ライブラリの JS や CSS、既存サイトデータなど

### PHP

WordPress サイトの場合、php フォルダを編集する。  
基本的には PHP ファイルはそのまま出力先（テーマフォルダ）にコピーする。  
ただし、先頭に \_（アンダースコア）がついたファイルは出力しない。  
Contact form 7 の管理画面に貼り付けるコードなどをストックするのに使用するといい

### Change log

v1.9.0
- remがsafari, firefoxで効かなかった不具合修正

v1.8.0
- GitHub Actions CI/CD パイプライン実装
  - ビルドワークフローの追加（静的サイト・WordPress両対応）
  - ステージング環境・本番環境への自動デプロイ機能
  - ワークフローファイルに`.sample`サフィックス追加で利便性向上
- EJSテンプレートファイルの改良
  - `_head.ejs`のmeta設定最適化
  - `_footer.ejs`の構造改善
  - `index.ejs`のヘッダー構造調整
- WordPressテーマファイルの機能強化
  - 404エラーページのテンプレート改良
  - テーマ設定ファイル（setting.php）の改善
- CSS/SCSS改善とコード品質向上
  - CSSボタンコンポーネントのtransition-property修正
  - OGP画像URLの修正とClaude設定の更新
  - WordPressパス設定の改善
  - SCSS変数と依存関係の整理
  - **rootフォントサイズを16pxから100%へ変更**
  - **WordPressのnoindexの `"` の修正（全角→半角）**
- アクセシビリティ向上
  - 視覚的に隠すユーティリティクラス（`.u-visually-hidden`）の最適化 ※要注意
- READMEドキュメント改善
  - 自動デプロイ機能の説明を初心者向けに詳細化
  - FTPパス設定の注意事項・レンタルサーバー別設定例を追加
  - WordPressワークフロー使用時のテーマディレクトリ設定説明追加

v1.7.0
Contact Form 7のカスタマイズファイル（cf7_custom.php）を更新
- 動的フィールド機能の説明コメントを追加
- 動的フィールド機能を一時的に無効化（wpcf7_form_tagフィルターをコメントアウト）
- オートコンプリート無効化機能にコメントを追加し、機能の説明を明確化
html要素に `scrollbar-gutter: stable;` を追加。ドロワー開いてメインコンテンツ固定時のガタつき対策
カスタムメニュー、ウィジェットを有効化するコードを追加

v1.6.0
EJSのヘッダーを追加

v1.5.0
スムーススクロール処理の共通化

v1.4.0
\_u-overflowHidden.scss を追加
\_u-hidden.scss を追加
index.html から keyword メタタグを削除

v1.3.0
sort-css-media-queries のバージョンが 2.4.1 以上でエラーになるため 2.4.0 で固定化
スムーススクロール処理を修正（common.js）
投稿詳細ページ、ページネーションのデフォルトスタイルを追加（\_p-article.scss, \_p-pagination.scss）

v1.2.0
swiper の js は読み込まずに css のみ読み込んでいたため css の読み込みを削除（index.html）
gsap, ScrollTrigger の読み込みを追加（index.html）
問い合わせフォーム入力欄がないページでエラーが出ていた件の修正（cf7_addConfirm.js）
ブラウザバックで白飛びする問題の修正（common.js）
画面遷移時の JS のイベントを簡易化（common.js）
functions.php からの読み込みファイル諸々調整
ページ全体のフェードインは body タグに fadeIn クラスが付与されている場合に限定(\_base.scss)
その他微調整

v1.0.0
