# レクサスRX専門高価買取JP LP

ランクル300専門高価買取JP（http://lancru300kaitori.jp/）の姉妹LP。同一クライアント（カーショップグローリー／株式会社ライジングサン）による、レクサスRX買取の問い合わせ獲得用ランディングページ。

## 構成
- `index.html` … 全セクション（Hero / Strong / Models / Trust / Reasons / Flow / Docs / Q&A / Contact+査定フォーム / Company）
- `style.css` … デザイン（ゴールド × ブラック 高級路線・モバイルファースト）
- `send.php` … 査定フォーム送信ハンドラ（→ carshopglory.yasuda@gmail.com）

## デザイン
漆黒（#0a0a0a）地にシャンパンゴールド（#c8a253）の差し色。見出しは明朝/セリフ（Noto Serif JP / Cinzel）で高級感を演出。全カラーはCSS変数で定義。

## 連絡先（ランクル300と共通）
- 電話: 0586-47-6055（10:00-18:00 / 火曜定休）
- LINE: https://line.me/R/ti/p/@083vtrdk

## 買取対応グレード
RX500h F SPORT Performance / RX450h+ / RX350h / RX350 F SPORT / RX350

## デプロイ
1. GitHub `jplabdiamond-jpg/lexus-rx` の main に push
2.（本番）独自ドメイン取得後、さくらインターネットへ `index.html` `style.css` `send.php` をFTPアップロード
   - CSSも必ず一緒にアップロード（古いCSSだと崩れる）
   - アップロード後はスーパーリロード（Cmd+Shift+R / Ctrl+F5、スマホはキャッシュ削除orシークレット）で確認

## 後日差し替え
- ヒーロー背景画像（`.hero-bg-main` / `.hero-bg-overlay`）… クライアント支給予定
- `trust_badge.webp`（帝国データバンク61点バッジ）… ランクル300と共通素材を配置
- 信頼動画 … ランクル300と共通（YouTube `uTLRsRbg6FQ`）
