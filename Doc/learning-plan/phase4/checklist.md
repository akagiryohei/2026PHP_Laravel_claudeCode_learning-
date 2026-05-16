# Phase 4: 応用 — 検索・フィルター・認可

## 目標

実務レベルの機能を追加し、セキュリティと保守性を意識した実装を学ぶ。

## 実装する機能

- [ ] タスク検索
- [ ] カテゴリ・ステータス・優先度でのフィルター
- [ ] タスクの共有（他ユーザーへの公開）
- [ ] 認可（自分のタスクのみ編集・削除可能）

## 実装チェックリスト

- [ ] 検索フォーム追加（`tasks/index.blade.php`）
- [ ] `TaskController@index` に `when()` を使った動的クエリ実装
- [ ] フィルター（カテゴリ・ステータス・優先度）実装
- [ ] `TaskPolicy` 作成（`php artisan make:policy TaskPolicy --model=Task`）
- [ ] `TaskController` の認可を `abort_if` から `authorize()` に置き換え

## ステータス

未着手（Phase 3完了後に着手）
