<?php

namespace Modules\PriceRule\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\PriceRule\Models\PriceRule;
use RCV\Core\Repositories\BaseRepository as CoreBaseRepository;

class PriceRuleRepository extends CoreBaseRepository
{
    public function __construct(PriceRule $model)
    {
        parent::__construct($model);
    }

    public function paginateWithFilters(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with(['type'])
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($filters['rule_type_id'] ?? null, function ($query, $ruleTypeId) {
                $query->where('rule_type_id', $ruleTypeId);
            })
            ->orderBy('priority')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
    }


    public function findById(int $id): PriceRule
    {
        return $this->model->newQuery()
            ->with([
                'type',
                'conditions',
                'actions',
                'coupons',
                'products',    
                'categories',
                'customerGroups',
                'schedules',
                'targets',
            ])
            ->findOrFail($id);
    }


    public function create(array $data): PriceRule
    {
        return $this->model->create($data);
    }


    public function updateModel(PriceRule $priceRule, array $data): PriceRule
    {
        $priceRule->update($data);

        return $priceRule->fresh([
            'type',
            'conditions',
            'actions',
            'coupons',
            'products',
            'categories',
            'customerGroups',
            'schedules',
            'targets',
        ]);
    }


    public function deleteModel(PriceRule $priceRule): bool
    {
        return (bool) $priceRule->delete();
    }


    public function getActiveRules(array $context = []): Collection
    {
        return $this->model->newQuery()
            ->with([
                'conditions',
                'actions',
                'coupons',
                'products',
                'categories',
                'customerGroups',
                'schedules',
                'targets'
            ])
            ->active()
            ->orderBy('priority')
            ->get();
    }

} 