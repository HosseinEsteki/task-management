<div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Task Creation Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <form wire:submit.prevent="createTask">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">عنوان</label>
                        <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">توضیحات</label>
                        <textarea wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">تاریخ پایان</label>
                            <input type="date" wire:model="due_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">اولویت</label>
                            <select wire:model="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="low">کم</option>
                                <option value="medium">متوسط</option>
                                <option value="high">زیاد</option>
                                <option value="critical">بحرانی</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">وضعیت</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="pending">در انتظار</option>
                                <option value="in_progress">در حال انجام</option>
                                <option value="completed">تکمیل شده</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            ایجاد وظیفه
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tasks List -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                عنوان
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                تاریخ پایان
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                اولویت
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                وضعیت
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->jalali_due_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $task->priority === 'critical' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $task->priority === 'high' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $task->priority === 'medium' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $task->priority === 'low' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $task->priority }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select wire:change="updateTaskStatus({{ $task->id }}, $event.target.value)"
                                            class="block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>در انتظار</option>
                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>در حال انجام</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
