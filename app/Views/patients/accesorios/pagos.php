<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Pagos Ventas Accesorios - KYP BIOINGENIERIA

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

  <li class="breadcrumb-item text-muted">
    <a href="<?= base_url('accesorios') ?>" class="text-muted text-hover-primary">Ventas Accesorios</a>
  </li>

  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>

  <li class="breadcrumb-item text-muted">Historial de Pagos</li>

</ul>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>


<div class="d-flex flex-column flex-lg-row mt-5">
  <!--begin::Content-->
  <div
    class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
    <!--begin::Form-->
    <div
      class="form">

      <!--begin::Pagos-->
      <div
        class="card card-flush pt-3 mb-5 mb-lg-10"
        data-kt-subscriptions-form="pricing">
        <!--begin::Card header-->
        <div class="card-header">
          <!--begin::Card title-->
          <div class="card-title">
            <h2 class="fw-bold">Historial de Pagos</h2>
          </div>
          <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Options-->
          <div id="kt_all_pagos">
            <?php foreach ($get['pagos'] as $index => $row) { ?>
              <div class="py-1">
                <div class="py-3 d-flex flex-stack flex-wrap">

                  <div
                    class="d-flex align-items-center collapsible toggle"
                    data-bs-toggle="collapse"
                    data-bs-target="#kt_all_pagos_<?= $index + 1 ?>">

                    <div
                      class="btn btn-sm btn-icon btn-active-color-primary ms-n3 me-2">
                      <i
                        class="ki-duotone ki-minus-square toggle-on text-primary fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                      </i>
                      <i
                        class="ki-duotone ki-plus-square toggle-off fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                      </i>
                    </div>


                    <div class="me-3">
                      <div
                        class="d-flex align-items-center fw-bold">
                         <?= $row['tip_pago'] ?>
                        <div
                          class="badge badge-light-primary ms-5">
                          Pago <?= $index + 1 ?>
                        </div>
                      </div>
                      
                    </div>

                  </div>

                </div>
                <div id="kt_all_pagos_<?= $index + 1 ?>" class="collapse show fs-6 ps-10">
                  <div class="d-flex flex-wrap py-5">

                    <div class="flex-equal me-5">
                      <table
                        class="table table-flush fw-semibold">
                        <tr class="pb-3">
                          <td
                            class="text-muted min-w-125px w-125px">
                            Nombres
                          </td>
                          <td class="text-gray-800">
                            <?= mb_strtoupper($get['nombres'] . ' ' . $get['apellidos']) ?>
                          </td>
                        </tr>
                        <tr class="pb-3">
                          <td
                            class="text-muted min-w-125px w-125px">
                            Monto
                          </td>
                          <td class="text-gray-800">
                            <span class="badge badge-light-warning">
                              <?= ($row['moneda'] == 'PEN') ? 'S/. ' : '$ ' ?> <?= moneda($row['monto']) ?>
                            </span>
                          </td>
                        </tr>
                        <tr class="pb-3">
                          <td
                            class="text-muted min-w-125px w-125px">
                            Fecha
                          </td>
                          <td class="text-gray-800"><?= $row['created_at'] ?></td>
                        </tr>
                        <tr class="pb-3">
                          <td
                            class="text-muted min-w-125px w-125px">
                            Método de Pago
                          </td>
                          <td class="text-gray-800">
                            <?= $row['tip_pago'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>


                    <div class="flex-equal">
                      <label class="text-muted">Observaciones</label>
                      <p class=""><?= $row['observaciones'] ?></p>
                    </div>

                  </div>

                  <div class="text-muted">
                        <a href="<?= base_url('sales/accesorios/generate/pagos/' . $row['referencia_id'] . '/' . $row['pago_nro']) ?>" target="_blank" class="fw-bold text-gray-600 text-hover-primary me-2">Ver Recibo</a>
                      </div>

                </div>
              </div>

              <div class="separator separator-dashed"></div>
            <?php } ?>
          </div>
          <!--end::Options-->
        </div>
        <!--end::Card body-->
      </div>
      <!--end::Pagos-->


    </div>
    <!--end::Form-->
  </div>
  <!--end::Content-->

  <div
    class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
    <!--begin::Card-->
    <div
      class="card card-flush pt-3 mb-0"
      data-kt-sticky="true"
      data-kt-sticky-name="subscription-summary"
      data-kt-sticky-offset="{default: false, lg: '200px'}"
      data-kt-sticky-width="{lg: '250px', xl: '300px'}"
      data-kt-sticky-left="auto"
      data-kt-sticky-top="150px"
      data-kt-sticky-animation="false"
      data-kt-sticky-zindex="95">
      <!--begin::Card header-->
      <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
          <h2>Resumen</h2>
        </div>
        <!--end::Card title-->
      </div>
      <!--end::Card header-->
      <!--begin::Card body-->
      <div class="card-body pt-0 fs-6">
        <!--begin::Section-->
        <div class="mb-7">
          <!--begin::Titulo-->
          <h5 class="mb-3">Detalles Paciente</h5>
          <!--end::Titulo-->
          <!--begin::Detalles-->
          <div class="d-flex align-items-center mb-1">
            <!--begin::Nombres y Apellidos -->
            <a class="fw-bold text-gray-800 text-hover-primary me-2" id="name"><?= mb_strtoupper($get['nombres'] . ' ' . $get['apellidos']) ?></a>
            <!--end::Nombres y Apellidos-->
          </div>
          <!--end::Details-->
          <!--begin::Servicio-->
          <a class="fw-semibold text-gray-600 text-hover-primary" id="service"><?= $get['cod_paciente'] ?> | <?= mb_strtoupper($get['trabajo']) ?></a>
          <!--end::Servicio-->
        </div>
        <!--end::Section-->
        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->
        <!--begin::Section-->
        <div class="mb-7">
          <!--begin::Title-->
          <h5 class="mb-3">Montos y Deudas</h5>
          <!--end::Title-->

          <div class="mb-3">
            <!--begin::Plan-->
            <span class="badge badge-light-info me-2">Monto Total</span>
            <!--end::Plan-->
            <!--begin::Price-->
            <span class="fw-semibold text-gray-600" id="monto_total"><?= ($get['moneda'] == 'PEN') ? 'S/.' : '$' ?> <?= moneda($get['monto_total']) ?></span>
            <!--end::Price-->
          </div>

          <div class="mb-0">
            <!--begin::Plan-->
            <span class="badge badge-light-danger me-2">Deuda</span>
            <!--end::Plan-->
            <!--begin::Price-->
            <span class="fw-semibold text-gray-600" id="deuda">
              <?= ($get['deuda'] === 'pagado') ? '<span class="badge badge-light-success">Pagado</span>' : ($get['moneda'] == 'PEN' ? 'S/.' : '$') . ' ' . moneda($get['deuda']) ?>
            </span>
            <!--end::Price-->
          </div>

        </div>
        <!--end::Section-->
        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->
        <!--begin::Section-->
        <div class="mb-10">
          <!--begin::Title-->
          <h5 class="mb-3">Fecha del Contrato</h5>
          <!--end::Title-->
          <!--begin::Details-->
          <div class="mb-0">
            <!--begin::Card info-->
            <div
              class="fw-semibold text-gray-600 d-flex align-items-center" id="fecha_inicio">
              Fecha: <?= $get['fecha_inicio'] ?>
            </div>
            <!--end::Card info-->
            <!--begin::Card expiry-->
            <div class="fw-semibold text-gray-600" id="garantia">
              Garantía: <span class="badge badge-light-<?= ($get['garantia'] == 'activa') ? 'success' : 'danger' ?> me-2"><?= $get['garantia'] ?></span>
            </div>
            <!--end::Card expiry-->
          </div>
          <!--end::Details-->
        </div>
        <!--end::Section-->

      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
</div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>


<?= $this->endSection(); ?>