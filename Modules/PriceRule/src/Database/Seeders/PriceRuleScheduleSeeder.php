<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_rule_schedules')->insert([
            [
                'price_rule_id' => 1,
                'recurrence_type' => 'weekly',
                'day_of_week' => 6,
                'time_from' => '00:00:00',
                'time_to' => '23:59:59',
                'timezone' => 'Asia/Kolkata',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
} 