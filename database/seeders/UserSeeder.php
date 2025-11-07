<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(20)->create();

        $managerUser = User::factory()->create([
            'name' => 'Test Managet User1',
            'email' => 'test1@example.com',
            'password' => bcrypt('passw0rd'),
        ]);

        $managerRole = Role::create(['name' => 'manager']);
        $managerUser->assignRole($managerRole);
    }
}
