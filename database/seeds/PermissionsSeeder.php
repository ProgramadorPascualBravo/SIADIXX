<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // List Permission


       /**
        * User Monitor
        */
       Permission::create(['name' => 'user_read']);

       Permission::create(['name' => 'user_write']);

       Permission::create(['name' => 'user_destroy']);


       /**
        * User Moodle
        */
       Permission::create(['name' => 'moodle_read']);

       Permission::create(['name' => 'moodle_write']);

       Permission::create(['name' => 'moodle_destroy']);

       Permission::create(['name' => 'moodle_massive']);

       /**
        *  Categoria
        */
       Permission::create(['name' => 'category_read']);

       Permission::create(['name' => 'category_write']);

       Permission::create(['name' => 'category_destroy']);

       /**
        * Programs
        */
       Permission::create(['name' => 'program_read']);

       Permission::create(['name' => 'program_write']);

       Permission::create(['name' => 'program_destroy']);

       /**
        * Course
        */
       Permission::create(['name' => 'course_read']);

       Permission::create(['name' => 'course_write']);

       Permission::create(['name' => 'course_destroy']);

       /**
        * Group
        */

       Permission::create(['name' => 'group_read']);

       Permission::create(['name' => 'group_write']);

       Permission::create(['name' => 'group_destroy']);

       /**
        * Rols
        */

       Permission::create(['name' => 'role_moodle_read']);

       Permission::create(['name' => 'role_moodle_write']);

       Permission::create(['name' => 'role_moodle_destroy']);

       /**
        * Enrollment
        */

       Permission::create(['name' => 'enrollment_read']);

       Permission::create(['name' => 'enrollment_write']);

       Permission::create(['name' => 'enrollment_destroy']);

       Permission::create(['name' => 'enrollment_massive']);

       Permission::create(['name' => 'role_read']);

       Permission::create(['name' => 'role_write']);

       Permission::create(['name' => 'role_destroy']);

       Permission::create(['name' => 'permission_write']);

       Permission::create(['name' => 'permission_read']);

       /**
        *  Búsqueda
        */

       Permission::create(['name' => 'search_read']);

       /**
        *  Reportes
        */

       Permission::create(['name' => 'report_read']);

       $admin = Role::create(['name' => 'admin']);
       $manager = Role::create(['name' => 'manager']);
       $reports = Role::create(['name' => 'reports']);

       $admin->givePermissionTo([
          'user_read',
          'user_write',
          'user_destroy',
          'moodle_read',
          'moodle_write',
          'moodle_destroy',
          'moodle_massive',
          'category_read',
          'category_write',
          'category_destroy',
          'program_read',
          'program_write',
          'program_destroy',
          'course_read',
          'course_write',
          'course_destroy',
          'group_read',
          'group_write',
          'group_destroy',
          'rol_read',
          'rol_write',
          'rol_destroy',
          'enrollment_read',
          'enrollment_write',
          'enrollment_destroy',
          'enrollment_massive',
          'search_read',
          'report_read'
       ]);

       $manager->givePermissionTo([
          'moodle_read',
          'moodle_write',
          'moodle_destroy',
          'moodle_massive',
          'category_read',
          'category_write',
          'category_destroy',
          'program_read',
          'program_write',
          'program_destroy',
          'course_read',
          'course_write',
          'course_destroy',
          'group_read',
          'group_write',
          'group_destroy',
          'rol_read',
          'rol_write',
          'rol_destroy',
          'enrollment_read',
          'enrollment_write',
          'enrollment_destroy',
          'enrollment_massive',
          'search_read',
          'report_read'
       ]);

       $reports->givePermissionTo([
          'report_read'
       ]);
    }
}
