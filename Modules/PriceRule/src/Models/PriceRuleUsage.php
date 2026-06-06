<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleUsage extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'price_rule_usages';

    protected $fillable = [
        'price_rule_id',
        'customer_id',
        'order_id',
        'discount_amount',
        'order_subtotal',
        'currency',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:4',
        'order_subtotal' => 'decimal:4',
    ];

    public function rule(): BelongsTo
    {
        return $this->belongsTo(PriceRule::class, 'price_rule_id');
    }

}