<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_rule_conditions')->insert([
            [
                'price_rule_id' => 1,
                'field' => 'day_of_week',
                'operator' => 'in',
                'value' => json_encode(['sat', 'sun']),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 3,
                'field' => 'time_range',
                'operator' => 'between',
                'value' => json_encode(['10:00', '12:00']),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 4,
                'field' => 'day_of_week',
                'operator' => 'in',
                'value' => json_encode(['sat', 'sun']),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 5,
                'field' => 'cart_total',
                'operator' => '>=',
                'value' => json_encode(5000),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 