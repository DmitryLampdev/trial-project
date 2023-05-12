<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create Settings
        Settings::create([
            'key'   => 'tenant_title',
            'value' => 'My tenant',
            'tenant_id' => Tenant::inRandomOrder()->first()->id
        ]);
    }
}
