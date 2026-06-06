<?php

namespace Modules\PriceRule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleAction extends Model
{


    protected $table = 'price_rule_actions';

    protected $fillable = [
        'price_rule_id',
        'action_type',
        'configuration',
        'sort_order',
    ];

    protected $casts = [
        'configuration' => 'array',
        'sort_order' => 'integer',
    ];

    public function rule(): BelongsTo
    {
        return $this->belongsTo(PriceRule::class, 'price_rule_id');
    }

}