# Phase 1: Laravel基礎 — ルーティング・MVC・認証

## 目標

Laravelプロジェクトの基本構造を理解し、タスク一覧・作成機能を持つ最小構成のアプリを作る。

## 実装する機能

- [x] ユーザー登録・ログイン（Laravel Breeze）
- [x] タスク一覧表示
- [x] タスク新規作成

## 環境構築手順

- [x] Laravelプロジェクト新規作成（`/home/ubuntu/projects/my-app/task-app/`）
- [x] `.env` 設定（DB接続・パスワード設定済み）
- [x] DBマイグレーション実行
- [x] Laravel Breeze インストール（blade）

## 実装チェックリスト

- [x] Taskモデル作成（`app/Models/Task.php`）
- [x] tasksテーブルのマイグレーション作成（`database/migrations/2026_05_11_123245_create_tasks_table.php`）
  - カラム: `id`, `user_id`（外部キー）, `title`, `is_completed`, `timestamps`
- [x] マイグレーション実行（`php artisan migrate`）
- [x] Taskモデルに`$fillable`を設定
- [x] TaskControllerを作成（index / create / store）
- [x] ルーティングを追加（`routes/web.php`）
- [x] タスク一覧ビュー作成（`resources/views/tasks/index.blade.php`）
- [x] タスク作成フォーム作成（`resources/views/tasks/create.blade.php`）

## ステータス

完了（2026-05-11）
