<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\CajaVentasModel;
use App\Models\PermissionModel;
use App\Models\Production\ProductionUserModel;
use App\Models\RoleModel;
use App\Models\RolePermissionModel;
use App\Models\SedeModel;
use App\Models\UserRoleModel;
use App\Models\Users;

class UserController extends BaseController
{
  protected $userModel, $rolModel, $userRolModel, $permisoModel, $rolePermisoModel, $cajaAccesoModel, $sedesModel, $userProductionModel;

  protected $area_production = [
    'Desarrollo Tecnológico',
    'Producción',
    'Textil'
  ];
  
  function __construct()
  {
    $this->userModel            = new Users();
    $this->rolModel             = new RoleModel();
    $this->userRolModel         = new UserRoleModel();
    $this->permisoModel         = new PermissionModel();
    $this->rolePermisoModel     = new RolePermissionModel();
    $this->cajaAccesoModel      = new CajaVentasModel();
    $this->sedesModel           = new SedeModel();
    $this->userProductionModel  = new ProductionUserModel();
  }

  public function index()
  {
    $data['users'] = $this->userModel->getUsersRoles();
    $data['roles'] = $this->rolModel->findAll();
    $data['sedes'] = $this->sedesModel->findAll();
    $data['area_production'] = $this->area_production;
    return view('auth/Users/index', $data);
  }

  public function create()
  {
    try {
      $data = [
        'nombres' => $this->request->getPost('nombres'),
        'apellidos' => $this->request->getPost('apellidos'),
        'email' => $this->request->getPost('email'),
        'password' => $this->request->getPost('password'),
      ];

      // Verificar si el email ya existe
      $existingUser = $this->userModel->where('email', $data['email'])->first();
      if ($existingUser) {
        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(400)
            ->setJSON([
              'status' => 400,
              'message' => 'El email ya está registrado'
            ]);
        }
        return redirect()->back()->with('error', 'El email ya está registrado');
      }

      $this->userModel->insert($data);
      // Recuperar el usuario insertado por email (u otro campo único)
      $user = $this->userModel->where('email', $data['email'])->first();
      $userId = $user['id'];

      if ($userId) {
        $this->userRolModel->insert([
          'user_id' => $userId,
          'role_id' => $this->request->getPost('user_role'),
        ]);

        if ($this->request->getPost('acceso_caja')) {
          $sedes = $this->request->getPost('sedes');
          if (is_array($sedes)) {
            foreach ($sedes as $sedeId) {
              $this->cajaAccesoModel->insert([
                'user_id'    => $userId,
                'sede_id'    => $sedeId,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
              ]);
            }
          }
        }

        if ($this->request->getPost('gestion_produccion')) {
          $areas = $this->request->getPost('area');
          if (is_array($areas)) {
            foreach ($areas as $area) {
              $this->userProductionModel->insert([
                'user_id'    => $userId,
                'area'       => $area,
                'is_active'  => 1
              ]);
            }
          }
        }

        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Usuario creado exitosamente',
              'redirect' => 'users'
            ]);
        }

        // 4. Flujo no-AJAX
        return redirect()
          ->to('users')
          ->with('success', 'Usuario creado exitosamente');
      }
    } catch (\Exception $e) {
      // 5. Loguear error
      log_message('error', 'Error al crear usuario: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear usuario: ' . $e->getMessage(),
          ]);
      }

      // 6. Flujo no-AJAX con flashdata de error
      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }

  public function show(string $id)
  {
    $user = $this->userModel
      ->select('users.*, user_roles.role_id as rol_id')
      ->join('user_roles', 'user_roles.user_id = users.id', 'left')
      ->where('users.id', $id)
      ->first();

    // Acceso a caja
    $accesoCaja = $this->cajaAccesoModel
      ->where('user_id', $id)
      ->where('is_active', true)
      ->findAll();

    $sedes = array_column($accesoCaja, 'sede_id');

    // Acceso a producción
    $accesoProduccion = $this->userProductionModel
      ->where('user_id', $id)
      ->where('is_active', true)
      ->findAll();

    $areas = array_column($accesoProduccion, 'area');

    if ($this->request->isAJAX()) {
      return $this->response
        ->setStatusCode(200)
        ->setJSON([
          'status'  => 200, 
          'message' => 'Usuario encontrado',
          'data'    => [
            'user' => $user,
            'caja' => [
              'activo' => count($sedes) > 0,
              'sedes'  => $sedes,
            ],
            'produccion' => [
              'activo' => count($areas) > 0,
              'areas'  => $areas,
            ]
          ]
        ]);
    }
  }


  public function edit(string $id)
  {
    try {
      $data = [
        'nombres'   => $this->request->getPost('nombres_edit'),
        'apellidos' => $this->request->getPost('apellidos_edit'),
        'email'     => $this->request->getPost('email_edit'),
      ];

      $newPassword = $this->request->getPost('password_edit');
      if (!empty($newPassword)) {
        $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
      }

      $this->userModel->update($id, $data);

      // Actualizar rol
      $this->userRolModel
        ->where('user_id', $id)
        ->set(['role_id' => $this->request->getPost('user_role_edit')])
        ->update();

      // Acceso a caja
      $accesoCaja = $this->request->getPost('acceso_caja') === 'on';
      $sedes = $this->request->getPost('sedes') ?? [];

      // Acceso a producción
      $accesoProduccion = $this->request->getPost('gestion_produccion') === 'on';
      $areas = $this->request->getPost('area') ?? [];

      // Eliminar anteriores
      $this->cajaAccesoModel->where('user_id', $id)->delete();
      $this->userProductionModel->where('user_id', $id)->delete();

      if ($accesoCaja) {
        foreach ($sedes as $sedeId) {
          $this->cajaAccesoModel->insert([
            'user_id'   => $id,
            'sede_id'   => $sedeId,
            'is_active' => true,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }
      }

      if ($accesoProduccion) {
        foreach ($areas as $area) {
          $this->userProductionModel->insert([
            'user_id'   => $id,
            'area'      => $area,
            'is_active' => 1,
          ]);
        }
      }

      return $this->response
        ->setStatusCode(200)
        ->setJSON([
          'status'  => 200,
          'message' => 'Usuario actualizado correctamente',
          'redirect' => 'users'
        ]);
    } catch (\Exception $e) {
      log_message('error', 'Error al editar usuario: ' . $e->getMessage());

      return $this->response
        ->setStatusCode(500)
        ->setJSON([
          'status'  => 500,
          'message' => 'Error: ' . $e->getMessage()
        ]);
    }
  }



  public function inactive(string $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->to('users');
    }

    $this->userModel->update($id, ['is_active' => 0]);

    return redirect()->to('users');
  }

  public function active(string $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->to('users');
    }

    $this->userModel->update($id, ['is_active' => 1]);

    return redirect()->to('users');
  }

  public function delete(string $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->to('users');
    }

    $this->userModel->delete($id);

    return redirect()->to('users');
  }



  public function roles()
  {
    $roles = $this->rolModel
      ->select('roles.*, COUNT(DISTINCT role_permisos.permisos_id) as permisos_count, COUNT(DISTINCT user_roles.user_id) as usuarios_count')
      ->join('role_permisos', 'role_permisos.role_id = roles.id', 'left')
      ->join('user_roles', 'user_roles.role_id = roles.id', 'left')
      ->groupBy('roles.id')
      ->findAll();

    return view('auth/roles/index', [
      'roles'    => $roles,
    ]);
  }

  public function new_roles()
  {
    $permisos = $this->permisoModel->findAll();

    $modulosAgrupados = [];
    foreach ($permisos as $permiso) {
      $seccion = strtolower(trim($permiso['seccion']));
      $subSeccion = strtolower(trim($permiso['sub_seccion']));
      $clave = "$seccion.$subSeccion." . strtolower($permiso['accion']);

      if (!isset($modulosAgrupados[$seccion])) {
        $modulosAgrupados[$seccion] = [
          'titulo'    => ucwords(str_replace('_', ' ', $seccion)),
          'subsecciones' => []
        ];
      }

      if (!isset($modulosAgrupados[$seccion]['subsecciones'][$subSeccion])) {
        $modulosAgrupados[$seccion]['subsecciones'][$subSeccion] = [
          'titulo'   => ucwords(str_replace('_', ' ', $subSeccion)),
          'permisos' => []
        ];
      }

      $modulosAgrupados[$seccion]['subsecciones'][$subSeccion]['permisos'][] = [
        'id'     => $permiso['id'],
        'clave'  => $clave,
        'nombre' => $permiso['nombres'],
      ];
    }

    return view('auth/roles/new', [
      'modulos' => $modulosAgrupados,
    ]);
  }

  public function edit_roles(int $id)
  {
    $rol = $this->rolModel->find($id);
    if (!$rol) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Rol no encontrado");
    }

    $permisos = $this->permisoModel->findAll();

    // Agrupar permisos por sección y subsección
    $modulos = [];
    foreach ($permisos as $perm) {
      $modulos[$perm['seccion']]['titulo'] = $perm['seccion'];
      $modulos[$perm['seccion']]['subsecciones'][$perm['sub_seccion']]['titulo'] = $perm['sub_seccion'];
      $modulos[$perm['seccion']]['subsecciones'][$perm['sub_seccion']]['permisos'][] = [
        'id'     => $perm['id'],
        'nombre' => $perm['nombres'],
        'clave'  => "{$perm['seccion']}.{$perm['sub_seccion']}.{$perm['accion']}"
      ];
    }

    // Obtener permisos ya asignados al rol
    $permisosAsignados = $this->rolePermisoModel
      ->select('permisos.seccion, permisos.sub_seccion, permisos.accion')
      ->join('permisos', 'permisos.id = role_permisos.permisos_id')
      ->where('role_id', $id)
      ->findAll();

    $permisosMarcados = array_map(function ($perm) {
      return "{$perm['seccion']}.{$perm['sub_seccion']}.{$perm['accion']}";
    }, $permisosAsignados);

    return view('auth/roles/edit', [
      'rol' => $rol,
      'modulos' => $modulos,
      'permisosMarcados' => $permisosMarcados,
    ]);
  }

  public function store()
  {
    $data = $this->request->getPost();

    $roleData = [
      'nombre'      => $data['nombre'],
      'descripcion' => $data['descripcion'] ?? null,
    ];

    $roleId = $this->rolModel->insert($roleData);

    if (!empty($data['permisos'])) {
      $permisosInsert = [];
      foreach ($data['permisos'] as $clave) {
        [$seccion, $subSeccion, $accion] = explode('.', $clave);
        $permiso = $this->permisoModel
          ->where('LOWER(seccion)', $seccion)
          ->where('LOWER(sub_seccion)', $subSeccion)
          ->where('LOWER(accion)', $accion)
          ->first();

        if ($permiso) {
          $permisosInsert[] = [
            'role_id'    => $roleId,
            'permisos_id' => $permiso['id'],
          ];
        }
      }

      if (!empty($permisosInsert)) {
        $this->rolePermisoModel->insertBatch($permisosInsert);
      }
    }

    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'Rol creado correctamente',
      'redirect' => 'roles'
    ]);
  }

  public function update_role(int $id)
  {
    if (!$this->request->isAJAX()) {
      return $this->response->setStatusCode(403)->setJSON(['status' => 403, 'message' => 'Acceso no autorizado']);
    }

    $nombre = $this->request->getPost('nombre');
    $descripcion = $this->request->getPost('descripcion');
    $permisos = $this->request->getPost('permisos');

    // Validación simple
    if (!$nombre) {
      return $this->response->setJSON([
        'status' => 400,
        'message' => 'El nombre del rol es obligatorio'
      ]);
    }

    // Actualizar datos básicos del rol
    $this->rolModel->update($id, [
      'nombre' => $nombre,
      'descripcion' => $descripcion
    ]);

    // Eliminar todos los permisos actuales asociados al rol
    $this->rolePermisoModel->where('role_id', $id)->delete();

    // Insertar los nuevos permisos seleccionados
    if (!empty($permisos)) {
      foreach ($permisos as $clave) {
        $permiso = $this->permisoModel
          ->where("CONCAT(seccion, '.', sub_seccion, '.', accion)", $clave)
          ->first();

        if ($permiso) {
          $this->rolePermisoModel->insert([
            'role_id' => $id,
            'permisos_id' => $permiso['id'],
          ]);
        }
      }
    }

    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Rol actualizado correctamente',
      'redirect' => 'roles'
    ]);
  }


  public function getEditData($id)
  {
    $rol = $this->rolModel->find($id);
    $permisosAsignados = $this->rolePermisoModel
      ->select('permisos.seccion, permisos.sub_seccion, permisos.accion')
      ->join('permisos', 'permisos.id = role_permisos.permisos_id')
      ->where('role_id', $id)
      ->findAll();

    $rol['permisos_claves_asignados'] = array_map(function ($p) {
      return $p['seccion'] . '.' . $p['sub_seccion'] . '.' . $p['accion'];
    }, $permisosAsignados);

    return $this->response->setJSON($rol);
  }

  public function permisos()
  {
    return view('auth/permisos/index');
  }
}
