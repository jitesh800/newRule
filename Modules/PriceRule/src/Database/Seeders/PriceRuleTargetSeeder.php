<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_rule_targets')->insert([
            [
                'price_rule_id' => 1,
                'target_type' => 'category',
                'target_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'price_rule_id' => 2,
                'target_type' => 'customer_group',
                'target_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 