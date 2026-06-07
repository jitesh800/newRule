{{-- resources/views/pricerule/create.blade.php --}}
@extends('pricerule::layouts.app')

@section('title', 'Create Price Rule')
@section('page-title', 'Create Price Rule')

@section('content')
<div x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
     x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val) })"
     :class="{ 'dark': darkMode }">

<div class="min-h-screen bg-gray-50/80 dark:bg-gray-950 py-6 px-4 sm:px-6 lg:px-8 transition-colors duration-300">

    {{-- ============================================================ --}}
    {{-- DARK / LIGHT MODE TOGGLE --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto flex items-center justify-end mb-4">
        <button type="button"
                @click="darkMode = !darkMode"
                class="relative inline-flex items-center gap-2.5 px-4 py-2.5 rounded-full border shadow-sm transition-all duration-300
                       bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700
                       hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">

            {{-- Sun Icon (visible in dark mode) --}}
            <svg x-show="darkMode" x-transition.opacity.duration.200ms
                 class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>

            {{-- Moon Icon (visible in light mode) --}}
            <svg x-show="!darkMode" x-transition.opacity.duration.200ms
                 class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>

            {{-- Toggle Track --}}
            <div class="relative w-11 h-6 rounded-full transition-colors duration-300"
                 :class="darkMode ? 'bg-indigo-600' : 'bg-gray-300'">
                <div class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow-md transition-transform duration-300"
                     :class="darkMode ? 'translate-x-5' : 'translate-x-0'"></div>
            </div>

            <span class="text-xs font-semibold hidden sm:inline" x-text="darkMode ? 'Dark' : 'Light'"></span>
        </button>
    </div>

    {{-- ============================================================ --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                    Create Promotion Rule
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Create discounts, offers, and promotional campaigns.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.price-rules.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium rounded-full shadow-sm transition
                          text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600
                          hover:bg-gray-50 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>

                <button type="button" onclick="document.getElementById('priceRuleForm').submit()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-full hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 transition shadow-sm shadow-indigo-200 dark:shadow-none">
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
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4">
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
    <form action="{{ route('admin.price-rules.store') }}" method="POST" id="priceRuleForm">
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
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Quick Templates</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <button type="button"
                                    class="group flex items-center gap-3 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:border-indigo-200 dark:hover:border-indigo-600 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition text-left"
                                    onclick="applyTemplate('cart_discount')">
                                <span class="text-2xl">🔥</span>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition">Cart Discount</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Order value based discount</div>
                                </div>
                            </button>

                            <button type="button"
                                    class="group flex items-center gap-3 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:border-indigo-200 dark:hover:border-indigo-600 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition text-left"
                                    onclick="applyTemplate('bxgy')">
                                <span class="text-2xl">🎁</span>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition">Buy X Get Y</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Purchase reward offer</div>
                                </div>
                            </button>

                            <button type="button"
                                    class="group flex items-center gap-3 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-700 hover:border-indigo-200 dark:hover:border-indigo-600 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition text-left"
                                    onclick="applyTemplate('free_shipping')">
                                <span class="text-2xl">🚚</span>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition">Free Shipping</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Shipping promotion</div>
                                </div>
                            </button>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- RULE DETAILS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-5">Rule Details</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            {{-- Rule Type --}}
                            <div>
                                <label for="rule_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Rule Type <span class="text-red-500">*</span>
                                </label>
                                <select name="rule_type_id" id="rule_type_id"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('rule_type_id') border-red-400 ring-1 ring-red-400 @enderror">
                                    <option value="">Select Rule Type</option>
                                    @foreach($ruleTypes as $ruleType)
                                        <option value="{{ $ruleType->id }}" @selected(old('rule_type_id') == $ruleType->id)>
                                            {{ $ruleType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rule_type_id')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Promotion Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                       placeholder="e.g. Diwali Mega Sale"
                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('name') border-red-400 ring-1 ring-red-400 @enderror">
                                @error('name')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Slug <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                       placeholder="diwali-mega-sale"
                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('slug') border-red-400 ring-1 ring-red-400 @enderror">
                                @error('slug')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('status') border-red-400 ring-1 ring-red-400 @enderror">
                                    @foreach(['draft' => '📝 Draft', 'scheduled' => '📅 Scheduled', 'active' => '✅ Active', 'expired' => '⏰ Expired'] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', 'draft') === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Starts At --}}
                            <div>
                                <label for="starts_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Start Date
                                </label>
                                <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at') }}"
                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('starts_at') border-red-400 ring-1 ring-red-400 @enderror">
                                @error('starts_at')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Ends At --}}
                            <div>
                                <label for="ends_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    End Date
                                </label>
                                <input type="datetime-local" name="ends_at" id="ends_at" value="{{ old('ends_at') }}"
                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('ends_at') border-red-400 ring-1 ring-red-400 @enderror">
                                @error('ends_at')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="sm:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="3"
                                          placeholder="Short description about this rule..."
                                          class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('description') border-red-400 ring-1 ring-red-400 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- ADVANCED SETTINGS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-5">Advanced Settings</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Priority --}}
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Priority <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="priority" id="priority"
                                       value="{{ old('priority', 100) }}" min="0" max="65535"
                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('priority') border-red-400 ring-1 ring-red-400 @enderror">
                                <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">Lower number = higher priority</p>
                                @error('priority')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Condition Match --}}
                            <div>
                                <label for="condition_match" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Condition Match <span class="text-red-500">*</span>
                                </label>
                                <select name="condition_match" id="condition_match"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition @error('condition_match') border-red-400 ring-1 ring-red-400 @enderror">
                                    <option value="all" @selected(old('condition_match', 'all') === 'all')>Match All Conditions (AND)</option>
                                    <option value="any" @selected(old('condition_match') === 'any')>Match Any Condition (OR)</option>
                                </select>
                                @error('condition_match')
                                    <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Toggle Switches (Alpine.js based) --}}
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">

                            {{-- Stop Further Rules --}}
                            <div x-data="{ enabled: {{ old('stop_further_rules') ? 'true' : 'false' }} }"
                                 class="flex items-center justify-between gap-3 p-4 rounded-xl border transition-all duration-200 cursor-pointer
                                        border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 hover:border-indigo-300 dark:hover:border-indigo-600"
                                 @click="enabled = !enabled">
                                <input type="hidden" name="stop_further_rules" :value="enabled ? 1 : 0">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Stop Further Rules</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Block lower-priority rules</p>
                                </div>
                                <div class="relative flex-shrink-0 w-11 h-6 rounded-full transition-colors duration-300"
                                     :class="enabled ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                    <div class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow-md transition-transform duration-300"
                                         :class="enabled ? 'translate-x-5' : 'translate-x-0'"></div>
                                </div>
                            </div>

                            {{-- Is Combinable --}}
                            <div x-data="{ enabled: {{ old('is_combinable', 1) ? 'true' : 'false' }} }"
                                 class="flex items-center justify-between gap-3 p-4 rounded-xl border transition-all duration-200 cursor-pointer
                                        border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 hover:border-indigo-300 dark:hover:border-indigo-600"
                                 @click="enabled = !enabled">
                                <input type="hidden" name="is_combinable" :value="enabled ? 1 : 0">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Is Combinable</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Stack with other rules</p>
                                </div>
                                <div class="relative flex-shrink-0 w-11 h-6 rounded-full transition-colors duration-300"
                                     :class="enabled ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                    <div class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow-md transition-transform duration-300"
                                         :class="enabled ? 'translate-x-5' : 'translate-x-0'"></div>
                                </div>
                            </div>

                            {{-- Coupon Required --}}
                            <div x-data="{ enabled: {{ old('coupon_required') ? 'true' : 'false' }} }"
                                 class="flex items-center justify-between gap-3 p-4 rounded-xl border transition-all duration-200 cursor-pointer
                                        border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 hover:border-indigo-300 dark:hover:border-indigo-600"
                                 @click="enabled = !enabled">
                                <input type="hidden" name="coupon_required" :value="enabled ? 1 : 0">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Coupon Required</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Needs coupon code</p>
                                </div>
                                <div class="relative flex-shrink-0 w-11 h-6 rounded-full transition-colors duration-300"
                                     :class="enabled ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                    <div class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow-md transition-transform duration-300"
                                         :class="enabled ? 'translate-x-5' : 'translate-x-0'"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- CONDITIONS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('conditions', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Conditions</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">When should this rule apply?</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addCondition()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Condition
                                    </button>
                                </div>

                                <div id="conditions-wrapper" class="space-y-3">
                                    @php $oldConditions = old('conditions', []); @endphp
                                    @foreach($oldConditions as $index => $condition)
                                        <div class="condition-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1 min-w-[140px]">
                                                <input type="text" name="conditions[{{ $index }}][field]"
                                                       value="{{ $condition['field'] ?? '' }}"
                                                       placeholder="Field e.g. subtotal"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="w-28">
                                                <select name="conditions[{{ $index }}][operator]"
                                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                                    @foreach(['=', '!=', '>', '>=', '<', '<=', 'in', 'not_in', 'between', 'contains'] as $op)
                                                        <option value="{{ $op }}" @selected(($condition['operator'] ?? '') === $op)>{{ $op }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex-1 min-w-[140px]">
                                                <input type="text" name="conditions[{{ $index }}][value]"
                                                       value="{{ $condition['value'] ?? '' }}"
                                                       placeholder="Value"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="w-20">
                                                <input type="number" name="conditions[{{ $index }}][sort_order]"
                                                       value="{{ $condition['sort_order'] ?? ($index + 1) }}"
                                                       placeholder="Sort"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'condition-row', 'conditions')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="conditions-empty" class="{{ count($oldConditions) > 0 ? 'hidden' : '' }} text-center py-8 text-gray-400 dark:text-gray-500 text-sm">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                    No conditions added yet. Click "Add Condition" to start.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- ACTIONS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: true }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Actions <span class="text-red-500">*</span></h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">What discount/action to apply?</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addAction()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Action
                                    </button>
                                </div>

                                <div id="actions-wrapper" class="space-y-3">
                                    @php $oldActions = old('actions', []); @endphp
                                    @foreach($oldActions as $index => $action)
                                        <div class="action-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1 min-w-[150px]">
                                                <select name="actions[{{ $index }}][action_type]"
                                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                                    @foreach(['percentage_discount' => 'Percentage Discount', 'fixed_discount' => 'Fixed Discount', 'free_shipping' => 'Free Shipping'] as $val => $label)
                                                        <option value="{{ $val }}" @selected(($action['action_type'] ?? '') === $val)>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex-1 min-w-[120px]">
                                                <input type="number" step="0.01"
                                                       name="actions[{{ $index }}][configuration][value]"
                                                       value="{{ $action['configuration']['value'] ?? '' }}"
                                                       placeholder="Value"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="flex-1 min-w-[120px]">
                                                <input type="number" step="0.01"
                                                       name="actions[{{ $index }}][configuration][max_discount]"
                                                       value="{{ $action['configuration']['max_discount'] ?? '' }}"
                                                       placeholder="Max Discount"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="w-20">
                                                <input type="number" name="actions[{{ $index }}][sort_order]"
                                                       value="{{ $action['sort_order'] ?? ($index + 1) }}"
                                                       placeholder="Sort"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'action-row', 'actions')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="actions-empty" class="{{ count($oldActions) > 0 ? 'hidden' : '' }} text-center py-8 text-gray-400 dark:text-gray-500 text-sm">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    No actions added yet. At least one action is required.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- PRODUCTS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('products', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Products</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Target specific products</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addProduct()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Product
                                    </button>
                                </div>

                                <div id="products-wrapper" class="space-y-3">
                                    @foreach(old('products', []) as $index => $product)
                                        <div class="product-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1 min-w-[150px]">
                                                <input type="number" name="products[{{ $index }}][product_id]"
                                                       value="{{ $product['product_id'] ?? '' }}"
                                                       placeholder="Product ID"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="flex-1 min-w-[150px]">
                                                <input type="number" step="0.01"
                                                       name="products[{{ $index }}][override_discount_value]"
                                                       value="{{ $product['override_discount_value'] ?? '' }}"
                                                       placeholder="Override Discount Value"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'product-row', 'products')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="products-empty" class="{{ count(old('products', [])) > 0 ? 'hidden' : '' }} text-center py-6 text-gray-400 dark:text-gray-500 text-sm">
                                    No products targeted. Applies to all products by default.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- CATEGORIES --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('categories', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Categories</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Target specific categories</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addCategory()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Category
                                    </button>
                                </div>

                                <div id="categories-wrapper" class="space-y-3">
                                    @foreach(old('categories', []) as $index => $category)
                                        <div class="category-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1 min-w-[150px]">
                                                <input type="number" name="categories[{{ $index }}][category_id]"
                                                       value="{{ $category['category_id'] ?? '' }}"
                                                       placeholder="Category ID"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <input type="hidden" name="categories[{{ $index }}][include_subcategories]" value="0">
                                                <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">
                                                    <input type="checkbox" name="categories[{{ $index }}][include_subcategories]"
                                                           value="1" class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700"
                                                           @checked($category['include_subcategories'] ?? true)>
                                                    Include Subcategories
                                                </label>
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'category-row', 'categories')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="categories-empty" class="{{ count(old('categories', [])) > 0 ? 'hidden' : '' }} text-center py-6 text-gray-400 dark:text-gray-500 text-sm">
                                    No categories targeted. Applies to all categories by default.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- CUSTOMER GROUPS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('customer_groups', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-teal-100 dark:bg-teal-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Customer Groups</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Restrict to specific customer segments</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addCustomerGroup()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Customer Group
                                    </button>
                                </div>

                                <div id="customer-groups-wrapper" class="space-y-3">
                                    @foreach(old('customer_groups', []) as $index => $group)
                                        <div class="customer-group-row group flex items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1">
                                                <input type="number" name="customer_groups[{{ $index }}][customer_group_id]"
                                                       value="{{ $group['customer_group_id'] ?? '' }}"
                                                       placeholder="Customer Group ID"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'customer-group-row', 'customer-groups')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="customer-groups-empty" class="{{ count(old('customer_groups', [])) > 0 ? 'hidden' : '' }} text-center py-6 text-gray-400 dark:text-gray-500 text-sm">
                                    No customer groups. Applies to all customers by default.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- COUPONS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('coupons', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-rose-100 dark:bg-rose-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Coupons</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Manage coupon codes for this rule</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addCoupon()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Coupon
                                    </button>
                                </div>

                                <div id="coupons-wrapper" class="space-y-3">
                                    @foreach(old('coupons', []) as $index => $coupon)
                                        <div class="coupon-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1 min-w-[140px]">
                                                <input type="text" name="coupons[{{ $index }}][code]"
                                                       value="{{ $coupon['code'] ?? '' }}"
                                                       placeholder="Coupon Code"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition font-mono uppercase">
                                            </div>
                                            <div class="w-28">
                                                <select name="coupons[{{ $index }}][type]"
                                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                                    <option value="shared" @selected(($coupon['type'] ?? '') === 'shared')>Shared</option>
                                                    <option value="unique" @selected(($coupon['type'] ?? '') === 'unique')>Unique</option>
                                                </select>
                                            </div>
                                            <div class="w-28">
                                                <input type="number" name="coupons[{{ $index }}][usage_limit]"
                                                       value="{{ $coupon['usage_limit'] ?? '' }}"
                                                       placeholder="Usage Limit"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <input type="hidden" name="coupons[{{ $index }}][is_active]" value="0">
                                                <label class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">
                                                    <input type="checkbox" name="coupons[{{ $index }}][is_active]"
                                                           value="1" class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700"
                                                           @checked($coupon['is_active'] ?? true)>
                                                    Active
                                                </label>
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'coupon-row', 'coupons')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="coupons-empty" class="{{ count(old('coupons', [])) > 0 ? 'hidden' : '' }} text-center py-6 text-gray-400 dark:text-gray-500 text-sm">
                                    No coupons added. Rule will apply automatically without a coupon code.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- SCHEDULES --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('schedules', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Schedules</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Set recurring time windows</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addSchedule()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Schedule
                                    </button>
                                </div>

                                <div id="schedules-wrapper" class="space-y-3">
                                    @foreach(old('schedules', []) as $index => $schedule)
                                        <div class="schedule-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="w-32">
                                                <select name="schedules[{{ $index }}][recurrence_type]"
                                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                                    @foreach(['daily', 'weekly', 'monthly', 'custom'] as $type)
                                                        <option value="{{ $type }}" @selected(($schedule['recurrence_type'] ?? '') === $type)>{{ ucfirst($type) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="w-24">
                                                <input type="number" name="schedules[{{ $index }}][day_of_week]"
                                                       value="{{ $schedule['day_of_week'] ?? '' }}"
                                                       placeholder="Day 0-6"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="w-24">
                                                <input type="number" name="schedules[{{ $index }}][day_of_month]"
                                                       value="{{ $schedule['day_of_month'] ?? '' }}"
                                                       placeholder="Day 1-31"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="w-32">
                                                <input type="time" name="schedules[{{ $index }}][time_from]"
                                                       value="{{ $schedule['time_from'] ?? '' }}"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="w-32">
                                                <input type="time" name="schedules[{{ $index }}][time_to]"
                                                       value="{{ $schedule['time_to'] ?? '' }}"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'schedule-row', 'schedules')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="schedules-empty" class="{{ count(old('schedules', [])) > 0 ? 'hidden' : '' }} text-center py-6 text-gray-400 dark:text-gray-500 text-sm">
                                    No schedules. Rule runs continuously within its start/end dates.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- TARGETS --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
                         x-data="{ open: {{ count(old('targets', [])) > 0 ? 'true' : 'false' }} }">

                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Targets</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Store / channel targeting</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="px-5 pb-5 border-t border-gray-100 dark:border-gray-800">
                                <div class="flex justify-end pt-4 mb-3">
                                    <button type="button" onclick="addTarget()"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Target
                                    </button>
                                </div>

                                <div id="targets-wrapper" class="space-y-3">
                                    @foreach(old('targets', []) as $index => $target)
                                        <div class="target-row group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                                            <div class="flex-1 min-w-[150px]">
                                                <input type="text" name="targets[{{ $index }}][target_type]"
                                                       value="{{ $target['target_type'] ?? '' }}"
                                                       placeholder="Target Type"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <div class="flex-1 min-w-[150px]">
                                                <input type="number" name="targets[{{ $index }}][target_id]"
                                                       value="{{ $target['target_id'] ?? '' }}"
                                                       placeholder="Target ID"
                                                       class="w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                            </div>
                                            <button type="button" onclick="removeRow(this, 'target-row', 'targets')"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="targets-empty" class="{{ count(old('targets', [])) > 0 ? 'hidden' : '' }} text-center py-6 text-gray-400 dark:text-gray-500 text-sm">
                                    No targets. Rule applies globally across all stores/channels.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─────────────────────────────────────────────── --}}
                    {{-- BOTTOM ACTION BAR --}}
                    {{-- ─────────────────────────────────────────────── --}}
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-5">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.price-rules.index') }}"
                               class="px-5 py-2.5 text-sm font-medium rounded-lg transition
                                      text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600
                                      hover:bg-gray-50 dark:hover:bg-gray-700">
                                Cancel
                            </a>
                            <button type="submit" name="action" value="draft"
                                    class="px-5 py-2.5 text-sm font-medium rounded-lg transition
                                           text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600
                                           hover:bg-gray-50 dark:hover:bg-gray-700">
                                Save Draft
                            </button>
                            <button type="submit"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 transition shadow-sm shadow-indigo-200 dark:shadow-none">
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
                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-5">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                </span>
                                Live Preview
                            </h3>

                            <div class="space-y-4">
                                {{-- WHEN --}}
                                <div class="border-l-2 border-amber-400 pl-3">
                                    <p class="text-[10px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider mb-1">When</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300" id="preview-conditions">
                                        No conditions set — applies to all
                                    </p>
                                </div>

                                {{-- THEN --}}
                                <div class="border-l-2 border-green-400 pl-3">
                                    <p class="text-[10px] font-bold text-green-600 dark:text-green-400 uppercase tracking-wider mb-1">Then</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300" id="preview-actions">
                                        No action defined yet
                                    </p>
                                </div>

                                {{-- STATUS --}}
                                <div class="border-l-2 border-indigo-400 pl-3">
                                    <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-1">Status</p>
                                    <div>
                                        <span id="preview-status"
                                              class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                            Draft
                                        </span>
                                    </div>
                                </div>

                                {{-- SCHEDULE --}}
                                <div class="border-l-2 border-cyan-400 pl-3">
                                    <p class="text-[10px] font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider mb-1">Schedule</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300" id="preview-schedule">
                                        Always active
                                    </p>
                                </div>

                                {{-- COUPONS --}}
                                <div class="border-l-2 border-rose-400 pl-3">
                                    <p class="text-[10px] font-bold text-rose-600 dark:text-rose-400 uppercase tracking-wider mb-1">Coupon</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300" id="preview-coupon">
                                        Not required
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Help Card --}}
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 rounded-2xl border border-indigo-100 dark:border-indigo-800 p-5">
                            <h4 class="text-sm font-semibold text-indigo-900 dark:text-indigo-300 mb-2">💡 Quick Tips</h4>
                            <ul class="space-y-2 text-xs text-indigo-700 dark:text-indigo-400">
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
                                    <span>Add <strong>conditions</strong> like <code class="bg-white/60 dark:bg-gray-700/60 px-1 rounded">subtotal >= 500</code> to target specific carts.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 w-1 h-1 rounded-full bg-indigo-400 flex-shrink-0"></span>
                                    <span>Use <strong>schedules</strong> for recurring promotions (e.g., every weekend).</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </form>
</div>
</div>
@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    // ─── Shared CSS Class Strings ──────────────────────────────
    const inputCls  = 'w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 px-3.5 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/30 transition';
    const rowCls    = 'group flex flex-wrap items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700';
    const deleteSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>';

    function makeDeleteBtn(rowClass, section) {
        return '<button type="button" onclick="removeRow(this, \'' + rowClass + '\', \'' + section + '\')" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">' + deleteSvg + '</button>';
    }

    // ─── Index Counters ────────────────────────────────────────
    let conditionIndex     = {{ count(old('conditions', [])) }};
    let actionIndex        = {{ count(old('actions', [])) }};
    let productIndex       = {{ count(old('products', [])) }};
    let categoryIndex      = {{ count(old('categories', [])) }};
    let customerGroupIndex = {{ count(old('customer_groups', [])) }};
    let couponIndex        = {{ count(old('coupons', [])) }};
    let scheduleIndex      = {{ count(old('schedules', [])) }};
    let targetIndex        = {{ count(old('targets', [])) }};

    // ─── Generic Remove Row ────────────────────────────────────
    function removeRow(btn, rowClass, section) {
        btn.closest('.' + rowClass).remove();
        showEmptyIfNeeded(section);
        updatePreview();
    }

    function showEmptyIfNeeded(section) {
        var wrapper = document.getElementById(section + '-wrapper');
        var empty   = document.getElementById(section + '-empty');
        if (wrapper && empty) {
            if (wrapper.children.length === 0) {
                empty.classList.remove('hidden');
            } else {
                empty.classList.add('hidden');
            }
        }
    }

    function hideEmpty(section) {
        var el = document.getElementById(section + '-empty');
        if (el) el.classList.add('hidden');
    }

    // ─── Add Condition ─────────────────────────────────────────
    function addCondition() {
        var i = conditionIndex++;
        var html = '<div class="condition-row ' + rowCls + '">'
            + '<div class="flex-1 min-w-[140px]">'
            + '<input type="text" name="conditions[' + i + '][field]" class="' + inputCls + '" placeholder="Field e.g. subtotal" oninput="updatePreview()">'
            + '</div>'
            + '<div class="w-28">'
            + '<select name="conditions[' + i + '][operator]" class="' + inputCls + '" onchange="updatePreview()">'
            + '<option value="=">=</option>'
            + '<option value="!=">!=</option>'
            + '<option value=">">&gt;</option>'
            + '<option value=">=">&gt;=</option>'
            + '<option value="<">&lt;</option>'
            + '<option value="<=">&lt;=</option>'
            + '<option value="in">in</option>'
            + '<option value="not_in">not_in</option>'
            + '<option value="between">between</option>'
            + '<option value="contains">contains</option>'
            + '</select>'
            + '</div>'
            + '<div class="flex-1 min-w-[140px]">'
            + '<input type="text" name="conditions[' + i + '][value]" class="' + inputCls + '" placeholder="Value" oninput="updatePreview()">'
            + '</div>'
            + '<div class="w-20">'
            + '<input type="number" name="conditions[' + i + '][sort_order]" value="' + (i + 1) + '" class="' + inputCls + '" placeholder="Sort">'
            + '</div>'
            + makeDeleteBtn('condition-row', 'conditions')
            + '</div>';
        document.getElementById('conditions-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('conditions');
    }

    // ─── Add Action ────────────────────────────────────────────
    function addAction() {
        var i = actionIndex++;
        var html = '<div class="action-row ' + rowCls + '">'
            + '<div class="flex-1 min-w-[150px]">'
            + '<select name="actions[' + i + '][action_type]" class="' + inputCls + '" onchange="updatePreview()">'
            + '<option value="percentage_discount">Percentage Discount</option>'
            + '<option value="fixed_discount">Fixed Discount</option>'
            + '<option value="free_shipping">Free Shipping</option>'
            + '</select>'
            + '</div>'
            + '<div class="flex-1 min-w-[120px]">'
            + '<input type="number" step="0.01" name="actions[' + i + '][configuration][value]" class="' + inputCls + '" placeholder="Value" oninput="updatePreview()">'
            + '</div>'
            + '<div class="flex-1 min-w-[120px]">'
            + '<input type="number" step="0.01" name="actions[' + i + '][configuration][max_discount]" class="' + inputCls + '" placeholder="Max Discount">'
            + '</div>'
            + '<div class="w-20">'
            + '<input type="number" name="actions[' + i + '][sort_order]" value="' + (i + 1) + '" class="' + inputCls + '" placeholder="Sort">'
            + '</div>'
            + makeDeleteBtn('action-row', 'actions')
            + '</div>';
        document.getElementById('actions-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('actions');
    }

    // ─── Add Product ───────────────────────────────────────────
    function addProduct() {
        var i = productIndex++;
        var html = '<div class="product-row ' + rowCls + '">'
            + '<div class="flex-1 min-w-[150px]">'
            + '<input type="number" name="products[' + i + '][product_id]" class="' + inputCls + '" placeholder="Product ID">'
            + '</div>'
            + '<div class="flex-1 min-w-[150px]">'
            + '<input type="number" step="0.01" name="products[' + i + '][override_discount_value]" class="' + inputCls + '" placeholder="Override Discount Value">'
            + '</div>'
            + makeDeleteBtn('product-row', 'products')
            + '</div>';
        document.getElementById('products-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('products');
    }

    // ─── Add Category ──────────────────────────────────────────
    function addCategory() {
        var i = categoryIndex++;
        var html = '<div class="category-row ' + rowCls + '">'
            + '<div class="flex-1 min-w-[150px]">'
            + '<input type="number" name="categories[' + i + '][category_id]" class="' + inputCls + '" placeholder="Category ID">'
            + '</div>'
            + '<div class="flex items-center gap-2">'
            + '<input type="hidden" name="categories[' + i + '][include_subcategories]" value="0">'
            + '<label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">'
            + '<input type="checkbox" name="categories[' + i + '][include_subcategories]" value="1" class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700" checked>'
            + 'Include Subcategories'
            + '</label>'
            + '</div>'
            + makeDeleteBtn('category-row', 'categories')
            + '</div>';
        document.getElementById('categories-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('categories');
    }

    // ─── Add Customer Group ────────────────────────────────────
    function addCustomerGroup() {
        var i = customerGroupIndex++;
        var html = '<div class="customer-group-row ' + rowCls + '">'
            + '<div class="flex-1">'
            + '<input type="number" name="customer_groups[' + i + '][customer_group_id]" class="' + inputCls + '" placeholder="Customer Group ID">'
            + '</div>'
            + makeDeleteBtn('customer-group-row', 'customer-groups')
            + '</div>';
        document.getElementById('customer-groups-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('customer-groups');
    }

    // ─── Add Coupon ────────────────────────────────────────────
    function addCoupon() {
        var i = couponIndex++;
        var html = '<div class="coupon-row ' + rowCls + '">'
            + '<div class="flex-1 min-w-[140px]">'
            + '<input type="text" name="coupons[' + i + '][code]" class="' + inputCls + ' font-mono uppercase" placeholder="Coupon Code" oninput="updatePreview()">'
            + '</div>'
            + '<div class="w-28">'
            + '<select name="coupons[' + i + '][type]" class="' + inputCls + '">'
            + '<option value="shared">Shared</option>'
            + '<option value="unique">Unique</option>'
            + '</select>'
            + '</div>'
            + '<div class="w-28">'
            + '<input type="number" name="coupons[' + i + '][usage_limit]" class="' + inputCls + '" placeholder="Usage Limit">'
            + '</div>'
            + '<div class="flex items-center gap-2">'
            + '<input type="hidden" name="coupons[' + i + '][is_active]" value="0">'
            + '<label class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">'
            + '<input type="checkbox" name="coupons[' + i + '][is_active]" value="1" class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700" checked>'
            + 'Active'
            + '</label>'
            + '</div>'
            + makeDeleteBtn('coupon-row', 'coupons')
            + '</div>';
        document.getElementById('coupons-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('coupons');
    }

    // ─── Add Schedule ──────────────────────────────────────────
    function addSchedule() {
        var i = scheduleIndex++;
        var html = '<div class="schedule-row ' + rowCls + '">'
            + '<div class="w-32">'
            + '<select name="schedules[' + i + '][recurrence_type]" class="' + inputCls + '" onchange="updatePreview()">'
            + '<option value="daily">Daily</option>'
            + '<option value="weekly">Weekly</option>'
            + '<option value="monthly">Monthly</option>'
            + '<option value="custom">Custom</option>'
            + '</select>'
            + '</div>'
            + '<div class="w-24">'
            + '<input type="number" name="schedules[' + i + '][day_of_week]" class="' + inputCls + '" placeholder="Day 0-6">'
            + '</div>'
            + '<div class="w-24">'
            + '<input type="number" name="schedules[' + i + '][day_of_month]" class="' + inputCls + '" placeholder="Day 1-31">'
            + '</div>'
            + '<div class="w-32">'
            + '<input type="time" name="schedules[' + i + '][time_from]" class="' + inputCls + '" onchange="updatePreview()">'
            + '</div>'
            + '<div class="w-32">'
            + '<input type="time" name="schedules[' + i + '][time_to]" class="' + inputCls + '" onchange="updatePreview()">'
            + '</div>'
            + makeDeleteBtn('schedule-row', 'schedules')
            + '</div>';
        document.getElementById('schedules-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('schedules');
    }

    // ─── Add Target ────────────────────────────────────────────
    function addTarget() {
        var i = targetIndex++;
        var html = '<div class="target-row ' + rowCls + '">'
            + '<div class="flex-1 min-w-[150px]">'
            + '<input type="text" name="targets[' + i + '][target_type]" class="' + inputCls + '" placeholder="Target Type">'
            + '</div>'
            + '<div class="flex-1 min-w-[150px]">'
            + '<input type="number" name="targets[' + i + '][target_id]" class="' + inputCls + '" placeholder="Target ID">'
            + '</div>'
            + makeDeleteBtn('target-row', 'targets')
            + '</div>';
        document.getElementById('targets-wrapper').insertAdjacentHTML('beforeend', html);
        hideEmpty('targets');
    }

    // ─── Live Preview Updater ──────────────────────────────────
    function updatePreview() {
        // ── Status ──
        var statusEl  = document.getElementById('status');
        var previewSt = document.getElementById('preview-status');
        var statusMap = {
            draft:     'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300',
            scheduled: 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400',
            active:    'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400',
            expired:   'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400'
        };
        if (statusEl && previewSt) {
            var val = statusEl.value;
            previewSt.textContent = val.charAt(0).toUpperCase() + val.slice(1);
            previewSt.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' + (statusMap[val] || statusMap.draft);
        }

        // ── Conditions ──
        var condRows    = document.querySelectorAll('.condition-row');
        var previewCond = document.getElementById('preview-conditions');
        if (previewCond) {
            if (condRows.length === 0) {
                previewCond.textContent = 'No conditions set — applies to all';
            } else {
                var parts = [];
                condRows.forEach(function(row) {
                    var field = row.querySelector('[name*="[field]"]');
                    var op    = row.querySelector('[name*="[operator]"]');
                    var val   = row.querySelector('[name*="[value]"]');
                    var f = field ? field.value : '?';
                    var o = op ? op.value : '=';
                    var v = val ? val.value : '?';
                    if (f || v) parts.push(f + ' ' + o + ' ' + v);
                });
                previewCond.textContent = parts.length ? parts.join(' & ') : 'No conditions set — applies to all';
            }
        }

        // ── Actions ──
        var actRows    = document.querySelectorAll('.action-row');
        var previewAct = document.getElementById('preview-actions');
        if (previewAct) {
            if (actRows.length === 0) {
                previewAct.textContent = 'No action defined yet';
            } else {
                var actionParts = [];
                actRows.forEach(function(row) {
                    var typeEl = row.querySelector('[name*="[action_type]"]');
                    var valEl  = row.querySelector('[name*="[configuration][value]"]');
                    var type   = typeEl ? typeEl.value : '';
                    var val    = valEl ? valEl.value : '';
                    var label  = type.replace(/_/g, ' ').replace(/\b\w/g, function(c) { return c.toUpperCase(); });
                    if (val) {
                        var symbol = type.indexOf('percentage') !== -1 ? '%' : '₹';
                        actionParts.push('Apply ' + val + symbol + ' ' + label);
                    } else {
                        actionParts.push(label);
                    }
                });
                previewAct.textContent = actionParts.join(', ');
            }
        }

        // ── Schedule ──
        var schedRows    = document.querySelectorAll('.schedule-row');
        var previewSched = document.getElementById('preview-schedule');
        var startsAtEl   = document.getElementById('starts_at');
        var endsAtEl     = document.getElementById('ends_at');
        var startsAt     = startsAtEl ? startsAtEl.value : '';
        var endsAt       = endsAtEl ? endsAtEl.value : '';

        if (previewSched) {
            if (startsAt || endsAt) {
                var txt = '';
                if (startsAt) txt += 'From ' + new Date(startsAt).toLocaleDateString('en-IN');
                if (endsAt)   txt += ' to ' + new Date(endsAt).toLocaleDateString('en-IN');
                if (schedRows.length > 0) {
                    txt += ' (' + schedRows.length + ' recurring schedule' + (schedRows.length > 1 ? 's' : '') + ')';
                }
                previewSched.textContent = txt.trim();
            } else if (schedRows.length > 0) {
                previewSched.textContent = schedRows.length + ' recurring schedule' + (schedRows.length > 1 ? 's' : '');
            } else {
                previewSched.textContent = 'Always active';
            }
        }

        // ── Coupon ──
        var coupRows      = document.querySelectorAll('.coupon-row');
        var previewCoupon = document.getElementById('preview-coupon');
        if (previewCoupon) {
            if (coupRows.length === 0) {
                previewCoupon.textContent = 'Not required';
            } else {
                var codes = [];
                coupRows.forEach(function(row) {
                    var codeEl = row.querySelector('[name*="[code]"]');
                    var code   = codeEl ? codeEl.value : '';
                    if (code) codes.push(code.toUpperCase());
                });
                previewCoupon.textContent = codes.length ? codes.join(', ') : coupRows.length + ' coupon(s)';
            }
        }
    }

    // ─── Auto-generate Slug from Name ──────────────────────────
    var nameInput = document.getElementById('name');
    var slugInput = document.getElementById('slug');
    var slugManuallyEdited = false;

    if (slugInput) {
        slugInput.addEventListener('input', function() {
            slugManuallyEdited = true;
        });
    }

    if (nameInput) {
        nameInput.addEventListener('input', function() {
            if (!slugManuallyEdited && slugInput) {
                slugInput.value = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
            }
            updatePreview();
        });
    }

    // ─── Quick Template Presets ────────────────────────────────
    function applyTemplate(type) {
        // Clear existing actions
        document.getElementById('actions-wrapper').innerHTML = '';
        actionIndex = 0;

        // Clear existing conditions
        document.getElementById('conditions-wrapper').innerHTML = '';
        conditionIndex = 0;

        if (type === 'cart_discount') {
            document.getElementById('name').value = 'Cart Discount';
            slugManuallyEdited = false;
            nameInput.dispatchEvent(new Event('input'));

            // Add a condition: subtotal >= 500
            addCondition();
            var lastCondField = document.querySelector('.condition-row:last-child [name*="[field]"]');
            var lastCondOp    = document.querySelector('.condition-row:last-child [name*="[operator]"]');
            var lastCondVal   = document.querySelector('.condition-row:last-child [name*="[value]"]');
            if (lastCondField) lastCondField.value = 'subtotal';
            if (lastCondOp)    lastCondOp.value = '>=';
            if (lastCondVal)   lastCondVal.value = '500';

            // Add an action: percentage_discount 10%
            addAction();
            var lastActType = document.querySelector('.action-row:last-child [name*="[action_type]"]');
            var lastActVal  = document.querySelector('.action-row:last-child [name*="[configuration][value]"]');
            if (lastActType) lastActType.value = 'percentage_discount';
            if (lastActVal)  lastActVal.value = '10';

        } else if (type === 'bxgy') {
            document.getElementById('name').value = 'Buy X Get Y';
            slugManuallyEdited = false;
            nameInput.dispatchEvent(new Event('input'));

            // Add a condition: quantity >= 2
            addCondition();
            var bxgyField = document.querySelector('.condition-row:last-child [name*="[field]"]');
            var bxgyOp    = document.querySelector('.condition-row:last-child [name*="[operator]"]');
            var bxgyVal   = document.querySelector('.condition-row:last-child [name*="[value]"]');
            if (bxgyField) bxgyField.value = 'quantity';
            if (bxgyOp)    bxgyOp.value = '>=';
            if (bxgyVal)   bxgyVal.value = '2';

            // Add an action: fixed_discount
            addAction();
            var bxgyActType = document.querySelector('.action-row:last-child [name*="[action_type]"]');
            var bxgyActVal  = document.querySelector('.action-row:last-child [name*="[configuration][value]"]');
            if (bxgyActType) bxgyActType.value = 'fixed_discount';
            if (bxgyActVal)  bxgyActVal.value = '0';

        } else if (type === 'free_shipping') {
            document.getElementById('name').value = 'Free Shipping';
            slugManuallyEdited = false;
            nameInput.dispatchEvent(new Event('input'));

            // Add an action: free_shipping
            addAction();
            var fsActType = document.querySelector('.action-row:last-child [name*="[action_type]"]');
            if (fsActType) fsActType.value = 'free_shipping';
        }

        updatePreview();
    }

    // ─── Bind Live Preview to Existing Inputs on Load ──────────
    document.addEventListener('DOMContentLoaded', function() {
        var statusEl   = document.getElementById('status');
        var startsAtEl = document.getElementById('starts_at');
        var endsAtEl   = document.getElementById('ends_at');

        if (statusEl)   statusEl.addEventListener('change', updatePreview);
        if (startsAtEl) startsAtEl.addEventListener('change', updatePreview);
        if (endsAtEl)   endsAtEl.addEventListener('change', updatePreview);

        // Bind existing condition/action rows oninput
        document.querySelectorAll('.condition-row input, .condition-row select').forEach(function(el) {
            el.addEventListener('input', updatePreview);
            el.addEventListener('change', updatePreview);
        });

        document.querySelectorAll('.action-row input, .action-row select').forEach(function(el) {
            el.addEventListener('input', updatePreview);
            el.addEventListener('change', updatePreview);
        });

        document.querySelectorAll('.coupon-row input').forEach(function(el) {
            el.addEventListener('input', updatePreview);
        });

        document.querySelectorAll('.schedule-row input, .schedule-row select').forEach(function(el) {
            el.addEventListener('input', updatePreview);
            el.addEventListener('change', updatePreview);
        });

        // Initial preview render
        updatePreview();
    });
</script>
@endpush