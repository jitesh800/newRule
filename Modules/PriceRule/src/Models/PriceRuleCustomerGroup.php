<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleCustomerGroup extends Model
{


    protected $table = 'price_rule_customer_groups';

    protected $fillable = [
        'price_rule_id',
        'customer_group_id',
    ];

}