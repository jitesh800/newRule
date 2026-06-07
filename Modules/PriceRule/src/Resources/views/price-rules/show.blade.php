{{-- resources/views/pricerule/show.blade.php --}}
@extends('pricerule::layouts.app')

@section('title', 'Price Rule Details')
@section('page-title', 'Price Rule Details')

@section('content')
<div class="min-h-screen bg-gray-50/80 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- ============================================================ --}}
        {{-- PAGE HEADER --}}
        {{-- ============================================================ --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                        {{ $priceRule->name }}
                    </h1>

                    @php
                    $statusConfig = match($priceRule->status) {
                    'active' => ['bg' => 'bg-green-100 text-green-700 ring-green-600/20', 'dot' => 'bg-green-500'],
                    'scheduled' => ['bg' => 'bg-amber-100 text-amber-700 ring-amber-600/20', 'dot' => 'bg-amber-500'],
                    'expired' => ['bg' => 'bg-red-100 text-red-700 ring-red-600/20', 'dot' => 'bg-red-500'],
                    default => ['bg' => 'bg-gray-100 text-gray-600 ring-gray-500/20', 'dot' => 'bg-gray-400'],
                    };
                    @endphp

                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $statusConfig['bg'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                        {{ ucfirst($priceRule->status) }}
                    </span>
                </div>

                <p class="text-sm text-gray-500">
                    View complete information about this price rule, its conditions, actions and related settings.
                </p>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('admin.price-rules.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>

                <a href="{{ route('admin.price-rules.edit', $priceRule) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-amber-700 bg-amber-50 border border-amber-200 rounded-full hover:bg-amber-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>

                <form action="{{ route('admin.price-rules.destroy', $priceRule) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this price rule?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-full hover:bg-red-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- MAIN LAYOUT — 2 Column --}}
        {{-- ============================================================ --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ====================================================== --}}
            {{-- LEFT COLUMN — Detail Sections --}}
            {{-- ====================================================== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ─────────────────────────────────────────────── --}}
                {{-- RULE FLOW VISUALIZATION --}}
                {{-- ─────────────────────────────────────────────── --}}
                {{-- ─────────────────────────────────────────────── --}}
                {{-- RULE FLOW — Professional Clean Design --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900">Rule Flow</h3>
                        </div>

                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $statusConfig['bg'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                            {{ ucfirst($priceRule->status) }}
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch gap-0">

                        {{-- STEP 1 — WHEN (Conditions) --}}
                        <div class="flex-1 relative">
                            <div class="border border-gray-200 rounded-xl p-4 h-full bg-amber-50/30">
                                {{-- Step Number --}}
                                <div class="flex items-center gap-2 mb-3">
                                    <span
                                        class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-amber-100 text-[10px] font-bold text-amber-700">1</span>
                                    <p class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">When</p>
                                </div>

                                @if($priceRule->conditions && $priceRule->conditions->count())
                                <div class="space-y-1.5">
                                    @foreach($priceRule->conditions->take(3) as $condition)
                                    <div class="flex items-center gap-1.5 text-xs">
                                        <code
                                            class="px-1.5 py-0.5 rounded bg-white border border-gray-200 text-gray-700 font-medium">{{ $condition->field }}</code>
                                        <span class="font-bold text-amber-600">{{ $condition->operator }}</span>
                                        <code
                                            class="px-1.5 py-0.5 rounded bg-white border border-gray-200 text-gray-700">{{ is_array($condition->value) ? json_encode($condition->value) : $condition->value }}</code>
                                    </div>
                                    @endforeach

                                    @if($priceRule->conditions->count() > 3)
                                    <p class="text-[10px] text-gray-400 mt-1">+ {{ $priceRule->conditions->count() - 3
                                        }} more condition(s)</p>
                                    @endif
                                </div>

                                <div class="mt-3 pt-2 border-t border-amber-200/50">
                                    <span class="text-[10px] font-medium text-gray-400">Match:
                                        <span class="font-bold text-gray-600 uppercase">{{ $priceRule->condition_match
                                            ?? 'ALL' }}</span>
                                    </span>
                                </div>
                                @else
                                <p class="text-xs text-gray-400 italic">No conditions — applies universally</p>
                                @endif
                            </div>

                            {{-- Connector Arrow (Desktop) --}}
                            <div
                                class="hidden sm:flex absolute -right-3 top-1/2 -translate-y-1/2 z-10 w-6 h-6 rounded-full bg-white border border-gray-200 items-center justify-center shadow-sm">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- Connector Arrow (Mobile) --}}
                        <div class="flex sm:hidden justify-center py-1">
                            <div
                                class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center shadow-sm">
                                <svg class="w-3 h-3 text-gray-400 rotate-90" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- Spacer (Desktop) --}}
                        <div class="hidden sm:block w-3"></div>

                        {{-- STEP 2 — THEN (Actions) --}}
                        <div class="flex-1 relative">
                            <div class="border border-gray-200 rounded-xl p-4 h-full bg-green-50/30">
                                {{-- Step Number --}}
                                <div class="flex items-center gap-2 mb-3">
                                    <span
                                        class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-green-100 text-[10px] font-bold text-green-700">2</span>
                                    <p class="text-[10px] font-bold text-green-600 uppercase tracking-widest">Then</p>
                                </div>

                                @if($priceRule->actions && $priceRule->actions->count())
                                <div class="space-y-1.5">
                                    @foreach($priceRule->actions->take(3) as $action)
                                    @php
                                    $config = $action->configuration;
                                    if (is_string($config)) $config = json_decode($config, true) ?: [];
                                    $val = is_array($config) ? ($config['value'] ?? '') : '';
                                    $maxDiscount = is_array($config) ? ($config['max_discount'] ?? '') : '';
                                    @endphp
                                    <div class="flex flex-wrap items-center gap-1.5 text-xs">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md bg-green-100 text-green-700 font-semibold">
                                            {{ ucwords(str_replace('_', ' ', $action->action_type)) }}
                                        </span>
                                        @if($val)
                                        <span class="text-gray-300">→</span>
                                        <code
                                            class="px-1.5 py-0.5 rounded bg-white border border-gray-200 text-gray-800 font-bold">
                                        {{ $val }}{{ str_contains($action->action_type, 'percentage') ? '%' : '' }}
                                    </code>
                                        @endif
                                        @if($maxDiscount)
                                        <span class="text-[10px] text-gray-400">(max: {{ $maxDiscount }})</span>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p class="text-xs text-gray-400 italic">No actions defined</p>
                                @endif
                            </div>

                            {{-- Connector Arrow (Desktop) --}}
                            <div
                                class="hidden sm:flex absolute -right-3 top-1/2 -translate-y-1/2 z-10 w-6 h-6 rounded-full bg-white border border-gray-200 items-center justify-center shadow-sm">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- Connector Arrow (Mobile) --}}
                        <div class="flex sm:hidden justify-center py-1">
                            <div
                                class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center shadow-sm">
                                <svg class="w-3 h-3 text-gray-400 rotate-90" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- Spacer (Desktop) --}}
                        <div class="hidden sm:block w-3"></div>

                        {{-- STEP 3 — APPLIES TO --}}
                        <div class="flex-1">
                            <div class="border border-gray-200 rounded-xl p-4 h-full bg-blue-50/30">
                                {{-- Step Number --}}
                                <div class="flex items-center gap-2 mb-3">
                                    <span
                                        class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-100 text-[10px] font-bold text-blue-700">3</span>
                                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Applies To
                                    </p>
                                </div>

                                <div class="space-y-2">
                                    {{-- Products --}}
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Products</span>
                                        <span class="font-semibold text-gray-700">
                                            {{ ($priceRule->products && $priceRule->products->count()) ?
                                            $priceRule->products->count() . ' selected' : 'All' }}
                                        </span>
                                    </div>

                                    {{-- Categories --}}
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Categories</span>
                                        <span class="font-semibold text-gray-700">
                                            {{ ($priceRule->categories && $priceRule->categories->count()) ?
                                            $priceRule->categories->count() . ' selected' : 'All' }}
                                        </span>
                                    </div>

                                    {{-- Customer Groups --}}
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Customers</span>
                                        <span class="font-semibold text-gray-700">
                                            {{ ($priceRule->customerGroups && $priceRule->customerGroups->count()) ?
                                            $priceRule->customerGroups->count() . ' group(s)' : 'All' }}
                                        </span>
                                    </div>

                                    {{-- Coupon --}}
                                    <div
                                        class="flex items-center justify-between text-xs border-t border-blue-100 pt-2 mt-2">
                                        <span class="text-gray-500">Coupon</span>
                                        @if($priceRule->coupon_required)
                                        <span
                                            class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-700">
                                            🎟️ Required
                                        </span>
                                        @else
                                        <span class="font-medium text-gray-400">Not required</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Bottom Info Bar --}}
                    <div class="mt-4 flex flex-wrap items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                            Priority: <span class="font-semibold text-gray-700">{{ $priceRule->priority }}</span>
                        </div>

                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $priceRule->starts_at?->format('d M Y') ?? 'No start' }} — {{
                            $priceRule->ends_at?->format('d M Y') ?? 'No end' }}
                        </div>

                        @if($priceRule->stop_further_rules)
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Stops further rules
                        </span>
                        @endif

                        @if($priceRule->is_combinable)
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Combinable
                        </span>
                        @endif

                        @if($priceRule->schedules && $priceRule->schedules->count())
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-cyan-100 text-cyan-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $priceRule->schedules->count() }} schedule(s)
                        </span>
                        @endif
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- BASIC INFORMATION --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-5 flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">

                        <div>
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">ID</p>
                            <p class="text-sm font-semibold text-gray-900">#{{ $priceRule->id }}</p>
                        </div>

                        <div>
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Rule Type</p>
                            @if($priceRule->type?->name)
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                {{ $priceRule->type->name }}
                            </span>
                            @else
                            <p class="text-sm text-gray-400">—</p>
                            @endif
                        </div>

                        <div>
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Priority</p>
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 text-sm font-bold text-gray-700">
                                {{ $priceRule->priority }}
                            </span>
                        </div>

                        <div>
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Condition
                                Match</p>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                                {{ ($priceRule->condition_match ?? 'all') === 'all' ? 'bg-blue-50 text-blue-700' : 'bg-orange-50 text-orange-700' }}">
                                {{ strtoupper($priceRule->condition_match ?? 'ALL') }}
                            </span>
                        </div>

                        <div class="col-span-2">
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Name</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $priceRule->name }}</p>
                        </div>

                        <div class="col-span-2">
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Slug</p>
                            <code
                                class="text-sm bg-gray-100 px-2.5 py-1 rounded-lg text-indigo-600 font-mono">{{ $priceRule->slug }}</code>
                        </div>

                        <div class="col-span-2 sm:col-span-4">
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Description
                            </p>
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $priceRule->description ?: 'No
                                description provided.' }}</p>
                        </div>

                    </div>

                    {{-- Dates Row --}}
                    <div class="mt-5 pt-5 border-t border-gray-100">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                            <div>
                                <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Starts At
                                </p>
                                <div class="flex items-center gap-1.5 text-sm text-gray-700">
                                    <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $priceRule->starts_at?->format('d M Y, h:i A') ?? 'No start date' }}
                                </div>
                            </div>

                            <div>
                                <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Ends At
                                </p>
                                <div class="flex items-center gap-1.5 text-sm text-gray-700">
                                    <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $priceRule->ends_at?->format('d M Y, h:i A') ?? 'No end date' }}
                                </div>
                            </div>

                            <div>
                                <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Created
                                </p>
                                <p class="text-sm text-gray-500">{{ $priceRule->created_at?->format('d M Y, h:i A') ??
                                    '—' }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">Updated
                                </p>
                                <p class="text-sm text-gray-500">{{ $priceRule->updated_at?->format('d M Y, h:i A') ??
                                    '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- RULE FLAGS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    {{-- Stop Further Rules --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-3">
                            <div
                                class="w-10 h-10 rounded-xl {{ $priceRule->stop_further_rules ? 'bg-red-100' : 'bg-gray-100' }} flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $priceRule->stop_further_rules ? 'text-red-600' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>

                            @if($priceRule->stop_further_rules)
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700">YES</span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500">NO</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-1">Stop Further Rules</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            {{ $priceRule->stop_further_rules ? 'No other rules will be evaluated after this one.' :
                            'Other rules can still apply after this one.' }}
                        </p>
                    </div>

                    {{-- Is Combinable --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-3">
                            <div
                                class="w-10 h-10 rounded-xl {{ $priceRule->is_combinable ? 'bg-green-100' : 'bg-gray-100' }} flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $priceRule->is_combinable ? 'text-green-600' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>

                            @if($priceRule->is_combinable)
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700">YES</span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500">NO</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-1">Is Combinable</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            {{ $priceRule->is_combinable ? 'Can be combined with other applicable rules.' : 'Cannot be
                            combined with other rules.' }}
                        </p>
                    </div>

                    {{-- Coupon Required --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-3">
                            <div
                                class="w-10 h-10 rounded-xl {{ $priceRule->coupon_required ? 'bg-purple-100' : 'bg-gray-100' }} flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $priceRule->coupon_required ? 'text-purple-600' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>

                            @if($priceRule->coupon_required)
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-700">YES</span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500">NO</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-1">Coupon Required</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            {{ $priceRule->coupon_required ? 'A valid coupon code must be applied.' : 'Rule applies
                            automatically without a coupon.' }}
                        </p>
                    </div>

                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- CONDITIONS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: true }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Conditions</h3>
                                <p class="text-xs text-gray-500">When should this rule trigger?</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700">
                                {{ $priceRule->conditions?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->conditions && $priceRule->conditions->count())
                            <div class="p-4 space-y-2">
                                @foreach($priceRule->conditions as $condition)
                                <div
                                    class="flex flex-wrap items-center gap-2 p-3 rounded-xl bg-gray-50 border border-gray-100">
                                    <span
                                        class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-white border border-gray-200 text-xs font-bold text-gray-500">
                                        {{ $condition->sort_order }}
                                    </span>
                                    <code
                                        class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                                {{ $condition->field }}
                                            </code>
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-800 text-white text-[11px] font-bold">
                                        {{ $condition->operator }}
                                    </span>
                                    @php $conditionValue = $condition->value; @endphp
                                    @if(is_array($conditionValue))
                                    <code class="px-2.5 py-1 rounded-lg bg-green-50 text-green-700 text-xs font-mono">
                                                    {{ json_encode($conditionValue) }}
                                                </code>
                                    @else
                                    <code class="px-2.5 py-1 rounded-lg bg-green-50 text-green-700 text-xs font-mono">
                                                    {{ $conditionValue }}
                                                </code>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                                <p class="text-sm text-gray-400">No conditions — this rule applies universally.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- ACTIONS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: true }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Actions</h3>
                                <p class="text-xs text-gray-500">What discounts/effects to apply?</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-green-100 text-green-700">
                                {{ $priceRule->actions?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->actions && $priceRule->actions->count())
                            <div class="p-4 space-y-2">
                                @foreach($priceRule->actions as $action)
                                @php
                                $config = $action->configuration;
                                if (is_string($config)) $config = json_decode($config, true) ?: $config;
                                @endphp
                                <div
                                    class="flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <span
                                        class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-white border border-gray-200 text-xs font-bold text-gray-500">
                                        {{ $action->sort_order }}
                                    </span>

                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-600 text-white text-xs font-semibold">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        {{ ucwords(str_replace('_', ' ', $action->action_type)) }}
                                    </span>

                                    @if(is_array($config))
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($config as $key => $val)
                                        <div class="px-2.5 py-1 rounded-lg bg-white border border-gray-200 text-xs">
                                            <span class="text-gray-400">{{ $key }}:</span>
                                            <span class="font-semibold text-gray-700">{{ $val }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <code
                                        class="px-2.5 py-1 rounded-lg bg-white border border-gray-200 text-xs font-mono text-gray-700">
                                                    {{ $config }}
                                                </code>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <p class="text-sm text-gray-400">No actions defined for this rule.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- PRODUCTS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: {{ ($priceRule->products && $priceRule->products->count()) ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Products</h3>
                                <p class="text-xs text-gray-500">Targeted product restrictions</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700">
                                {{ $priceRule->products?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->products && $priceRule->products->count())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50/80">
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Product ID</th>
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Override Discount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($priceRule->products as $product)
                                        <tr class="hover:bg-gray-50/50">
                                            <td class="px-5 py-3">
                                                <span
                                                    class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-900">
                                                    <span
                                                        class="w-6 h-6 rounded-md bg-blue-50 flex items-center justify-center text-[10px] font-bold text-blue-600">P</span>
                                                    #{{ $product->product_id }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-3 text-sm text-gray-600">
                                                {{ $product->override_discount_value ?? '—' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">No product restrictions — applies to all products.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- CATEGORIES --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: {{ ($priceRule->categories && $priceRule->categories->count()) ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Categories</h3>
                                <p class="text-xs text-gray-500">Category-based targeting</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-purple-100 text-purple-700">
                                {{ $priceRule->categories?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->categories && $priceRule->categories->count())
                            <div class="p-4 space-y-2">
                                @foreach($priceRule->categories as $category)
                                <div
                                    class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-100">
                                    <span class="inline-flex items-center gap-2 text-sm font-medium text-gray-900">
                                        <span
                                            class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center text-[10px] font-bold text-purple-600">C</span>
                                        Category #{{ $category->category_id }}
                                    </span>
                                    @if($category->include_subcategories)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Subcategories
                                    </span>
                                    @else
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500">
                                        No Subcategories
                                    </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">No category restrictions — applies to all categories.
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- CUSTOMER GROUPS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: {{ ($priceRule->customerGroups && $priceRule->customerGroups->count()) ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Customer Groups</h3>
                                <p class="text-xs text-gray-500">Segment-based restrictions</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-teal-100 text-teal-700">
                                {{ $priceRule->customerGroups?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->customerGroups && $priceRule->customerGroups->count())
                            <div class="p-4 flex flex-wrap gap-2">
                                @foreach($priceRule->customerGroups as $group)
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-gray-50 border border-gray-200 text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Group #{{ $group->customer_group_id }}
                                </span>
                                @endforeach
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">No customer group restrictions — applies to all
                                    customers.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- COUPONS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: {{ ($priceRule->coupons && $priceRule->coupons->count()) ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-rose-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Coupons</h3>
                                <p class="text-xs text-gray-500">Associated coupon codes</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">
                                {{ $priceRule->coupons?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->coupons && $priceRule->coupons->count())
                            <div class="p-4 space-y-3">
                                @foreach($priceRule->coupons as $coupon)
                                <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-3">
                                            <code
                                                class="px-3 py-1.5 rounded-lg bg-white border-2 border-dashed border-gray-300 text-sm font-bold font-mono text-gray-800 tracking-wider">
                                                        {{ $coupon->code }}
                                                    </code>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase
                                                        {{ $coupon->type === 'unique' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                                {{ $coupon->type }}
                                            </span>
                                        </div>
                                        @if($coupon->is_active)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active
                                        </span>
                                        @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Inactive
                                        </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                        <div>
                                            <p class="text-[10px] text-gray-400 uppercase font-medium">Usage Limit</p>
                                            <p class="text-sm font-semibold text-gray-700">{{ $coupon->usage_limit ?? '∞
                                                Unlimited' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-400 uppercase font-medium">Used</p>
                                            <p class="text-sm font-semibold text-gray-700">{{ $coupon->usage_count ?? 0
                                                }} times</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-400 uppercase font-medium">Starts</p>
                                            <p class="text-xs text-gray-600">{{ $coupon->starts_at?->format('d M Y') ??
                                                '—' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-400 uppercase font-medium">Ends</p>
                                            <p class="text-xs text-gray-600">{{ $coupon->ends_at?->format('d M Y') ??
                                                '—' }}</p>
                                        </div>
                                    </div>

                                    {{-- Usage Progress Bar --}}
                                    @if($coupon->usage_limit)
                                    @php $usagePercent = min(100, round((($coupon->usage_count ?? 0) /
                                    $coupon->usage_limit) * 100)); @endphp
                                    <div class="mt-3">
                                        <div class="flex justify-between text-[10px] text-gray-400 mb-1">
                                            <span>Usage</span>
                                            <span>{{ $usagePercent }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                                            <div class="h-1.5 rounded-full transition-all {{ $usagePercent >= 90 ? 'bg-red-500' : ($usagePercent >= 60 ? 'bg-amber-500' : 'bg-green-500') }}"
                                                style="width: {{ $usagePercent }}%"></div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">No coupons associated with this rule.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- SCHEDULES --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: {{ ($priceRule->schedules && $priceRule->schedules->count()) ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-cyan-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Schedules</h3>
                                <p class="text-xs text-gray-500">Recurring time windows</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-cyan-100 text-cyan-700">
                                {{ $priceRule->schedules?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->schedules && $priceRule->schedules->count())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50/80">
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Recurrence</th>
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Day of Week</th>
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Day of Month</th>
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Time From</th>
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Time To</th>
                                            <th
                                                class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                                                Timezone</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($priceRule->schedules as $schedule)
                                        <tr class="hover:bg-gray-50/50">
                                            <td class="px-5 py-3">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                                                            {{ match($schedule->recurrence_type) {
                                                                'daily'   => 'bg-green-50 text-green-700',
                                                                'weekly'  => 'bg-blue-50 text-blue-700',
                                                                'monthly' => 'bg-purple-50 text-purple-700',
                                                                default   => 'bg-gray-100 text-gray-600',
                                                            } }}">
                                                    {{ ucfirst($schedule->recurrence_type) }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-3 text-sm text-gray-600">{{ $schedule->day_of_week ?? '—'
                                                }}</td>
                                            <td class="px-5 py-3 text-sm text-gray-600">{{ $schedule->day_of_month ??
                                                '—' }}</td>
                                            <td class="px-5 py-3 text-sm text-gray-600 font-mono">{{
                                                $schedule->time_from ?? '—' }}</td>
                                            <td class="px-5 py-3 text-sm text-gray-600 font-mono">{{ $schedule->time_to
                                                ?? '—' }}</td>
                                            <td class="px-5 py-3 text-xs text-gray-500">{{ $schedule->timezone ?? '—' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">No schedules — rule runs continuously within its date
                                    range.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- TARGETS --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: {{ ($priceRule->targets && $priceRule->targets->count()) ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Targets</h3>
                                <p class="text-xs text-gray-500">Store/channel targeting</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold bg-orange-100 text-orange-700">
                                {{ $priceRule->targets?->count() ?? 0 }}
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100">
                            @if($priceRule->targets && $priceRule->targets->count())
                            <div class="p-4 space-y-2">
                                @foreach($priceRule->targets as $target)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                                    <span
                                        class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center text-[10px] font-bold text-orange-600">T</span>
                                    <code
                                        class="px-2.5 py-1 rounded-lg bg-white border border-gray-200 text-xs font-mono text-gray-700">{{ $target->target_type }}</code>
                                    <span class="text-gray-300">→</span>
                                    <span class="text-sm font-semibold text-gray-700">#{{ $target->target_id }}</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">No targets — rule applies globally.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ─────────────────────────────────────────────── --}}
                {{-- METADATA --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between p-5 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-sm font-semibold text-gray-900">Metadata</h3>
                                <p class="text-xs text-gray-500">Raw JSON metadata</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse>
                        <div class="border-t border-gray-100 p-5">
                            @if($priceRule->metadata)
                            @php
                            $metadata = $priceRule->metadata;
                            if (is_string($metadata)) $metadata = json_decode($metadata, true) ?: $metadata;
                            @endphp

                            @if(is_array($metadata))
                            <pre
                                class="bg-gray-900 text-green-400 rounded-xl p-4 text-xs font-mono overflow-x-auto leading-relaxed">{{ json_encode($metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                            @else
                            <code
                                class="block bg-gray-100 rounded-xl p-4 text-sm font-mono text-gray-700">{{ $metadata }}</code>
                            @endif
                            @else
                            <p class="text-sm text-gray-400 text-center">No metadata available.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- ====================================================== --}}
            {{-- RIGHT COLUMN — Sticky Sidebar --}}
            {{-- ====================================================== --}}
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">

                    {{-- Quick Summary Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Summary
                        </h3>

                        <div class="space-y-4">
                            <div class="border-l-2 border-indigo-400 pl-3">
                                <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-0.5">Rule ID
                                </p>
                                <p class="text-sm font-semibold text-gray-900">#{{ $priceRule->id }}</p>
                            </div>

                            <div class="border-l-2 border-amber-400 pl-3">
                                <p class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-0.5">
                                    Conditions</p>
                                <p class="text-sm text-gray-700">{{ $priceRule->conditions?->count() ?? 0 }}
                                    condition(s)</p>
                            </div>

                            <div class="border-l-2 border-green-400 pl-3">
                                <p class="text-[10px] font-bold text-green-600 uppercase tracking-wider mb-0.5">Actions
                                </p>
                                <p class="text-sm text-gray-700">{{ $priceRule->actions?->count() ?? 0 }} action(s)</p>
                            </div>

                            <div class="border-l-2 border-rose-400 pl-3">
                                <p class="text-[10px] font-bold text-rose-600 uppercase tracking-wider mb-0.5">Coupons
                                </p>
                                <p class="text-sm text-gray-700">{{ $priceRule->coupons?->count() ?? 0 }} coupon(s)</p>
                            </div>

                            <div class="border-l-2 border-blue-400 pl-3">
                                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-0.5">Products
                                </p>
                                <p class="text-sm text-gray-700">{{ $priceRule->products?->count() ?? 0 }} product(s)
                                </p>
                            </div>

                            <div class="border-l-2 border-purple-400 pl-3">
                                <p class="text-[10px] font-bold text-purple-600 uppercase tracking-wider mb-0.5">
                                    Categories</p>
                                <p class="text-sm text-gray-700">{{ $priceRule->categories?->count() ?? 0 }}
                                    category(ies)</p>
                            </div>

                            <div class="border-l-2 border-cyan-400 pl-3">
                                <p class="text-[10px] font-bold text-cyan-600 uppercase tracking-wider mb-0.5">Schedules
                                </p>
                                <p class="text-sm text-gray-700">{{ $priceRule->schedules?->count() ?? 0 }} schedule(s)
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Actions Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.price-rules.edit', $priceRule) }}"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-amber-50 text-sm text-gray-700 hover:text-amber-700 transition group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-amber-600 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit this Rule
                            </a>

                            <a href="{{ route('admin.price-rules.create') }}"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-50 text-sm text-gray-700 hover:text-indigo-700 transition group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Create New Rule
                            </a>

                            <a href="{{ route('admin.price-rules.index') }}"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-sm text-gray-700 hover:text-gray-900 transition group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                View All Rules
                            </a>
                        </div>
                    </div>

                    {{-- Timestamps Card --}}
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border border-gray-200 p-5">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Timestamps</h4>
                        <div class="space-y-3">
                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Created: {{ $priceRule->created_at?->format('d M Y, h:i A') ?? '—' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span>Updated: {{ $priceRule->updated_at?->format('d M Y, h:i A') ?? '—' }}</span>
                            </div>
                            @if($priceRule->updated_at)
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $priceRule->updated_at->diffForHumans() }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection