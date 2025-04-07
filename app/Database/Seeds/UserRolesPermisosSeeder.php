<?php

namespace App\Database\Seeds;

use App\Models\Users;
use CodeIgniter\Database\Seeder;

class UserRolesPermisosSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Instanciamos el modelo para insertar usuarios y ejecutar los beforeInsert.
        $userModel = new Users();

        // Creamos 10 usuarios de ejemplo
        for ($i = 1; $i <= 10; $i++) {
            $user = [
                'nombres'    => "Usuario{$i}",
                'apellidos'  => "Apellido{$i}",
                'email'      => "usuario{$i}@example.com",
                'password'   => 'Root1234', // se aplicará hash en el beforeInsert
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $userModel->insert($user);
        }

        // Inserción de roles
        $roles = [
            [
                'nombre'      => 'Admin',
                'descripcion' => 'Rol de administrador',
                'created_at'  => $now,
            ],
            [
                'nombre'      => 'Usuario',
                'descripcion' => 'Rol de usuario regular',
                'created_at'  => $now,
            ],
        ];
        $this->db->table('roles')->insertBatch($roles);

        // Inserción de permisos
        $permisos = [
            [
                'nombres'     => 'create',
                'descripcion' => 'Permite crear contenido',
                'created_at'  => $now,
            ],
            [
                'nombres'     => 'edit',
                'descripcion' => 'Permite editar contenido',
                'created_at'  => $now,
            ],
            [
                'nombres'     => 'delete',
                'descripcion' => 'Permite eliminar contenido',
                'created_at'  => $now,
            ],
        ];
        $this->db->table('permisos')->insertBatch($permisos);

        // Recuperamos los registros insertados para establecer relaciones.
        $usersData    = $this->db->table('users')->get()->getResult();
        $rolesData    = $this->db->table('roles')->get()->getResult();
        $permisosData = $this->db->table('permisos')->get()->getResult();

        // Asignamos relaciones en la tabla pivote user_roles:
        // Asignamos el rol "Admin" a los primeros 2 usuarios y "Usuario" al resto.
        $userRoles = [];
        foreach ($usersData as $index => $user) {
            if ($index < 2) {
                // Primeros 2 usuarios como Admin
                $userRoles[] = [
                    'user_id' => $user->id,
                    'role_id' => $rolesData[0]->id, // Admin
                ];
            } else {
                // Resto como Usuario
                $userRoles[] = [
                    'user_id' => $user->id,
                    'role_id' => $rolesData[1]->id, // Usuario
                ];
            }
        }
        $this->db->table('user_roles')->insertBatch($userRoles);

        // Asignamos permisos en la tabla pivote role_permisos:
        // Al rol "Admin" se le asignan todos los permisos,
        // y al rol "Usuario" solo se le asignan 'create' y 'edit'.
        $rolePermisos = [];

        // Para el rol Admin: todos los permisos.
        foreach ($permisosData as $permiso) {
            $rolePermisos[] = [
                'role_id'     => $rolesData[0]->id,
                'permisos_id' => $permiso->id,
            ];
        }
        // Para el rol Usuario: solo 'create' y 'edit'
        $rolePermisos[] = [
            'role_id'     => $rolesData[1]->id,
            'permisos_id' => $permisosData[0]->id, // create
        ];
        $rolePermisos[] = [
            'role_id'     => $rolesData[1]->id,
            'permisos_id' => $permisosData[1]->id, // edit
        ];
        $this->db->table('role_permisos')->insertBatch($rolePermisos);
    }
}
