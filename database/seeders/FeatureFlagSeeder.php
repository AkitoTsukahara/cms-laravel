<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infra\EloquentModel\FeatureFlag;

class FeatureFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeatureFlag::factory()->count(1)->create([
            'name' => '2021_12_02_acquirer_terms_master',
            'is_enabled' => true,
        ]);
    }
}
