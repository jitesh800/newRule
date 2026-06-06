<?php

namespace Modules\PriceRule\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PriceRule\Models\PriceRuleType;


class PriceRule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'price_rules';

    protected $fillable = [
        'rule_type_id',
        'name',
        'slug',
        'description',
        'status',
        'starts_at',
        'ends_at',
        'priority',
        'stop_further_rules',
        'is_combinable',
        'coupon_required',
        'condition_match',
        'metadata',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'priority' => 'integer',
        'stop_further_rules' => 'boolean',
        'is_combinable' => 'boolean',
        'coupon_required' => 'boolean',
        'metadata' => 'array',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_EXPIRED = 'expired';

    public function type(): BelongsTo
    {
        return $this->belongsTo(PriceRuleType::class, 'rule_type_id');
    }

    public function conditions(): HasMany
    {
        return $this->hasMany(PriceRuleCondition::class, 'price_rule_id')
            ->orderBy('sort_order');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(PriceRuleAction::class, 'price_rule_id')
            ->orderBy('sort_order');
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(PriceRuleCoupon::class, 'price_rule_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(PriceRuleProduct::class, 'price_rule_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(PriceRuleCategory::class, 'price_rule_id');
    }

    public function customerGroups(): HasMany
    {
        return $this->hasMany(PriceRuleCustomerGroup::class, 'price_rule_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(PriceRuleSchedule::class, 'price_rule_id');
    }

    public function targets(): HasMany
    {
        return $this->hasMany(PriceRuleTarget::class, 'price_rule_id');
    }

    public function usages(): HasMany
    {
        return $this->hasMany(PriceRuleUsage::class, 'price_rule_id');
    }

    public function scopeActive($query)
    {
        return $query
            ->where('status', self::STATUS_ACTIVE)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            });
    }


}