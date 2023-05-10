<?php

namespace App\Console\Commands;

use App\Models\Settings;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserTitle;
use Database\Factories\UserRoleFactory;
use Illuminate\Console\Command;


class GenerateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return
     */
    public function handle()
    {
        // create users with factory
        $users = User::factory()->count(10)->make();

        // create tenants with factory
        $tenants = Tenant::factory()->count(4)->create();

        // create Settings

        Settings::create([
            'key'   => 'tenant_title',
            'value' => 'My tenant'
        ]);

        // set random user data with meta
        foreach ($users as $user) {
            $meta = [
                'user_title' => $user->user_title,
                'user_role'  => $user->getUserRole(),
            ];

            $user->offsetUnset('user_title');
            $user->offsetUnset('user_role');


            $user->current_tenant_id = Tenant::all()->random()->id;
            $user->save();

            $user->setManyMeta($meta);
        }


        // Simply set up randomly tenant for every user
        foreach ($users as $user) {
            foreach ($tenants as $tenant) {
                // randomly making them multiple
                $tenant->users()->attach($user->id);
            }
        }

        $this->output->write('The data has been added.', true);
    }
}
