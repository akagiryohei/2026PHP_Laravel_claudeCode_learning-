# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Doc参照ルール

**回答・実装・提案を行う前に必ず `Doc/` を参照すること。まず `Doc/README.md` でどこに何があるかを確認する。**

| ファイル | 用途 |
|----------|------|
| `Doc/README.md` | ドキュメント全体のインデックス（構成を把握するために最初に読む） |
| `Doc/context.md` | プロジェクトの経緯・目的・ユーザースキル感 |
| `Doc/learning-plan/overview.md` | フェーズ全体の進捗・技術スタック |
| `Doc/learning-plan/phase{N}/checklist.md` | 各フェーズの実装内容・進捗チェックリスト |
| `Doc/learning-plan/phase{N}/guide.md` | 各フェーズの学習解説・コード例（存在するフェーズのみ） |

フェーズが進んだ際は該当の `phase{N}/checklist.md` のステータスとチェックリストを更新すること。

## Project Overview

PHP/Laravel学習プロジェクト。タスク管理アプリを題材に、基礎から段階的にLaravelを習得する。
詳細は `Doc/learning-plan/overview.md` を参照。

## Status

Phase 2 完了。現在 Phase 3（リレーション）に着手中。

## Common Commands

```bash
# 開発サーバー起動
php artisan serve

# マイグレーション実行
php artisan migrate

# マイグレーションをリセットして再実行
php artisan migrate:fresh --seed

# コントローラー作成
php artisan make:controller TaskController --resource

# モデル + マイグレーション同時作成
php artisan make:model Task -m

# ルーティング一覧確認
php artisan route:list

# テスト実行（全件）
php artisan test

# テスト実行（単一ファイル）
php artisan test tests/Feature/TaskTest.php
```

## Architecture

Laravelの標準MVCアーキテクチャに従う。

```
app/
├── Http/Controllers/   # コントローラー（ビジネスロジックの入口）
├── Models/             # Eloquentモデル（DBとのマッピング）
└── Policies/           # 認可ロジック（Phase 4以降）
resources/
├── views/              # Bladeテンプレート
└── css/, js/           # フロントエンドアセット
routes/
└── web.php             # Webルーティング定義
database/
├── migrations/         # テーブル定義
└── seeders/            # テストデータ
```

## Learning Phases

| Phase | ブランチ予定 | 内容 |
|-------|------------|------|
| 1 | `phase/1-basics` | ルーティング・認証・タスク一覧・作成 |
| 2 | `phase/2-crud` | 編集・削除・バリデーション |
| 3 | `phase/3-relations` | カテゴリ・期限・優先度 |
| 4 | `phase/4-advanced` | 検索・認可・最適化 |

各Phaseの詳細は `Doc/learning-plan/phase{N}/checklist.md` を参照。

## User Context

- PHP/Laravel実務経験約1年（最終使用から約1年のブランク）
- ルーティング・変数宣言レベルから丁寧に解説しながら進める
- フロントエンドは後でデザインを取得して適用予定（現時点ではBladeのシンプルなHTMLで可）
