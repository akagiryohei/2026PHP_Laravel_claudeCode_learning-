# Phase 1: Laravel基礎 — ルーティング・MVC・認証

## 目標

Laravelプロジェクトの基本構造を理解し、タスク一覧・作成機能を持つ最小構成のアプリを作る。

## 実装する機能

- [ ] ユーザー登録・ログイン（Laravel Breeze）
- [ ] タスク一覧表示
- [ ] タスク新規作成

## 学習ポイント

### ルーティング
- `routes/web.php` の書き方
- `Route::get()`, `Route::post()` など基本メソッド
- 名前付きルート（`->name()`）

### コントローラー
- コントローラーの作成（`php artisan make:controller`）
- アクションメソッドの書き方
- ビューへのデータ渡し（`return view('xxx', compact('data'))`）

### マイグレーション
- マイグレーションファイルの作成（`php artisan make:migration`）
- `up()` / `down()` メソッド
- `php artisan migrate` の実行

### Bladeテンプレート
- `{{ $variable }}` での変数展開
- `@foreach`, `@if` などのディレクティブ
- レイアウトの継承（`@extends`, `@section`）

### モデル
- Eloquentモデルの作成（`php artisan make:model`）
- `$fillable` プロパティ
- 基本的なクエリ（`Model::all()`, `Model::create()`）

## 環境構築手順

- [x] Laravelプロジェクト新規作成（`/home/ubuntu/projects/my-app/task-app/`）
- [x] `.env` 設定（DB接続・パスワード設定済み）
- [x] DBマイグレーション実行
- [x] Laravel Breeze インストール（blade）

## 実装チェックリスト

- [x] Taskモデル作成（`app/Models/Task.php`）
- [x] tasksテーブルのマイグレーション作成（`database/migrations/2026_05_11_123245_create_tasks_table.php`）
  - カラム: `id`, `user_id`（外部キー）, `title`, `is_completed`, `timestamps`
- [ ] マイグレーション実行（`php artisan migrate`）← **次回ここから**
- [ ] Taskモデルに`$fillable`を設定
- [ ] TaskControllerを作成
- [ ] ルーティングを追加（`routes/web.php`）
- [ ] タスク一覧ビュー作成
- [ ] タスク作成フォーム作成

## 次回の作業開始手順

```bash
# 開発サーバー起動（別ターミナルで）
cd /home/ubuntu/projects/my-app/task-app && php artisan serve

# マイグレーション実行
cd /home/ubuntu/projects/my-app/task-app && php artisan migrate
```

## ステータス

進行中（2026-05-11）
