<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $roles = array(
            array('id' => '1', 'name_ar' => 'المسؤول العام', 'name_en' => 'Super Admin', 'created_at' => '2021-09-03 17:56:44', 'updated_at' => '2021-09-03 17:56:44'),
            array('id' => '2', 'name_ar' => 'مدير عام', 'name_en' => 'General Manager', 'created_at' => '2021-09-03 18:38:27', 'updated_at' => '2021-09-03 18:38:27'),
            array('id' => '3', 'name_ar' => 'مسؤول كول سنتر', 'name_en' => 'Call Center Supervisor', 'created_at' => '2021-09-03 18:39:29', 'updated_at' => '2021-09-03 18:39:29'),
            array('id' => '4', 'name_ar' => 'كول سنتر', 'name_en' => 'Call Center', 'created_at' => '2021-09-03 18:40:01', 'updated_at' => '2021-09-03 18:40:01'),
            array('id' => '5', 'name_ar' => 'موزع', 'name_en' => 'Dispacher', 'created_at' => '2021-09-03 18:40:46', 'updated_at' => '2021-09-03 18:40:46'),
            array('id' => '6', 'name_ar' => 'مراقب', 'name_en' => 'Foreman', 'created_at' => '2021-09-03 19:00:07', 'updated_at' => '2021-09-03 19:00:07'),
            array('id' => '7', 'name_ar' => 'فني', 'name_en' => 'Technician', 'created_at' => '2021-09-03 19:00:27', 'updated_at' => '2021-09-03 19:00:27')
        );
        Role::insert($roles);
    }
}
