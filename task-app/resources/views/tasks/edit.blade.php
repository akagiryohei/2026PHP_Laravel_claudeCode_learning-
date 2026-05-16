<x-app-layout>
    <x-slot name="header">
        <h2 class="studio-title">タスクを編集</h2>
    </x-slot>

    <div style="max-width: 48rem; margin: 2rem auto; padding: 0 1.5rem;">
        <div class="studio-card" style="padding: 2rem;">

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 1.75rem;">
                    <label for="title" class="studio-label">タスク名</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $task->title) }}"
                           class="studio-input"
                           autofocus>
                    @error('title')
                        <p class="studio-error">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <button type="submit" class="studio-btn-save">更新</button>
                    <a href="{{ route('tasks.index') }}" class="studio-btn-ghost">キャンセル</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
