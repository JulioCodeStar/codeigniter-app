<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Contratos | Pagos - KYP Bioingeniería
<?= $this->endSection(); ?>



<?= $this->section('content_sales'); ?>
<div class="col-xl-12">
  <!--begin::Table widget 8-->
  <div class="card">
    <!--begin::Header-->
    <div
      class="card-header position-relative py-0 border-bottom-2">
      <!--begin::Nav-->
      <ul
        class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
        <!--begin::Nav item-->
        <li class="nav-item p-0 ms-0 me-8">
          <!--begin::Nav link-->
          <a
            class="nav-link active btn btn-color-muted px-0"
            data-bs-toggle="tab"
            href="#kt_table_widget_7_tab_content_1">
            <!--begin::Title-->
            <span class="nav-text fw-semibold fs-4 mb-3">Pagos (23)</span>
            <!--end::Title-->
            <!--begin::Bullet-->
            <span
              class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
            <!--end::Bullet-->
          </a>
          <!--end::Nav link-->
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item p-0 ms-0 me-8">
          <!--begin::Nav link-->
          <a
            class="nav-link btn btn-color-muted px-0"
            data-bs-toggle="tab"
            href="#kt_table_widget_7_tab_content_2">
            <!--begin::Title-->
            <span class="nav-text fw-semibold fs-4 mb-3">Contratos (23)</span>
            <!--end::Title-->
            <!--begin::Bullet-->
            <span
              class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
            <!--end::Bullet-->
          </a>
          <!--end::Nav link-->
        </li>
        <!--end::Nav item-->

      </ul>
      <!--end::Nav-->
      <!--begin::Toolbar-->
      <div class="card-toolbar">

        <a href="<?= base_url('sales/contract/pagos') ?>" class="btn btn-primary me-2">Agregar Pago</a>
        <a href="<?= base_url('sales/contract/new') ?>" class="btn btn-secondary">Agregar Contrato</a>

      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
      <!--begin::Tab Content (ishlamayabdi)-->
      <div class="tab-content mb-2">
        <!--begin::Tap pane-->
        <div
          class="tab-pane fade show active"
          id="kt_table_widget_7_tab_content_1">

          <div class="border-0">
            <!--begin::Card title-->
            <div class="card-title">
              <!--begin::Search-->
              <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
                <input type="text" data-kt-pagos-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Pagos" />
              </div>
              <!--end::Search-->
            </div>
            <!--begin::Card title-->

          </div>

          <!--begin::Table-->
          <table class="table align-middle table-row-dashed fs-6 gy-5" id="tblPagos">
            <!--begin::Table head-->
            <thead class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
              <tr>
                <th class="min-w-50px text-center">N°</th>
                <th class="min-w-50px">Código</th>
                <th class="min-w-100px">Paciente</th>
                <th class="min-w-80px">Monto</th>
                <th class="min-w-80px">Fecha</th>
                <th class="text-end min-w-80px">Acciones</th>
              </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-ray-600 fw-semibold">
              <?php foreach ($pagos as $index => $row) { ?>
                <tr>
                  <td class="text-center"><?= $index + 1 ?></td>
                  <td class="">
                    <span class="badge badge-warning badge-lg"><?= $row['cod_paciente'] ?></span>
                  </td>
                  <td class="d-flex flex-column">
                    <h5><?= $row['nombres'] . ' ' . $row['apellidos'] ?></h5>
                    <p><?= $row['trabajo'] ?></p>
                  </td>
                  <td class="">
                    <span class="badge badge-light-dark badge-lg">
                      <?= ($row['moneda'] == 'PEN' ? 'S/.' : '$') . ' ' . moneda($row['monto']) ?>
                    </span>
                  </td>
                  <td><?= fecha_dmy($row['created_at']) ?></td>
                  <td></td>
                </tr>
              <?php } ?>
            </tbody>
            <!--end::Table body-->
          </table>
          <!--end::Table-->
        </div>
        <!--end::Tap pane-->
        <!--begin::Tap pane-->
        <div
          class="tab-pane fade"
          id="kt_table_widget_7_tab_content_2">
          <div class="border-0">
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

          </div>
          <!--begin::Table-->
          <table class="table align-middle table-row-dashed fs-6 gy-5" id="tblContrato">
            <!--begin::Table head-->
            <thead class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
              <tr>
                <th class="min-w-50px text-center">N°</th>
                <th class="min-w-20px">Código</th>
                <th class="min-w-150px">Paciente</th>
                <th class="min-w-80px">Monto</th>
                <th class="min-w-80px">Fecha</th>
                <th class="text-end min-w-80px">Acciones</th>
              </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-ray-600 fw-semibold">
              <?php foreach ($contrato as $index => $row) { ?>
                <tr>
                  <td class="text-center"><?= $index + 1 ?></td>
                  <td class="">
                    <span class="badge badge-warning badge-lg"><?= $row['cod_paciente'] ?></span>
                  </td>
                  <td class="d-flex flex-column">
                    <h5><?= $row['nombres'] . ' ' . $row['apellidos'] ?></h5>
                    <p><?= $row['trabajo'] ?></p>
                  </td>
                  <td class="">
                    <span class="badge badge-light-dark badge-lg">
                      <?= ($row['moneda'] == 'PEN' ? 'S/.' : '$') . ' ' . moneda($row['monto_total']) ?>
                    </span>
                  </td>
                  <td><?= fecha_dmy($row['created_at']) ?></td>
                  <td></td>
                </tr>
              <?php } ?>
            </tbody>
            <!--end::Table body-->
          </table>
          <!--end::Table-->
        </div>
        <!--end::Tap pane-->

      </div>
      <!--end::Tab Content-->
    </div>
    <!--end: Card Body-->
  </div>
  <!--end::Table widget 8-->
</div>

<?= $this->endSection(); ?>




<?= $this->section('scripts_sales'); ?>

<script>
  const KTDatatables = function() {
    let dt_pago;
    let dt_contrato;

    const initDatatable = () => {
      dt_pago = $("#tblPagos").DataTable({
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

      dt_contrato = $("#tblContrato").DataTable({
        searchDelay: 500,
        responsive: true,
        processing: true,
        order: [
          [0, 'asc']
        ],
        "language": {
          "url": "<?= base_url('assets/i18n/Spanish.json') ?>"
        }
      })
    }

    const handleSearchPagos = () => {
      const filter = document.querySelector('[data-kt-pagos-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_pago.search(e.target.value).draw();
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
        handleSearchPagos();
        handleSearchContratos();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });
</script>

<?= $this->endSection(); ?>