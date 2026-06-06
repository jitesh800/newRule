@extends('layouts.app')

@section('title', $priceRule->name)
@section('page-title', $priceRule->name)

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm text-gray-500">
         }}" class="hover:text-blue-600">Price Rules</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">{{ $priceRule->name }}</span>
    </nav>

    <!-- ═══════════════════════════════════ -->
    <!-- Basic Info                         -->
    <!-- ═══════════════════════════════════ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ $priceRule->name }}</h2>

            @php
                $statusColors = [
                    'draft' => 'bg-gray-100 text-gray-700',
                    'scheduled' => 'bg-yellow-100 text-yellow-700',
                    'active' => 'bg-green-100 text-green-700',
                    'expired' => 'bg-red-100 text-red-700',
                ];
            @endphp

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$priceRule->status] ?? '' }}">
                {{ ucfirst($priceRule->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">

            <div>
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Slug</span>
                <span class="text-gray-700 font-mono">{{ $priceRule->slug }}</span>
            </div>

            <div>
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Rule Type</span>
                <span class="text-gray-700">{{ $priceRule->type?->name ?? '-' }}</span>
            </div>

            <div>
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Priority</span>
                <span class="text-gray-700">{{ $priceRule->priority }}</span>
            </div>

            <div>
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Starts At</span>
                <span class="text-gray-700">{{ $priceRule->starts_at?->format('d M Y H:i') ?? '-' }}</span>
            </div>

            <div>
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Ends At</span>
                <span class="text-gray-700">{{ $priceRule->ends_at?->format('d M Y H:i') ?? '-' }}</span>
            </div>

            <div>
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Condition Match</span>
                <span class="text-gray-700">{{ ucfirst($priceRule->condition_match) }}</span>
            </div>

        </div>

        @if($priceRule->description)
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Description</span>
                <p class="text-gray-600 text-sm">{{ $priceRule->description }}</p>
            </div>
        @endif

        <!-- Flags -->
        <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-100">
            @if($priceRule->stop_further_rules)
                <span class="px-2.5 py-1 bg-red-50 text-red-600 text-xs font-medium rounded-full">Stop Further Rules</span>
            @endif

            @if($priceRule->is_combinable)
                <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-medium rounded-full">Combinable</span>
            @endif

            @if($priceRule->coupon_required)
                <span class="px-2.5 py-1 bg-purple-50 text-purple-600 text-xs font-medium rounded-full">Coupon Required</span>
            @endif
        </div>

    </div>

    <!-- ═══════════════════════════════════ -->
    <!-- Conditions                         -->
    <!-- ═══════════════════════════════════ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

        <h3 class="text-lg font-semibold text-gray-800 mb-4">Conditions</h3>

        @if($priceRule->conditions->isNotEmpty())
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Field</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Operator</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Value</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Order</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @foreach($priceRule->conditions as $condition)
                        <tr>
                            <td class="py-3 font-medium text-gray-700">{{ $condition->field }}</td>
                            <td class="py-3">
                                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-xs rounded font-mono">
                                    {{ $condition->operator }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-600 font-mono text-xs">
                                {{ json_encode($condition->value) }}
                            </td>
                            <td class="py-3 text-gray-400">{{ $condition->sort_order }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-sm text-gray-400">No conditions configured (applies to all)</p>
        @endif

    </div>

    <!-- ═══════════════════════════════════ -->
    <!-- Actions                            -->
    <!-- ═══════════════════════════════════ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

        <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>

        @if($priceRule->actions->isNotEmpty())
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Action Type</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Configuration</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Order</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @foreach($priceRule->actions as $action)
                        <tr>
                            <td class="py-3">
                                <span class="px-2.5 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-full">
                                    {{ str_replace('_', ' ', ucfirst($action->action_type)) }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-600 font-mono text-xs">
                                {{ json_encode($action->configuration) }}
                            </td>
                            <td class="py-3 text-gray-400">{{ $action->sort_order }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-sm text-gray-400">No actions configured</p>
        @endif

    </div>

    <!-- ═══════════════════════════════════ -->
    <!-- Coupons                            -->
    <!-- ═══════════════════════════════════ -->
    @if($priceRule->coupons->isNotEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">Coupons</h3>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Code</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Type</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Active</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Usage</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @foreach($priceRule->coupons as $coupon)
                        <tr>
                            <td class="py-3 font-mono font-bold text-gray-800">{{ $coupon->code }}</td>
                            <td class="py-3 text-gray-600">{{ ucfirst($coupon->type) }}</td>
                            <td class="py-3">
                                @if($coupon->is_active)
                                    <span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span>
                                    <span class="text-green-600 text-xs ml-1">Active</span>
                                @else
                                    <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                                    <span class="text-red-600 text-xs ml-1">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 text-gray-600">
                                {{ $coupon->usage_count }} / {{ $coupon->usage_limit ?? '∞' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

    <!-- ═══════════════════════════════════ -->
    <!-- Products                           -->
    <!-- ═══════════════════════════════════ -->
    @if($priceRule->products->isNotEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">Products</h3>

            <div class="flex flex-wrap gap-2">
                @foreach($priceRule->products as $product)
                    <span class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-lg">
                        Product #{{ $product->product_id }}

                        @if($product->override_discount_value)
                            <span class="text-blue-600 ml-1">(Override: {{ $product->override_discount_value }})</span>
                        @endif
                    </span>
                @endforeach
            </div>

        </div>
    @endif

    <!-- ═══════════════════════════════════ -->
    <!-- Categories                         -->
    <!-- ═══════════════════════════════════ -->
    @if($priceRule->categories->isNotEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>

            <div class="flex flex-wrap gap-2">
                @foreach($priceRule->categories as $category)
                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-xs rounded-lg">
                        Category #{{ $category->category_id }}

                        @if($category->include_subcategories)
                            <span class="text-indigo-400 ml-1">(+ sub)</span>
                        @endif
                    </span>
                @endforeach
            </div>

        </div>
    @endif

    <!-- ═══════════════════════════════════ -->
    <!-- Schedules                          -->
    <!-- ═══════════════════════════════════ -->
    @if($priceRule->schedules->isNotEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">Schedules</h3>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Recurrence</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Day</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Time</th>
                        <th class="text-left py-2 text-xs text-gray-500 uppercase">Timezone</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @foreach($priceRule->schedules as $schedule)
                        <tr>
                            <td class="py-3 text-gray-700">{{ ucfirst($schedule->recurrence_type) }}</td>
                            <td class="py-3 text-gray-600">
                                {{ $schedule->day_of_week !== null ? 'Week Day: ' . $schedule->day_of_week : '' }}
                                {{ $schedule->day_of_month !== null ? 'Month Day: ' . $schedule->day_of_month : '' }}
                            </td>
                            <td class="py-3 text-gray-600">
                                {{ $schedule->time_from ?? '-' }} — {{ $schedule->time_to ?? '-' }}
                            </td>
                            <td class="py-3 text-gray-400 text-xs">{{ $schedule->timezone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

    <!-- ═══════════════════════════════════ -->
    <!-- Bottom Actions                     -->
    <!-- ═══════════════════════════════════ -->
    <div class="flex items-center justify-between mt-6">
         }}"
            class="px-5 py-2.5 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
            ← Back to List
        </a>

        <div class="flex items-center space-x-3">
             }}"
                class="px-5 py-2.5 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                Edit Rule
            </a>

             }}" method="POST"
                onsubmit="return confirm('Delete this price rule?')">
                @csrf
                @method('DELETE')

                <button class="px-5 py-2.5 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                    Delete Rule
                </button>
            </form>
        </div>
    </div>

</div>

@endsection