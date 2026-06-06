<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleCategory extends Model
{

    
    protected $table = 'price_rule_categories';

    protected $fillable = [
        'price_rule_id',
        'category_id',
        'include_subcategories',
    ];

    protected $casts = [
        'include_subcategories' => 'boolean',
    ];

}