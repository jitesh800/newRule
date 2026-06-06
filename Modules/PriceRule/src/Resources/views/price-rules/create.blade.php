@extends('pricerule::layouts.app')

@section('title', 'Create Price Rule')
@section('page-title', 'Create Price Rule')

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Create Price Rule</h1>
            <p class="text-muted mb-0">
                Create a new pricing rule with conditions, actions, coupons and targeting options.
            </p>
        </div>

        <a href="{{ route('admin.price-rules.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Create Form --}}
    <form action="{{ route('admin.price-rules.store') }}" method="POST">
        @csrf

        {{-- Basic Information --}}
        <div class="card mb-4">
            <div class="card-header bg-white">
                <strong>Basic Information</strong>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    {{-- Rule Type --}}
                    <div class="col-md-6">
                        <label for="rule_type_id" class="form-label">
                            Rule Type <span class="text-danger">*</span>
                        </label>

                        <select name="rule_type_id"
                                id="rule_type_id"
                                class="form-select @error('rule_type_id') is-invalid @enderror">
                            <option value="">Select Rule Type</option>

                            @foreach($ruleTypes as $ruleType)
                                <option value="{{ $ruleType->id }}"
                                    @selected(old('rule_type_id') == $ruleType->id)>
                                    {{ $ruleType->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('rule_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">
                            Rule Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Example: Summer Sale 20% Off">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="col-md-6">
                        <label for="slug" class="form-label">
                            Slug <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug') }}"
                               class="form-control @error('slug') is-invalid @enderror"
                               placeholder="summer-sale-20-off">

                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label">
                            Status <span class="text-danger">*</span>
                        </label>

                        <select name="status"
                                id="status"
                                class="form-select @error('status') is-invalid @enderror">
                            @foreach(['draft', 'scheduled', 'active', 'expired'] as $status)
                                <option value="{{ $status }}"
                                    @selected(old('status', 'draft') === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12">
                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Short description about this rule">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Starts At --}}
                    <div class="col-md-3">
                        <label for="starts_at" class="form-label">
                            Starts At
                        </label>

                        <input type="datetime-local"
                               name="starts_at"
                               id="starts_at"
                               value="{{ old('starts_at') }}"
                               class="form-control @error('starts_at') is-invalid @enderror">

                        @error('starts_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ends At --}}
                    <div class="col-md-3">
                        <label for="ends_at" class="form-label">
                            Ends At
                        </label>

                        <input type="datetime-local"
                               name="ends_at"
                               id="ends_at"
                               value="{{ old('ends_at') }}"
                               class="form-control @error('ends_at') is-invalid @enderror">

                        @error('ends_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Priority --}}
                    <div class="col-md-3">
                        <label for="priority" class="form-label">
                            Priority <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               name="priority"
                               id="priority"
                               value="{{ old('priority', 100) }}"
                               min="0"
                               max="65535"
                               class="form-control @error('priority') is-invalid @enderror">

                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Condition Match --}}
                    <div class="col-md-3">
                        <label for="condition_match" class="form-label">
                            Condition Match <span class="text-danger">*</span>
                        </label>

                        <select name="condition_match"
                                id="condition_match"
                                class="form-select @error('condition_match') is-invalid @enderror">
                            <option value="all" @selected(old('condition_match', 'all') === 'all')>
                                Match All Conditions
                            </option>
                            <option value="any" @selected(old('condition_match') === 'any')>
                                Match Any Condition
                            </option>
                        </select>

                        @error('condition_match')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Booleans --}}
                    <div class="col-md-4">
                        <input type="hidden" name="stop_further_rules" value="0">

                        <div class="form-check mt-4">
                            <input type="checkbox"
                                   name="stop_further_rules"
                                   id="stop_further_rules"
                                   value="1"
                                   class="form-check-input"
                                   @checked(old('stop_further_rules'))>

                            <label for="stop_further_rules" class="form-check-label">
                                Stop Further Rules
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" name="is_combinable" value="0">

                        <div class="form-check mt-4">
                            <input type="checkbox"
                                   name="is_combinable"
                                   id="is_combinable"
                                   value="1"
                                   class="form-check-input"
                                   @checked(old('is_combinable', 1))>

                            <label for="is_combinable" class="form-check-label">
                                Is Combinable
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" name="coupon_required" value="0">

                        <div class="form-check mt-4">
                            <input type="checkbox"
                                   name="coupon_required"
                                   id="coupon_required"
                                   value="1"
                                   class="form-check-input"
                                   @checked(old('coupon_required'))>

                            <label for="coupon_required" class="form-check-label">
                                Coupon Required
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Conditions --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Conditions</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addCondition()">
                    Add Condition
                </button>
            </div>

            <div class="card-body" id="conditions-wrapper">
                @php
                    $oldConditions = old('conditions', []);
                @endphp

                @foreach($oldConditions as $index => $condition)
                    <div class="row g-2 mb-2 condition-row">
                        <div class="col-md-3">
                            <input type="text"
                                   name="conditions[{{ $index }}][field]"
                                   value="{{ $condition['field'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Field e.g. subtotal">
                        </div>

                        <div class="col-md-2">
                            <select name="conditions[{{ $index }}][operator]" class="form-select">
                                @foreach(['=', '!=', '>', '>=', '<', '<=', 'in', 'not_in', 'between', 'contains'] as $operator)
                                    <option value="{{ $operator }}"
                                        @selected(($condition['operator'] ?? '') === $operator)>
                                        {{ $operator }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text"
                                   name="conditions[{{ $index }}][value]"
                                   value="{{ $condition['value'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Value">
                        </div>

                        <div class="col-md-2">
                            <input type="number"
                                   name="conditions[{{ $index }}][sort_order]"
                                   value="{{ $condition['sort_order'] ?? ($index + 1) }}"
                                   class="form-control"
                                   placeholder="Sort">
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.condition-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Actions --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Actions <span class="text-danger">*</span></strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addAction()">
                    Add Action
                </button>
            </div>

            <div class="card-body" id="actions-wrapper">
                @php
                    $oldActions = old('actions', []);
                @endphp

                @foreach($oldActions as $index => $action)
                    <div class="row g-2 mb-2 action-row">
                        <div class="col-md-3">
                            <select name="actions[{{ $index }}][action_type]" class="form-select">
                                @foreach(['percentage_discount', 'fixed_discount', 'free_shipping'] as $type)
                                    <option value="{{ $type }}"
                                        @selected(($action['action_type'] ?? '') === $type)>
                                        {{ ucwords(str_replace('_', ' ', $type)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="number"
                                   step="0.01"
                                   name="actions[{{ $index }}][configuration][value]"
                                   value="{{ $action['configuration']['value'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Value">
                        </div>

                        <div class="col-md-3">
                            <input type="number"
                                   step="0.01"
                                   name="actions[{{ $index }}][configuration][max_discount]"
                                   value="{{ $action['configuration']['max_discount'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Max Discount">
                        </div>

                        <div class="col-md-1">
                            <input type="number"
                                   name="actions[{{ $index }}][sort_order]"
                                   value="{{ $action['sort_order'] ?? ($index + 1) }}"
                                   class="form-control"
                                   placeholder="Sort">
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.action-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Products --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Products</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addProduct()">
                    Add Product
                </button>
            </div>

            <div class="card-body" id="products-wrapper">
                @foreach(old('products', []) as $index => $product)
                    <div class="row g-2 mb-2 product-row">
                        <div class="col-md-5">
                            <input type="number"
                                   name="products[{{ $index }}][product_id]"
                                   value="{{ $product['product_id'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Product ID">
                        </div>

                        <div class="col-md-5">
                            <input type="number"
                                   step="0.01"
                                   name="products[{{ $index }}][override_discount_value]"
                                   value="{{ $product['override_discount_value'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Override Discount Value">
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.product-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Categories --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Categories</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addCategory()">
                    Add Category
                </button>
            </div>

            <div class="card-body" id="categories-wrapper">
                @foreach(old('categories', []) as $index => $category)
                    <div class="row g-2 mb-2 category-row">
                        <div class="col-md-5">
                            <input type="number"
                                   name="categories[{{ $index }}][category_id]"
                                   value="{{ $category['category_id'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Category ID">
                        </div>

                        <div class="col-md-5">
                            <input type="hidden"
                                   name="categories[{{ $index }}][include_subcategories]"
                                   value="0">

                            <div class="form-check mt-2">
                                <input type="checkbox"
                                       name="categories[{{ $index }}][include_subcategories]"
                                       value="1"
                                       class="form-check-input"
                                       @checked($category['include_subcategories'] ?? true)>

                                <label class="form-check-label">
                                    Include Subcategories
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.category-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Customer Groups --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Customer Groups</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addCustomerGroup()">
                    Add Customer Group
                </button>
            </div>

            <div class="card-body" id="customer-groups-wrapper">
                @foreach(old('customer_groups', []) as $index => $group)
                    <div class="row g-2 mb-2 customer-group-row">
                        <div class="col-md-10">
                            <input type="number"
                                   name="customer_groups[{{ $index }}][customer_group_id]"
                                   value="{{ $group['customer_group_id'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Customer Group ID">
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.customer-group-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Coupons --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Coupons</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addCoupon()">
                    Add Coupon
                </button>
            </div>

            <div class="card-body" id="coupons-wrapper">
                @foreach(old('coupons', []) as $index => $coupon)
                    <div class="row g-2 mb-2 coupon-row">
                        <div class="col-md-3">
                            <input type="text"
                                   name="coupons[{{ $index }}][code]"
                                   value="{{ $coupon['code'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Coupon Code">
                        </div>

                        <div class="col-md-2">
                            <select name="coupons[{{ $index }}][type]" class="form-select">
                                <option value="shared" @selected(($coupon['type'] ?? '') === 'shared')>
                                    Shared
                                </option>
                                <option value="unique" @selected(($coupon['type'] ?? '') === 'unique')>
                                    Unique
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="number"
                                   name="coupons[{{ $index }}][usage_limit]"
                                   value="{{ $coupon['usage_limit'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Usage Limit">
                        </div>

                        <div class="col-md-3">
                            <input type="hidden"
                                   name="coupons[{{ $index }}][is_active]"
                                   value="0">

                            <div class="form-check mt-2">
                                <input type="checkbox"
                                       name="coupons[{{ $index }}][is_active]"
                                       value="1"
                                       class="form-check-input"
                                       @checked($coupon['is_active'] ?? true)>

                                <label class="form-check-label">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.coupon-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Schedules --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Schedules</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addSchedule()">
                    Add Schedule
                </button>
            </div>

            <div class="card-body" id="schedules-wrapper">
                @foreach(old('schedules', []) as $index => $schedule)
                    <div class="row g-2 mb-2 schedule-row">
                        <div class="col-md-2">
                            <select name="schedules[{{ $index }}][recurrence_type]" class="form-select">
                                @foreach(['daily', 'weekly', 'monthly', 'custom'] as $type)
                                    <option value="{{ $type }}"
                                        @selected(($schedule['recurrence_type'] ?? '') === $type)>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="number"
                                   name="schedules[{{ $index }}][day_of_week]"
                                   value="{{ $schedule['day_of_week'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Day Week 0-6">
                        </div>

                        <div class="col-md-2">
                            <input type="number"
                                   name="schedules[{{ $index }}][day_of_month]"
                                   value="{{ $schedule['day_of_month'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Day Month">
                        </div>

                        <div class="col-md-2">
                            <input type="time"
                                   name="schedules[{{ $index }}][time_from]"
                                   value="{{ $schedule['time_from'] ?? '' }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-2">
                            <input type="time"
                                   name="schedules[{{ $index }}][time_to]"
                                   value="{{ $schedule['time_to'] ?? '' }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.schedule-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Targets --}}
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Targets</strong>

                <button type="button" class="btn btn-sm btn-primary" onclick="addTarget()">
                    Add Target
                </button>
            </div>

            <div class="card-body" id="targets-wrapper">
                @foreach(old('targets', []) as $index => $target)
                    <div class="row g-2 mb-2 target-row">
                        <div class="col-md-5">
                            <input type="text"
                                   name="targets[{{ $index }}][target_type]"
                                   value="{{ $target['target_type'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Target Type">
                        </div>

                        <div class="col-md-5">
                            <input type="number"
                                   name="targets[{{ $index }}][target_id]"
                                   value="{{ $target['target_id'] ?? '' }}"
                                   class="form-control"
                                   placeholder="Target ID">
                        </div>

                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="this.closest('.target-row').remove()">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="card mb-5">
            <div class="card-body d-flex justify-content-end gap-2">
                <a href="{{ route('admin.price-rules.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-success">
                    Create Price Rule
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    let conditionIndex = {{ count(old('conditions', [])) }};
    let actionIndex = {{ count(old('actions', [])) }};
    let productIndex = {{ count(old('products', [])) }};
    let categoryIndex = {{ count(old('categories', [])) }};
    let customerGroupIndex = {{ count(old('customer_groups', [])) }};
    let couponIndex = {{ count(old('coupons', [])) }};
    let scheduleIndex = {{ count(old('schedules', [])) }};
    let targetIndex = {{ count(old('targets', [])) }};

    function addCondition() {
        const html = `
            <div class="row g-2 mb-2 condition-row">
                <div class="col-md-3">
                    <input type="text" name="conditions[${conditionIndex}][field]" class="form-control" placeholder="Field e.g. subtotal">
                </div>

                <div class="col-md-2">
                    <select name="conditions[${conditionIndex}][operator]" class="form-select">
                        <option value="=">=</option>
                        <option value="!=">!=</option>
                        <option value=">">&gt;</option>
                        <option value=">=">&gt;=</option>
                        <option value="<">&lt;</option>
                        <option value="<=">&lt;=</option>
                        <option value="in">in</option>
                        <option value="not_in">not_in</option>
                        <option value="between">between</option>
                        <option value="contains">contains</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" name="conditions[${conditionIndex}][value]" class="form-control" placeholder="Value">
                </div>

                <div class="col-md-2">
                    <input type="number" name="conditions[${conditionIndex}][sort_order]" value="${conditionIndex + 1}" class="form-control" placeholder="Sort">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.condition-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('conditions-wrapper').insertAdjacentHTML('beforeend', html);
        conditionIndex++;
    }

    function addAction() {
        const html = `
            <div class="row g-2 mb-2 action-row">
                <div class="col-md-3">
                    <select name="actions[${actionIndex}][action_type]" class="form-select">
                        <option value="percentage_discount">Percentage Discount</option>
                        <option value="fixed_discount">Fixed Discount</option>
                        <option value="free_shipping">Free Shipping</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="number" step="0.01" name="actions[${actionIndex}][configuration][value]" class="form-control" placeholder="Value">
                </div>

                <div class="col-md-3">
                    <input type="number" step="0.01" name="actions[${actionIndex}][configuration][max_discount]" class="form-control" placeholder="Max Discount">
                </div>

                <div class="col-md-1">
                    <input type="number" name="actions[${actionIndex}][sort_order]" value="${actionIndex + 1}" class="form-control" placeholder="Sort">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.action-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('actions-wrapper').insertAdjacentHTML('beforeend', html);
        actionIndex++;
    }

    function addProduct() {
        const html = `
            <div class="row g-2 mb-2 product-row">
                <div class="col-md-5">
                    <input type="number" name="products[${productIndex}][product_id]" class="form-control" placeholder="Product ID">
                </div>

                <div class="col-md-5">
                    <input type="number" step="0.01" name="products[${productIndex}][override_discount_value]" class="form-control" placeholder="Override Discount Value">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.product-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('products-wrapper').insertAdjacentHTML('beforeend', html);
        productIndex++;
    }

    function addCategory() {
        const html = `
            <div class="row g-2 mb-2 category-row">
                <div class="col-md-5">
                    <input type="number" name="categories[${categoryIndex}][category_id]" class="form-control" placeholder="Category ID">
                </div>

                <div class="col-md-5">
                    <input type="hidden" name="categories[${categoryIndex}][include_subcategories]" value="0">

                    <div class="form-check mt-2">
                        <input type="checkbox" name="categories[${categoryIndex}][include_subcategories]" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Include Subcategories</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.category-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('categories-wrapper').insertAdjacentHTML('beforeend', html);
        categoryIndex++;
    }

    function addCustomerGroup() {
        const html = `
            <div class="row g-2 mb-2 customer-group-row">
                <div class="col-md-10">
                    <input type="number" name="customer_groups[${customerGroupIndex}][customer_group_id]" class="form-control" placeholder="Customer Group ID">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.customer-group-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('customer-groups-wrapper').insertAdjacentHTML('beforeend', html);
        customerGroupIndex++;
    }

    function addCoupon() {
        const html = `
            <div class="row g-2 mb-2 coupon-row">
                <div class="col-md-3">
                    <input type="text" name="coupons[${couponIndex}][code]" class="form-control" placeholder="Coupon Code">
                </div>

                <div class="col-md-2">
                    <select name="coupons[${couponIndex}][type]" class="form-select">
                        <option value="shared">Shared</option>
                        <option value="unique">Unique</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="number" name="coupons[${couponIndex}][usage_limit]" class="form-control" placeholder="Usage Limit">
                </div>

                <div class="col-md-3">
                    <input type="hidden" name="coupons[${couponIndex}][is_active]" value="0">

                    <div class="form-check mt-2">
                        <input type="checkbox" name="coupons[${couponIndex}][is_active]" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.coupon-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('coupons-wrapper').insertAdjacentHTML('beforeend', html);
        couponIndex++;
    }

    function addSchedule() {
        const html = `
            <div class="row g-2 mb-2 schedule-row">
                <div class="col-md-2">
                    <select name="schedules[${scheduleIndex}][recurrence_type]" class="form-select">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="number" name="schedules[${scheduleIndex}][day_of_week]" class="form-control" placeholder="Day Week 0-6">
                </div>

                <div class="col-md-2">
                    <input type="number" name="schedules[${scheduleIndex}][day_of_month]" class="form-control" placeholder="Day Month">
                </div>

                <div class="col-md-2">
                    <input type="time" name="schedules[${scheduleIndex}][time_from]" class="form-control">
                </div>

                <div class="col-md-2">
                    <input type="time" name="schedules[${scheduleIndex}][time_to]" class="form-control">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.schedule-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('schedules-wrapper').insertAdjacentHTML('beforeend', html);
        scheduleIndex++;
    }

    function addTarget() {
        const html = `
            <div class="row g-2 mb-2 target-row">
                <div class="col-md-5">
                    <input type="text" name="targets[${targetIndex}][target_type]" class="form-control" placeholder="Target Type">
                </div>

                <div class="col-md-5">
                    <input type="number" name="targets[${targetIndex}][target_id]" class="form-control" placeholder="Target ID">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="this.closest('.target-row').remove()">Remove</button>
                </div>
            </div>
        `;

        document.getElementById('targets-wrapper').insertAdjacentHTML('beforeend', html);
        targetIndex++;
    }
</script>
@endpush