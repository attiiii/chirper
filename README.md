# 概要

本リポジトリは、Laravelの公式チュートリアル [Laravel Bootcamp](https://bootcamp.laravel.com/) に記載のSNSアプリを Inertia.js と Vue.js を用いて実装したソースコードです。

# Chirper

チュートリアルに含まれていない追加機能は下記の通りです。
* GitHub ActionsによるCI/CD
* ESLintの導入
* 機能テストの導入
* ユーザ登録時のメール認証機能
* s3への画像投稿・削除機能

# ローカル環境の起動方法

起動方法は下記コマンドを実行ください。

```
composer install

./vendor/bin/sail up -d

./vendor/bin/sail php artisan migrate

./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
