<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //******CREANDO DOS ROLES (VERIFICAR)******
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'User']);


        //******CREANDO PERMISOS Y ASIGNANDOLO A UN ROL (assignRole)******
        
        /** Nota: chepi, se recomienda que a cada permiso se les ponga el mismo nombre que se les podrá a las rutas a   *proteger con permisos
        *Ejemplo: si quieres que la ruta: /admin.evaluaciones, solo lo pueda ver un admin, a ese permiso colocar "admin.evaluaciones"  
        */

        //permiso para proteger la sección con ruta "admin.evaluaciones"
        //syncRoles: para sincronizar un permiso a varios roles
        Permission::create(['name' => 'admin.evaluaciones'])->syncRoles([$roleAdmin, $roleUser]);
        
        //permiso para decidir quien podrá visualizar la tabla de evaluaciones
        Permission::create(['name' => 'admin.evaluaciones.index'])->assignRole($roleAdmin);

        //permiso para proteger quien puede crear una evaluacion
        Permission::create(['name' => 'admin.evaluaciones.create'])->assignRole($roleAdmin);
        
        //permiso para proteger quien puede editar una evaluacion
        Permission::create(['name' => 'admin.evaluaciones.edit'])->assignRole($roleAdmin);

        //permiso para proteger quien puede eliminar una evaluacion
        Permission::create(['name' => 'admin.evaluaciones.destroy'])->assignRole($roleAdmin);

    }
}
