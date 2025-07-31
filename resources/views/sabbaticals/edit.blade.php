<x-layouts.app>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        @if(auth()->user()->isAdmin())
                            Edit Sabbatical
                        @else
                            Update Sabbatical Request
                        @endif
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        @if(auth()->user()->isAdmin())
                            Update sabbatical information
                        @else
                            Update your sabbatical request details
                        @endif
                    </p>
                </div>
                <div>
                    <a href="{{ route('sabbaticals.show', $sabbatical) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Details
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-8">
                <form action="{{ route('sabbaticals.update', $sabbatical) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Doctor Selection (Admin Only) -->
                        @if(auth()->user()->isAdmin())
                        <div class="md:col-span-2">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Doctor</label>
                            <select name="user_id" id="user_id" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="">Select a doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('user_id', $sabbatical->user_id) == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }} ({{ $doctor->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <!-- Destination -->
                        <div class="md:col-span-2">
                            <label for="destination" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Destination</label>
                            <input type="text" name="destination" id="destination" value="{{ old('destination', $sabbatical->destination) }}" required placeholder="e.g., Harvard Medical School, Boston" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            @error('destination')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Purpose -->
                        <div class="md:col-span-2">
                            <label for="purpose" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Purpose</label>
                            <textarea name="purpose" id="purpose" rows="4" required placeholder="Describe the purpose and objectives of this sabbatical..." class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ old('purpose', $sabbatical->purpose) }}</textarea>
                            @error('purpose')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $sabbatical->start_date->format('Y-m-d')) }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            @error('start_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $sabbatical->end_date->format('Y-m-d')) }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            @error('end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Update Frequency -->
                        <div>
                            <label for="update_frequency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Frequency</label>
                            <select name="update_frequency" id="update_frequency" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="">Select update frequency</option>
                                @foreach($updateFrequencies as $value => $label)
                                    <option value="{{ $value }}" {{ old('update_frequency', $sabbatical->update_frequency) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('update_frequency')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status (Admin Only) -->
                        @if(auth()->user()->isAdmin())
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="status" id="status" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="upcoming" {{ old('status', $sabbatical->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="active" {{ old('status', $sabbatical->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ old('status', $sabbatical->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('sabbaticals.show', $sabbatical) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                @if(auth()->user()->isAdmin())
                                    Update Sabbatical
                                @else
                                    Update Request
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

</x-layouts.app> 