<?php $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>
Roles y Permisos | KYP BIOINGENIERIA
<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>
<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
  Gestor de Roles y Permisos
</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
  <li class="breadcrumb-item text-muted">Autenticación</li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Roles</li>
</ul>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card mt-5">
  <div class="card-header border-0 pt-6">
    <div class="card-title">
      <div class="d-flex align-items-center position-relative my-1">
        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"></i>
        <input type="text" data-kt-role-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Rol" />
      </div>
    </div>
    <div class="card-toolbar">
      <div class="d-flex justify-content-end">
        <a href="<?= base_url('users/roles/new') ?>" class="btn btn-primary">
          <i class="ki-duotone ki-plus fs-2"></i>Agregar Rol</a>
      </div>
    </div>
  </div>
  <div class="card-body py-4">
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_roles">
      <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
          <th class="text-center min-w-50px">#</th>
          <th class="min-w-150px">Nombre del Rol</th>
          <th class="min-w-200px">Descripción</th>
          <th class="text-center min-w-100px">Permisos</th>
          <th class="text-center min-w-100px">Usuarios</th>
          <th class="text-end min-w-100px">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 fw-semibold">
        <?php foreach ($roles as $index => $role): ?>
          <tr>
            <td class="text-center"><?= $index + 1; ?></td>
            <td><?= $role['nombre']; ?></td>
            <td><?= $role['descripcion']; ?></td>
            <td class="text-center">
              <span class="badge badge-light-info"><?= $role['permisos_count'] ?? '0'; ?> Permisos</span>
            </td>
            <td class="text-center">
              <span class="badge badge-light-primary"><?= $role['usuarios_count'] ?? '0'; ?> Usuarios</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                Acciones
                <span class="svg-icon fs-5 m-0">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <polygon points="0 0 24 0 24 24 0 24"></polygon>
                      <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                    </g>
                  </svg>
                </span>
              </a>

              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                <div class="menu-item px-3">
                  <a href="<?= base_url('users/roles/edit/' . $role['id']); ?>" class="menu-link px-3">Editar</a>
                </div>
                <div class="menu-item px-3">
                  <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_delete_role">Eliminar</a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  const KTDatatables = function() {
    let dt_roles;

    const initDatatable = () => {
      dt_roles = $("#kt_table_roles").DataTable({
        searchDelay: 500,
        responsive: true,
        processing: true,
        order: [
          [0, 'asc']
        ],
        "language": {
          "url": "<?= base_url('assets/i18n/Spanish.json') ?>"
        }
      });
    }

    const handleSearchRoles = () => {
      const filter = document.querySelector('[data-kt-role-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_roles.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearchRoles();
      }
    }
  }();

  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });
</script>

<?= $this->endSection() ?>