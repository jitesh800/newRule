@extends('pricerule::layouts.app')

@section('title', 'Price Rules')
@section('page-title', 'Price Rules')

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Price Rules</h1>
            <p class="text-muted mb-0">
                Manage pricing rules, discounts, coupons, schedules and promotions.
            </p>
        </div>

        {{ route('admin.price-rules.create') }}
            + Create Price Rule
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-header bg-white">
            <strong>Filters</strong>
        </div>

        <div class="card-body">
             }}">
                <div class="row g-3">

                    {{-- Search --}}
                    <div class="col-md-4">
                        <label for="search" class="form-label">
                            Search
                        </label>

                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Search by name or slug">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-3">
                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select id="status" name="status" class="form-select">
                            <option value="">All Status</option>

                            @foreach(['draft', 'scheduled', 'active', 'expired'] as $status)
                                <option value="{{ $status }}"
                                    @selected(request('status') === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Rule Type --}}
                    <div class="col-md-3">
                        <label for="rule_type_id" class="form-label">
                            Rule Type
                        </label>

                        <select id="rule_type_id" name="rule_type_id" class="form-select">
                            <option value="">All Rule Types</option>

                            @foreach($ruleTypes as $type)
                                <option value="{{ $type->id }}"
                                    @selected((string) request('rule_type_id') === (string) $type->id)>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-dark w-100">
                            Filter
                        </button>
                    </div>

                    @if(request()->hasAny(['search', 'status', 'rule_type_id']))
                        <div class="col-md-12">
                             }}"
                               class="btn btn-sm btn-outline-secondary">
                                Clear Filters
                            </a>
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </div>

    {{-- Price Rules Table --}}
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Price Rule List</strong>

            <span class="text-muted small">
                Total: {{ method_exists($rules, 'total') ? $rules->total() : $rules->count() }}
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Rule Type</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Combinable</th>
                            <th>Coupon Required</th>
                            <th>Duration</th>
                            <th width="230" class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rules as $rule)
                            <tr>
                                {{-- ID --}}
                                <td>
                                    {{ $rule->id }}
                                </td>

                                {{-- Name --}}
                                <td>
                                    <div class="fw-semibold">
                                        {{ $rule->name }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $rule->slug }}
                                    </div>

                                    @if($rule->description)
                                        <div class="text-muted small mt-1">
                                            {{ \Illuminate\Support\Str::limit($rule->description, 70) }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Rule Type --}}
                                <td>
                                    {{ $rule->type?->name ?? '-' }}
                                </td>

                                {{-- Status --}}
                                <td>
                                    @php
                                        $statusClass = match($rule->status) {
                                            'active' => 'success',
                                            'scheduled' => 'warning',
                                            'expired' => 'danger',
                                            'draft' => 'secondary',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ ucfirst($rule->status) }}
                                    </span>
                                </td>

                                {{-- Priority --}}
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $rule->priority }}
                                    </span>
                                </td>

                                {{-- Combinable --}}
                                <td>
                                    @if($rule->is_combinable)
                                        <span class="badge bg-success">
                                            Yes
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            No
                                        </span>
                                    @endif
                                </td>

                                {{-- Coupon Required --}}
                                <td>
                                    @if($rule->coupon_required)
                                        <span class="badge bg-info text-dark">
                                            Yes
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark border">
                                            No
                                        </span>
                                    @endif
                                </td>

                                {{-- Duration --}}
                                <td>
                                    <div class="small">
                                        <strong>Start:</strong>
                                        {{ $rule->starts_at?->format('d M Y, h:i A') ?? 'No start' }}
                                    </div>

                                    <div class="small">
                                        <strong>End:</strong>
                                        {{ $rule->ends_at?->format('d M Y, h:i A') ?? 'No end' }}
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="text-end">
                                     }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                     }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                     }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this price rule?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="mb-3">
                                        <span class="display-6 text-muted">
                                            📋
                                        </span>
                                    </div>

                                    <h5 class="text-muted mb-1">
                                        No price rules found
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Create your first price rule to start managing discounts and promotions.
                                    </p>

                                     }}"
                                       class="btn btn-primary">
                                        Create Price Rule
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($rules, 'links'))
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="text-muted small">
                        @if(method_exists($rules, 'firstItem') && $rules->total() > 0)
                            Showing {{ $rules->firstItem() }} to {{ $rules->lastItem() }}
                            of {{ $rules->total() }} results
                        @else
                            Showing 0 results
                        @endif
                    </div>

                    <div>
                        {{ $rules->links() }}
                    </div>

                </div>
            </div>
        @endif
    </div>

</div>
@endsection