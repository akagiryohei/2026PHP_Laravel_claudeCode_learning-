# Phase 3 学習ガイド — リレーション・マイグレーション応用・クエリビルダー

## 目次

1. [Eloquentリレーション](#1-eloquentリレーション)
2. [マイグレーション応用](#2-マイグレーション応用)
3. [クエリビルダー](#3-クエリビルダー)

---

## 1. Eloquentリレーション

### 1-1. 1対多とは

「1つのカテゴリが複数のタスクを持つ」関係が **1対多（One to Many）**。

```
categories テーブル       tasks テーブル
┌────┬───────┐           ┌────┬────────────────┬─────────────┐
│ id │ name  │           │ id │ title          │ category_id │
├────┼───────┤           ├────┼────────────────┼─────────────┤
│  1 │ 仕事  │ ──┬──→    │  1 │ 会議の準備      │      1      │
│  2 │ 趣味  │   └──→    │  2 │ 資料作成        │      1      │
└────┴───────┘           │  3 │ ギター練習       │      2      │
                         └────┴────────────────┴─────────────┘
```

DBレベルでは `tasks.category_id` が `categories.id` を参照する外部キーになる。

---

### 1-2. hasMany（親側モデルに書く）

`Category` は「複数の Task を持つ」ので `hasMany` を使う。

```php
// app/Models/Category.php
class Category extends Model
{
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
        // 「tasks.category_id = categories.id」で紐づく
    }
}
```

使い方：

```php
$category = Category::find(1);
$category->tasks;            // そのカテゴリのタスク一覧（コレクション）
$category->tasks()->count(); // タスク数
```

---

### 1-3. belongsTo（子側モデルに書く）

`Task` は「1つの Category に属する」ので `belongsTo` を使う。

```php
// app/Models/Task.php
class Task extends Model
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
        // 「tasks.category_id」を使って Category を探す
    }
}
```

使い方：

```php
$task = Task::find(1);
$task->category;        // 紐づいた Category モデル
$task->category->name;  // カテゴリ名
```

**ポイント：** `hasMany` は親→子（1→多）、`belongsTo` は子→親（多→1）。セットで定義するのが基本。

---

### 1-4. Eager Loading で N+1 問題を防ぐ

**N+1 問題とは**：タスク一覧を表示する際、各タスクのカテゴリを個別に SELECT してしまう現象。

```php
// 悪い例（N+1問題が発生）
$tasks = Task::all();
foreach ($tasks as $task) {
    echo $task->category->name; // タスク1件ごとにSQLが1回走る
}
// タスクが100件 → SQL が101回（1 + 100）
```

```php
// 良い例（Eager Loading）
$tasks = Task::with('category')->get();
foreach ($tasks as $task) {
    echo $task->category->name; // SQLは最初の2回だけ
}
// SQL 2回で済む：SELECT * FROM tasks と SELECT * FROM categories WHERE id IN (...)
```

`with('category')` を付けるだけで自動的にまとめて取得してくれる。

---

## 2. マイグレーション応用

### 2-1. 外部キー制約

`foreignId()->constrained()` は外部キーカラムを作る省略記法。

```php
// 冗長な書き方
$table->unsignedBigInteger('category_id');
$table->foreign('category_id')->references('id')->on('categories');

// 省略記法（同じ意味）
$table->foreignId('category_id')->constrained();
// カラム名から自動的に「categories テーブルの id」を参照と判断する
```

NULL を許可する場合（カテゴリなしも可）：

```php
$table->foreignId('category_id')->nullable()->constrained();
```

外部キー制約があると、存在しない `category_id` は INSERT できない。
また、カテゴリを削除する際に紐づくタスクが残っているとエラーになる（整合性の保護）。

---

### 2-2. 既存テーブルへのカラム追加

`tasks` テーブルに `category_id`, `due_date`, `priority` を追加する場合、
**既存のマイグレーションは編集しない**。新しいマイグレーションファイルを作る。

```bash
php artisan make:migration add_fields_to_tasks_table --table=tasks
```

`--table=tasks` を付けると、`Schema::table()` の雛形が生成される（`Schema::create()` ではなく）。

```php
public function up(): void
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->foreignId('category_id')->nullable()->constrained()->after('user_id');
        $table->date('due_date')->nullable()->after('title');
        $table->string('priority')->default('medium')->after('due_date');
    });
}

public function down(): void
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropForeign(['category_id']); // 外部キーを先に削除
        $table->dropColumn(['category_id', 'due_date', 'priority']);
    });
}
```

**ポイント：**
- `after('カラム名')` でカラムの挿入位置を指定できる
- 外部キーを `dropColumn` する前に `dropForeign` が必要（順序を守る）
- `down()` は `php artisan migrate:rollback` で実行される「元に戻す」処理

---

### 2-3. migrate と migrate:fresh の使い分け

| コマンド | 動作 | 使う場面 |
|---------|------|---------|
| `php artisan migrate` | 未実行のマイグレーションだけ実行 | **本番・開発中の追加** |
| `php artisan migrate:fresh` | 全テーブルを削除して最初から実行 | データを捨ててよい開発初期 |
| `php artisan migrate:rollback` | 直前のマイグレーションを `down()` で戻す | ミスを取り消したいとき |

今回は既存データを保持したまま追加するので `php artisan migrate` を使う。

---

## 3. クエリビルダー

### 3-1. 基本メソッド

```php
Task::all();                                        // 全件取得
Task::where('is_completed', false)->get();          // 条件絞り込み
Task::where('priority', 'high')->get();
Task::where('is_completed', false)
    ->where('priority', 'high')->get();             // 複数条件
Task::latest()->get();                              // 新しい順（created_at DESC）
Task::orderBy('due_date', 'asc')->get();            // 期限が近い順
Task::where('is_completed', false)->count();        // 件数取得
```

---

### 3-2. リレーション込みのクエリ

```php
$tasks = auth()->user()
    ->tasks()
    ->with('category')            // カテゴリを一緒に取得（Eager Loading）
    ->where('is_completed', false)
    ->orderBy('due_date', 'asc')
    ->get();
```

---

### 3-3. ローカルスコープ

よく使うクエリ条件をモデルにメソッドとして定義できる。
メソッド名を `scope〇〇` にするのがルール。

```php
// app/Models/Task.php
public function scopeCompleted(Builder $query): Builder
{
    return $query->where('is_completed', true);
}

public function scopePending(Builder $query): Builder
{
    return $query->where('is_completed', false);
}

public function scopeHighPriority(Builder $query): Builder
{
    return $query->where('priority', 'high');
}
```

使い方（`scope` プレフィックスは省略して呼び出す）：

```php
Task::completed()->get();                                    // 完了タスク
Task::pending()->get();                                      // 未完了タスク
Task::pending()->highPriority()->orderBy('due_date')->get(); // チェーンも可能
```

コントローラーに `where(...)` を直書きするより、スコープを使うと意図が読みやすくなる。

---

## まとめ

| 概念 | キーワード | 一言メモ |
|------|-----------|---------|
| 1対多（親→子） | `hasMany` | Category が Task を複数持つ |
| 多対1（子→親） | `belongsTo` | Task が Category に属する |
| N+1対策 | `with('relation')` | ループ内でリレーション参照するなら必須 |
| カラム追加 | `Schema::table()` | 既存マイグレーションは触らない |
| 外部キー | `foreignId()->constrained()` | 整合性を DB レベルで保証 |
| 並び替え | `orderBy()`, `latest()` | `latest()` は `orderBy('created_at', 'desc')` の省略 |
| スコープ | `scopeXxx()` | よく使うクエリ条件をモデルにまとめる |
