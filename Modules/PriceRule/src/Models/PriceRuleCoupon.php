<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleCoupon extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'price_rule_coupons';

    protected $fillable = [
        'price_rule_id',
        'code',
        'type',
        'is_active',
        'usage_limit',
        'usage_count',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'usage_limit' => 'integer',
        'usage_count' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

}