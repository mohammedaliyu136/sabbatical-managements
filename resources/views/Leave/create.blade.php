<x-layouts.app>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-8 sm:px-8">
                        
                        <!-- Header Section -->
                        <div class="text-center mb-8">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900 mb-4">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Submit Leave Request</h1>
                            <p class="text-gray-600 dark:text-gray-400 text-lg">Please fill out the form below to request time off.</p>
                        </div>
                        
                        <!-- Form Section -->
                        <form method="POST" action="{{ route('leaves.store') }}" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 gap-6">
                                <x-forms.input 
                                    label="Employee Name" 
                                    name="employee_name" 
                                    type="text" 
                                    placeholder="e.g. Dr. Jane Doe"
                                    :value="old('employee_name', auth()->user()->name)"
                                    required
                                />

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-forms.date
                                        name="start_date"
                                        label="Start Date"
                                        :value="old('start_date')"
                                        required
                                    />

                                    <x-forms.date
                                        name="end_date"
                                        label="End Date"
                                        :value="old('end_date')"
                                        required
                                    />
                                </div>

                                <x-forms.select-input
                                    name="leave_type"
                                    label="Type of Leave"
                                    placeholder="Select a type"
                                    :options="$leaveTypes"
                                    :selected="old('leave_type')"
                                    required
                                />

                                <x-forms.textarea-input
                                    name="comments"
                                    label="Comments"
                                    placeholder="Optional: Provide any additional details about your leave request..."
                                    rows="4"
                                    :value="old('comments')"
                                />
                            </div>

                            <!-- Submit Button Section -->
                            <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <button type="submit" class="w-full sm:w-auto px-8 py-3 text-base font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Submit Request
                                    </button>
                                    
                                    <a href="{{ route('leaves.index') }}" class="w-full sm:w-auto px-8 py-3 text-base font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200 text-center">
                                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            
            <!-- Sidebar Information Section -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-8">
                        <div class="text-center mb-6">
                            <div class="mx-auto flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 mb-3">
                                <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Important Information</h3>
                        </div>
                        
                        <div class="space-y-4 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                </div>
                                <p class="ml-3">Please submit your request at least 2 weeks in advance for better approval chances</p>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                </div>
                                <p class="ml-3">Your request will be reviewed by your supervisor within 3-5 business days</p>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                </div>
                                <p class="ml-3">You will receive an email notification once your request is processed</p>
                            </div>
                        </div>
                        
                        <!-- Additional Tips Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Quick Tips</h4>
                            <div class="space-y-2 text-xs text-gray-500 dark:text-gray-400">
                                <p>• Include specific dates and duration</p>
                                <p>• Provide clear reasoning for your request</p>
                                <p>• Check your remaining leave balance</p>
                                <p>• Consider team workload when planning</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

</x-layouts.app> 