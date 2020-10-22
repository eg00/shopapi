<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@". request()->getHost();
        $user->password = bcrypt('secret');
        $user->role = 'admin';
        $user->save();

        User::factory()->count(20)->create();
    }
}
