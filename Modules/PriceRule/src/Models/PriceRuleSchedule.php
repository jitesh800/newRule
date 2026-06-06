<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'price_rule_schedules';
    protected $fillable = [
        'price_rule_id',
        'recurrence_type',
        'day_of_week',
        'day_of_month',
        'time_from',
        'time_to',
        'timezone',
    ];

}