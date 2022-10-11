<?php

namespace Database\Seeders;

use App\Models\PermissionRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_role = array(
            array('id' => '1', 'role_id' => '1', 'permission_id' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '2', 'role_id' => '1', 'permission_id' => '2', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '3', 'role_id' => '1', 'permission_id' => '3', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '4', 'role_id' => '1', 'permission_id' => '4', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '6', 'role_id' => '1', 'permission_id' => '6', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '7', 'role_id' => '1', 'permission_id' => '7', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '8', 'role_id' => '1', 'permission_id' => '8', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '9', 'role_id' => '1', 'permission_id' => '9', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '12', 'role_id' => '1', 'permission_id' => '12', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '14', 'role_id' => '2', 'permission_id' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '15', 'role_id' => '2', 'permission_id' => '7', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '16', 'role_id' => '2', 'permission_id' => '8', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '17', 'role_id' => '2', 'permission_id' => '9', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '18', 'role_id' => '2', 'permission_id' => '11', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '19', 'role_id' => '3', 'permission_id' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '20', 'role_id' => '3', 'permission_id' => '7', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '21', 'role_id' => '3', 'permission_id' => '8', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '22', 'role_id' => '3', 'permission_id' => '9', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '23', 'role_id' => '3', 'permission_id' => '11', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '24', 'role_id' => '4', 'permission_id' => '7', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '25', 'role_id' => '4', 'permission_id' => '8', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '26', 'role_id' => '4', 'permission_id' => '9', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '27', 'role_id' => '4', 'permission_id' => '11', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '28', 'role_id' => '5', 'permission_id' => '10', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '29', 'role_id' => '5', 'permission_id' => '11', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '30', 'role_id' => '5', 'permission_id' => '9', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '31', 'role_id' => '5', 'permission_id' => '7', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '32', 'role_id' => '6', 'permission_id' => '14', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '33', 'role_id' => '7', 'permission_id' => '14', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '35', 'role_id' => '1', 'permission_id' => '15', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '36', 'role_id' => '1', 'permission_id' => '16', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '37', 'role_id' => '1', 'permission_id' => '17', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '38', 'role_id' => '1', 'permission_id' => '18', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '39', 'role_id' => '1', 'permission_id' => '20', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '40', 'role_id' => '1', 'permission_id' => '19', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '41', 'role_id' => '1', 'permission_id' => '21', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '42', 'role_id' => '1', 'permission_id' => '23', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '43', 'role_id' => '1', 'permission_id' => '22', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '44', 'role_id' => '1', 'permission_id' => '24', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '45', 'role_id' => '1', 'permission_id' => '26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '46', 'role_id' => '1', 'permission_id' => '25', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '47', 'role_id' => '1', 'permission_id' => '27', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '48', 'role_id' => '1', 'permission_id' => '28', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '49', 'role_id' => '1', 'permission_id' => '31', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '50', 'role_id' => '1', 'permission_id' => '30', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '51', 'role_id' => '1', 'permission_id' => '29', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '52', 'role_id' => '1', 'permission_id' => '33', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '53', 'role_id' => '1', 'permission_id' => '32', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '54', 'role_id' => '1', 'permission_id' => '10', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '55', 'role_id' => '1', 'permission_id' => '11', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '56', 'role_id' => '1', 'permission_id' => '14', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '57', 'role_id' => '1', 'permission_id' => '5', 'created_at' => NULL, 'updated_at' => NULL)
        );

        PermissionRole::insert($permission_role);
    }
}
