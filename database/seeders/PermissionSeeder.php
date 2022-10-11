<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $permissions = array(
            array('id' => '1', 'name' => 'dashboard_menu', 'desc_ar' => 'عرض قائمة لوحة المعلومات', 'desc_en' => 'Dashboard Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '2', 'name' => 'settings_menu', 'desc_ar' => 'عرض قائمة الاعدادات', 'desc_en' => 'Settings Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '3', 'name' => 'departments_menu', 'desc_ar' => 'عرض قائمة الاقسام', 'desc_en' => 'Departments Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '4', 'name' => 'titles_menu', 'desc_ar' => 'عرض قائمة الوظائف', 'desc_en' => 'Titles Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '5', 'name' => 'users_menu', 'desc_ar' => 'عرض قائمة المستخدمين', 'desc_en' => 'Users Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '6', 'name' => 'statuses_menu', 'desc_ar' => 'عرض قائمة الحالات', 'desc_en' => 'Statuses Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '7', 'name' => 'operations_menu', 'desc_ar' => 'عرض قائمة العمليات', 'desc_en' => 'Operations Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '8', 'name' => 'customers_menu', 'desc_ar' => 'عرض قائمة العملاء', 'desc_en' => 'Customers Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '9', 'name' => 'orders_menu', 'desc_ar' => 'عرض قائمة الطلبات', 'desc_en' => 'Orders Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '10', 'name' => 'dispatching_menu', 'desc_ar' => 'عرض قائمة التوزيع', 'desc_en' => 'Dispatching Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '11', 'name' => 'reports_menu', 'desc_ar' => 'عرض قائمة التقارير', 'desc_en' => 'Reports Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '12', 'name' => 'roles_menu', 'desc_ar' => 'عرض قائمة الادوار', 'desc_en' => 'Roles Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '14', 'name' => 'technician_page_menu', 'desc_ar' => 'عرض صفحة الفني', 'desc_en' => 'Technician Page Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '15', 'name' => 'departments_create', 'desc_ar' => 'انشاء اقسام', 'desc_en' => 'Departments Create', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '16', 'name' => 'departments_edit', 'desc_ar' => 'تعديل الاقسام', 'desc_en' => 'Departments Edit', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '17', 'name' => 'departments_delete', 'desc_ar' => 'حذف الاقسام', 'desc_en' => 'Departments Delete', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '18', 'name' => 'titles_create', 'desc_ar' => 'انشاء وظائف', 'desc_en' => 'Titles Create', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '19', 'name' => 'titles_edit', 'desc_ar' => 'تعديل الوظائف', 'desc_en' => 'Titles Edit', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '20', 'name' => 'titles_delete', 'desc_ar' => 'حذف الوظائف', 'desc_en' => 'Titles Delete', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '21', 'name' => 'users_create', 'desc_ar' => 'انشاء مستخدمين', 'desc_en' => 'Users Create', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '22', 'name' => 'users_edit', 'desc_ar' => 'تعديل بيانات المستخدمين', 'desc_en' => 'Users Edit', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '23', 'name' => 'users_delete', 'desc_ar' => 'حذف المستخدمين', 'desc_en' => 'Users Delete', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '24', 'name' => 'roles_create', 'desc_ar' => 'انشاء ادوار', 'desc_en' => 'Roles Create', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '25', 'name' => 'roles_edit', 'desc_ar' => 'تعديل الادوار', 'desc_en' => 'Roles Edit', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '26', 'name' => 'roles_delete', 'desc_ar' => 'حذف الادوار', 'desc_en' => 'Roles Delete', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '27', 'name' => 'statuses_edit', 'desc_ar' => 'تعديل الحالات', 'desc_en' => 'Statuses Edit', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '28', 'name' => 'customers_create', 'desc_ar' => 'انشاء عميل جديد', 'desc_en' => 'Customers Create', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '29', 'name' => 'orders_create', 'desc_ar' => 'انشاء طلبات', 'desc_en' => 'Orders Create', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '30', 'name' => 'customers_edit', 'desc_ar' => 'تعديل بيانات العملاء', 'desc_en' => 'Customers Edit', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '31', 'name' => 'customers_delete', 'desc_ar' => 'حذف العملاء', 'desc_en' => 'Customers Delete', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '32', 'name' => 'orders_show', 'desc_ar' => 'عرض تفاصيل الطلبات', 'desc_en' => 'Orders Show', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '33', 'name' => 'orders_edit', 'desc_ar' => 'تعديل الطلبات', 'desc_en' => 'Orders Edit', 'created_at' => NULL, 'updated_at' => NULL)
        );
        Permission::insert($permissions);
    }
}
