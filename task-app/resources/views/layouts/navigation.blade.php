<nav x-data="{ open: false }" class="studio-nav">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14">

            <!-- Logo / Brand -->
            <a href="{{ route('tasks.index') }}"
               style="font-family: 'Shippori Mincho', serif; color: var(--accent); font-size: 1rem; letter-spacing: 0.06em; font-weight: 500; text-decoration: none;">
                Task
            </a>

            <!-- Desktop links -->
            <div class="hidden sm:flex items-center gap-6">
                <a href="{{ route('tasks.index') }}"
                   class="studio-nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                    タスク
                </a>
            </div>

            <!-- User / Logout -->
            <div class="hidden sm:flex items-center gap-4">
                <span class="studio-nav-user">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="studio-nav-link" style="background: none; border: none; cursor: pointer;">
                        ログアウト
                    </button>
                </form>
            </div>

            <!-- Hamburger (mobile) -->
            <button @click="open = !open"
                    class="sm:hidden p-2"
                    style="color: var(--text-secondary); background: none; border: none; cursor: pointer;">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden"
         style="border-top: 1px solid var(--border); padding: 1rem;">
        <div class="space-y-3">
            <a href="{{ route('tasks.index') }}" class="studio-nav-link block">タスク</a>
            <div style="font-size: 0.8125rem; color: var(--text-muted);">{{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="studio-nav-link" style="background: none; border: none; cursor: pointer;">
                    ログアウト
                </button>
            </form>
        </div>
    </div>
</nav>
