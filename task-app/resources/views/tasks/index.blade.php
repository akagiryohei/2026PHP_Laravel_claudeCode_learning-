<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h2 class="studio-title">タスク一覧</h2>
            <a href="{{ route('tasks.create') }}" class="studio-btn-primary">
                <svg width="11" height="11" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                    <line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/>
                </svg>
                新規作成
            </a>
        </div>
    </x-slot>

    <div style="max-width: 48rem; margin: 2rem auto; padding: 0 1.5rem;">

        @if (session('success'))
            <div class="studio-flash">{{ session('success') }}</div>
        @endif

        <div class="studio-card">
            @if ($tasks->isEmpty())
                <div class="studio-empty">
                    <p style="margin-bottom: 0.5rem; font-family: 'Shippori Mincho', serif; font-size: 1rem;">
                        タスクがありません
                    </p>
                    <p style="font-size: 0.75rem; letter-spacing: 0.06em; color: var(--text-muted);">
                        「新規作成」からタスクを追加してください
                    </p>
                </div>
            @else
                @foreach ($tasks as $task)
                    <div class="studio-task-row">

                        <!-- Checkbox toggle -->
                        <div style="display: flex; align-items: center; gap: 0.875rem; flex: 1; min-width: 0;">
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" style="flex-shrink: 0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="studio-check {{ $task->is_completed ? 'checked' : '' }}">
                                    <svg width="8" height="8" viewBox="0 0 10 8" fill="none"
                                         stroke="#0d0c0a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="1,4 4,7 9,1"/>
                                    </svg>
                                </button>
                            </form>

                            <span class="studio-task-title {{ $task->is_completed ? 'done' : '' }}"
                                  style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $task->title }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div style="display: flex; align-items: center; gap: 0.25rem; flex-shrink: 0; margin-left: 1rem;">
                            <a href="{{ route('tasks.edit', $task) }}" class="studio-btn-ghost">編集</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                  onsubmit="return confirm('このタスクを削除しますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="studio-btn-danger">削除</button>
                            </form>
                        </div>

                    </div>
                @endforeach
            @endif
        </div>

        <!-- Summary line -->
        @unless ($tasks->isEmpty())
            <p style="margin-top: 1rem; font-size: 0.75rem; color: var(--text-muted); letter-spacing: 0.04em; text-align: right;">
                {{ $tasks->where('is_completed', true)->count() }} / {{ $tasks->count() }} 完了
            </p>
        @endunless

    </div>
</x-app-layout>
