<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PriceRuleType extends Model
{



    protected $table = 'price_rule_types';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function rules(): HasMany
    {
        return $this->hasMany(PriceRule::class, 'rule_type_id');
    }

}