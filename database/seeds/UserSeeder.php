<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $role_super_admin = Role::where('name','super admin')->first();
        $role_admin = Role::where('name','admin opd')->first();
        $role_masyarakat = Role::where('name','masyarakat')->first();

        $user_super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'super.admin@gmail.com',
            'username' => $faker->unique()->userName,
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' => Str::random(10),
        ]);
        $user_super_admin->assignRole($role_super_admin->name);

        $user_admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => $faker->unique()->userName,
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' => Str::random(10),
        ]);
        $user_admin->assignRole($role_admin->name);

        $user_masyarakat = User::create([
            'name' => 'Anto Joko',
            'email' => 'masyarakat@gmail.com',
            'username' => $faker->unique()->userName,
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' => Str::random(10),
        ]);
        $user_masyarakat->assignRole($role_masyarakat->name);
    }
}
