<?php

namespace Modules\PriceRule\Services;

use Illuminate\Support\Facades\DB;
use Modules\PriceRule\Models\PriceRule;
use Modules\PriceRule\Repositories\PriceRuleRepository;
use RCV\Core\Services\BaseService as CoreBaseService;

 
class PriceRuleService extends CoreBaseService
{
    public function __construct(
        private readonly PriceRuleRepository $priceRuleRepository
    ) {
    }

    public function getPaginatedRules(array $filters = [], int $perPage = 20)
    {
        return $this->priceRuleRepository->paginateWithFilters($filters, $perPage);
    }

    public function findRule(int $id): PriceRule
    {
        return $this->priceRuleRepository->findById($id);
    }

    public function createRule(array $data): PriceRule
    {
        return DB::transaction(function () use ($data) {
            $rule = $this->priceRuleRepository->create(
                $this->extractRuleData($data)
            );

            $this->syncRelations($rule, $data);

            return $this->priceRuleRepository->findById($rule->id);
        });
    }

    public function updateRule(PriceRule $priceRule, array $data): PriceRule
    {
        return DB::transaction(function () use ($priceRule, $data) {
            $rule = $this->priceRuleRepository->updateModel(
                $priceRule,
                $this->extractRuleData($data)
            );

            $this->syncRelations($rule, $data);

            return $this->priceRuleRepository->findById($rule->id);
        });
    }

    public function deleteRule(PriceRule $priceRule): bool
    {
        return DB::transaction(function () use ($priceRule) {
            return $this->priceRuleRepository->deleteModel($priceRule);
        });
    }

    private function extractRuleData(array $data): array
    {
        return [
            'rule_type_id' => $data['rule_type_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'],
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'priority' => $data['priority'] ?? 100,
            'stop_further_rules' => $data['stop_further_rules'] ?? false,
            'is_combinable' => $data['is_combinable'] ?? true,
            'coupon_required' => $data['coupon_required'] ?? false,
            'condition_match' => $data['condition_match'] ?? 'all',
            'metadata' => $data['metadata'] ?? null,
        ];
    }

    private function syncRelations(PriceRule $rule, array $data): void
    {
        $this->syncConditions($rule, $data['conditions'] ?? []);
        $this->syncActions($rule, $data['actions'] ?? []);
        $this->syncProducts($rule, $data['products'] ?? []);
        $this->syncCategories($rule, $data['categories'] ?? []);
        $this->syncCustomerGroups($rule, $data['customer_groups'] ?? []);
        $this->syncCoupons($rule, $data['coupons'] ?? []);
        $this->syncSchedules($rule, $data['schedules'] ?? []);
        $this->syncTargets($rule, $data['targets'] ?? []);
    }

    private function syncConditions(PriceRule $rule, array $conditions): void
    {
        $rule->conditions()->delete();

        foreach ($conditions as $index => $condition) {
            $rule->conditions()->create([
                'field' => $condition['field'],
                'operator' => $condition['operator'],
                'value' => $this->normalizeJsonValue($condition['value']),
                'sort_order' => $condition['sort_order'] ?? $index + 1,
            ]);
        }
    }

    private function syncActions(PriceRule $rule, array $actions): void
    {
        $rule->actions()->delete();

        foreach ($actions as $index => $action) {
            $rule->actions()->create([
                'action_type' => $action['action_type'],
                'configuration' => $action['configuration'],
                'sort_order' => $action['sort_order'] ?? $index + 1,
            ]);
        }
    }

    private function syncProducts(PriceRule $rule, array $products): void
    {
        $rule->products()->delete();

        foreach ($products as $product) {
            $rule->products()->create([
                'product_id' => $product['product_id'],
                'override_discount_value' => $product['override_discount_value'] ?? null,
            ]);
        }
    }

    private function syncCategories(PriceRule $rule, array $categories): void
    {
        $rule->categories()->delete();

        foreach ($categories as $category) {
            $rule->categories()->create([
                'category_id' => $category['category_id'],
                'include_subcategories' => $category['include_subcategories'] ?? true,
            ]);
        }
    }

    private function syncCustomerGroups(PriceRule $rule, array $groups): void
    {
        $rule->customerGroups()->delete();

        foreach ($groups as $group) {
            $rule->customerGroups()->create([
                'customer_group_id' => $group['customer_group_id'],
            ]);
        }
    }

    private function syncCoupons(PriceRule $rule, array $coupons): void
    {
        $rule->coupons()->delete();

        foreach ($coupons as $coupon) {
            $rule->coupons()->create([
                'code' => strtoupper(trim($coupon['code'])),
                'type' => $coupon['type'] ?? 'shared',
                'is_active' => $coupon['is_active'] ?? true,
                'usage_limit' => $coupon['usage_limit'] ?? null,
                'usage_count' => 0,
                'starts_at' => $coupon['starts_at'] ?? null,
                'ends_at' => $coupon['ends_at'] ?? null,
            ]);
        }
    }

    private function syncSchedules(PriceRule $rule, array $schedules): void
    {
        $rule->schedules()->delete();

        foreach ($schedules as $schedule) {
            $rule->schedules()->create([
                'recurrence_type' => $schedule['recurrence_type'] ?? 'weekly',
                'day_of_week' => $schedule['day_of_week'] ?? null,
                'day_of_month' => $schedule['day_of_month'] ?? null,
                'time_from' => $schedule['time_from'] ?? null,
                'time_to' => $schedule['time_to'] ?? null,
                'timezone' => $schedule['timezone'] ?? config('app.timezone'),
            ]);
        }
    }

    private function syncTargets(PriceRule $rule, array $targets): void
    {
        $rule->targets()->delete();

        foreach ($targets as $target) {
            $rule->targets()->create([
                'target_type' => $target['target_type'],
                'target_id' => $target['target_id'],
            ]);
        }
    }

    private function normalizeJsonValue(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        return ['value' => $value];
    }

}