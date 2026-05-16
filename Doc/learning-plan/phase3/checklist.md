# Phase 3: リレーション — カテゴリ・期限・優先度

## 目標

テーブル間のリレーションを理解し、カテゴリ・期限・優先度機能を追加する。

## 実装する機能

- [ ] カテゴリの追加・管理
- [ ] タスクへのカテゴリ紐付け
- [ ] 期限日の設定
- [ ] 優先度（高/中/低）の設定

## 実装チェックリスト

- [ ] `categories` テーブルのマイグレーション作成
- [ ] `Category` モデル作成（`app/Models/Category.php`）
- [ ] `tasks` テーブルに `category_id` / `due_date` / `priority` を追加するマイグレーション作成
- [ ] マイグレーション実行（`php artisan migrate`）
- [ ] `Category` モデルに `hasMany(Task::class)` を定義
- [ ] `Task` モデルに `belongsTo(Category::class)` を定義・`$fillable` 更新
- [ ] `CategoryController` 作成（index / create / store / edit / update / destroy）
- [ ] カテゴリ一覧・作成・編集ビュー作成
- [ ] `TaskController` を更新（`with('category')` / カテゴリ選択・期限・優先度を store / update に追加）
- [ ] タスク作成・編集フォームにカテゴリ選択・期限・優先度フィールドを追加
- [ ] タスク一覧にカテゴリ・期限・優先度を表示

## ステータス

未着手（2026-05-15 着手開始）
