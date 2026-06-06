<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_rules')->insert([
           [
                'id' => 1,
                'rule_type_id' => 1,
                'name' => 'Weekend Electronics Sale',
                'slug' => 'weekend-electronics-sale',
                'description' => '10% discount on weekends',
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'priority' => 1,
                'stop_further_rules' => false,
                'is_combinable' => true,
                'coupon_required' => false,
                'condition_match' => 'all',
                'metadata' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 2,
                'rule_type_id' => 2,
                'name' => 'Welcome Coupon',
                'slug' => 'welcome-coupon',
                'description' => '20% off for new customers',
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'priority' => 2,
                'stop_further_rules' => false,
                'is_combinable' => true,
                'coupon_required' => true,
                'condition_match' => 'all',
                'metadata' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 3,
                'rule_type_id' => 3,
                'name' => 'Flash Sale 50%',
                'slug' => 'flash-sale-50',
                'description' => 'Flash sale from 10 AM to 12 PM',
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'priority' => 1,
                'stop_furtheridx_rule_field_rules' => true,
                'is_combinable' => false,
                'coupon_required' => false,
                'condition_match' => 'all',
                'metadata' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 4,
                'rule_type_id' => 4,
                'name' => 'Weekend Price Hike',
                'slug' => 'weekend-price-hike',
                'description' => '15% price increase on weekends',
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'priority' => 5,
                'stop_further_rules' => false,
                'is_combinable' => true,
                'coupon_required' => false,
                'condition_match' => 'all',
                'metadata' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 5,
                'rule_type_id' => 5,
                'name' => 'Free Shipping Above 5000',
                'slug' => 'free-shipping-above-5000',
                'description' => 'Free shipping on orders above ₹5000',
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'priority' => 3,
                'stop_further_rules' => false,
                'is_combinable' => true,
                'coupon_required' => false,
                'condition_match' => 'all',
                'metadata' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 