{{-- resources/views/pricerule/create.blade.php --}}
@extends('pricerule::layouts.app')

@section('title', 'Create Price Rule')
@section('page-title', 'Create Price Rule')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-[#0a0f1e] py-6 px-4 sm:px-6 lg:px-8 transition-colors duration-300">

    {{-- ============================================================ --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                    Create Promotion Rule
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                    Create discounts, offers, and promotional campaigns.
                </p>
            </div>

            <div class="flex items-center gap-3">
                {{-- Theme Toggle --}}
                <button type="button" id="themeToggle"
                        class="relative w-16 h-8 rounded-full bg-gray-200 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-[#0a0f1e]"
                        title="Toggle Dark/Light Mode">
                    <div id="toggleKnob"
                         class="absolute top-0.5 left-0.5 w-7 h-7 rounded-full bg-white dark:bg-slate-900 shadow-md flex items-center justify-center transition-transform duration-300 dark:translate-x-8">
                        <svg class="w-4 h-4 text-amber-500 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="w-4 h-4 text-indigo-400 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </div>
                </button>

                <a href="{{ route('admin.price-rules.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium rounded-full transition shadow-sm
                          text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-600
                          hover:bg-gray-50 dark:hover:bg-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>

                <button type="button" onclick="document.getElementById('priceRuleForm').submit()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 dark:bg-indigo-500 rounded-full hover:bg-indigo-700 dark:hover:bg-indigo-400 transition shadow-sm shadow-indigo-200 dark:shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Publish Rule
                </button>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ============================================================ --}}
    @if($errors->any())
        <div class="max-w-7xl mx-auto mb-6">
            <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-red-500 dark:text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-red-800 dark:text-red-300">Please fix the following errors:</h3>
                        <ul class="mt-2 text-sm text-red-700 dark:text-red-400 list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ============================================================ --}}
    {{-- MAIN FORM --}}
    {{-- ============================================================ --}}
    <form id="priceRuleForm" action="{{ route('admin.price-rules.store') }}" method="POST">
        @csrf

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ====================================================== --}}
                {{-- LEFT COLUMN — Form Sections --}}
                {{-- ====================================================== --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- QUICK TEMPLATES --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-[#111827]/80 dark:backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 p-6 transition-colors duration-300">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Quick Templates</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <button type="button"
                                    class="group flex items-center gap-3 p-4 rounded-xl border-2 transition text-left
                                           border-gray-100 dark:border-slate-700 hover:border-indigo-200 dark:hover:border-indigo-500/30
                                           hover:bg-indigo-50/50 dark:hover:bg-indigo-500/5"
                                    onclick="applyTemplate('cart_discount')">
                                <span class="text-2xl">🔥</span>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-slate-200 text-sm group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition">Cart Discount</div>
                                    <div class="text-xs text-gray-500 dark:text-slate-500">Order value based discount</div>
                                </div>
                            </button>

                            <button type="button"
                                    class="group flex items-center gap-3 p-4 rounded-xl border-2 transition text-left
                                           border-gray-100 dark:border-slate-700 hover:border-indigo-200 dark:hover:border-indigo-500/30
                                           hover:bg-indigo-50/50 dark:hover:bg-indigo-500/5"
                                    onclick="applyTemplate('bxgy')">
                                <span class="text-2xl">🎁</span>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-slate-200 text-sm group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition">Buy X Get Y</div>
                                    <div class="text-xs text-gray-500 dark:text-slate-500">Purchase reward offer</div>
                                </div>
                            </button>

                            <button type="button"
                                    class="group flex items-center gap-3 p-4 rounded-xl border-2 transition text-left
                                           border-gray-100 dark:border-slate-700 hover:border-indigo-200 dark:hover:border-indigo-500/30
                                           hover:bg-indigo-50/50 dark:hover:bg-indigo-500/5"
                                    onclick="applyTemplate('free_shipping')">
                                <span class="text-2xl">🚚</span>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-slate-200 text-sm group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition">Free Shipping</div>
                                    <div class="text-xs text-gray-500 dark:text-slate-500">Shipping promotion</div>
                                </div>
                            </button>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- RULE DETAILS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-[#111827]/80 dark:backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 p-6 transition-colors duration-300">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-5">Rule Details</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            {{-- Rule Type --}}
                            <div>
                                <label for="rule_type_id" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                                    Rule Type <span class="text-red-500">*</span>
                                </label>
                                <select name="rule_type_id" id="rule_type_id"
                                        class="w-full rounded-lg border shadow-sm text-sm transition
                                               bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                               text-gray-900 dark:text-slate-200
                                               focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                               @error('rule_type_id') border-red-400 dark:border-red-500/50 ring-1 ring-red-400 dark:ring-red-500/50 @enderror">
                                    <option value="">Select Rule Type</option>
                                    @foreach($ruleTypes as $ruleType)
                                        <option value="{{ $ruleType->id }}" @selected(old('rule_type_id') == $ruleType->id)>
                                            {{ $ruleType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rule_type_id')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                                    Promotion Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                       placeholder="e.g. Diwali Mega Sale"
                                       class="w-full rounded-lg border shadow-sm text-sm transition
                                              bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                              text-gray-900 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500
                                              focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                              @error('name') border-red-400 dark:border-red-500/50 ring-1 ring-red-400 dark:ring-red-500/50 @enderror">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                                    Slug <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                       placeholder="diwali-mega-sale"
                                       class="w-full rounded-lg border shadow-sm text-sm transition font-mono
                                              bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                              text-gray-900 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500
                                              focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                              @error('slug') border-red-400 dark:border-red-500/50 ring-1 ring-red-400 dark:ring-red-500/50 @enderror">
                                @error('slug')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status"
                                        class="w-full rounded-lg border shadow-sm text-sm transition
                                               bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                               text-gray-900 dark:text-slate-200
                                               focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                               @error('status') border-red-400 dark:border-red-500/50 ring-1 ring-red-400 dark:ring-red-500/50 @enderror">
                                    @foreach(['draft' => '📝 Draft', 'scheduled' => '📅 Scheduled', 'active' => '✅ Active', 'expired' => '⏰ Expired'] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', 'draft') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Starts At --}}
                            <div>
                                <label for="starts_at" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">Start Date</label>
                                <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at') }}"
                                       class="w-full rounded-lg border shadow-sm text-sm transition
                                              bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                              text-gray-900 dark:text-slate-200
                                              focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                              @error('starts_at') border-red-400 dark:border-red-500/50 @enderror">
                                @error('starts_at')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Ends At --}}
                            <div>
                                <label for="ends_at" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">End Date</label>
                                <input type="datetime-local" name="ends_at" id="ends_at" value="{{ old('ends_at') }}"
                                       class="w-full rounded-lg border shadow-sm text-sm transition
                                              bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                              text-gray-900 dark:text-slate-200
                                              focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                              @error('ends_at') border-red-400 dark:border-red-500/50 @enderror">
                                @error('ends_at')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="sm:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">Description</label>
                                <textarea name="description" id="description" rows="3"
                                          placeholder="Short description about this rule..."
                                          class="w-full rounded-lg border shadow-sm text-sm transition
                                                 bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                                 text-gray-900 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500
                                                 focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                                 @error('description') border-red-400 dark:border-red-500/50 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- ADVANCED SETTINGS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-[#111827]/80 dark:backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 p-6 transition-colors duration-300">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-5">Advanced Settings</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Priority --}}
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                                    Priority <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="priority" id="priority"
                                       value="{{ old('priority', 100) }}" min="0" max="65535"
                                       class="w-full rounded-lg border shadow-sm text-sm transition
                                              bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                              text-gray-900 dark:text-slate-200
                                              focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                              @error('priority') border-red-400 dark:border-red-500/50 @enderror">
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">Lower number = higher priority</p>
                                @error('priority')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Condition Match --}}
                            <div>
                                <label for="condition_match" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                                    Condition Match <span class="text-red-500">*</span>
                                </label>
                                <select name="condition_match" id="condition_match"
                                        class="w-full rounded-lg border shadow-sm text-sm transition
                                               bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700
                                               text-gray-900 dark:text-slate-200
                                               focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40
                                               @error('condition_match') border-red-400 dark:border-red-500/50 @enderror">
                                    <option value="all" @selected(old('condition_match', 'all') === 'all')>Match All Conditions (AND)</option>
                                    <option value="any" @selected(old('condition_match') === 'any')>Match Any Condition (OR)</option>
                                </select>
                                @error('condition_match')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Toggle Switches --}}
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach([
                                ['name' => 'stop_further_rules', 'label' => 'Stop Further Rules', 'default' => false],
                                ['name' => 'is_combinable', 'label' => 'Is Combinable', 'default' => true],
                                ['name' => 'coupon_required', 'label' => 'Coupon Required', 'default' => false],
                            ] as $toggle)
                                <label class="relative flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition
                                              border-gray-100 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                                    <input type="hidden" name="{{ $toggle['name'] }}" value="0">
                                    <input type="checkbox" name="{{ $toggle['name'] }}" value="1"
                                           class="w-5 h-5 rounded border-gray-300 dark:border-slate-600 text-indigo-600 dark:text-indigo-500
                                                  bg-white dark:bg-[#0a0f1e]
                                                  focus:ring-indigo-500 dark:focus:ring-indigo-500/40 transition"
                                           @checked(old($toggle['name'], $toggle['default']))>
                                    <span class="text-sm font-medium text-gray-700 dark:text-slate-300">{{ $toggle['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- DYNAMIC SECTIONS (Conditions, Actions, Products, Categories, Customer Groups, Coupons, Schedules, Targets) --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    @php
                        $sections = [
                            [
                                'key' => 'conditions', 'title' => 'Conditions', 'subtitle' => 'When should this rule apply?',
                                'icon_bg' => 'bg-amber-100 dark:bg-amber-500/10', 'icon_color' => 'text-amber-600 dark:text-amber-400',
                                'count_bg' => 'bg-amber-100 dark:bg-amber-500/10', 'count_color' => 'text-amber-700 dark:text-amber-400',
                                'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
                                'empty' => 'No conditions added yet. Click "Add Condition" to start.',
                                'add_fn' => 'addCondition()',
                            ],
                            [
                                'key' => 'actions', 'title' => 'Actions', 'subtitle' => 'What discount/action to apply?', 'required' => true,
                                'icon_bg' => 'bg-green-100 dark:bg-emerald-500/10', 'icon_color' => 'text-green-600 dark:text-emerald-400',
                                'count_bg' => 'bg-green-100 dark:bg-emerald-500/10', 'count_color' => 'text-green-700 dark:text-emerald-400',
                                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                'empty' => 'No actions added yet. At least one action is required.',
                                'add_fn' => 'addAction()',
                            ],
                            [
                                'key' => 'products', 'title' => 'Products', 'subtitle' => 'Target specific products',
                                'icon_bg' => 'bg-blue-100 dark:bg-blue-500/10', 'icon_color' => 'text-blue-600 dark:text-blue-400',
                                'count_bg' => 'bg-blue-100 dark:bg-blue-500/10', 'count_color' => 'text-blue-700 dark:text-blue-400',
                                'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                                'empty' => 'No products targeted. Applies to all products by default.',
                                'add_fn' => 'addProduct()',
                            ],
                            [
                                'key' => 'categories', 'title' => 'Categories', 'subtitle' => 'Target specific categories',
                                'icon_bg' => 'bg-purple-100 dark:bg-purple-500/10', 'icon_color' => 'text-purple-600 dark:text-purple-400',
                                'count_bg' => 'bg-purple-100 dark:bg-purple-500/10', 'count_color' => 'text-purple-700 dark:text-purple-400',
                                'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                                'empty' => 'No categories targeted. Applies to all categories by default.',
                                'add_fn' => 'addCategory()',
                            ],
                            [
                                'key' => 'customer_groups', 'title' => 'Customer Groups', 'subtitle' => 'Restrict to specific customer segments',
                                'icon_bg' => 'bg-teal-100 dark:bg-teal-500/10', 'icon_color' => 'text-teal-600 dark:text-teal-400',
                                'count_bg' => 'bg-teal-100 dark:bg-teal-500/10', 'count_color' => 'text-teal-700 dark:text-teal-400',
                                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                                'empty' => 'No customer groups. Applies to all customers by default.',
                                'add_fn' => 'addCustomerGroup()',
                            ],
                            [
                                'key' => 'coupons', 'title' => 'Coupons', 'subtitle' => 'Manage coupon codes for this rule',
                                'icon_bg' => 'bg-rose-100 dark:bg-rose-500/10', 'icon_color' => 'text-rose-600 dark:text-rose-400',
                                'count_bg' => 'bg-rose-100 dark:bg-rose-500/10', 'count_color' => 'text-rose-700 dark:text-rose-400',
                                'icon' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z',
                                'empty' => 'No coupons added. Rule will apply automatically without a coupon code.',
                                'add_fn' => 'addCoupon()',
                            ],
                            [
                                'key' => 'schedules', 'title' => 'Schedules', 'subtitle' => 'Set recurring time windows',
                                'icon_bg' => 'bg-cyan-100 dark:bg-cyan-500/10', 'icon_color' => 'text-cyan-600 dark:text-cyan-400',
                                'count_bg' => 'bg-cyan-100 dark:bg-cyan-500/10', 'count_color' => 'text-cyan-700 dark:text-cyan-400',
                                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                'empty' => 'No schedules. Rule runs continuously within its start/end dates.',
                                'add_fn' => 'addSchedule()',
                            ],
                            [
                                'key' => 'targets', 'title' => 'Targets', 'subtitle' => 'Store / channel targeting',
                                'icon_bg' => 'bg-orange-100 dark:bg-orange-500/10', 'icon_color' => 'text-orange-600 dark:text-orange-400',
                                'count_bg' => 'bg-orange-100 dark:bg-orange-500/10', 'count_color' => 'text-orange-700 dark:text-orange-400',
                                'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z',
                                'empty' => 'No targets. Rule applies globally across all stores/channels.',
                                'add_fn' => 'addTarget()',
                            ],
                        ];
                    @endphp

                    @foreach($sections as $section)
                        @php $oldItems = old($section['key'], []); @endphp
                        <div class="bg-white dark:bg-[#111827]/80 dark:backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 overflow-hidden transition-colors duration-300"
                             x-data="{ open: {{ ($section['key'] === 'actions' || count($oldItems) > 0) ? 'true' : 'false' }} }">

                            <button type="button" @click="open = !open"
                                    class="w-full flex items-center justify-between p-5 hover:bg-gray-50 dark:hover:bg-white/[0.02] transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg {{ $section['icon_bg'] }} flex items-center justify-center">
                                        <svg class="w-4 h-4 {{ $section['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $section['icon'] }}"/>
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-slate-200">
                                            {{ $section['title'] }}
                                            @if($section['required'] ?? false)
                                                <span class="text-red-500">*</span>
                                            @endif
                                        </h3>
                                        <p class="text-xs text-gray-500 dark:text-slate-500">{{ $section['subtitle'] }}</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 dark:text-slate-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-collapse>
                                <div class="px-5 pb-5 border-t border-gray-100 dark:border-slate-700/50">
                                    <div class="flex justify-end pt-4 mb-3">
                                        <button type="button" onclick="{{ $section['add_fn'] }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition
                                                       text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-500/10
                                                       hover:bg-indigo-100 dark:hover:bg-indigo-500/20">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Add {{ str_replace('_', ' ', Str::singular(ucfirst($section['key']))) }}
                                        </button>
                                    </div>

                                    <div id="{{ str_replace('_', '-', $section['key']) }}-wrapper" class="space-y-3">
                                        {{-- Old data rows rendered by JS on page load if needed --}}
                                    </div>

                                    <div id="{{ str_replace('_', '-', $section['key']) }}-empty"
                                         class="{{ count($oldItems) > 0 ? 'hidden' : '' }} text-center py-8 text-sm text-gray-400 dark:text-slate-500">
                                        {{ $section['empty'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- BOTTOM ACTION BAR --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-[#111827]/80 dark:backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 p-4 transition-colors duration-300">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.price-rules.index') }}"
                               class="px-5 py-2.5 text-sm font-medium rounded-lg border transition
                                      text-gray-700 dark:text-slate-400 bg-white dark:bg-transparent border-gray-300 dark:border-slate-600
                                      hover:bg-gray-50 dark:hover:bg-slate-800">
                                Cancel
                            </a>
                            <button type="submit" name="action" value="draft"
                                    class="px-5 py-2.5 text-sm font-medium rounded-lg border transition
                                           text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-600
                                           hover:bg-gray-50 dark:hover:bg-slate-700">
                                Save Draft
                            </button>
                            <button type="submit"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 dark:bg-indigo-500 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-400 transition shadow-sm shadow-indigo-200 dark:shadow-indigo-500/20">
                                Publish Rule
                            </button>
                        </div>
                    </div>

                </div>

                {{-- ====================================================== --}}
                {{-- RIGHT COLUMN — Live Preview Sidebar --}}
                {{-- ====================================================== --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-6 space-y-6">

                        {{-- Live Preview Card --}}
                        <div class="bg-white dark:bg-[#111827]/80 dark:backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700/50 p-5 transition-colors duration-300">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 dark:bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500 dark:bg-emerald-400"></span>
                                </span>
                                Live Preview
                            </h3>

                            <div class="space-y-4">
                                @foreach([
                                    ['border' => 'border-amber-400', 'label_color' => 'text-amber-600 dark:text-amber-400', 'label' => 'When', 'id' => 'preview-conditions', 'default' => 'No conditions set — applies to all'],
                                    ['border' => 'border-green-400 dark:border-emerald-400', 'label_color' => 'text-green-600 dark:text-emerald-400', 'label' => 'Then', 'id' => 'preview-actions', 'default' => 'No action defined yet'],
                                    ['border' => 'border-indigo-400', 'label_color' => 'text-indigo-600 dark:text-indigo-400', 'label' => 'Status', 'id' => 'preview-status-wrap', 'is_badge' => true],
                                    ['border' => 'border-cyan-400', 'label_color' => 'text-cyan-600 dark:text-cyan-400', 'label' => 'Schedule', 'id' => 'preview-schedule', 'default' => 'Always active'],
                                    ['border' => 'border-rose-400', 'label_color' => 'text-rose-600 dark:text-rose-400', 'label' => 'Coupon', 'id' => 'preview-coupon', 'default' => 'Not required'],
                                ] as $preview)
                                    <div class="border-l-2 {{ $preview['border'] }} pl-3">
                                        <p class="text-[10px] font-bold {{ $preview['label_color'] }} uppercase tracking-wider mb-1">{{ $preview['label'] }}</p>
                                        @if($preview['is_badge'] ?? false)
                                            <div>
                                                <span id="preview-status"
                                                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300">
                                                    Draft
                                                </span>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-700 dark:text-slate-300" id="{{ $preview['id'] }}">
                                                {{ $preview['default'] }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Tips Card --}}
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-500/5 dark:to-purple-500/5 rounded-2xl border border-indigo-100 dark:border-indigo-500/20 p-5 transition-colors duration-300">
                            <h4 class="text-sm font-semibold text-indigo-900 dark:text-indigo-300 mb-2">💡 Quick Tips</h4>
                            <ul class="space-y-2 text-xs text-indigo-700 dark:text-indigo-400/80">
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-1 h-1 rounded-full bg-indigo-400 flex-shrink-0"></span>
                                    <span>Use <strong>priority</strong> to control which rules fire first (lower = higher priority).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-1 h-1 rounded-full bg-indigo-400 flex-shrink-0"></span>
                                    <span>Enable <strong>Stop Further Rules</strong> to prevent stacking with lower-priority rules.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-1 h-1 rounded-full bg-indigo-400 flex-shrink-0"></span>
                                    <span>Add <strong>conditions</strong> like <code class="bg-white/60 dark:bg-white/10 px-1 rounded">subtotal >= 500</code> to target specific carts.</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
    // ─── Theme Toggle ──────────────────────────────────────────
    (function () {
        const html = document.documentElement;
        const toggle = document.getElementById('themeToggle');
        const storageKey = 'price-rule-theme';

        function loadTheme() {
            const saved = localStorage.getItem(storageKey);
            if (saved === 'dark') html.classList.add('dark');
            else if (saved === 'light') html.classList.remove('dark');
            else if (window.matchMedia('(prefers-color-scheme: dark)').matches) html.classList.add('dark');
        }

        if (toggle) {
            toggle.addEventListener('click', function () {
                html.classList.toggle('dark');
                localStorage.setItem(storageKey, html.classList.contains('dark') ? 'dark' : 'light');
            });
        }
        loadTheme();
    })();

    // ─── Index Counters ────────────────────────────────────────
    let conditionIndex     = {{ count(old('conditions', [])) }};
    let actionIndex        = {{ count(old('actions', [])) }};
    let productIndex       = {{ count(old('products', [])) }};
    let categoryIndex      = {{ count(old('categories', [])) }};
    let customerGroupIndex = {{ count(old('customer_groups', [])) }};
    let couponIndex        = {{ count(old('coupons', [])) }};
    let scheduleIndex      = {{ count(old('schedules', [])) }};
    let targetIndex        = {{ count(old('targets', [])) }};

    // ─── Shared Styles ─────────────────────────────────────────
    const inputClass = 'w-full rounded-lg border shadow-sm text-sm transition bg-white dark:bg-[#0a0f1e] border-gray-300 dark:border-slate-700 text-gray-900 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500 focus:border-indigo-500 dark:focus:border-indigo-500/50 focus:ring-indigo-500 dark:focus:ring-indigo-500/40';
    const rowClass = 'group flex flex-wrap items-center gap-2 p-3 rounded-xl bg-gray-50 dark:bg-slate-800/50 border border-gray-100 dark:border-slate-700/50';

    function deleteBtn(rowSelector) {
        return `<button type="button" class="p-2 text-gray-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition" onclick="this.closest('${rowSelector}').remove(); updatePreview();">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>`;
    }

    function hideEmpty(section) {
        const el = document.getElementById(`${section}-empty`);
        if (el) el.classList.add('hidden');
    }

    // ─── Add Functions ─────────────────────────────────────────
    function addCondition() {
        const i = conditionIndex++;
        document.getElementById('conditions-wrapper').insertAdjacentHTML('beforeend', `
            <div class="condition-row ${rowClass}">
                <div class="flex-1 min-w-[140px]"><input type="text" name="conditions[${i}][field]" class="${inputClass}" placeholder="Field e.g. subtotal" oninput="updatePreview()"></div>
                <div class="w-28"><select name="conditions[${i}][operator]" class="${inputClass}" onchange="updatePreview()">
                    <option value="=">=</option><option value="!=">!=</option><option value=">">&gt;</option><option value=">=">&gt;=</option>
                    <option value="<">&lt;</option><option value="<=">&lt;=</option><option value="in">in</option><option value="not_in">not_in</option>
                    <option value="between">between</option><option value="contains">contains</option>
                </select></div>
                <div class="flex-1 min-w-[140px]"><input type="text" name="conditions[${i}][value]" class="${inputClass}" placeholder="Value" oninput="updatePreview()"></div>
                <div class="w-20"><input type="number" name="conditions[${i}][sort_order]" value="${i+1}" class="${inputClass}" placeholder="Sort"></div>
                ${deleteBtn('.condition-row')}
            </div>`);
        hideEmpty('conditions');
    }

    function addAction() {
        const i = actionIndex++;
        document.getElementById('actions-wrapper').insertAdjacentHTML('beforeend', `
            <div class="action-row ${rowClass}">
                <div class="flex-1 min-w-[150px]"><select name="actions[${i}][action_type]" class="${inputClass}" onchange="updatePreview()">
                    <option value="percentage_discount">Percentage Discount</option><option value="fixed_discount">Fixed Discount</option><option value="free_shipping">Free Shipping</option>
                </select></div>
                <div class="flex-1 min-w-[120px]"><input type="number" step="0.01" name="actions[${i}][configuration][value]" class="${inputClass}" placeholder="Value" oninput="updatePreview()"></div>
                <div class="flex-1 min-w-[120px]"><input type="number" step="0.01" name="actions[${i}][configuration][max_discount]" class="${inputClass}" placeholder="Max Discount"></div>
                <div class="w-16"><input type="number" name="actions[${i}][sort_order]" value="${i+1}" class="${inputClass}" placeholder="Sort"></div>
                ${deleteBtn('.action-row')}
            </div>`);
        hideEmpty('actions');
    }

    function addProduct() {
        const i = productIndex++;
        document.getElementById('products-wrapper').insertAdjacentHTML('beforeend', `
            <div class="product-row ${rowClass}">
                <div class="flex-1 min-w-[150px]"><input type="number" name="products[${i}][product_id]" class="${inputClass}" placeholder="Product ID"></div>
                <div class="flex-1 min-w-[150px]"><input type="number" step="0.01" name="products[${i}][override_discount_value]" class="${inputClass}" placeholder="Override Discount Value"></div>
                ${deleteBtn('.product-row')}
            </div>`);
        hideEmpty('products');
    }

    function addCategory() {
        const i = categoryIndex++;
        document.getElementById('categories-wrapper').insertAdjacentHTML('beforeend', `
            <div class="category-row ${rowClass}">
                <div class="flex-1 min-w-[150px]"><input type="number" name="categories[${i}][category_id]" class="${inputClass}" placeholder="Category ID"></div>
                <div class="flex items-center gap-2">
                    <input type="hidden" name="categories[${i}][include_subcategories]" value="0">
                    <label class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" name="categories[${i}][include_subcategories]" value="1" class="rounded border-gray-300 dark:border-slate-600 text-indigo-600 dark:text-indigo-500 bg-white dark:bg-[#0a0f1e] focus:ring-indigo-500" checked>
                        Include Subcategories
                    </label>
                </div>
                ${deleteBtn('.category-row')}
            </div>`);
        hideEmpty('categories');
    }

    function addCustomerGroup() {
        const i = customerGroupIndex++;
        document.getElementById('customer-groups-wrapper').insertAdjacentHTML('beforeend', `
            <div class="customer-group-row ${rowClass}">
                <div class="flex-1"><input type="number" name="customer_groups[${i}][customer_group_id]" class="${inputClass}" placeholder="Customer Group ID"></div>
                ${deleteBtn('.customer-group-row')}
            </div>`);
        hideEmpty('customer-groups');
    }

    function addCoupon() {
        const i = couponIndex++;
        document.getElementById('coupons-wrapper').insertAdjacentHTML('beforeend', `
            <div class="coupon-row ${rowClass}">
                <div class="flex-1 min-w-[140px]"><input type="text" name="coupons[${i}][code]" class="${inputClass} font-mono uppercase" placeholder="Coupon Code" oninput="updatePreview()"></div>
                <div class="w-28"><select name="coupons[${i}][type]" class="${inputClass}"><option value="shared">Shared</option><option value="unique">Unique</option></select></div>
                <div class="w-28"><input type="number" name="coupons[${i}][usage_limit]" class="${inputClass}" placeholder="Usage Limit"></div>
                <div class="flex items-center gap-2">
                    <input type="hidden" name="coupons[${i}][is_active]" value="0">
                    <label class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" name="coupons[${i}][is_active]" value="1" class="rounded border-gray-300 dark:border-slate-600 text-indigo-600 dark:text-indigo-500 bg-white dark:bg-[#0a0f1e] focus:ring-indigo-500" checked> Active
                    </label>
                </div>
                ${deleteBtn('.coupon-row')}
            </div>`);
        hideEmpty('coupons');
    }

    function addSchedule() {
        const i = scheduleIndex++;
        document.getElementById('schedules-wrapper').insertAdjacentHTML('beforeend', `
            <div class="schedule-row ${rowClass}">
                <div class="w-28"><select name="schedules[${i}][recurrence_type]" class="${inputClass}" onchange="updatePreview()">
                    <option value="daily">Daily</option><option value="weekly">Weekly</option><option value="monthly">Monthly</option><option value="custom">Custom</option>
                </select></div>
                <div class="w-24"><input type="number" name="schedules[${i}][day_of_week]" class="${inputClass}" placeholder="Day 0-6"></div>
                <div class="w-24"><input type="number" name="schedules[${i}][day_of_month]" class="${inputClass}" placeholder="Day 1-31"></div>
                <div class="w-28"><input type="time" name="schedules[${i}][time_from]" class="${inputClass}" onchange="updatePreview()"></div>
                <div class="w-28"><input type="time" name="schedules[${i}][time_to]" class="${inputClass}" onchange="updatePreview()"></div>
                ${deleteBtn('.schedule-row')}
            </div>`);
        hideEmpty('schedules');
    }

    function addTarget() {
        const i = targetIndex++;
        document.getElementById('targets-wrapper').insertAdjacentHTML('beforeend', `
            <div class="target-row ${rowClass}">
                <div class="flex-1 min-w-[150px]"><input type="text" name="targets[${i}][target_type]" class="${inputClass}" placeholder="Target Type"></div>
                <div class="flex-1 min-w-[150px]"><input type="number" name="targets[${i}][target_id]" class="${inputClass}" placeholder="Target ID"></div>
                ${deleteBtn('.target-row')}
            </div>`);
        hideEmpty('targets');
    }

    // ─── Live Preview ──────────────────────────────────────────
    function updatePreview() {
        const isDark = document.documentElement.classList.contains('dark');

        // Status
        const statusEl = document.getElementById('status');
        const previewSt = document.getElementById('preview-status');
        const statusMap = {
            draft:     isDark ? 'bg-slate-700 text-slate-300' : 'bg-gray-100 text-gray-700',
            scheduled: isDark ? 'bg-blue-500/10 text-blue-300' : 'bg-blue-100 text-blue-700',
            active:    isDark ? 'bg-emerald-500/10 text-emerald-300' : 'bg-green-100 text-green-700',
            expired:   isDark ? 'bg-red-500/10 text-red-300' : 'bg-red-100 text-red-700'
        };
        if (statusEl && previewSt) {
            const val = statusEl.value;
            previewSt.textContent = val.charAt(0).toUpperCase() + val.slice(1);
            previewSt.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusMap[val] || statusMap.draft}`;
        }

        // Conditions
        const condRows = document.querySelectorAll('.condition-row');
        const previewCond = document.getElementById('preview-conditions');
        if (previewCond) {
            if (condRows.length === 0) { previewCond.textContent = 'No conditions set — applies to all'; }
            else {
                const parts = [];
                condRows.forEach(r => {
                    const f = r.querySelector('[name*="[field]"]')?.value || '?';
                    const o = r.querySelector('[name*="[operator]"]')?.value || '=';
                    const v = r.querySelector('[name*="[value]"]')?.value || '?';
                    if (f || v) parts.push(`${f} ${o} ${v}`);
                });
                previewCond.textContent = parts.length ? parts.join(' & ') : 'No conditions set — applies to all';
            }
        }

        // Actions
        const actRows = document.querySelectorAll('.action-row');
        const previewAct = document.getElementById('preview-actions');
        if (previewAct) {
            if (actRows.length === 0) { previewAct.textContent = 'No action defined yet'; }
            else {
                const parts = [];
                actRows.forEach(r => {
                    const t = r.querySelector('[name*="[action_type]"]')?.value || '';
                    const v = r.querySelector('[name*="[configuration][value]"]')?.value || '';
                    const label = t.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                    parts.push(v ? `Apply ${v}${t.includes('percentage') ? '%' : '₹'} ${label}` : label);
                });
                previewAct.textContent = parts.join(', ');
            }
        }

        // Schedule
        const schedRows = document.querySelectorAll('.schedule-row');
        const previewSched = document.getElementById('preview-schedule');
        const startsAt = document.getElementById('starts_at')?.value;
        const endsAt = document.getElementById('ends_at')?.value;
        if (previewSched) {
            let txt = '';
            if (startsAt) txt += `From ${new Date(startsAt).toLocaleDateString('en-IN')}`;
            if (endsAt) txt += ` to ${new Date(endsAt).toLocaleDateString('en-IN')}`;
            if (schedRows.length > 0) txt += ` (${schedRows.length} schedule${schedRows.length > 1 ? 's' : ''})`;
            previewSched.textContent = txt.trim() || 'Always active';
        }

        // Coupon
        const coupRows = document.querySelectorAll('.coupon-row');
        const previewCoupon = document.getElementById('preview-coupon');
        if (previewCoupon) {
            if (coupRows.length === 0) { previewCoupon.textContent = 'Not required'; }
            else {
                const codes = [];
                coupRows.forEach(r => { const c = r.querySelector('[name*="[code]"]')?.value; if (c) codes.push(c.toUpperCase()); });
                previewCoupon.textContent = codes.length ? codes.join(', ') : `${coupRows.length} coupon(s)`;
            }
        }
    }

    // ─── Auto Slug ─────────────────────────────────────────────
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    let slugManuallyEdited = false;
    if (slugInput) slugInput.addEventListener('input', () => { slugManuallyEdited = true; });
    if (nameInput) {
        nameInput.addEventListener('input', function () {
            if (!slugManuallyEdited && slugInput) {
                slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').trim();
            }
            updatePreview();
        });
    }

    // ─── Quick Templates ───────────────────────────────────────
    function applyTemplate(type) {
        document.getElementById('actions-wrapper').innerHTML = '';
        actionIndex = 0;
        if (type === 'cart_discount') { document.getElementById('name').value = 'Cart Discount'; }
        else if (type === 'bxgy') { document.getElementById('name').value = 'Buy X Get Y'; addCondition(); }
        else if (type === 'free_shipping') { document.getElementById('name').value = 'Free Shipping'; }
        slugManuallyEdited = false;
        nameInput.dispatchEvent(new Event('input'));
        addAction();
        if (type === 'free_shipping') {
            const sel = document.querySelector('.action-row:last-child [name*="[action_type]"]');
            if (sel) sel.value = 'free_shipping';
        }
        updatePreview();
    }

    // ─── Init ──────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('status')?.addEventListener('change', updatePreview);
        document.getElementById('starts_at')?.addEventListener('change', updatePreview);
        document.getElementById('ends_at')?.addEventListener('change', updatePreview);
        updatePreview();
    });
</script>
@endpush