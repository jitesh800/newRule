@extends('layouts.app')

@section('title', 'Edit Price Rule')
@section('page-title', 'Edit Price Rule')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm text-gray-500">
         }}" class="hover:text-blue-600">Price Rules</a>
        <span class="mx-2">/</span>
         }}" class="hover:text-blue-600">{{ $priceRule->name }}</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">Edit</span>
    </nav>

     }}">
        @csrf
        @method('PUT')

        @include('price-rule::price-rules.partials.form', [
            'rule' => $priceRule,
            'ruleTypes' => $ruleTypes,
        ])

        <!-- Submit -->
        <div class="flex items-center justify-end space-x-3 mt-6">
             }}"
                class="px-5 py-2.5 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                Cancel
            </a>

            <button type="submit"
                class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                Update Rule
            </button>
        </div>

    </form>

</div>

@endsection