<?php

namespace Modules\PriceRule\Services;

use Modules\PriceRule\Models\PriceRule;
use Modules\PriceRule\Repositories\PriceRuleRepository;
use RCV\Core\Services\BaseService as CoreBaseService;

 
class PriceRuleEvaluationService extends CoreBaseService
{
   
   
 public function __construct(
        private readonly PriceRuleRepository $priceRuleRepository
    ) {
    }

    public function evaluate(array $context): array
    {
        $rules = $this->priceRuleRepository->getActiveRules($context);

        $appliedRules = [];
        $totalDiscount = 0.0;

        foreach ($rules as $rule) {
            if (! $this->ruleMatches($rule, $context)) {
                continue;
            }

            $discount = $this->applyActions($rule, $context);

            if ($discount <= 0) {
                continue;
            }

            $appliedRules[] = [
                'rule_id' => $rule->id,
                'rule_name' => $rule->name,
                'discount' => $discount,
            ];

            $totalDiscount += $discount;

            if ($rule->stop_further_rules) {
                break;
            }

            if (! $rule->is_combinable) {
                break;
            }
        }

        return [
            'applied_rules' => $appliedRules,
            'total_discount' => round($totalDiscount, 4),
        ];
    }

    private function ruleMatches(PriceRule $rule, array $context): bool
    {
        $conditions = $rule->conditions;

        if ($conditions->isEmpty()) {
            return true;
        }

        $results = [];

        foreach ($conditions as $condition) {
            $results[] = $this->conditionMatches(
                $context[$condition->field] ?? null,
                $condition->operator,
                $condition->value
            );
        }

        return $rule->condition_match === 'all'
            ? ! in_array(false, $results, true)
            : in_array(true, $results, true);
    }

    private function conditionMatches(mixed $actualValue, string $operator, mixed $expectedValue): bool
    {
        $expected = is_array($expectedValue) && array_key_exists('value', $expectedValue)
            ? $expectedValue['value']
            : $expectedValue;

        return match ($operator) {
            '=' => $actualValue == $expected,
            '!=' => $actualValue != $expected,
            '>' => $actualValue > $expected,
            '>=' => $actualValue >= $expected,
            '<' => $actualValue < $expected,
            '<=' => $actualValue <= $expected,
            'in' => in_array($actualValue, (array) $expected, true),
            'not_in' => ! in_array($actualValue, (array) $expected, true),
            'between' => $this->isBetween($actualValue, (array) $expected),
            'contains' => str_contains((string) $actualValue, (string) $expected),
            default => false,
        };
    }

    private function isBetween(mixed $actualValue, array $range): bool
    {
        if (count($range) < 2) {
            return false;
        }

        return $actualValue >= $range[0] && $actualValue <= $range[1];
    }

    private function applyActions(PriceRule $rule, array $context): float
    {
        $discount = 0.0;

        foreach ($rule->actions as $action) {
            $config = $action->configuration;
            $subtotal = (float) ($context['subtotal'] ?? 0);

            $discount += match ($action->action_type) {
                'percentage_discount' => $this->percentageDiscount($subtotal, $config),
                'fixed_discount' => $this->fixedDiscount($config),
                'free_shipping' => (float) ($context['shipping_amount'] ?? 0),
                default => 0.0,
            };
        }

        return min($discount, (float) ($context['subtotal'] ?? $discount));
    }

    private function percentageDiscount(float $subtotal, array $config): float
    {
        $percentage = (float) ($config['value'] ?? 0);
        $maxDiscount = $config['max_discount'] ?? null;

        $discount = ($subtotal * $percentage) / 100;

        if ($maxDiscount !== null) {
            $discount = min($discount, (float) $maxDiscount);
        }

        return $discount;
    }

    private function fixedDiscount(array $config): float
    {
        return (float) ($config['value'] ?? 0);
    }

} 