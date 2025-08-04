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

  <li class="breadcrumb-item text-muted">Citas</li>

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
        <input type="text" data-kt-citas-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Citas" />
      </div>
      <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        <!--begin::Export-->
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
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_citas">
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
        <?php foreach ($citas as $row) { ?>
          <tr>
            <td class="d-flex flex-column">
              <h5><?= mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></h5>
              <p class="text-muted">Código: <?= $row['cod_paciente'] ?></p>
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
              <a href="<?= base_url('api/citas/generate/') . $row['id'] ?>" target="_blank" class="btn btn-icon btn-primary btn-sm">
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
    let dt_citas;

    const initDatatable = () => {
      dt_citas = $("#kt_table_citas").DataTable({
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

    const exportButtons = () => {
      const documentTitle = 'Citas';
      const columnasAExportar = [0, 1, 2, 3, 4];
      const buttons = new $.fn.dataTable.Buttons(dt_citas, {
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

    const handleSearchCitas = () => {
      const filter = document.querySelector('[data-kt-citas-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_citas.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearchCitas();
        exportButtons();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });
</script>

<?= $this->endSection(); ?>