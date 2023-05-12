<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(10)->make();

        // set random user data with meta
        foreach ($users as $user) {
            $meta = [
                'user_title' => $user->user_title,
                'user_role'  => $user->getUserRole(),
            ];

            $user->offsetUnset('user_title');
            $user->offsetUnset('user_role');

            $user->save();

            $user->setManyMeta($meta);
        }
    }
}
