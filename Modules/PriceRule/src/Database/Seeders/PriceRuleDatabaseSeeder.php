<?php

namespace Modules\PriceRule\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PriceRule\Database\Seeders\PriceRuleActionSeeder;
use Modules\PriceRule\Database\Seeders\PriceRuleConditionSeeder;
use Modules\PriceRule\Database\Seeders\PriceRuleCouponSeeder;
use Modules\PriceRule\Database\Seeders\PriceRuleSeeder;
use Modules\PriceRule\Database\Seeders\PriceRuleTargetSeeder;
use Modules\PriceRule\Database\Seeders\PriceRuleTypeSeeder;



class PriceRuleDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PriceRuleTypeSeeder::class,
            PriceRuleSeeder::class,
            PriceRuleTargetSeeder::class,
            PriceRuleConditionSeeder::class,
            PriceRuleActionSeeder::class,
            PriceRuleCouponSeeder::class,
            PriceRuleScheduleSeeder::class,
        ]);


    }

}
