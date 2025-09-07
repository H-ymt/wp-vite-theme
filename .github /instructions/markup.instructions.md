---
applyTo: "**"
---

## Web 制作向けコーディング規約

このプロジェクトでは、以下のコーディング規約を厳守してください。

対象: HTML, CSS, JavaScript, TypeScript

### 1. HTML

#### 基本構造

- DOCTYPE 宣言は必須（`<!DOCTYPE html>`）
- `<html>` タグには言語属性を設定（`lang="ja"`）
- `<meta charset="UTF-8">` と `<meta name="viewport">` は必須
- セマンティックなタグ（header, nav, main, section, article, aside, footer など）を適切に使用
- インデントはスペース 2 つ、ネスト構造を明確に

#### 命名規則

- クラス名・ID 名は BEM 記法（block\_\_element--modifier）を推奨
- 単語間はハイフン（-）で区切る（kebab-case）
  `html
    <div class="news-card">  <h2 class="news-card__main-title">タイトル</h2>  <p class="news-card__description-text news-card__description-text--large">テキスト</p>  <button class="news-card__action-button news-card__action-button--primary">ボタン</button></div>
    `
- ID 名も `kebab-case` で統一

#### アクセシビリティ

- 画像には適切な `alt` 属性を設定
- フォーム要素には `label` を関連付け
- ARIA 属性を適切に使用（`aria-label`, `aria-describedby` 等）
- コントラスト比は WCAG 2.1 AA 基準を満たす
- キーボードナビゲーションを考慮

#### その他

- 不要な `div` や `span` の多用は避ける
- インライン要素内にブロック要素を配置しない
- 属性値は必ずダブルクォートで囲む

### 2. CSS

#### 基本記法

- インデントはスペース 2 つ
- プロパティ値の後にセミコロンを必ず記述
- 1 つのセレクタは 1 行で記述、複数セレクタは改行で区切る
- プロパティは論理的順序（またはアルファベット順）で整理

#### BEM 記法

```css
/* Block */
.news-card {
  background: #fff;
  border-radius: 8px;
}

/* Element */
.news-card__main-title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

/* Modifier */
.news-card--featured {
  border: 2px solid #007bff;
}

.news-card__action-button--primary {
  background: #007bff;
  color: #fff;
}
```

#### カスタムプロパティ（CSS 変数）

```css
/* CSS変数で色やサイズを管理 */
:root {
  --primary-color: #007bff;
  --secondary-color: #6c757d;
  --font-size-base: 1rem;
  --font-size-large: 1.25rem;
  --spacing-unit: 1rem;
  --border-radius: 0.375rem;
}

/* 使用例 */
.button {
  background-color: var(--primary-color);
  font-size: var(--font-size-base);
  padding: calc(var(--spacing-unit) * 0.5) var(--spacing-unit);
  border-radius: var(--border-radius);
}
```

#### 禁止事項

- `!important` の使用は原則禁止（やむを得ない場合は理由をコメントで明記）
- ID セレクタでのスタイリングは避ける
- インラインスタイルは使用しない

### 3. JavaScript / TypeScript

#### 基本記法

- インデントはスペース 2 つ
- 文末にセミコロンを必ず記述
- 文字列はシングルクォートを推奨（テンプレートリテラルはバッククォート）
- 変数名・関数名はキャメルケース（`camelCase`）
- 定数名はスクリームスネークケース（`SCREAMING_SNAKE_CASE`）

#### ES6+ 記法の活用

```javascript
// アロー関数
const handleClick = (event) => {
  event.preventDefault();
  // 処理
};

// テンプレートリテラル
const message = `こんにちは、${userName}さん`;

// 分割代入
const { width, height } = element.getBoundingClientRect();

// デフォルトパラメータ
const createCard = (title = "タイトルなし", content = "") => {
  // 処理
};
```

#### DOM 操作

- `document.querySelector`、`document.querySelectorAll` を使用
- `addEventListener` でイベントリスナーを登録
- DOMContentLoaded イベントを活用

```javascript
document.addEventListener("DOMContentLoaded", () => {
  const button = document.querySelector(".js-submit-button");
  button?.addEventListener("click", handleClick);
});
```

#### 非同期処理

- `async/await` を推奨（Promise チェーンより可読性が高い）

```javascript
const fetchData = async (url) => {
  try {
    const response = await fetch(url);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("データ取得エラー:", error);
    throw error;
  }
};
```

#### 禁止・非推奨事項

- jQuery は使用しない
- `var` は使用しない（`const`、`let` を使用）
- `eval()` は使用しない
- グローバル変数の濫用は避ける
- `document.write()` は使用しない

#### モジュール化

```javascript
// 即時関数またはモジュールパターンでスコープを限定
(() => {
  "use strict";

  const CONSTANTS = {
    ANIMATION_DURATION: 300,
    API_BASE_URL: "/api",
  };

  const Utils = {
    debounce: (func, wait) => {
      // 処理
    },
  };

  // メイン処理
})();
```

### 4. ファイル構成・命名規則

#### ディレクトリ構造例

```
project/
├── assets/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── fonts/
├── src/
│   ├── css/
│   └── ts/
├── components/
├── pages/
└── dist/ (ビルド後)
```

#### ファイル命名

- ファイル名は `kebab-case` を推奨
- CSS ファイル: `main-style.css`, `component-list.css`
- JS ファイル: `main-script.js`, `form-utils.js`

##### 画像ファイル命名規則

**基本ルール**

- 小文字のみ使用: `icon-arrow.svg`
- ハイフン区切り: `bg-pattern-main.webp`
- 連番の場合: `img-gallery-01.webp`, `img-gallery-02.webp`
- レスポンシブ用: `banner-hero-desktop.webp`, `banner-hero-mobile.webp`

**必須接頭辞ルール** ファイル名は必ず以下の接頭辞のいずれかで始める：

- `icon-`: アイコン画像
- `bg-`: 背景画像
- `img-`: 一般的な画像
- `figure-`: 図版・説明画像
- `banner-`: バナー・ヒーロー画像
- `text-`: テキスト画像・ロゴタイプ
- `logo-`: ロゴ画像

**例:**

```
icon-menu.svg          - メニューアイコン
bg-pattern.webp        - パターン背景
img-product.webp       - 商品画像
figure-diagram.webp    - 図解画像
banner-hero.webp       - ヒーロー画像
text-heading.webp      - テキスト画像
logo-company.svg       - 会社ロゴ
```

### 5. パフォーマンス・SEO

#### HTML

- 画像の `loading="lazy"` を適切に使用
- 重要な CSS は `<head>` 内に、JS は `</body>` 直前に配置
- メタタグ（description, keywords, og:image 等）を適切に設定

#### CSS

- 不要な CSS を削除、ファイルサイズを最適化
- Critical CSS をインライン化検討
- ベンダープレフィックスは自動付与ツール使用

#### JavaScript

- 不要なライブラリやコードは削除
- イベントリスナーの適切な削除
- 画像の遅延読み込み実装

---

### Copilot への指示

上記のコーディング規約を**厳密に遵守**して HTML、CSS、JavaScript のコードを生成してください。

#### 特に重要な点：

1. **BEM 記法**を必ず使用
2. **インデント**はスペース 2 つで統一
3. **アクセシビリティ**を常に考慮
4. **jQuery 禁止**、バニラ JS を使用
5. **レスポンシブ対応**を前提とした実装
6. **パフォーマンス**を意識したコード
7. **適切なコメント**を日本語で記述
8. **ES6+ 記法**を積極的に活用

#### コード生成時の確認項目：

- [ ] セマンティックな HTML になっているか
- [ ] BEM 記法が正しく使用されているか
- [ ] アクセシビリティ要件を満たしているか
- [ ] レスポンシブ対応されているか
- [ ] 不要なコードが含まれていないか
- [ ] 適切なコメントが記述されているか
- [ ] パフォーマンスに配慮されているか

**コードレビュー時には、この規約への準拠を厳格にチェックします。**
