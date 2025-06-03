<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Gestion de Pacientes | KYP BIOINGENIERIA

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

    <li class="breadcrumb-item text-muted">Contratos</li>

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
        <input type="text" data-kt-contract-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Contratos" />
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
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_contract">
      <thead>
        <tr class="fw-bold fs-5 text-gray-800">
          <th>Paciente</th>
          <th class="text-center">Sede</th>
          <th class="text-center">Monto Total</th>
          <th class="text-center">Pagado</th>
          <th class="text-center">Pendiente</th>
          <th class="text-center">Estado</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 fw-semibold">
        <?php foreach ($contract as $index => $row) { ?>
          <tr>
            <td class="d-flex flex-column">
              <h5><?= mb_strtoupper($row['paciente']) ?></h5>
              <p class="text-muted"><?= $row['cod_paciente'] . ' | ' . $row['trabajo'] ?></p>
            </td>
            <td class="text-center">
              <span class="badge badge-secondary badge-lg"><?= $row['sede'] ?></span>
            </td>
            <td class="text-center text-primary fs-5">
              <?= ($row['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($row['monto_total']) ?>
            </td>
            <td class="text-center text-success fs-5">
              <?= ($row['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($row['pagado']) ?>
            </td>
            <td class="text-center <?= ($row['pendiente'] == 0) ? '' : 'text-danger' ?> fs-5">
              <?= ($row['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($row['pendiente']) ?>
            </td>
            <td class="text-center">
              <span class="badge badge-<?= ($row['estado'] == 'Deuda') ? 'danger' : 'success' ?>"><?= $row['estado'] ?></span>
            </td>
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
              <!--begin::Menu-->
              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                  <a href="<?= base_url('contract/pagos/') . $row['id'] ?>" class="menu-link px-3">
                    Visualizar
                  </a>
                </div>
                <!--end::Menu item-->

                <div class="menu-item px-3">
                  <a href="<?= base_url('sales/contract/generate/' . $row['id']) ?>" target="_blank" class="menu-link px-3">
                    Pdf
                  </a>
                </div>
              </div>
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
    let dt_contrato;

    const initDatatable = () => {
      dt_contrato = $("#kt_table_contract").DataTable({
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

    const handleSearchContratos = () => {
      const filter = document.querySelector('[data-kt-contract-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_contrato.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearchContratos();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });
</script>
<?= $this->endSection(); ?>