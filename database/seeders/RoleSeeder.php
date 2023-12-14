<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use HasRoles;
    public function run(): void
    {
       $role1= Role::create(['name'=>'administrador']);
        $role2= Role::create(['name'=>'tecnico']);


        Permission::create(['name'=>'estados']);
        Permission::create(['name'=>'estados.index']);
        Permission::create(['name'=>'estados.create']);
        Permission::create(['name'=>'estados.edit']);
        Permission::create(['name'=>'estados.destroy']);


        Permission::create(['name'=>'tareas.index']);
        Permission::create(['name'=>'tareas.create']);
        Permission::create(['name'=>'tareas.edit']);
        Permission::create(['name'=>'tareas.destroy']);



        Permission::create(['name'=>'areas.index']);
        Permission::create(['name'=>'areas.create']);
        Permission::create(['name'=>'areas.edit']);
        Permission::create(['name'=>'areas.destroy']);

        Permission::create(['name'=>'users.index']);
        Permission::create(['name'=>'users.create']);
        Permission::create(['name'=>'users.edit']);
        Permission::create(['name'=>'users.destroy']);
    }
}
