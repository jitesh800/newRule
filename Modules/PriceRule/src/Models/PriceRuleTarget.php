<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleTarget extends Model
{


    protected $table = 'price_rule_targets';

    protected $fillable = [
        'price_rule_id',
        'target_type',
        'target_id',
    ];

}