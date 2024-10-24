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
        
        /** Nota:Se recomienda que a cada permiso se les ponga el mismo nombre que se les podrá a las rutas a   *proteger con permisos
        *Ejemplo: si quieres que la ruta: /admin.evaluaciones, solo lo pueda ver un admin, a ese permiso colocar "admin.evaluaciones"  
        */

        //permiso para proteger la sección con ruta "admin.evaluaciones"
        //syncRoles: para sincronizar un permiso a varios roles
        
        // Permisos para el módulo de Evaluaciones, accesible solo para el rol User
        Permission::create(['name' => 'user.evaluaciones'])->assignRole($roleUser);

        // Permiso para visualizar la tabla de evaluaciones
        Permission::create(['name' => 'user.evaluaciones.index'])->assignRole($roleUser);

        // Permiso para crear una evaluación
        Permission::create(['name' => 'user.evaluaciones.create'])->assignRole($roleUser);

        // Permiso para editar una evaluación
        Permission::create(['name' => 'user.evaluaciones.edit'])->assignRole($roleUser);

       // Permiso para eliminar una evaluación
        Permission::create(['name' => 'user.evaluaciones.destroy'])->assignRole($roleUser);


        // Permisos para el módulo de Finanzas
        Permission::create(['name' => 'admin.finanzas.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.finanzas.create'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.finanzas.edit'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.finanzas.destroy'])->assignRole($roleAdmin);
       
        // Permisos para el módulo de Catálogos (Admin y User)
        Permission::create(['name' => 'catalogos'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'catalogos.index'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'catalogos.create'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'catalogos.edit'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'catalogos.destroy'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'catalogos.download'])->syncRoles([$roleAdmin, $roleUser]);
        

        // Permisos para el módulo de Operaciones
        Permission::create(['name' => 'operaciones'])->syncRoles([$roleAdmin, $roleUser]); 
        Permission::create(['name' => 'operaciones.index'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'operaciones.create'])->assignRole($roleUser); 
        Permission::create(['name' => 'operaciones.edit'])->assignRole($roleUser); 
        Permission::create(['name' => 'operaciones.destroy'])->assignRole($roleUser); 
        
        // Permisos para el módulo de Informes Operativos
        Permission::create(['name' => 'reportes'])->syncRoles([$roleAdmin, $roleUser]); // Acceso general
        Permission::create(['name' => 'reportes.index'])->syncRoles([$roleAdmin, $roleUser]); // Ver informes
        Permission::create(['name' => 'reportes.create'])->assignRole($roleUser); // Solo el usuario puede crear
        Permission::create(['name' => 'reportes.edit'])->assignRole($roleUser); // Solo el usuario puede editar
        Permission::create(['name' => 'reportes.destroy'])->assignRole($roleUser); // Solo el usuario puede eliminar
        Permission::create(['name' => 'reportes.download'])->syncRoles([$roleAdmin, $roleUser]);
        

        // Permisos para el módulo de permisos al que solo el Admin tiene acceso
         Permission::create(['name' => 'admin.permisos.index'])->assignRole($roleAdmin);
         Permission::create(['name' => 'admin.permisos.create'])->assignRole($roleAdmin);
         Permission::create(['name' => 'admin.permisos.edit'])->assignRole($roleAdmin);
         Permission::create(['name' => 'admin.permisos.destroy'])->assignRole($roleAdmin);
         
         
         // Permisos para el módulo de Roles, accesible solo para el Admin
         Permission::create(['name' => 'admin.roles.index'])->assignRole($roleAdmin); // Solo Admin puede ver el módulo de roles
         Permission::create(['name' => 'admin.roles.create'])->assignRole($roleAdmin); // Solo Admin puede crear roles
         Permission::create(['name' => 'admin.roles.edit'])->assignRole($roleAdmin); // Solo Admin puede editar roles
         Permission::create(['name' => 'admin.roles.destroy'])->assignRole($roleAdmin); // Solo Admin puede eliminar roles

         // Permisos para el módulo de Usuarios, accesible solo para el Admin
         Permission::create(['name' => 'admin.usuarios.index'])->assignRole($roleAdmin); // Solo Admin puede ver el módulo de usuarios
         Permission::create(['name' => 'admin.usuarios.create'])->assignRole($roleAdmin); // Solo Admin puede crear usuarios
         Permission::create(['name' => 'admin.usuarios.edit'])->assignRole($roleAdmin); // Solo Admin puede editar usuarios
         Permission::create(['name' => 'admin.usuarios.destroy'])->assignRole($roleAdmin); // Solo Admin puede eliminar usuarios
         
    } 
    
}
