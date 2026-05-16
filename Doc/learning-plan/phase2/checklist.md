# Phase 2: CRUD完成 — 編集・削除・ステータス管理

## 目標

タスクの編集・削除・完了切り替えを実装し、フルCRUDを完成させる。

## 実装する機能

- [x] タスク編集
- [x] タスク削除
- [x] 完了/未完了の切り替え

## 実装チェックリスト

- [x] `TaskController` に `edit` / `update` / `destroy` / `toggle` を追加
- [x] ルートを `Route::resource()` に整理 + `tasks.toggle` 追加
- [x] `resources/views/tasks/edit.blade.php` 作成
- [x] `resources/views/tasks/index.blade.php` に編集・削除・完了ボタンを追加
- [x] フラッシュメッセージ（`with('success', ...)`）実装

## ステータス

完了（2026-05-14）
