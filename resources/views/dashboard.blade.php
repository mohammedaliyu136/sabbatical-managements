<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Dashboard')}}</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Welcome to the dashboard') }}</p>
    </div>

    <!-- Statistics Cards -->
    @if(auth()->user()->isAdmin())
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Sabbaticals</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.index') }}" class="block mt-4 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                View All Sabbaticals →
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Upcoming</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::where('status', 'upcoming')->count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.upcoming') }}" class="block mt-4 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                View Upcoming Sabbaticals →
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::where('status', 'active')->count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.active') }}" class="block mt-4 text-sm text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium">
                View Active Sabbaticals →
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-gray-100 dark:bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::where('status', 'completed')->count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.completed') }}" class="block mt-4 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 font-medium">
                View Completed Sabbaticals →
            </a>
        </div>
    </div>
    @else
    <!-- Doctor Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">My Sabbaticals</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::where('user_id', auth()->id())->count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.index') }}" class="block mt-4 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                View My Sabbaticals →
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Sabbatical</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::where('user_id', auth()->id())->where('status', 'active')->count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.active') }}" class="block mt-4 text-sm text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium">
                View Active Sabbatical →
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Approval</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\Sabbatical::where('user_id', auth()->id())->where('approval_status', 'pending')->count() }}</p>
                </div>
            </div>
            <a href="{{ route('sabbaticals.index') }}" class="block mt-4 text-sm text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 font-medium">
                Check Status →
            </a>
        </div>
    </div>
    @endif

    <!-- Quick Actions Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        <!-- Sabbatical Management Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <div class="bg-indigo-100 dark:bg-indigo-900 p-3 rounded-full mr-4">
                    <svg class="h-6 w-6 text-indigo-500 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sabbatical Management</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        @if(auth()->user()->isAdmin())
                            Manage sabbatical records
                        @else
                            View and manage your sabbatical
                        @endif
                    </p>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('sabbaticals.index') }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    @if(auth()->user()->isAdmin())
                        View All Sabbaticals
                    @else
                        View My Sabbatical
                    @endif
                </a>
                <a href="{{ route('sabbaticals.create') }}" class="block w-full text-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    @if(auth()->user()->isAdmin())
                        New Sabbatical
                    @else
                        Request Sabbatical
                    @endif
                </a>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full mr-4">
                    <svg class="h-6 w-6 text-green-500 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Latest activities</p>
                </div>
            </div>
            <div class="space-y-3">
                @if(auth()->user()->isAdmin())
                    @foreach(App\Models\Sabbatical::latest()->take(3)->get() as $sabbatical)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full 
                                @if($sabbatical->status === 'upcoming') bg-blue-500
                                @elseif($sabbatical->status === 'active') bg-green-500
                                @else bg-gray-500 @endif mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $sabbatical->doctor->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sabbatical->destination }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $sabbatical->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                @else
                    @foreach(App\Models\Sabbatical::where('user_id', auth()->id())->latest()->take(3)->get() as $sabbatical)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full 
                                @if($sabbatical->status === 'upcoming') bg-blue-500
                                @elseif($sabbatical->status === 'active') bg-green-500
                                @else bg-gray-500 @endif mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $sabbatical->destination }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($sabbatical->status) }} • {{ ucfirst($sabbatical->approval_status) }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $sabbatical->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Pending Approvals Section (Admin Only) -->
    @if(auth()->user()->isAdmin() && App\Models\Sabbatical::where('approval_status', 'pending')->count() > 0)
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-2 rounded-full mr-3">
                            <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pending Sabbatical Approvals</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ App\Models\Sabbatical::where('approval_status', 'pending')->count() }} sabbatical requests awaiting your approval</p>
                        </div>
                    </div>
                    <a href="{{ route('sabbaticals.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 text-sm font-medium">
                        View All →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach(App\Models\Sabbatical::where('approval_status', 'pending')->latest()->take(5)->get() as $sabbatical)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                                <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                    {{ substr($sabbatical->doctor->name, 0, 2) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $sabbatical->doctor->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sabbatical->destination }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $sabbatical->start_date->format('M d') }} - {{ $sabbatical->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <form action="{{ route('sabbaticals.approve', $sabbatical) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md transition-colors duration-200" onclick="return confirm('Approve this sabbatical request?')">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Approve
                                </button>
                            </form>
                            <button onclick="showRejectModal({{ $sabbatical->id }})" class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject
                            </button>
                            <a href="{{ route('sabbaticals.show', $sabbatical) }}" class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-md transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

</x-layouts.app>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Reject Sabbatical Request</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rejection Reason</label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="4" required placeholder="Please provide a reason for rejection..." class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        Reject Request
                    </button>
                    <button type="button" onclick="hideRejectModal()" class="flex-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRejectModal(sabbaticalId) {
    document.getElementById('rejectForm').action = `/sabbaticals/${sabbaticalId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function hideRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejection_reason').value = '';
}
</script>
