<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_rule_actions')->insert([
        [
                'price_rule_id' => 1,
                'action_type' => 'discount',
                'configuration' => json_encode([
                    'discount_type' => 'percentage',
                    'value' => 10,
                    'max_discount' => 1000,
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 2,
                'action_type' => 'discount',
                'configuration' => json_encode([
                    'discount_type' => 'percentage',
                    'value' => 20,
                    'max_discount' => 2000,
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 3,
                'action_type' => 'discount',
                'configuration' => json_encode([
                    'discount_type' => 'percentage',
                    'value' => 50,
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 4,
                'action_type' => 'price_adjustment',
                'configuration' => json_encode([
                    'adjustment_type' => 'percentage',
                    'operation' => 'increase',
                    'value' => 15,
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'price_rule_id' => 5,
                'action_type' => 'free_shipping',
                'configuration' => json_encode([
                    'shipping_type' => 'free',
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 