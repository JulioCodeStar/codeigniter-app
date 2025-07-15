<?php

use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\UserRoleModel;

if (!function_exists('user_has_permission')) {
    function user_has_permission(string $slug): bool
    {
        $session    = session();
        $userId     = $session->get('user')['user_id'];
        if (!$userId) return false;

        $permModel  = new PermissionModel();
        $perm       = $permModel->where('nombres', $slug)->first();
        if (!$perm) return false;

        $userRoleModel = new UserRoleModel();
        $roles        = $userRoleModel->where('user_id', $userId)->findAll();
        $roleIds      = array_column($roles, 'role_id');
        if (empty($roleIds)) return false;

        $rolePermModel = new RolePermissionModel();
        return $rolePermModel
            ->whereIn('role_id', $roleIds)
            ->where('permisos_id', $perm['id'])
            ->countAllResults() > 0;
    }
}

if (!function_exists('show_if_permission')) {
    function show_if_permission($permissions)
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        foreach ($permissions as $perm) {
            if (user_has_permission($perm)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('permisos_pacientes')) {
    function permisos_pacientes(): array
    {
        return [
            'gestion_pacientes.pacientes.listado',
            'gestion_pacientes.pacientes.create',
            'gestion_pacientes.cotizaciones.listado',
            'gestion_pacientes.cotizaciones.create',
            'gestion_pacientes.historial',
            'gestion_pacientes.contratos',
            'gestion_pacientes.ventas_accesorios',
            'gestion_pacientes.citas',
            'gestion_pacientes.mantenimiento',
        ];
    }
}

if (!function_exists('permisos_logistica')){
    function permisos_logistica(): array
    {
        return [
            'logistica.orden_de_compra.listado',
            'logistica.orden_de_compra.create',
            'logistica.orden_de_compra.proveedores',
            'logistica.orden_de_compra.delete',
            'logistica.orden_de_trabajo.listado',
            'logistica.orden_de_trabajo.create',
            'logistica.orden_de_trabajo.delete',
            'logistica.orden_de_importacion.listado',
            'logistica.orden_de_importacion.create',
            'logistica.orden_de_importacion.delete',
            'logistica.produccion.sidebar',
            'logistica.produccion.seguimiento'
        ];
    }
}

if (!function_exists('user_has_permission_sales')) {
    function user_has_permission_sales(string $slug): bool
    {
        $session    = session();
        $userId     = $session->get('caja_user')['id'];
        if (!$userId) return false;

        $permModel  = new PermissionModel();
        $perm       = $permModel->where('nombres', $slug)->first();
        if (!$perm) return false;

        $userRoleModel = new UserRoleModel();
        $roles        = $userRoleModel->where('user_id', $userId)->findAll();
        $roleIds      = array_column($roles, 'role_id');
        if (empty($roleIds)) return false;

        $rolePermModel = new RolePermissionModel();
        return $rolePermModel
            ->whereIn('role_id', $roleIds)
            ->where('permisos_id', $perm['id'])
            ->countAllResults() > 0;
    }
}

if (!function_exists('sedes_permitidas_reporte')) {
    function sedes_permitidas_reporte(): array
    {
      $sedes = [];
  
      if (user_has_permission('caja_ventas.reportes.sede_lima')) {
        $sedes[] = 1; // ID de Lima
      }
  
      if (user_has_permission('caja_ventas.reportes.sede_arequipa')) {
        $sedes[] = 2; // ID de Arequipa
      }
  
      if (user_has_permission('caja_ventas.reportes.sede_chiclayo')) {
        $sedes[] = 3; // ID de Chiclayo
      }
      
      if (user_has_permission('caja_ventas.reportes.sede_piura')) {
        $sedes[] = 4; // ID de Piura
      }
  
      return $sedes;
    }
  }
  