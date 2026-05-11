# Phase 2: CRUD完成 — 編集・削除・ステータス管理

## 目標

タスクの編集・削除・完了切り替えを実装し、フルCRUDを完成させる。

## 実装する機能

- [ ] タスク編集
- [ ] タスク削除
- [ ] 完了/未完了の切り替え

## 学習ポイント

### Eloquent ORM
- `Model::find()`, `Model::findOrFail()`
- `$model->update()`, `$model->delete()`
- マスアサインメント保護と `$fillable`

### フォームバリデーション
- `$request->validate()` の使い方
- バリデーションルール（`required`, `max`, `date` など）
- エラーメッセージの表示（`@error` ディレクティブ）

### ルーティング（応用）
- RESTfulルート（`Route::resource()`）
- フォームメソッドスプーフィング（`@method('PUT')`, `@method('DELETE')`）

### リダイレクト
- `redirect()->route()`
- フラッシュメッセージ（`with('success', '...')`）

## ステータス

未着手（Phase 1完了後に着手）
