<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_rule_types')->insert([
           [
                'name' => 'Discount',
                'slug' => 'discount',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coupon',
                'slug' => 'coupon',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flash Sale',
                'slug' => 'flash-sale',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dynamic Pricing',
                'slug' => 'dynamic-pricing',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Free Shipping',
                'slug' => 'free-shipping',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 