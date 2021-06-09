<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Admin';
        $manager->slug = 'admin-role';
        $manager->save();

        $developer = new Role();
        $developer->name = 'Developer';
        $developer->slug = 'web-developer';
        $developer->save();
    }
}