# お問い合わせフォームプロジェクト

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300">
  </a>
</p>

---

## プロジェクト概要

このプロジェクトは Laravel 10 を使用したお問い合わせフォームです。  
開発・動作確認は Docker 上で行います。

---

## 開発環境セットアップ

### 1. リポジトリをクローン
```bash
git clone https://github.com/Sin-s555/kakuninntestkakunin-new.git
cd kakuninntestkakunin-new
2. Docker ビルド＆起動
bash
コードをコピーする
docker-compose up -d --build
※ MySQL は OS によって起動しない場合があります。必要に応じて docker-compose.yml を編集してください。

3. Laravel 環境構築
bash
コードをコピーする
# コンテナに入る
docker-compose exec kakunin-new-php-1 bash

# Laravel パッケージインストール
composer install

# 環境設定ファイル作成
cp .env.example .env

# アプリキー生成
php artisan key:generate

# データベースマイグレーション＆シード
php artisan migrate --seed
.env 内の DB 設定例：

env
コードをコピーする
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
補足：コンテナ内操作や DB 設定は開発環境に合わせて調整してください。

使用技術
PHP 8.0

Laravel 10.0

MySQL 8.0

Docker


ER図
[![ER図](docs/screenshot_20250818.png)](docs/screenshot_20250818.png)

URL
開発環境 (Nginx): http://localhost:8081

phpMyAdmin: http://localhost:8080