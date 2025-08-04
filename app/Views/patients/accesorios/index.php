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

  <li class="breadcrumb-item text-muted">Ventas Accesorios</li>

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
        <input type="text" data-kt-accesorios-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Ventas" />
      </div>
      <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        <button type="button" class="btn btn-light-warning me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
          <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
          Exportar
        </button>

        <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="copy">
              Copy to clipboard
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="excel">
              Export as Excel
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="csv">
              Export as CSV
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="pdf">
              Export as PDF
            </a>
          </div>
          <!--end::Menu item-->
        </div>
        <!--end::Export-->

        <div id="kt_datatable_example_buttons" class="d-none"></div>

      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Card toolbar-->
  </div>
  <!--end::Card header-->
  <!--begin::Card body-->
  <div class="card-body py-4">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_accesorios">
      <thead>
        <tr class="fw-bold fs-5 text-gray-800">
          <th>Paciente</th>
          <th class="text-center">Moneda</th>
          <th class="text-center">Monto Total</th>
          <th class="text-center">Pagado</th>
          <th class="text-center">Pendiente</th>
          <th class="text-center">Estado</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 fw-semibold">
        <?php foreach ($ventas as $index => $row) { ?>
          <tr>
            <td class="d-flex flex-column">
              <h5><?= mb_strtoupper($row['paciente']) ?></h5>
              <p class="text-muted"><?= $row['cod_paciente'] . ' | ' . $row['trabajo'] ?></p>
            </td>
            <td class="text-center"><?= $row['moneda'] ?></td>
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
                  <a href="<?= base_url('accesorios/pagos/') . $row['id'] ?>" class="menu-link px-3">
                    Visualizar
                  </a>
                </div>
                <!--end::Menu item-->

                <div class="menu-item px-3">
                  <a href="<?= base_url('api/accesorios/generate/') . $row['id'] ?>" target="_blank" class="menu-link px-3">
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
    let dt_accesorios;

    const initDatatable = () => {
      dt_accesorios = $("#kt_table_accesorios").DataTable({
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

    const exportButtons = () => {
      const documentTitle = 'Ventas_Accesorios';
      const columnasAExportar = [0, 1, 2, 3, 4, 5];
      const buttons = new $.fn.dataTable.Buttons(dt_accesorios, {
        buttons: [{
            extend: 'copyHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          },
          {
            extend: 'excelHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          },
          {
            extend: 'csvHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          },
          {
            extend: 'pdfHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          }
        ]
      }).container().appendTo($('#kt_datatable_example_buttons'));

      // Hook dropdown menu click event to datatable export buttons
      const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
      exportButtons.forEach(exportButton => {
        exportButton.addEventListener('click', e => {
          e.preventDefault();

          // Get clicked export value
          const exportValue = e.target.getAttribute('data-kt-export');
          const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

          // Trigger click event on hidden datatable export buttons
          target.click();
        });
      });
    }

    const handleSearchAccesorios = () => {
      const filter = document.querySelector('[data-kt-accesorios-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_accesorios.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        exportButtons();
        handleSearchAccesorios();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });
</script>
<?= $this->endSection(); ?>