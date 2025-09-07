**目次**

- [使用技術](#使用技術)
- [環境構築手順](#環境構築手順)
  - [ログイン情報](#ログイン情報)
  - [依存関係のインストール](#依存関係のインストール)
  - [Local のプロジェクト作成〜開発サーバー起動](#local-のプロジェクト作成開発サーバー起動)
  - [開発ワークフロー](#開発ワークフロー)
    - [通常の開発手順](#通常の開発手順)
    - [本番デプロイ手順](#本番デプロイ手順)
- [ディレクトリ構造](#ディレクトリ構造)
- [CSS について](#css-について)
  - [読み込み方式](#読み込み方式)
    - [1. 共通 CSS](#1-共通-css)
    - [2. ページ固有 CSS](#2-ページ固有-css)
  - [環境による読み込みパス](#環境による読み込みパス)
  - [CSS でのパス指定](#css-でのパス指定)
- [開発・本番環境の切り替え](#開発本番環境の切り替え)
- [トラブルシューティング](#トラブルシューティング)
  - [よくある問題](#よくある問題)
    - [CSS が反映されない](#css-が反映されない)
    - [Vite サーバーに接続できない](#vite-サーバーに接続できない)
    - [ページ固有 CSS が読み込まれない](#ページ固有-css-が読み込まれない)

## 使用技術

- [Vite](https://ja.vitejs.dev/)
- ECMAScript2018(ES9)
- [Local](https://localwp.com/)

## 環境構築手順

### ログイン情報

- **開発ユーザー**
  - ユーザー名: `developer`
  - パスワード: `fTK#N9`

### 依存関係のインストール

`npm install`コマンドを実行する。

> [!NOTE]  
> Node.js v22系・npm v11系 で動作を固定しています。  
> [Volta](https://volta.sh/) などのバージョン管理ツールで `volta install node@22 npm@11` を実行し、バージョンを揃えてください。

### Local のプロジェクト作成〜開発サーバー起動

1. [Local](https://localwp.com/)でプロジェクトを作成し、サーバーを立ち上げます。
2. 作成したプロジェクトの`/wp-content/themes/`配下に本ファイル一式をコピーします。（WordPress 側のテーマアップロードでも可能。）
3. `npm run dev`コマンドを実行します。

### 開発ワークフロー

#### 通常の開発手順

1. `npm run dev` で開発サーバー起動
2. [`IS_VITE_DEVELOPMENT`](functions.php) が `true` になっていることを確認
3. ファイルを編集（ホットリロードで自動反映）

#### 本番デプロイ手順

1. `npm run build` でビルド実行
2. [`IS_VITE_DEVELOPMENT`](functions.php) を `false` に変更
3. [`dist/`](dist/) フォルダをサーバーにアップロード

## ディレクトリ構造

フォーマッターは Prettier を導入済み。
ESLint や Stylelint などの Linter も設定済み。

**Git フック（lefthook）**

- コミット時：自動的に Prettier、Stylelint、ESLint が実行され、修正されたファイルは自動ステージング
- プッシュ時：コードの品質チェックを実行（修正は行わない）

```
project-name
├── assets
│   ├── css
│   │   ├── common
│   │   ├── page
│   │   └── main.css
│   ├── images
│   └── js
├── config
│   └── vite.php
├── footer.php
├── front-page.php
├── functions
│   ├── enqueue-page-specific-css.php
│   └── post-type.php
├── functions.php
├── header.php
├── index.php
├── main.js
├── package-lock.json
├── package.json
├── page-sample.php
├── page.php
├── postcss.config.js
├── screenshot.png
├── style.css
└── vite.config.js
```

## CSS について

> [!NOTE]
> CSS は CSS Layers を使用して階層化されており、`reset` → `base` → `components` の順序で適用されます。

### 読み込み方式

#### 1. 共通 CSS

[`main.css`](assets/css/main.css) が全ページで読み込まれ、以下のファイルを統合：

- [`reset.css`](assets/css/common/reset.css) - リセット CSS
- [`base.css`](assets/css/common/base.css) - 基本スタイル
- [`layout.css`](assets/css/common/layout.css) - レイアウト

#### 2. ページ固有 CSS

[`enqueue_styles`](functions/enqueue-styles.php) 関数により、ページに応じて自動的に読み込まれます：

| ページタイプ         | 読み込まれる CSS                              |
| -------------------- | --------------------------------------------- |
| フロントページ       | `front-page.css`                              |
| 固定ページ           | `page.css`                                    |
| カスタムテンプレート | テンプレート名に対応（例：`page-sample.css`） |
| 投稿詳細             | `single.css`                                  |
| アーカイブ           | `archive.css`                                 |

現在の実装では、ページ固有 CSS の読み込みはサーバー側で決定されたスラッグ（`get_page_css_slug()`）に基づいて行われます。

### 環境による読み込みパス

**開発環境** ([`IS_VITE_DEVELOPMENT`](functions.php) が `true`)：

- Vite サーバーから読み込み：`http://localhost:3000/assets/css/`

**本番環境** ([`IS_VITE_DEVELOPMENT`](functions.php) が `false`)：

- ビルド後のファイルを読み込み：`/wp-content/themes/theme-name/dist/assets/css/`（`DIST_URI` 経由、通常は `/dist/` が base）

### CSS でのパス指定

CSS ファイルでパスを指定するときは次の様に変数を用いる必要があります。
`$base-dir`は`vite.config.js`内で定義しています。

例：

```css
background: url($base-dir + "assets/images/dummy.jpg");
```

開発時のパス
`$base-dir: '/'`

本番環境のパス
`$base-dir: '/dist/'`

## 開発・本番環境の切り替え

`functions.php` の `IS_VITE_DEVELOPMENT` 定数で開発サーバーと本番ビルドを切り替えます。

- **開発モード**：`define( "IS_VITE_DEVELOPMENT", true );`
  - `main.js`が CSS ファイルを読み込み
  - Vite サーバー（`http://localhost:3000`）からアセットを配信
- **本番モード**：`define( "IS_VITE_DEVELOPMENT", false );`
  - `dist/` ディレクトリ内の `main.css` を読み込み
  - ビルド済みアセットを使用

> [!IMPORTANT]
> デプロイ前に必ず `IS_VITE_DEVELOPMENT` を `false` に設定してください。

> [!NOTE] 推奨設定
> セキュリティのため、`wp-config.php` で環境を管理することを推奨：
>
> ```php
> // 開発環境
> define("IS_VITE_DEVELOPMENT", true);
>
> // 本番環境
> define("IS_VITE_DEVELOPMENT", false);
> ```
>
> この場合、`functions.php` からこの設定を削除してください。

## トラブルシューティング

### よくある問題

#### CSS が反映されない

- [`IS_VITE_DEVELOPMENT`](functions.php) の値を確認
- 開発環境：`http://localhost:3000` が起動しているか確認
- 本番環境：`npm run build` が実行済みか確認

#### Vite サーバーに接続できない

- ポート 3000 が他のプロセスで使用されていないか確認
- [`vite.config.js`](vite.config.js) の `port` 設定と [`config/vite.php`](config/vite.php) の `VITE_SERVER` が一致しているか確認

#### ページ固有 CSS が読み込まれない

- ファイルパスが正しいか確認：[`assets/css/page/`](assets/css/page/) 配下
- [`enqueue_page_specific_css`](functions/enqueue-page-specific-css.php) 関数が正しく動作しているか確認
