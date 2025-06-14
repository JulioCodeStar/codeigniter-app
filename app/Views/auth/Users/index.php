<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Gestion de Usuarios | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

<h1
  class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
  Mantenimiento de Usuarios
</h1>

<ul
  class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

  <li class="breadcrumb-item text-muted">Autenticación</li>

  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>

  <li class="breadcrumb-item text-muted">Usuarios</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!--begin::Card-->
<div class="card mt-5">
  <!--begin::Card header-->
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title">
      <!--begin::Search-->
      <div class="d-flex align-items-center position-relative my-1">
        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
          <span class="path1"></span>
          <span class="path2"></span>
        </i>
        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Usuario" />
      </div>
      <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
      <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#create_user">
          <i class="ki-duotone ki-plus fs-2"></i>Agregar Usuario</a>
      </div>

      <div
        class="modal fade"
        id="create_user"
        tabindex="-1"
        aria-hidden="true">

        <div
          class="modal-dialog modal-dialog-centered mw-650px">

          <div class="modal-content">

            <div
              class="modal-header"
              id="kt_form_user_header">

              <h2 class="fw-bold">Agregar Usuario</h2>

              <div
                class="btn btn-icon btn-sm btn-active-icon-primary"
                data-bs-dismiss="modal">
                <i class="ki-duotone ki-cross fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </div>
            </div>

            <div class="modal-body px-5 my-7">

              <?= form_open('api/auth/create', ['id' => 'kt_form_user', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

              <div
                class="d-flex flex-column scroll-y px-5 px-lg-10"
                id="kt_form_user_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="true"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_form_user_header"
                data-kt-scroll-wrappers="#kt_form_user_scroll"
                data-kt-scroll-offset="300px">

                <div class="fv-row row mb-7">
                  <div class="col-6">
                    <label
                      class="required fw-semibold fs-6 mb-2">Nombres Completos</label>

                    <input
                      type="text"
                      name="nombres"
                      id="nombres"
                      class="form-control form-control-solid mb-3 mb-lg-0"
                      placeholder="Nombres Completos" />
                  </div>

                  <div class="col-6">
                    <label
                      class="required fw-semibold fs-6 mb-2">Apellidos Completos</label>

                    <input
                      type="text"
                      name="apellidos"
                      id="apellidos"
                      class="form-control form-control-solid mb-3 mb-lg-0"
                      placeholder="Apellidos Completos" />
                  </div>

                </div>

                <div class="fv-row mb-7">

                  <label
                    class="required fw-semibold fs-6 mb-2">Email</label>

                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control form-control-solid mb-3 mb-lg-0"
                    placeholder="example@kypbioingenieria.com" />

                </div>

                <div class="fv-row mb-7" data-kt-password-meter="true">

                  <label
                    class="required fw-semibold fs-6 mb-2">Contraseña</label>

                  <div class="position-relative mb-3">
                    <input class="form-control form-control-solid mb-3 mb-lg-0"
                      type="password" placeholder="•••••••••••••••••" id="password" name="password" autocomplete="off" />

                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                      data-kt-password-meter-control="visibility">
                      <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                      <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </span>
                    <!--end::Visibility toggle-->
                  </div>
                  <!--end::Input wrapper-->
                </div>

                <div class="mb-5 fv-row">
                  <label
                    class="required fw-semibold fs-6 mb-5">Roles</label>
                  <?php foreach ($roles as $role) : ?>
                    <div class="d-flex">
                      <div
                        class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input
                          class="form-check-input me-3"
                          name="user_role"
                          id="user_role_<?= $role['id'] ?>"
                          type="radio"
                          value="<?= $role['id'] ?>" />
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label
                          class="form-check-label"
                          for="user_role_<?= $role['id'] ?>">
                          <div class="fw-bold text-gray-800">
                            <?= $role['nombre'] ?>
                          </div>
                          <div class="text-gray-600">
                            <?= $role['descripcion'] ?>
                          </div>
                        </label>
                      </div>
                    </div>
                    <div class="separator separator-dashed my-5"></div>
                  <?php endforeach; ?>
                </div>

                <div class="separator separator-dashed my-5"></div>

                <div class="fv-row mb-7">
                  <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" name="acceso_caja" id="acceso_caja" value="1" />
                    <span class="form-check-label">Acceso a Caja de Ventas</span>
                  </label>
                </div>

                <div id="sedes_container" class="fv-row mb-7 d-none">
                  <label class="fw-semibold fs-6 mb-2">Sedes habilitadas</label>
                  <div class="d-flex flex-wrap gap-3">
                    <div class="form-check form-check-custom form-check-solid me-5">
                      <input class="form-check-input" type="checkbox" name="sedes[]" value="1" id="sede_lima" />
                      <label class="form-check-label" for="sede_lima">Lima</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid me-5">
                      <input class="form-check-input" type="checkbox" name="sedes[]" value="2" id="sede_arequipa" />
                      <label class="form-check-label" for="sede_arequipa">Arequipa</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                      <input class="form-check-input" type="checkbox" name="sedes[]" value="3" id="sede_chiclayo" />
                      <label class="form-check-label" for="sede_chiclayo">Chiclayo</label>
                    </div>
                  </div>
                </div>

                <!--end::Input group-->
              </div>
              <!--end::Scroll-->
              <!--begin::Actions-->
              <div class="text-center pt-10">
                <button
                  type="reset"
                  class="btn btn-light me-3"
                  data-bs-dismiss="modal">
                  Cancel
                </button>
                <button
                  type="click"
                  id="kt_submit_form_user"
                  class="btn btn-primary">
                  <span class="indicator-label">Guardar</span>
                  <span class="indicator-progress">Guardando...
                    <span
                      class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
              </div>
              <!--end::Actions-->
              <?= form_close() ?>
              <!--end::Form-->
            </div>
            <!--end::Modal body-->
          </div>
          <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
      </div>
    </div>
    <!--end::Card toolbar-->
  </div>
  <!--end::Card header-->


  <!--begin::Card body-->
  <div class="card-body py-4">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
      <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
          <th class="min-w-125px text-center">N°</th>
          <th class="min-w-125px">Nombres y Apellidos</th>
          <th class="min-w-125px">Correo</th>
          <th class="min-w-125px text-center">Roles</th>
          <th class="min-w-125px text-center">Estado</th>
          <th class="min-w-100px text-center">Fecha</th>
          <th class="text-end min-w-100px">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-ray-600 fw-semibold">
        <?php foreach ($users as $index => $row) : ?>
          <tr>
            <td class="text-center"><?= $index + 1 ?></td>
            <td><?= mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></td>
            <td class=""><?= $row['email'] ?></td>
            <td class="text-center"><span class="badge badge-light-primary"><?= $row['rol'] ?></span></td>
            <td class="text-center"><?= $row['is_active'] == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>' ?></td>
            <td class="text-center"><?= fecha_dmy($row['created_at']) ?></td>
            <td class="text-end">
              <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                Actions
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
                <?php if ($row['is_active'] == 1) : ?>
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#editarModal" data-bs-url="<?= base_url('api/auth/show/' . $row['id']) ?>">Editar</a>
                  </div>
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#inactivarModal" data-bs-url="<?= base_url('api/auth/inactive/' . $row['id']) ?>">Inactivar</a>
                  </div>
                <?php else : ?>
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#activarModal" data-bs-url="<?= base_url('api/auth/active/' . $row['id']) ?>">Activar</a>
                  </div>
                  <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-url="<?= base_url('api/auth/delete/' . $row['id']) ?>">Eliminar</a>
                  </div>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <!--end::Table-->
  </div>
  <!--end::Card body-->
</div>
<!--end::Card-->


<!--begin::Modal Inactivar -->
<div class="modal fade" tabindex="-1" id="inactivarModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content position-absolute">
      <div class="modal-header">
        <h5 class="modal-title">Aviso</h5>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Close-->
      </div>

      <div class="modal-body">
        <p>¿Deseas Inactivar a este usuario del sistema?</p>
      </div>

      <div class="modal-footer">
        <form id="form-inactivar" action="" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="delete">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Inactivar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--end::Modal Inactivar -->

<!--begin::Modal Activar -->
<div class="modal fade" tabindex="-1" id="activarModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content position-absolute">
      <div class="modal-header">
        <h5 class="modal-title">Aviso</h5>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Close-->
      </div>

      <div class="modal-body">
        <p>¿Deseas Activar a este usuario del sistema?</p>
      </div>

      <div class="modal-footer">
        <form id="form-activar" action="" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="delete">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Activar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--end::Modal Activar -->

<!--begin::Modal Eliminar -->
<div class="modal fade" tabindex="-1" id="eliminarModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content position-absolute">
      <div class="modal-header">
        <h5 class="modal-title">Aviso</h5>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Close-->
      </div>

      <div class="modal-body">
        <p>¿Deseas Eliminar a este usuario del sistema?</p>
      </div>

      <div class="modal-footer">
        <form id="form-eliminar" action="" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="delete">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--end::Modal Eliminar -->

<!--begin::Modal Editar -->
<div
  class="modal fade"
  id="editarModal"
  tabindex="-1"
  aria-hidden="true">

  <div
    class="modal-dialog modal-dialog-centered mw-650px">

    <div class="modal-content">

      <div
        class="modal-header"
        id="kt_form_edit_user_header">

        <h2 class="fw-bold">Editar Usuario</h2>

        <div
          class="btn btn-icon btn-sm btn-active-icon-primary"
          data-bs-dismiss="modal">
          <i class="ki-duotone ki-cross fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>
        </div>
      </div>

      <div class="modal-body px-5 my-7">

        <?= form_open('', ['id' => 'kt_form_edit_user', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

        <div
          class="d-flex flex-column scroll-y px-5 px-lg-10"
          id="kt_form_edit_user_scroll"
          data-kt-scroll="true"
          data-kt-scroll-activate="true"
          data-kt-scroll-max-height="auto"
          data-kt-scroll-dependencies="#kt_form_edit_user_header"
          data-kt-scroll-wrappers="#kt_form_edit_user_scroll"
          data-kt-scroll-offset="300px">

          <div class="fv-row row mb-7">
            <div class="col-6">
              <label
                class="required fw-semibold fs-6 mb-2">Nombres Completos</label>
              <input
                type="text"
                name="nombres_edit"
                id="nombres_edit"
                class="form-control form-control-solid mb-3 mb-lg-0"
                placeholder="Nombres Completos" />
            </div>

            <div class="col-6">
              <label
                class="required fw-semibold fs-6 mb-2">Apellidos Completos</label>

              <input
                type="text"
                name="apellidos_edit"
                id="apellidos_edit"
                class="form-control form-control-solid mb-3 mb-lg-0"
                placeholder="Apellidos Completos" />
            </div>

          </div>

          <div class="fv-row mb-7">

            <label
              class="required fw-semibold fs-6 mb-2">Email</label>

            <input
              type="email"
              name="email_edit"
              id="email_edit"
              class="form-control form-control-solid mb-3 mb-lg-0"
              placeholder="example@kypbioingenieria.com" />

          </div>

          <div class="fv-row mb-7" data-kt-password-meter="true">

            <label
              class="required fw-semibold fs-6 mb-2">Contraseña</label>

            <div class="position-relative mb-3">
              <input class="form-control form-control-solid mb-3 mb-lg-0"
                type="password" placeholder="•••••••••••••••••" id="password_edit" name="password_edit" autocomplete="off" />

              <!--begin::Visibility toggle-->
              <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                data-kt-password-meter-control="visibility">
                <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
              </span>
              <!--end::Visibility toggle-->
            </div>
            <!--end::Input wrapper-->
          </div>

          <div class="mb-5 fv-row">
            <label
              class="required fw-semibold fs-6 mb-5">Roles</label>
            <?php foreach ($roles as $role) : ?>
              <div class="d-flex">
                <div
                  class="form-check form-check-custom form-check-solid">
                  <!--begin::Input-->
                  <input
                    class="form-check-input me-3"
                    name="user_role_edit"
                    id="user_role_edit_<?= $role['id'] ?>"
                    type="radio"
                    value="<?= $role['id'] ?>" />
                  <!--end::Input-->
                  <!--begin::Label-->
                  <label
                    class="form-check-label"
                    for="user_role_edit_<?= $role['id'] ?>">
                    <div class="fw-bold text-gray-800">
                      <?= $role['nombre'] ?>
                    </div>
                    <div class="text-gray-600">
                      <?= $role['descripcion'] ?>
                    </div>
                  </label>
                </div>
              </div>
              <div class="separator separator-dashed my-5"></div>
            <?php endforeach; ?>
          </div>

          <div class="mb-7">
            <label class="fs-6 fw-bold mb-3">Acceso a Caja de Ventas</label>
            <div class="form-check form-check-custom form-check-solid">
              <input class="form-check-input" type="checkbox" name="acceso_caja" id="edit_acceso_caja" />
              <label class="form-check-label" for="edit_acceso_caja">
                Habilitar acceso
              </label>
            </div>

            <div id="edit_sedes_wrapper" class="mt-4" style="display: none;">
              <label class="fs-7 fw-semibold">Sedes permitidas:</label>
              <?php foreach ($sedes as $sede): ?>
                <div class="form-check form-check-custom form-check-solid">
                  <input class="form-check-input" type="checkbox" name="sedes[]" value="<?= $sede['id'] ?>" id="edit_sede_<?= $sede['id'] ?>" />
                  <label class="form-check-label" for="edit_sede_<?= $sede['id'] ?>">
                    <?= $sede['sucursal'] ?>
                  </label>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <!--end::Input group-->
        </div>
        <!--end::Scroll-->
        <!--begin::Actions-->
        <div class="text-center pt-10">
          <button
            type="reset"
            class="btn btn-light me-3"
            data-bs-dismiss="modal">
            Cancel
          </button>
          <button
            type="click"
            id="kt_submit_form_user_edit"
            class="btn btn-primary">
            <span class="indicator-label">Guardar</span>
            <span class="indicator-progress">Guardando...
              <span
                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
          </button>
        </div>
        <!--end::Actions-->
        <?= form_close() ?>
        <!--end::Form-->
      </div>
      <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
  </div>
  <!--end::Modal dialog-->
</div>
<!--end::Modal Editar-->

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= csrf_scripts_basic() ?>
<script>
  const KTDatatables = function() {
    let dt_users;

    const initDatatable = () => {
      dt_users = $("#kt_table_users").DataTable({
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

    const handleSearchUsers = () => {
      const filter = document.querySelector('[data-kt-user-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_users.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearchUsers();
      }
    }
  }();

  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });

  const form = document.querySelector("#kt_form_user");

  const validator = FormValidation.formValidation(form, {
    fields: {
      'nombres': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'apellidos': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'email': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'password': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'user_role': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      }
    },

    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap5({
        rowSelector: '.fv-row',
        eleInvalidClass: '',
        leValidClass: ''
      })
    }
  });

  const submit = document.querySelector('#kt_submit_form_user');
  submit.addEventListener('click', function(e) {
    e.preventDefault();
    if (!validator) {
      return;
    }

    validator.validate().then(function(status) {
      if (status == 'Valid') {
        submit.setAttribute('data-kt-indicator', 'on');
        submit.disabled = true;

        const executeFetch = async () => {
          try {
            const response = await fetch(form.action, {
              method: 'POST',
              body: new FormData(form),
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
              }
            });

            if (response.status === 403) {
              await updateCsrfToken(); // Usar helper aquí
              return executeFetch(); // Reintentar
            }

            const data = await response.json();

            if (!response.ok || data.status >= 400) {
              Swal.fire({
                text: data.message || 'Error en el servidor',
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Entendido',
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            } else {
              Swal.fire({
                text: data.message,
                icon: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Entendido',
                customClass: {
                  confirmButton: 'btn btn-primary'
                },
                preConfirm: () => {
                  if (data.redirect) {
                    window.location.href = data.redirect;
                  }
                }
              });
            }

          } catch (error) {
            console.error('Error:', error);
          } finally {
            submit.removeAttribute('data-kt-indicator');
            submit.disabled = false;
          }
        };

        setTimeout(executeFetch, 2000);
      }
    })
  });


  const inactivarModal = document.querySelector("#inactivarModal");
  if (inactivarModal) {
    inactivarModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      const form = inactivarModal.querySelector("#form-inactivar");
      form.setAttribute('action', url);
    })
  }

  const activarModal = document.querySelector("#activarModal");
  if (activarModal) {
    activarModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      const form = activarModal.querySelector("#form-activar");
      form.setAttribute('action', url);
    })
  }

  const eliminarModal = document.querySelector("#eliminarModal");
  if (eliminarModal) {
    eliminarModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      const form = eliminarModal.querySelector("#form-eliminar");
      form.setAttribute('action', url);
    })
  }

  const editarModal = document.querySelector("#editarModal");
  if (editarModal) {
    editarModal.addEventListener('show.bs.modal', async (event) => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      try {
        const res = await fetch(url, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        const result = await res.json();
        const user = result.data.user;

        // Completa los campos
        editarModal.querySelector('[name="nombres_edit"]').value = user.nombres;
        editarModal.querySelector('[name="apellidos_edit"]').value = user.apellidos;
        editarModal.querySelector('[name="email_edit"]').value = user.email;
        editarModal.querySelector('[name="password_edit"]').value = '';
        // Acceso a caja
        if (result.data.caja && result.data.caja.activo) {
          editarModal.querySelector('#edit_acceso_caja').checked = true;
          editarModal.querySelector('#edit_sedes_wrapper').style.display = 'block';

          result.data.caja.sedes.forEach(sedeId => {
            const checkbox = editarModal.querySelector(`#edit_sede_${sedeId}`);
            if (checkbox) checkbox.checked = true;
          });
        } else {
          editarModal.querySelector('#edit_acceso_caja').checked = false;
          editarModal.querySelector('#edit_sedes_wrapper').style.display = 'none';
        }


        // Asigna el role seleccionado si tienes el ID de rol en la respuesta (añade si es necesario)
        if (user.rol_id) {
          const roleInput = editarModal.querySelector(`[name="user_role_edit"][value="${user.rol_id}"]`);
          if (roleInput) roleInput.checked = true;
        }

        // Asigna la URL de envío para actualizar el usuario
        const form = editarModal.querySelector("form");
        form.setAttribute('action', `<?= base_url('api/auth/edit/') ?>/${user.id}`);

      } catch (err) {
        console.error('Error al cargar datos del usuario:', err);
      }
    });
  }

  const formEdit = document.querySelector("#kt_form_edit_user");

  const validatorEdit = FormValidation.formValidation(formEdit, {
    fields: {
      'nombres': {
        validators: {
          notEmpty: {
            message: 'El campo es obligatorio'
          }
        }
      },
      'apellidos': {
        validators: {
          notEmpty: {
            message: 'El campo es obligatorio'
          }
        }
      },
      'email': {
        validators: {
          notEmpty: {
            message: 'El campo es obligatorio'
          },
          emailAddress: {
            message: 'El formato no es válido'
          }
        }
      },
      // No obligatorio pero puede validarse si no está vacío
      'password': {
        validators: {
          stringLength: {
            min: 6,
            message: 'La contraseña debe tener al menos 6 caracteres'
          }
        }
      },
      'user_role': {
        validators: {
          notEmpty: {
            message: 'Debe seleccionar un rol'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap5({
        rowSelector: '.fv-row',
        eleInvalidClass: '',
        eleValidClass: ''
      })
    }
  });

  const submitEdit = document.querySelector('#kt_submit_form_user_edit');

  submitEdit.addEventListener('click', function(e) {
    e.preventDefault();
    if (!validatorEdit) return;

    validatorEdit.validate().then(function(status) {
      if (status === 'Valid') {
        submitEdit.setAttribute('data-kt-indicator', 'on');
        submitEdit.disabled = true;

        const executeEdit = async () => {
          try {
            const response = await fetch(formEdit.action, {
              method: 'POST',
              body: new FormData(formEdit),
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
              }
            });

            if (response.status === 403) {
              await updateCsrfToken();
              return executeEdit();
            }

            const data = await response.json();

            Swal.fire({
              text: data.message || 'Actualización exitosa',
              icon: data.status >= 400 ? 'error' : 'success',
              buttonsStyling: false,
              confirmButtonText: 'Entendido',
              customClass: {
                confirmButton: data.status >= 400 ? 'btn btn-danger' : 'btn btn-primary'
              },
              preConfirm: () => {
                if (data.redirect) {
                  window.location.href = data.redirect;
                }
              }
            });

          } catch (error) {
            console.error('Error al actualizar:', error);
          } finally {
            submitEdit.removeAttribute('data-kt-indicator');
            submitEdit.disabled = false;
          }
        };

        setTimeout(executeEdit, 2000);
      }
    });
  });

  document.addEventListener('DOMContentLoaded', () => {
    const checkboxCaja = document.querySelector('#acceso_caja');
    const sedesContainer = document.querySelector('#sedes_container');

    if (checkboxCaja) {
      checkboxCaja.addEventListener('change', () => {
        if (checkboxCaja.checked) {
          sedesContainer.classList.remove('d-none');
        } else {
          sedesContainer.classList.add('d-none');
        }
      });
    }
  });

  document.getElementById('edit_acceso_caja').addEventListener('change', function() {
    const wrapper = document.getElementById('edit_sedes_wrapper');
    wrapper.style.display = this.checked ? 'block' : 'none';
  });
</script>
<?= $this->endSection(); ?>