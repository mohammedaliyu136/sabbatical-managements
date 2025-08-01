            <aside :class="{ 'w-full md:w-64': sidebarOpen, 'w-0 md:w-16 hidden md:block': !sidebarOpen }"
                class="bg-sidebar text-sidebar-foreground border-r border-gray-200 dark:border-gray-700 sidebar-transition overflow-hidden">
                <!-- Sidebar Content -->
                <div class="h-full flex flex-col">
                    <!-- Quick Stats (Admin Only) -->
                    @if(auth()->user()->isAdmin())
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Quick Stats</div>
                        <div class="space-y-1 text-xs">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Active:</span>
                                <span class="font-medium text-green-600 dark:text-green-400">{{ App\Models\Sabbatical::where('status', 'active')->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Pending:</span>
                                <span class="font-medium text-yellow-600 dark:text-yellow-400">{{ App\Models\Sabbatical::where('approval_status', 'pending')->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Total:</span>
                                <span class="font-medium text-blue-600 dark:text-blue-400">{{ App\Models\Sabbatical::count() }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Sidebar Menu -->
                    <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
                        <ul class="space-y-1 px-2">
                            <!-- Dashboard -->
                            <x-layouts.sidebar-link href="{{ route('dashboard') }}" icon='fas-house'
                                :active="request()->routeIs('dashboard*')">Dashboard</x-layouts.sidebar-link>

                            <!-- Sabbatical Management -->
                            <x-layouts.sidebar-two-level-link-parent title="Sabbatical Management" icon="fas-calendar-alt"
                                :active="request()->routeIs('sabbaticals*')">
                                
                                <!-- All Sabbaticals -->
                                <x-layouts.sidebar-two-level-link href="{{ route('sabbaticals.index') }}" icon='fas-list'
                                    :active="request()->routeIs('sabbaticals.index') && !request()->routeIs('sabbaticals.*.status.*')">
                                    All Sabbaticals
                                </x-layouts.sidebar-two-level-link>

                                <!-- Active Sabbaticals -->
                                <x-layouts.sidebar-two-level-link href="{{ route('sabbaticals.active') }}" icon='fas-play-circle'
                                    :active="request()->routeIs('sabbaticals.active')">
                                    Active Sabbaticals
                                </x-layouts.sidebar-two-level-link>

                                <!-- Upcoming Sabbaticals -->
                                <x-layouts.sidebar-two-level-link href="{{ route('sabbaticals.upcoming') }}" icon='fas-clock'
                                    :active="request()->routeIs('sabbaticals.upcoming')">
                                    Upcoming Sabbaticals
                                </x-layouts.sidebar-two-level-link>

                                <!-- Completed Sabbaticals -->
                                <x-layouts.sidebar-two-level-link href="{{ route('sabbaticals.completed') }}" icon='fas-check-circle'
                                    :active="request()->routeIs('sabbaticals.completed')">
                                    Completed Sabbaticals
                                </x-layouts.sidebar-two-level-link>

                                <!-- Create New Sabbatical -->
                                <x-layouts.sidebar-two-level-link href="{{ route('sabbaticals.create') }}" icon='fas-plus'
                                    :active="request()->routeIs('sabbaticals.create')">
                                    {{ auth()->user()->isAdmin() ? 'Create Sabbatical' : 'Request Sabbatical' }}
                                </x-layouts.sidebar-two-level-link>
                            </x-layouts.sidebar-two-level-link-parent>

                            <!-- Settings -->
                            <x-layouts.sidebar-two-level-link-parent title="Settings" icon="fas-cog"
                                :active="request()->routeIs('settings*')">
                                
                                <!-- Profile Settings -->
                                <x-layouts.sidebar-two-level-link href="{{ route('settings.profile.edit') }}" icon='fas-user'
                                    :active="request()->routeIs('settings.profile*')">
                                    Profile Settings
                                </x-layouts.sidebar-two-level-link>

                                <!-- Password Settings -->
                                <x-layouts.sidebar-two-level-link href="{{ route('settings.password.edit') }}" icon='fas-lock'
                                    :active="request()->routeIs('settings.password*')">
                                    Password Settings
                                </x-layouts.sidebar-two-level-link>

                                <!-- Appearance Settings -->
                                <x-layouts.sidebar-two-level-link href="{{ route('settings.appearance.edit') }}" icon='fas-palette'
                                    :active="request()->routeIs('settings.appearance*')">
                                    Appearance Settings
                                </x-layouts.sidebar-two-level-link>
                            </x-layouts.sidebar-two-level-link-parent>
                        </ul>
                    </nav>
                </div>
            </aside>
