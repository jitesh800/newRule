<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleProduct extends Model
{


    protected $table = 'price_rule_products';

    protected $fillable = [
        'price_rule_id',
        'product_id',
        'override_discount_value',
    ];

    protected $casts = [
        'override_discount_value' => 'decimal:4',
    ];

}