<x-layouts.app>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Leave Request Details</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">View leave request information</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('leaves.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                    @if($leave->status === 'pending' && auth()->id() === $leave->user_id)
                        <a href="{{ route('leaves.edit', $leave) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Request
                        </a>
                    @endif
                    @if($leave->status === 'pending' && auth()->user()->isAdmin())
                        <div class="flex space-x-2">
                            <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200" onclick="return confirm('Are you sure you want to approve this leave request?')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200" onclick="return confirm('Are you sure you want to reject this leave request?')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Reject
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Leave Details Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-8">
                
                <!-- Status Badge -->
                <div class="mb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($leave->status === 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                        @elseif($leave->status === 'approved') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                        @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 @endif">
                        {{ ucfirst($leave->status) }}
                    </span>
                </div>

                <!-- Employee Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Employee Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Employee Name</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $leave->employee_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $leave->user->email ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Submitted By</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $leave->user->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Leave Details</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Leave Type</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    {{ $leave->leave_type }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Duration</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $leave->duration }} days</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Start Date</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $leave->start_date ? $leave->start_date->format('M d, Y') : '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">End Date</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $leave->end_date ? $leave->end_date->format('M d, Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                @if($leave->comments)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Comments</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $leave->comments }}</p>
                    </div>
                </div>
                @endif

                <!-- Approval Information -->
                @if($leave->status !== 'pending')
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Approval Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Approved By</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $leave->approver->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Approved At</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $leave->approved_at ? $leave->approved_at->format('M d, Y H:i') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Created</label>
                            <p class="text-gray-900 dark:text-white">{{ $leave->created_at ? $leave->created_at->format('M d, Y H:i') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</label>
                            <p class="text-gray-900 dark:text-white">{{ $leave->updated_at ? $leave->updated_at->format('M d, Y H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</x-layouts.app> 