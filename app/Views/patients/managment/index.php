<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Gestion de Pacientes - Citas | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

  <h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Mantenimiento de Pacientes
  </h1>

  <ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Pacientes</li>

    <li class="breadcrumb-item">
      <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Mantenimiento</li>

  </ul>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

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
        <input type="text" data-kt-managment-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Mantenimientos" />
      </div>
      <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        <!--begin::Filter-->
        <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
          <i class="ki-duotone ki-filter fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>Filtros</button>
        <!--begin::Menu 1-->
        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
          <!--begin::Header-->
          <div class="px-7 py-5">
            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
          </div>
          <!--end::Header-->
          <!--begin::Separator-->
          <div class="separator border-gray-200"></div>
          <!--end::Separator-->
          <!--begin::Content-->
          <div class="px-7 py-5" data-kt-user-table-filter="form">
            <!--begin::Input group-->
            <div class="mb-10">
              <label class="form-label fs-6 fw-semibold">Role:</label>
              <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                <option></option>
                <option value="Administrator">Administrator</option>
                <option value="Analyst">Analyst</option>
                <option value="Developer">Developer</option>
                <option value="Support">Support</option>
                <option value="Trial">Trial</option>
              </select>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
              <label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
              <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="two-step" data-hide-search="true">
                <option></option>
                <option value="Enabled">Enabled</option>
              </select>
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="d-flex justify-content-end">
              <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
              <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
            </div>
            <!--end::Actions-->
          </div>
          <!--end::Content-->
        </div>
        <!--end::Menu 1-->
        <!--end::Filter-->
        <!--begin::Export-->
        <button type="button" class="btn btn-light-primary me-3">
          <i class="ki-duotone ki-exit-up fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>Exportar</button>
        <!--end::Export-->

      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Card toolbar-->
  </div>
  <!--end::Card header-->
  <!--begin::Card body-->
  <div class="card-body py-4">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_managment">
      <thead>
        <tr class="fw-bold fs-5 text-gray-800">
          <th>Paciente</th>
          <th class="text-center">Moneda</th>
          <th class="text-center">Monto Total</th>
          <th style="width: 40%;">Descripción</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 fw-semibold">
        <?php foreach ($managment as $row) { ?>
          <tr>
            <td class="d-flex flex-column">
              <h5><?= mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></h5>
              <p class="text-muted"><?= $row['cod_paciente'] . ' | ' . $row['trabajo'] ?></p>
            </td>
            <td class="text-center"><?= $row['moneda'] ?></td>
            <td class="text-center text-primary fs-5">
              <?= ($row['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($row['monto']) ?>
            </td>
            <td class="text-muted">
              <?= $row['observaciones'] ?>
            </td>
            <td>
              <?= fecha_dmy($row['created_at']) ?>
            </td>
            <td class="text-center">
              <a href="<?= base_url('sales/managment/generate/' . $row['id']) ?>" target="_blank" class="btn btn-icon btn-primary btn-sm">
                <i class="ki-duotone ki-note-2 fs-4">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                </i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!--end::Table-->
  </div>
  <!--end::Card body-->
</div>


<?= $this->endSection(); ?>


<?= $this->section('scripts') ?>

<script>
  const KTDatatables = function() {
    let dt_managment;

    const initDatatable = () => {
      dt_managment = $("#kt_table_managment").DataTable({
        searchDelay: 500,
        responsive: true,
        processing: true,
        order: [
          [4, 'desc']
        ],
        "language": {
          "url": "<?= base_url('assets/i18n/Spanish.json') ?>"
        }
      });
    }

    const handleSearchManagment = () => {
      const filter = document.querySelector('[data-kt-managment-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_managment.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearchManagment();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });
</script>

<?= $this->endSection(); ?>