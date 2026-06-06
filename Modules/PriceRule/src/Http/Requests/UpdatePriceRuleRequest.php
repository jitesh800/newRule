<?php

namespace Modules\PriceRule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePriceRuleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'stop_further_rules' => $this->boolean('stop_further_rules'),
            'is_combinable' => $this->boolean('is_combinable'),
            'coupon_required' => $this->boolean('coupon_required'),
        ]);
    }

    public function rules(): array
    {
        $priceRuleId = $this->route('priceRule')?->id ?? $this->route('priceRule');

        return [
            'rule_type_id' => ['required', 'integer', 'exists:price_rule_types,id'],

            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('price_rules', 'slug')->ignore($priceRuleId),
            ],
            'description' => ['nullable', 'string'],

            'status' => ['required', Rule::in(['draft', 'scheduled', 'active', 'expired'])],

            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],

            'priority' => ['required', 'integer', 'min:0', 'max:65535'],

            'stop_further_rules' => ['boolean'],
            'is_combinable' => ['boolean'],
            'coupon_required' => ['boolean'],

            'condition_match' => ['required', Rule::in(['all', 'any'])],
            'metadata' => ['nullable', 'array'],

            'conditions' => ['nullable', 'array'],
            'conditions.*.field' => ['required_with:conditions', 'string', 'max:100'],
            'conditions.*.operator' => [
                'required_with:conditions',
                Rule::in(['=', '!=', '>', '>=', '<', '<=', 'in', 'not_in', 'between', 'contains']),
            ],
            'conditions.*.value' => ['required_with:conditions'],
            'conditions.*.sort_order' => ['nullable', 'integer', 'min:1'],

            'actions' => ['required', 'array', 'min:1'],
            'actions.*.action_type' => ['required', 'string', 'max:100'],
            'actions.*.configuration' => ['required', 'array'],
            'actions.*.sort_order' => ['nullable', 'integer', 'min:1'],

            'products' => ['nullable', 'array'],
            'products.*.product_id' => ['required_with:products', 'integer'],
            'products.*.override_discount_value' => ['nullable', 'numeric', 'min:0'],

            'categories' => ['nullable', 'array'],
            'categories.*.category_id' => ['required_with:categories', 'integer'],
            'categories.*.include_subcategories' => ['nullable', 'boolean'],

            'customer_groups' => ['nullable', 'array'],
            'customer_groups.*.customer_group_id' => ['required_with:customer_groups', 'integer'],

            'coupons' => ['nullable', 'array'],
            'coupons.*.id' => ['nullable', 'integer', 'exists:price_rule_coupons,id'],
            'coupons.*.code' => ['required_with:coupons', 'string', 'max:100', 'distinct'],
            'coupons.*.type' => ['required_with:coupons', Rule::in(['shared', 'unique'])],
            'coupons.*.is_active' => ['nullable', 'boolean'],
            'coupons.*.usage_limit' => ['nullable', 'integer', 'min:1'],
            'coupons.*.starts_at' => ['nullable', 'date'],
            'coupons.*.ends_at' => ['nullable', 'date'],

            'schedules' => ['nullable', 'array'],
            'schedules.*.recurrence_type' => ['required_with:schedules', Rule::in(['daily', 'weekly', 'monthly', 'custom'])],
            'schedules.*.day_of_week' => ['nullable', 'integer', 'between:0,6'],
            'schedules.*.day_of_month' => ['nullable', 'integer', 'between:1,31'],
            'schedules.*.time_from' => ['nullable', 'date_format:H:i'],
            'schedules.*.time_to' => ['nullable', 'date_format:H:i'],
            'schedules.*.timezone' => ['nullable', 'string', 'max:50'],

            'targets' => ['nullable', 'array'],
            'targets.*.target_type' => ['required_with:targets', 'string', 'max:100'],
            'targets.*.target_id' => ['required_with:targets', 'integer'],
        ];
    }

}