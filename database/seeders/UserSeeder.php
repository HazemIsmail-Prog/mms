<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = array(
            array('id' => '1', 'name_ar' => 'مسؤول عام', 'name_en' => 'Super Admin', 'username' => '1', 'email' => NULL, 'cid' => '293091106071', 'email_verified_at' => NULL, 'password' => '$2y$10$HPzUomXDke93xkLuKanbu.aRUt/OVA921B6IhpkTM6cQKa5W7xZWa', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 17:23:48', 'deleted_at' => NULL, 'role_id' => '1', 'title_id' => '2'),
            array('id' => '2', 'name_ar' => 'مدير عام', 'name_en' => 'Manager', 'username' => '2', 'email' => NULL, 'cid' => '292080803897', 'email_verified_at' => NULL, 'password' => '$2y$10$3u/kOdenT7B6iKWoQxATK..UFbX7/e2MF5wr.DMyuZCR2fYgbVIHa', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 17:26:03', 'deleted_at' => NULL, 'role_id' => '2', 'title_id' => '1'),
            array('id' => '3', 'name_ar' => 'موزع', 'name_en' => 'Dispatcher', 'username' => '3', 'email' => NULL, 'cid' => '', 'email_verified_at' => NULL, 'password' => '$2y$10$9mG2iOUQ4HAZvZxeO0VSt.bSArMAI2JT1C1wvzWc2a91T8kXGqp3W', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 17:27:41', 'deleted_at' => NULL, 'role_id' => '5', 'title_id' => '6'),
            array('id' => '4', 'name_ar' => 'كول سنتر', 'name_en' => 'Call Center', 'username' => '4', 'email' => NULL, 'cid' => '', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:18:31', 'deleted_at' => NULL, 'role_id' => '4', 'title_id' => '12'),
            array('id' => '5', 'name_ar' => 'مراقب تكييف', 'name_en' => 'AC Forman', 'username' => '5', 'email' => NULL, 'cid' => '294101002597', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:18:47', 'deleted_at' => NULL, 'role_id' => '6', 'title_id' => '10'),
            array('id' => '6', 'name_ar' => 'مراقب كهرباء', 'name_en' => 'Elec Forman', 'username' => '6', 'email' => NULL, 'cid' => '294101002597', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:18:55', 'deleted_at' => NULL, 'role_id' => '6', 'title_id' => '10'),
            array('id' => '7', 'name_ar' => 'مراقب صحي', 'name_en' => 'Plumbing Forman', 'username' => '7', 'email' => NULL, 'cid' => '294101002597', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:19:04', 'deleted_at' => NULL, 'role_id' => '6', 'title_id' => '10'),
            array('id' => '8', 'name_ar' => 'فني تكييف 1', 'name_en' => 'AC Tech 1', 'username' => '8', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:19:13', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '9', 'name_ar' => 'فني تكييف 2', 'name_en' => 'AC Tech 2', 'username' => '9', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:19:22', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '10', 'name_ar' => 'فني تكييف 3', 'name_en' => 'AC Tech 3', 'username' => '10', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:19:34', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '11', 'name_ar' => 'فني كهرباء 1', 'name_en' => 'Elec Tech 1', 'username' => '11', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:19:52', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '12', 'name_ar' => 'فني كهرباء 2', 'name_en' => 'Elec Tech 2', 'username' => '12', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:20:14', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '13', 'name_ar' => 'فني كهرباء 3', 'name_en' => 'Elec Tech 3', 'username' => '13', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:20:22', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '14', 'name_ar' => 'فني صحي 1', 'name_en' => 'Plumbing Tech 1', 'username' => '14', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:20:29', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '15', 'name_ar' => 'فني صحي 2', 'name_en' => 'Plumbing Tech 2', 'username' => '15', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:20:36', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11'),
            array('id' => '16', 'name_ar' => 'فني صحي 3', 'name_en' => 'Plumbing Tech 3', 'username' => '16', 'email' => NULL, 'cid' => '284032505764', 'email_verified_at' => NULL, 'password' => '$2y$10$pO58B.PGaZ/r3Fiih674DOxG/89x.A01Lh/Zu0saM0OH8MKI6jhuC', 'active' => '1', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => '2022-10-09 18:20:43', 'deleted_at' => NULL, 'role_id' => '7', 'title_id' => '11')
        );

        User::insert($users);
    }
}
