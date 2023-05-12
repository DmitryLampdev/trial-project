<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::all();

        // Simply set up randomly tenant for every user
        foreach(User::all() as $user) {

            $user->current_tenant_id = $tenants->random()->id;
            $user->save();
            
            foreach ($tenants as $tenant) {
                // randomly making them multiple
                $tenant->users()->attach($user->id);
            }
        }
    }
}
