@extends('pricerule::layouts.app')

@section('title', 'Price Rule Details')
@section('page-title', 'Price Rule Details')

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Price Rule Details</h1>
            <p class="text-muted mb-0">
                View complete information about this price rule, its conditions, actions and related settings.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.price-rules.index') }}" class="btn btn-secondary">
                Back to List
            </a>

            <a href="{{ route('admin.price-rules.edit', $priceRule) }}" class="btn btn-warning">
                Edit Rule
            </a>

            <form action="{{ route('admin.price-rules.destroy', $priceRule) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this price rule?');">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- Basic Information --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Basic Information</strong>

            @php
                $statusClass = match($priceRule->status) {
                    'active' => 'success',
                    'scheduled' => 'warning',
                    'expired' => 'danger',
                    'draft' => 'secondary',
                    default => 'secondary',
                };
            @endphp

            <span class="badge bg-{{ $statusClass }}">
                {{ ucfirst($priceRule->status) }}
            </span>
        </div>

        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-3">
                    <div class="text-muted small">ID</div>
                    <div class="fw-semibold">{{ $priceRule->id }}</div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Rule Type</div>
                    <div class="fw-semibold">{{ $priceRule->type?->name ?? '-' }}</div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Priority</div>
                    <div class="fw-semibold">{{ $priceRule->priority }}</div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Condition Match</div>
                    {{-- <div class="fw-semibold text-uppercase">{{ $priceRule->condition     <div class="fw-semibold">{{ $priceRule->name }}</div> --}}
                </div>

                <div class="col-md-6">
                    <div class="text-muted small">Slug</div>
                    <div>
                        <code>{{ $priceRule->slug }}</code>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="text-muted small">Description</div>
                    <div>{{ $priceRule->description ?: '-' }}</div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Starts At</div>
                    <div>
                        {{ $priceRule->starts_at?->format('d M Y, h:i A') ?? 'No start date' }}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Ends At</div>
                    <div>
                        {{ $priceRule->ends_at?->format('d M Y, h:i A') ?? 'No end date' }}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Created At</div>
                    <div>
                        {{ $priceRule->created_at?->format('d M Y, h:i A') ?? '-' }}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small">Updated At</div>
                    <div>
                        {{ $priceRule->updated_at?->format('d M Y, h:i A') ?? '-' }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Rule Flags --}}
    <div class="card mb-4">
        <div class="card-header bg-white">
            <strong>Rule Flags</strong>
        </div>

        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <div class="border rounded p-3 h-100">
                        <div class="text-muted small mb-1">Stop Further Rules</div>

                        @if($priceRule->stop_further_rules)
                            <span class="badge bg-danger">Yes</span>
                        @else
                            <span class="badge bg-light text-dark border">No</span>
                        @endif

                        <div class="small text-muted mt-2">
                            If yes, next price rules will not be evaluated after this rule applies.
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="border rounded p-3 h-100">
                        <div class="text-muted small mb-1">Is Combinable</div>

                        @if($priceRule->is_combinable)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif

                        <div class="small text-muted mt-2">
                            If yes, this rule can be combined with other applicable rules.
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="border rounded p-3 h-100">
                        <div class="text-muted small mb-1">Coupon Required</div>

                        @if($priceRule->coupon_required)
                            <span class="badge bg-info text-dark">Yes</span>
                        @else
                            <span class="badge bg-light text-dark border">No</span>
                        @endif

                        <div class="small text-muted mt-2">
                            If yes, a coupon should be required for this rule.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Conditions --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Conditions</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->conditions?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->conditions && $priceRule->conditions->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="70">Sort</th>
                                <th>Field</th>
                                <th>Operator</th>
                                <th>Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->conditions as $condition)
                                <tr>
                                    <td>{{ $condition->sort_order }}</td>

                                    <td>
                                        <code>{{ $condition->field }}</code>
                                    </td>

                                    <td>
                                        <span class="badge bg-dark">
                                            {{ $condition->operator }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $conditionValue = $condition->value;
                                        @endphp

                                        @if(is_array($conditionValue))
                                            <pre class="mb-0 bg-light border rounded p-2 small">{{ json_encode($conditionValue, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                        @else
                                            <code>{{ $conditionValue }}</code>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No conditions added. This rule can match without conditions.
                </div>
            @endif
        </div>
    </div>

    {{-- Actions --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Actions</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->actions?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->actions && $priceRule->actions->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="70">Sort</th>
                                <th>Action Type</th>
                                <th>Configuration</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->actions as $action)
                                <tr>
                                    <td>{{ $action->sort_order }}</td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ ucwords(str_replace('_', ' ', $action->action_type)) }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $configuration = $action->configuration;

                                            if (is_string($configuration)) {
                                                $configuration = json_decode($configuration, true) ?: $configuration;
                                            }
                                        @endphp

                                        @if(is_array($configuration))
                                            <pre class="mb-0 bg-light border rounded p-2 small">{{ json_encode($configuration, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                        @else
                                            <code>{{ $configuration }}</code>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No actions added.
                </div>
            @endif
        </div>
    </div>

    {{-- Products --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Products</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->products?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->products && $priceRule->products->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product ID</th>
                                <th>Override Discount Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->products as $product)
                                <tr>
                                    <td>{{ $product->product_id }}</td>
                                    <td>{{ $product->override_discount_value ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No product restrictions added.
                </div>
            @endif
        </div>
    </div>

    {{-- Categories --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Categories</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->categories?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->categories && $priceRule->categories->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Category ID</th>
                                <th>Include Subcategories</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->categories as $category)
                                <tr>
                                    <td>{{ $category->category_id }}</td>
                                    <td>
                                        @if($category->include_subcategories)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-light text-dark border">No</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No category restrictions added.
                </div>
            @endif
        </div>
    </div>

    {{-- Customer Groups --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Customer Groups</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->customerGroups?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->customerGroups && $priceRule->customerGroups->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Customer Group ID</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->customerGroups as $group)
                                <tr>
                                    <td>{{ $group->customer_group_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No customer group restrictions added.
                </div>
            @endif
        </div>
    </div>

    {{-- Coupons --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Coupons</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->coupons?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->coupons && $priceRule->coupons->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th>Usage Limit</th>
                                <th>Usage Count</th>
                                <th>Starts At</th>
                                <th>Ends At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->coupons as $coupon)
                                <tr>
                                    <td>
                                        <code>{{ $coupon->code }}</code>
                                    </td>

                                    <td>{{ ucfirst($coupon->type) }}</td>

                                    <td>
                                        @if($coupon->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>

                                    <td>{{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                                    <td>{{ $coupon->usage_count ?? 0 }}</td>

                                    <td>
                                        {{ $coupon->starts_at?->format('d M Y, h:i A') ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $coupon->ends_at?->format('d M Y, h:i A') ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No coupons added.
                </div>
            @endif
        </div>
    </div>

    {{-- Schedules --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Schedules</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->schedules?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->schedules && $priceRule->schedules->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Recurrence</th>
                                <th>Day of Week</th>
                                <th>Day of Month</th>
                                <th>Time From</th>
                                <th>Time To</th>
                                <th>Timezone</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->schedules as $schedule)
                                <tr>
                                    <td>{{ ucfirst($schedule->recurrence_type) }}</td>
                                    <td>{{ $schedule->day_of_week ?? '-' }}</td>
                                    <td>{{ $schedule->day_of_month ?? '-' }}</td>
                                    <td>{{ $schedule->time_from ?? '-' }}</td>
                                    <td>{{ $schedule->time_to ?? '-' }}</td>
                                    <td>{{ $schedule->timezone ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No schedules added.
                </div>
            @endif
        </div>
    </div>

    {{-- Targets --}}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Targets</strong>
            <span class="badge bg-secondary">
                {{ $priceRule->targets?->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($priceRule->targets && $priceRule->targets->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Target Type</th>
                                <th>Target ID</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRule->targets as $target)
                                <tr>
                                    <td>
                                        <code>{{ $target->target_type }}</code>
                                    </td>

                                    <td>{{ $target->target_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No targets added.
                </div>
            @endif
        </div>
    </div>

    {{-- Metadata --}}
    <div class="card mb-5">
        <div class="card-header bg-white">
            <strong>Metadata</strong>
        </div>

        <div class="card-body">
            @if($priceRule->metadata)
                @php
                    $metadata = $priceRule->metadata;

                    if (is_string($metadata)) {
                        $metadata = json_decode($metadata, true) ?: $metadata;
                    }
                @endphp

                @if(is_array($metadata))
                    <pre class="mb-0 bg-light border rounded p-3 small">{{ json_encode($metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                @else
                    <code>{{ $metadata }}</code>
                @endif
            @else
                <span class="text-muted">No metadata available.</span>
            @endif
        </div>
    </div>

</div>
@endsection