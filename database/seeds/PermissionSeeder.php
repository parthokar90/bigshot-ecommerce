<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Dashboard';
        $manageUser->slug = 'manage-dashboard';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Category';
        $createTasks->slug = 'create-category';
        $createTasks->save();
        $manageUser = new Permission();
        $manageUser->name = 'Manage Tag';
        $manageUser->slug = 'manage-tag';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Manage Attribute';
        $createTasks->slug = 'manage-attribute';
        $createTasks->save();

        $manageUser = new Permission();
        $manageUser->name = 'Manage Product';
        $manageUser->slug = 'manage-product';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Quick Report';
        $createTasks->slug = 'quick-report';
        $createTasks->save();

        $manageUser = new Permission();
        $manageUser->name = 'Order History';
        $manageUser->slug = 'order-history';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Send Parcel';
        $createTasks->slug = 'send-parcel';
        $createTasks->save();

        $manageUser = new Permission();
        $manageUser->name = 'Reject';
        $manageUser->slug = 'manage-reject';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Manage Stock';
        $createTasks->slug = 'manage-stock';
        $createTasks->save();

        $manageUser = new Permission();
        $manageUser->name = 'Customer List';
        $manageUser->slug = 'manage-customer';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Create Tasks';
        $createTasks->slug = 'create-tasks';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->name = 'Settings';
        $createTasks->slug = 'manage-settings';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->name = 'Manage Report';
        $createTasks->slug = 'manage-report';
        $createTasks->save();
    }
}
