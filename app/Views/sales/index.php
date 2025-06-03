<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Inicio | Caja Ventas - KYP Bioingeniería
<?= $this->endSection(); ?>


<?= $this->section('content_sales'); ?>

<?php if (!$apertura) { ?>
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body p-0">
      <!--begin::Wrapper-->
      <div class="card-px text-center py-20 my-10">
        <!--begin::Title-->
        <h2 class="fs-2x fw-bold mb-10">
          Welcome to Customers App
        </h2>
        <!--end::Title-->
        <!--begin::Description-->
        <p class="text-gray-500 fs-4 fw-semibold mb-10">
          There are no customers added yet. <br />Kickstart your
          CRM by adding a your first customer
        </p>
        <!--end::Description-->
        <!--begin::Action-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalApertura" class="btn btn-primary">Iniciar Caja</a>
        <!--end::Action-->
      </div>
      <!--end::Wrapper-->
      <!--begin::Illustration-->
      <div class="text-center pb-4 px-4">
        <img
          class="mw-100 mh-300px"
          alt=""
          src="<?= base_url('assets/media/illustrations/sketchy-1/2.png') ?>" />
      </div>
      <!--end::Illustration-->
    </div>
    <!--end::Card body-->
  </div>


  <div class="modal fade" tabindex="-1" id="modalApertura">
    <div class="modal-dialog modal-dialog-centered">
      <?= form_open('api/sales/init-sales', ['id' => 'kt_form_apertura', 'class' => 'modal-content']) ?>
      <div class="modal-header">
        <h3 class="modal-title">Apertura</h3>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Close-->
      </div>

      <div class="modal-body">
        <p>La caja se iniciara con <strong>0.00</strong> con fecha <strong><?= fecha_spanish(date('d-m-Y')) ?></strong></p>
      </div>

      <div class="modal-footer">
        <button id="btnInitSales" type="submit" class="btn btn-primary">
          <span class="indicator-label">
            Iniciar
          </span>
          <span class="indicator-progress">
            Iniciando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
          </span>
        </button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
<?php } else { ?>

  <div
    id="kt_app_toolbar_container"
    class="d-flex flex-stack mb-5 pt-6">
    <!--begin::Page title-->
    <div
      class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
      <!--begin::Title-->
      <h1
        class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
        Resumen Diario - Sede de <?= $sede['sucursal'] ?>
      </h1>
      <!--end::Title-->
      <!--begin::Breadcrumb-->
      <ul
        class="breadcrumb breadcrumb-separatorless fw-semibold fs-5 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
          <?= fecha_spanish(date('Y-m-d')) ?>
        </li>
        <!--end::Item-->
      </ul>
      <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center gap-2 gap-lg-3">
      <a href="#" class="btn fw-bold btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_cierre">
        <i class="ki-duotone ki-delete-folder fs-3">
          <span class="path1"></span>
          <span class="path2"></span>
        </i>
        Cerrar Caja
      </a>


      <div class="modal fade" tabindex="-1" id="kt_modal_cierre">
        <div class="modal-dialog modal-dialog-centered">
          <?= form_open('api/sales/close-sales', ['id' => 'kt_form_cierre', 'class' => 'modal-content']) ?>
          <div class="modal-header">
            <h3 class="modal-title">Cierre de Caja</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
              <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
          </div>

          <div class="modal-body">
            <p>¿Deseas cerrar la caja con este resumen?</p>
            <ul class="list-unstyled">
              <li>Ventas del Día: <strong>S/ <?= moneda($total_venta_soles) ?> - $ <?= moneda($total_venta_dolares) ?></strong></li>
              <li>Contratos: <strong>S/ <?= moneda($total_contract_soles) ?> - $ <?= moneda($total_venta_dolares) ?></strong></li>
              <li>Pagos Recibidos: <strong>S/ <?= moneda($pagos_total_soles) ?> - $ <?= moneda($pagos_total_dolares) ?></strong></li>
              <li>Citas.: <strong> S/ </strong></li>
              <li>Mantenimiento.: <strong> S/ </strong></li>
            </ul>
          </div>

          <div class="modal-footer">
            <button id="btnCloseSales" type="submit" class="btn btn-danger">
              <span class="indicator-label">
                Cerrar
              </span>
              <span class="indicator-progress">
                Cerrar... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
              </span>
            </button>
          </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
    <!--end::Actions-->
  </div>

  <div class="row g-3">
    <!-- Ventas del Día -->
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card h-100" style="max-width: 320px; width: 100%;">
        <div class="card-body">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-muted">Ventas del Día</h6>
            <i class="ki-duotone ki-tag fs-1">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
            </i>
          </div>

          <!-- Montos -->
          <div class="d-flex align-items-end">
            <h2 class="me-2 mb-0">S/ <?= moneda($total_venta_soles) ?></h2>
            <small class="text-muted mb-1">$ <?= moneda($total_venta_dolares) ?></small>
          </div>

          <!-- Detalle -->
          <p class="mb-3">
            <small class="text-muted">
              Total: <?= $count_total_venta ?> venta(s)<br>
              <?= $count_ventas_soles ?> en soles, <?= $count_ventas_dolares ?> en dólares
            </small>
          </p>


        </div>
      </div>

    </div>

    <!-- Contratos Activos -->
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card h-100" style="max-width: 320px; width: 100%;">
        <div class="card-body">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-muted">Contratos</h6>
            <i class="ki-duotone ki-tag fs-1">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
            </i>
          </div>

          <!-- Montos -->
          <div class="d-flex align-items-end">
            <h2 class="me-2 mb-0">S/ <?= moneda($total_contract_soles) ?></h2>
            <small class="text-muted mb-1">$ <?= moneda($total_venta_dolares) ?></small>
          </div>

          <!-- Detalle -->
          <p class="mb-3">
            <small class="text-muted">
              Total: <?= $count_contract_total ?> contrato(s)<br>
              <?= $count_contract_soles ?> en soles, <?= $count_contract_dolares ?> en dólares
            </small>
          </p>
        </div>
      </div>
    </div>

    <!-- Pagos Recibidos -->
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card h-100" style="max-width: 320px; width: 100%;">
        <div class="card-body">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-muted">Pagos Recibidos</h6>
            <i class="ki-duotone ki-tag fs-1">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
            </i>
          </div>

          <!-- Montos -->
          <div class="d-flex align-items-end">
            <h2 class="me-2 mb-0">S/ <?= moneda($pagos_total_soles) ?></h2>
            <small class="text-muted mb-1">$ <?= moneda($pagos_total_dolares) ?></small>
          </div>

          <!-- Detalle -->
          <p class="mb-3">
            <small class="text-muted">
              Total: <?= $count_pagos_total ?> pagos recibidos<br>
              <?= $count_pagos_soles ?> en soles, <?=$count_pagos_dolares ?> en dólares
            </small>
          </p>
        </div>
      </div>
    </div>

    <!-- Citas y Mantenimientos -->
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card h-100" style="max-width: 320px; width: 100%;">
        <div class="card-body">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-muted">Citas y Mantenimientos</h6>
            <i class="ki-duotone ki-chart fs-1">
              <i class="path1"></i>
              <i class="path2"></i>
            </i>
          </div>

          <!-- Conteo principal -->
          <div class="d-flex align-items-center mb-2">
            <h2 class="me-2 mb-0"><?= $count_cita_manag ?></h2>
          </div>

          <!-- Detalle de citas y montos -->
          <p class="mb-3">
            <small class="text-muted">
              <?= $count_cita ?> citas | <?= $count_manag ?> mant.<br>
              Pagos Realizados: S/ <?= moneda($pagos_total_citas_managment_soles) ?> | $ <?= moneda($pagos_total_citas_managment_dolares) ?>
            </small>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="py-5">
    <div class="card p-10">
      <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex ">
        <li class="nav-item p-0 ms-0 me-8">
          <a class="nav-link active btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_1">
            <span class="nav-text fw-semibold fs-4 mb-3">Ventas</span>
            <span
              class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
          </a>
        </li>
        <li class="nav-item p-0 ms-0 me-8">
          <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_2">
            <span class="nav-text fw-semibold fs-4 mb-3">Contratos </span>
            <span
              class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
          </a>
        </li>
        <li class="nav-item np-0 ms-0 me-8">
          <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_3">
            <span class="nav-text fw-semibold fs-4 mb-3">Citas </span>
            <span
              class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
          </a>
        </li>
        <li class="nav-item p-0 ms-0 me-8">
          <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_4">
            <span class="nav-text fw-semibold fs-4 mb-3">Mantenimientos </span>
            <span
              class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
          </a>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
          <div class="pt-10 pb-2">
            <h1 class="anchor fw-bold mb-5">Ventas Recientes</h1>
            <div class="my-5">
              <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 gy-7">
                  <thead>
                    <tr class="fw-bold fs-5 text-gray-800">
                      <th class="min-w-25px text-center">N°</th>
                      <th>Paciente</th>
                      <th class="text-center">Moneda</th>
                      <th class="text-center">Monto Total</th>
                      <th class="text-center">Pagado</th>
                      <th class="text-center">Pendiente</th>
                      <th class="text-center">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ventas as $row) { ?>
                      <tr>
                        <td class="text-center">
                          <span class="badge badge-light-info"><?= $row['n_boleta'] ?></span>
                        </td>
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
                      </tr>
                    <?php } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="7" class="text-center">
                        <a href="<?= base_url('sales/accesorios') ?>">Ver Todas las Ventas</a>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
          <div class="pt-10 pb-2">
            <h1 class="anchor fw-bold mb-5">Contratos Recientes</h1>
            <div class="my-5">
              <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 gy-7">
                  <thead>
                    <tr class="fw-bold fs-5 text-gray-800">
                      <th class="min-w-25px text-center">N°</th>
                      <th>Paciente</th>
                      <th class="text-center">Moneda</th>
                      <th class="text-center">Monto Total</th>
                      <th class="text-center">Pagado</th>
                      <th class="text-center">Pendiente</th>
                      <th class="text-center">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($contract as $index => $row) { ?>
                      <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
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
                      </tr>
                    <?php } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="7" class="text-center">
                        <a href="<?= base_url('sales/contract') ?>">Ver Todos los Contratos</a>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
          <div class="pt-10 pb-2">
            <h1 class="anchor fw-bold mb-5">Citas Recientes</h1>
            <div class="my-5">
              <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 gy-7">
                  <thead>
                    <tr class="fw-bold fs-5 text-gray-800">
                      <th class="min-w-25px text-center">N°</th>
                      <th>Paciente</th>
                      <th class="text-center">Moneda</th>
                      <th class="text-center">Monto Total</th>
                      <th style="width: 350px; white-space: nowrap;">Descripcion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($cita as $index => $row) { ?>
                      <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td class="d-flex flex-column">
                          <h5><?= mb_strtoupper($row['paciente']) ?></h5>
                          <p class="text-muted">Código: <?= $row['cod_paciente'] ?></p>
                        </td>
                        <td class="text-center"><?= $row['moneda'] ?></td>
                        <td class="text-center text-primary fs-5">
                          <?= ($row['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($row['monto']) ?>
                        </td>
                        <td class="text-muted">
                          <?= $row['observaciones'] ?>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="7" class="text-center">
                        <a href="<?= base_url('sales/citas') ?>">Ver Todas las Citas</a>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
          <div class="pt-10 pb-2">
            <h1 class="anchor fw-bold mb-5">Citas Recientes</h1>
            <div class="my-5">
              <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 gy-7">
                  <thead>
                    <tr class="fw-bold fs-5 text-gray-800">
                      <th class="min-w-25px text-center">N°</th>
                      <th>Paciente</th>
                      <th class="text-center">Moneda</th>
                      <th class="text-center">Monto Total</th>
                      <th style="width: 350px; white-space: nowrap;">Descripcion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($managment as $index => $row) { ?>
                      <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td class="d-flex flex-column">
                          <h5><?= mb_strtoupper($row['paciente']) ?></h5>
                          <p class="text-muted">Código: <?= $row['cod_paciente'] ?></p>
                        </td>
                        <td class="text-center"><?= $row['moneda'] ?></td>
                        <td class="text-center text-primary fs-5">
                          <?= ($row['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($row['monto']) ?>
                        </td>
                        <td class="text-muted">
                          <?= $row['observaciones'] ?>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="7" class="text-center">
                        <a href="<?= base_url('sales/managment') ?>">Ver Todos los Mantenimiento</a>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


<?= $this->endSection(); ?>



<?= $this->section('scripts_sales'); ?>

<script>
  <?php if (!$apertura) { ?>

    const btn = document.querySelector("#btnInitSales");
    const frm = document.querySelector("#kt_form_apertura");

    btn.addEventListener('click', function(event) {

      event.preventDefault();

      btn.setAttribute('data-kt-indicator', 'on');
      btn.disabled = true;

      setTimeout(() => {
        fetch(frm.action, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
            },
            body: new FormData(frm)
          })
          .then(res => res.json())
          .then(data => {
            if (data.status === "success") {
              Swal.fire({
                icon: 'success',
                title: 'Caja aperturada',
                text: 'Redirigiendo al módulo de ventas...',
                timer: 1500,
                showConfirmButton: false
              }).then(() => {
                window.location.href = data.redirect;
              });
            } else {
              Swal.fire({
                icon: 'warning',
                title: 'Ya existe una caja abierta',
                text: data.message
              }).then(() => location.reload());
            }
          })
          .catch(() => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ocurrió un problema al aperturar la caja'
            });
          })
          .finally(() => {
            btn.removeAttribute('data-kt-indicator');
            btn.disabled = false;
          })
      }, 2000)
    });

  <?php } else { ?>

    const btnClose = document.querySelector("#btnCloseSales");
    const frmClose = document.querySelector("#kt_form_cierre");

    btnClose.addEventListener('click', function(event) {
      event.preventDefault();

      btnClose.setAttribute('data-kt-indicator', 'on');
      btnClose.disabled = true;

      setTimeout(() => {
        fetch(frmClose.action, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
            },
            body: new FormData(frmClose)
          })
          .then(res => res.json())
          .then(data => {
            if (data.status === "success") {
              Swal.fire({
                icon: 'success',
                title: 'Caja Cerrada',
                text: 'Redirigiendo al inicio...',
                timer: 1500,
                showConfirmButton: false
              }).then(() => {
                window.location.href = data.redirect;
              });
            } else {
              Swal.fire({
                icon: 'warning',
                title: 'Error',
                text: data.message
              }).then(() => location.reload());
            }
          })
          .catch(() => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ocurrió un problema al cerrar la caja'
            });
          })
          .finally(() => {
            btnClose.removeAttribute('data-kt-indicator');
            btnClose.disabled = false;
          })
      }, 2000);

    });

  <?php } ?>
</script>

<?= $this->endSection(); ?>