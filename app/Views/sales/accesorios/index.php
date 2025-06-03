<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Venta Accesorios - KYP Bioingeniería
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
            <span class="nav-text fw-semibold fs-4 mb-3">Pagos </span>
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
            <span class="nav-text fw-semibold fs-4 mb-3">Ventas </span>
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

        <a href="<?= base_url('sales/accesorios/pagos') ?>" class="btn btn-primary me-2">Agregar Pago</a>
        <a href="<?= base_url('sales/accesorios/new') ?>" class="btn btn-secondary">Agregar Ventas</a>

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
                    <span class="badge badge-light-success badge-lg">
                      <?= ($row['moneda'] == 'PEN' ? 'S/.' : '$') . ' ' . moneda($row['monto']) ?>
                    </span>
                  </td>
                  <td><?= fecha_dmy($row['created_at']) ?></td>
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

                      <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#eliminarPagosModal" data-bs-url="<?= base_url('api/sales/accesorios/pagos/delete/') .  $row['id'] ?>">
                          Eliminar
                        </a>

                      </div>

                      <div class="menu-item px-3">
                        <a href="<?= base_url('sales/accesorios/generate/pagos/') . $row['referencia_id'] . '/' . $row['pago_nro'] ?>" target="_blank" class="menu-link px-3">
                          Pdf
                        </a>
                      </div>
                    </div>
                  </td>
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
                <input type="text" data-kt-ventas-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Ventas" />
              </div>
              <!--end::Search-->
            </div>
            <!--begin::Card title-->

          </div>
          <!--begin::Table-->
          <table class="table align-middle table-row-dashed fs-6 gy-5" id="tblAccesorios">
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
              <?php foreach ($ventas as $row) { ?>
                <tr>
                  <td class="text-center">
                    <span class="badge badge-light-primary badge-lg">
                      <?= $row['n_boleta'] ?>
                    </span>
                  </td>
                  <td class="">
                    <span class="badge badge-warning badge-lg"><?= $row['cod_paciente'] ?></span>
                  </td>
                  <td class="d-flex flex-column">
                    <h5><?= $row['nombres'] . ' ' . $row['apellidos'] ?></h5>
                    <p><?= $row['trabajo'] ?></p>
                  </td>
                  <td class="">
                    <span class="badge badge-light-success badge-lg">
                      <?= ($row['moneda'] == 'PEN' ? 'S/.' : '$') . ' ' . moneda($row['monto_total']) ?>
                    </span>
                  </td>
                  <td><?= fecha_dmy($row['created_at']) ?></td>
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

                      <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#eliminarVentasModal" data-bs-url="<?= base_url('api/sales/accesorios/ventas/delete/') . $row['id'] ?>">
                          Eliminar
                        </a> 
                      </div>

                      <div class="menu-item px-3">
                        <a href="<?= base_url('sales/accesorios/generate/') . $row['id'] ?>" target="_blank" class="menu-link px-3">
                          Pdf
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php  } ?>
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

<!--begin::Eliminar Pagos-->
<div class="modal fade" tabindex="-1" id="eliminarPagosModal" aria-hidden="true">
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
        <p>¿Deseas este Pago de forma Permanente?</p>
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
<!--end::Eliminar Pagos-->

<!--begin::Eliminar Ventas-->
<div class="modal fade" tabindex="-1" id="eliminarVentasModal" aria-hidden="true">
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
        <p>¿Deseas este Contrato de forma Permanente?</p>
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
<!--end::Eliminar Ventas-->

<?= $this->endSection(); ?>



<?= $this->section('scripts_sales'); ?>
<script>
  const KTDatatables = function() {
    let dt_pago;
    let dt_ventas;

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

      dt_ventas = $("#tblAccesorios").DataTable({
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
      const filter = document.querySelector('[data-kt-ventas-table-filter="search"]');
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

  const eliminarPagosModal = document.querySelector("#eliminarPagosModal");
  if (eliminarPagosModal) {
    eliminarPagosModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      const form = eliminarPagosModal.querySelector("#form-eliminar");
      form.setAttribute('action', url);
    })
  }


  const eliminarContractModal = document.querySelector("#eliminarVentasModal");
  if (eliminarContractModal) {
    eliminarContractModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      const form = eliminarContractModal.querySelector("#form-eliminar");
      form.setAttribute('action', url);
    })
  }
</script>
<?= $this->endSection(); ?>