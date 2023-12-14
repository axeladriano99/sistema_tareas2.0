<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
