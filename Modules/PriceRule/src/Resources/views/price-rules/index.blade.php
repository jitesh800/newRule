@extends('layouts.app')

@section('title', 'Price Rules')
@section('page-title', 'Price Rules')

@section('content')

<!-- ═══════════════════════════════════ -->
<!-- Header + Create Button             -->
<!-- ═══════════════════════════════════ -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Price Rules</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all pricing rules, discounts and promotions</p>
    </div>

     }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">

        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>

        Create Rule
    </a>
</div>

<!-- ═══════════════════════════════════ -->
<!-- Filters                            -->
<!-- ═══════════════════════════════════ -->
<form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <!-- Search -->
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name or slug"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
            >
        </div>

        <!-- Status -->
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
            <select name="status"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">All Status</option>
                @foreach(['draft','scheduled','active','expired'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Rule Type -->
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Rule Type</label>
            <select name="rule_type_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">All Types</option>
                @foreach($ruleTypes as $type)
                    <option value="{{ $type->id }}" @selected(request('rule_type_id') == $type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Button -->
        <div class="flex items-end">
            <button class="w-full px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900 transition">
                Apply Filters
            </button>
        </div>

    </div>
</form>

<!-- ═══════════════════════════════════ -->
<!-- Rules Table                        -->
<!-- ═══════════════════════════════════ -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm text-left">

        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Priority</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Duration</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @forelse($rules as $rule)
                <tr class="hover:bg-gray-50 transition">

                    <!-- Name -->
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $rule->name }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">{{ $rule->slug }}</div>
                    </td>

                    <!-- Type -->
                    <td class="px-6 py-4 text-gray-600">
                        {{ $rule->type?->name ?? '-' }}
                    </td>

                    <!-- Status Badge -->
                    <td class="px-6 py-4">
                        @php
                            $statusColors = [
                                'draft' => 'bg-gray-100 text-gray-700',
                                'scheduled' => 'bg-yellow-100 text-yellow-700',
                                'active' => 'bg-green-100 text-green-700',
                                'expired' => 'bg-red-100 text-red-700',
                            ];
                        @endphp

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$rule->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($rule->status) }}
                        </span>
                    </td>

                    <!-- Priority -->
                    <td class="px-6 py-4 text-gray-600">
                        {{ $rule->priority }}
                    </td>

                    <!-- Duration -->
                    <td class="px-6 py-4 text-xs text-gray-500">
                        <div>{{ $rule->starts_at?->format('d M Y H:i') ?? 'No start' }}</div>
                        <div>{{ $rule->ends_at?->format('d M Y H:i') ?? 'No end' }}</div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">

                             }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 text-xs font-medium rounded-lg hover:bg-blue-100 transition">
                                View
                            </a>

                             }}"
                                class="inline-flex items-center px-3 py-1.5 bg-yellow-50 text-yellow-600 text-xs font-medium rounded-lg hover:bg-yellow-100 transition">
                                Edit
                            </a>

                             }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this rule?')">
                                @csrf
                                @method('DELETE')

                                <button class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 text-xs font-medium rounded-lg hover:bg-red-100 transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>

                            <p class="text-sm font-medium">No price rules found</p>
                            <p class="text-xs mt-1">Create your first rule to get started</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $rules->links() }}
</div>

@endsection