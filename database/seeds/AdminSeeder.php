<?php

use App\Model\admin\admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new admin();
        $user1->name = 'Admin';
        $user1->email = 'admin@email.com';
        $user1->password = bcrypt('admin123');
        $user1->role_id = 1;
        $user1->status = 1;
        $user1->save();
    }
}
