# WordPress 開発のスターターテンプレート

## 使用技術

- [Vite](https://ja.vitejs.dev/)
- SCSS
- ECMAScript2018(ES9)
- [Local](https://localwp.com/)

## 環境

Node のバージョンは 16.0.0 以上が必要です。

## 依存関係のインストール

`npm install`コマンドを実行する。

## 環境構築手順

### Local のプロジェクト作成〜開発サーバー起動

1. [Local](https://localwp.com/)でプロジェクトを作成し、サーバーを立ち上げます。(Local の使用方法は[こちら](https://komaricote.com/wordpress/wp-local-environment/))
2. 作成したプロジェクトの`/wp-content/themes/`配下に本ファイル一式をコピーします。（WordPress 側のテーマアップロードでも可能。）
3. `npm run dev`コマンドを実行します。

### ディレクトリ構造

フォーマッターは Prettier を導入済み。
ESLint や Stylelint などの Linter、画像圧縮のプラグイン等は入っていないので必要に応じて適宜インストールする。

```
project-name
├── README.md
├── assets
│   ├── images
│   ├── scripts
│   └── styles
├── footer.php
├── functions.php
├── header.php
├── index.php
├── main.js
├── main.scss
├── package-lock.json
├── package.json
├── postcss.config.js
├── screenshot.png
├── style.css
└── vite.config.js
```

### SCSS の利用

CSS ファイルでパスを指定するときは次の様に変数を用いる必要があります。
`$base-dir`は`vite.config.js`内で定義しています。

例：

```
background: url( $base-dir + 'assets/images/dummy.jpg' );
```

開発時のパス
`$base-dir: '/'`

本番環境のパス
`$base-dir: '/dist/'`

## 設定

### 開発モードの変更

functions.php にて以下のように設定します。

- 開発モードオン：`define( "IS_VITE_DEVELOPMENT", true );`
- 開発モードオフ：`define( "IS_VITE_DEVELOPMENT", false );`

開発モードでは、`main.js`が SCSS ファイルを読み込みます。

開発モードがオフの場合、dist ディレクトリ内の main.css が読み込まれます。SCSS ファイルは使用されません。

## ビルド（サーバーへデプロイするコードを生成）

`npm run build`

- `npm run build`コマンドを実行します。
- `dist/`のファイルをサーバーへデプロイします。
