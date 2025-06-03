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

        $userIds = [];

        for ($i = 1; $i <= 10; $i++) {
            $user = [
                'nombres'    => "Usuario{$i}",
                'apellidos'  => "Apellido{$i}",
                'email'      => "usuario{$i}@example.com",
                'password'   => 'Root1234',
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $userModel->insert($user);
            $userIds[] = $userModel->getInsertID(); // Guarda el ID insertado
        }

        // Inserción de roles
        $roles = [
            [
                'nombre'      => 'Administrador',
                'descripcion' => 'Rol de administrador',
                'created_at'  => $now,
            ],
            [
                'nombre'      => 'Recepcionista',
                'descripcion' => 'Rol de recepcionistas',
                'created_at'  => $now,
            ],
            [
                'nombre'      => 'Ventas',
                'descripcion' => 'Rol de ventas',
                'created_at'  => $now,
            ]
        ];
        $this->db->table('roles')->insertBatch($roles);

        // Inserción de permisos
        $permisos = [
            // Pacientes
            ['nombres' => 'gestion_pacientes.pacientes.listado', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'pacientes', 'accion' => 'listado'],
            ['nombres' => 'gestion_pacientes.pacientes.create', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'pacientes', 'accion' => 'create'],
            ['nombres' => 'gestion_pacientes.pacientes.update', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'pacientes', 'accion' => 'update'],
            ['nombres' => 'gestion_pacientes.pacientes.delete', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'pacientes', 'accion' => 'delete'],

            // Cotizaciones
            ['nombres' => 'gestion_pacientes.cotizaciones.listado', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'cotizaciones', 'accion' => 'listado'],
            ['nombres' => 'gestion_pacientes.cotizaciones.create', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'cotizaciones', 'accion' => 'create'],
            ['nombres' => 'gestion_pacientes.cotizaciones.update', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'cotizaciones', 'accion' => 'update'],
            ['nombres' => 'gestion_pacientes.cotizaciones.delete', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'cotizaciones', 'accion' => 'delete'],

            // Otros accesos
            ['nombres' => 'gestion_pacientes.historial', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'historial', 'accion' => 'view'],
            ['nombres' => 'gestion_pacientes.contratos', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'contratos', 'accion' => 'view'],
            ['nombres' => 'gestion_pacientes.ventas_accesorios', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'ventas_accesorios', 'accion' => 'view'],
            ['nombres' => 'gestion_pacientes.citas', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'citas', 'accion' => 'view'],
            ['nombres' => 'gestion_pacientes.mantenimiento', 'seccion' => 'gestion_pacientes', 'sub_seccion' => 'mantenimiento', 'accion' => 'view'],
        ];
        $this->db->table('permisos')->insertBatch($permisos);

        $adminId = $this->db->table('roles')->where('nombre', 'Administrador')->get()->getRow()->id;
        $recepId = $this->db->table('roles')->where('nombre', 'Recepcionista')->get()->getRow()->id;
        $vendId  = $this->db->table('roles')->where('nombre', 'Ventas')->get()->getRow()->id;

        // Obtener todos los permisos
        $permisos = $this->db->table('permisos')->get()->getResultArray();

        // Para admin → todos los permisos
        $adminPerms = array_map(fn($p) => [
            'role_id' => $adminId,
            'permisos_id' => $p['id']
        ], $permisos);

        // Para recepcionista → algunos permisos
        $recepPerms = [];
        foreach ($permisos as $p) {
            if (in_array($p['nombres'], [
                'gestion_pacientes.pacientes.listado',
                'gestion_pacientes.pacientes.create',
                'gestion_pacientes.cotizaciones.listado',
                'gestion_pacientes.cotizaciones.create'
            ])) {
                $recepPerms[] = ['role_id' => $recepId, 'permisos_id' => $p['id']];
            }
        }

        // Para vendedor → otros permisos
        $vendPerms = [];
        foreach ($permisos as $p) {
            if (in_array($p['nombres'], [
                'gestion_pacientes.cotizaciones.listado',
                'gestion_pacientes.cotizaciones.create',
                'gestion_pacientes.contratos'
            ])) {
                $vendPerms[] = ['role_id' => $vendId, 'permisos_id' => $p['id']];
            }
        }

        $this->db->table('role_permisos')->insertBatch([...$adminPerms, ...$recepPerms, ...$vendPerms]);

        // Asignación de roles a usuarios
        $userRoles = [
            ['user_id' => $userIds[0], 'role_id' => $adminId],
            ['user_id' => $userIds[1], 'role_id' => $recepId],
            ['user_id' => $userIds[2], 'role_id' => $vendId],
            ['user_id' => $userIds[3], 'role_id' => $recepId],
            ['user_id' => $userIds[4], 'role_id' => $vendId],
            ['user_id' => $userIds[5], 'role_id' => $recepId],
            ['user_id' => $userIds[6], 'role_id' => $vendId],
            ['user_id' => $userIds[7], 'role_id' => $adminId],
            ['user_id' => $userIds[8], 'role_id' => $recepId],
            ['user_id' => $userIds[9], 'role_id' => $adminId],
        ];
        
        $this->db->table('user_roles')->insertBatch($userRoles);
    }
}
