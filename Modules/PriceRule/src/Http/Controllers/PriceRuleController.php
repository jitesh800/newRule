<?php

namespace Modules\PriceRule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PriceRule\Http\Requests\StorePriceRuleRequest;
use Modules\PriceRule\Http\Requests\UpdatePriceRuleRequest;
use Modules\PriceRule\Models\PriceRule;
use Modules\PriceRule\Models\PriceRuleType;
use Modules\PriceRule\Services\PriceRuleService;

class PriceRuleController extends Controller
{
   
    public function __construct(
        private readonly PriceRuleService $priceRuleService
    ) {
    }

    public function index(Request $request)
    {
        $rules = $this->priceRuleService->getPaginatedRules(
            $request->only(['search', 'status', 'rule_type_id']),
            20
        );

        $ruleTypes = PriceRuleType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('price-rules::price-rules.index', compact('rules', 'ruleTypes'));
    }

    public function create()
    {
        $ruleTypes = PriceRuleType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('price-rules::price-rules.create', compact('ruleTypes'));
    }

    public function store(StorePriceRuleRequest $request)
    {
        $rule = $this->priceRuleService->createRule($request->validated());

        return redirect()
            ->route('admin.price-rules.show', $rule)
            ->with('success', 'Price rule created successfully.');
    }

    public function show(PriceRule $priceRule)
    {
        $priceRule = $this->priceRuleService->findRule($priceRule->id);

        return view('price-rules::price-rules.show', compact('priceRule'));
    }

    public function edit(PriceRule $priceRule)
    {
        $priceRule = $this->priceRuleService->findRule($priceRule->id);

        $ruleTypes = PriceRuleType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('price-rules::price-rules.edit', compact('priceRule', 'ruleTypes'));
    }

    public function update(UpdatePriceRuleRequest $request, PriceRule $priceRule)
    {
        $rule = $this->priceRuleService->updateRule($priceRule, $request->validated());

        return redirect()
            ->route('admin.price-rules.show', $rule)
            ->with('success', 'Price rule updated successfully.');
    }

    public function destroy(PriceRule $priceRule)
    {
        $this->priceRuleService->deleteRule($priceRule);

        return redirect()
            ->route('admin.price-rules.index')
            ->with('success', 'Price rule deleted successfully.');
    }

}
