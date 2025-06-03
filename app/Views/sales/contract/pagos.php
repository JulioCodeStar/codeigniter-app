<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title'); ?>

Pagos - KYP BIOINGENIERIA

<?= $this->endSection(); ?>


<?= $this->section('content_sales'); ?>

<div
  id="kt_app_toolbar_container"
  class="d-flex flex-stack">
  <!--begin::Page title-->
  <div
    class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1
      class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
      Registrar Nuevo Pago
    </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul
      class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
        <a
          href="<?= base_url('sales/contract') ?>"
          class="text-muted text-hover-primary">Contratos | Pagos</a>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
        Pagos
      </li>
      <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
  </div>
  <!--end::Page title-->
  <!--begin::Actions-->
  <div class="">

  </div>
  <!--end::Actions-->
</div>

<div class="d-flex flex-column flex-lg-row mt-5">
  <!--begin::Content-->
  <div
    class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
    <!--begin::Form-->
    <div
      class="form">
      <!--begin::Customer-->
      <div class="card card-flush pt-3 mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header">
          <!--begin::Card title-->
          <div class="card-title">
            <h2 class="fw-bold">Paciente</h2>
          </div>
          <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Description-->
          <div class="text-gray-500 fw-semibold fs-5 mb-5">
            Seleccionar un paciente para proceder con su pago
          </div>
          <!--end::Description-->

          <!--begin::Customer change button-->
          <div class="mb-10">
            <select name="paciente" id="paciente" aria-label="Select a Patient" data-control="select2" data-placeholder="Seleccionar Paciente" class="form-select form-select-solid">
              <option value=""></option>
              <?php foreach ($contract as $row) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['cod_paciente'] . ' - ' . mb_strtoupper($row['nombres'] . ' ' . $row['apellidos'] . ' - ' . $row['trabajo']) ?></option>
              <?php } ?>
            </select>
          </div>
          <!--end::Customer change button-->

        </div>
        <!--end::Card body-->
      </div>
      <!--end::Customer-->



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
          <!--begin::Card toolbar-->
          <div class="card-toolbar">
            <a
              href="#"
              class="btn btn-light-primary disabled"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_new_pagos">Nuevo Pago</a>

            <div class="modal fade" tabindex="-1" id="kt_modal_new_pagos">
              <div class="modal-dialog modal-dialog-centered mw-650px">
                <?= form_open('api/sales/contract/pagos/create', ['id' => 'kt_form_pagos', 'class' => 'fv-row modal-content', 'autocomplete' => 'off']) ?>

                <div class="modal-header">
                  <h3 class="modal-title">Agregar Nuevo Pago</h3>

                  <!--begin::Close-->
                  <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                  </div>
                  <!--end::Close-->
                </div>

                <div class="modal-body">

                  <input type="hidden" id="id_contract" name="id_contract" readonly>
                  <input type="hidden" id="id_paciente" name="id_paciente" readonly>
                  <input type="hidden" id="moneda" name="moneda" readonly>

                  <div class="row g-4">

                    <div class="col-md-6 mb-4 fv-row">
                      <label for="fecha" class="required form-label">Fecha</label>
                      <input type="date" name="fecha" id="fecha" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">

                    </div>

                    <div class="col-md-6 mb-4 fv-row">
                      <select class="form-select" id="metodo" name="metodo" aria-label="Select example">
                        <option disabled selected value="">Seleccionar Método</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Pago con Tarjeta">Pago con Tarjeta</option>
                        <option value="Billetera Digital">Billetera Digital</option>
                      </select>
                    </div>

                    <div class="col-md-6 mb-4 fv-row">
                      <select class="form-select" id="submetodo" name="submetodo" aria-label="Select example">
                        <option disabled selected value="">Seleccionar Método</option>>
                      </select>
                    </div>

                    <div class="col-md-6 mb-4 fv-row">
                      <label for="bono" class="required form-label">Adelanto</label>
                      <input type="text" name="bono" id="bono" class="form-control" placeholder="Monto Adelanto" />
                    </div>

                    <div class="col-md-12 mb-4">
                      <label for="obs" class="form-label">Observaciones</label>
                      <textarea name="observacion" id="observacion" class="form-control" style="height: 100px;"></textarea>
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="kt_btn_submit_pagos">
                    <i class="ki-duotone ki-triangle fs-3">
                      <span class="path1"></span>
                      <span class="path2"></span>
                      <span class="path3"></span>
                    </i>
                    <span class="indicator-label">
                      Guardar
                    </span>
                    <span class="indicator-progress">
                      Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                  </button>
                </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
          <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Options-->
          <div id="kt_all_pagos">



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
            <a class="fw-bold text-gray-800 text-hover-primary me-2" id="name">Nombres y Apellidos</a>
            <!--end::Nombres y Apellidos-->
          </div>
          <!--end::Details-->
          <!--begin::Servicio-->
          <a class="fw-semibold text-gray-600 text-hover-primary" id="service">Servicio</a>
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
            <span class="fw-semibold text-gray-600" id="monto_total"></span>
            <!--end::Price-->
          </div>

          <div class="mb-0">
            <!--begin::Plan-->
            <span class="badge badge-light-danger me-2">Deuda</span>
            <!--end::Plan-->
            <!--begin::Price-->
            <span class="fw-semibold text-gray-600" id="deuda"></span>
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
              Fecha:
            </div>
            <!--end::Card info-->
            <!--begin::Card expiry-->
            <div class="fw-semibold text-gray-600" id="garantia">
              Garantía
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



<?= $this->section('scripts_sales'); ?>

<script>
  $(document).ready(function() {
    $("#paciente").on('change', function() {
      const id_contract = $(this).val();

      if (id_contract) {
        $.ajax({
          url: `<?= base_url('api/sales/contract/getDataContract/') ?>${id_contract}`,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $("#name").html(`${response.nombres} ${response.apellidos}`);
            $("#service").html(`${response.trabajo}`);
            $("#monto_total").html(`${response.moneda} ${response.monto_total}`);
            $("#deuda").html(
              response.deuda === 'pagado' ?
              '<span class="badge badge-light-success">Pagado</span>' :
              `${response.moneda} ${response.deuda}`
            );
            $("#fecha_inicio").html(`fecha: ${response.fecha_inicio}`);
            $("#garantia").html(`Garantía: <span class="badge badge-light-success me-2"> ${response.garantia}</span>`);
            $('a[data-bs-target="#kt_modal_new_pagos"]').removeClass('disabled');

            $("#id_contract").val(response.id);
            $("#id_paciente").val(response.paciente_id);
            $("#moneda").val(response.moneda);

            let htmlContent = '';
            response.pagos.forEach((row, index) => {
              htmlContent += `
                <div class="py-1">
                  <div class="py-3 d-flex flex-stack flex-wrap">
                    
                    <div
                      class="d-flex align-items-center collapsible toggle"
                      data-bs-toggle="collapse"
                      data-bs-target="#kt_all_pagos_${index + 1}">
                      
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
                          ${row.tip_pago}
                          <div
                            class="badge badge-light-primary ms-5">
                            Pago ${index + 1 }
                          </div>
                        </div>
                      </div>
            
                    </div>
                    
                  </div>
                  <div id="kt_all_pagos_${index + 1}" class="collapse show fs-6 ps-10">
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
                              ${response.nombres} ${response.apellidos}
                            </td>
                          </tr>
                          <tr class="pb-3">
                            <td
                              class="text-muted min-w-125px w-125px">
                              Monto
                            </td>
                            <td class="text-gray-800">
                              <span class="badge badge-light-warning">${row.moneda} ${row.monto}</span>
                            </td>
                          </tr>
                          <tr class="pb-3">
                            <td
                              class="text-muted min-w-125px w-125px">
                              Fecha
                            </td>
                            <td class="text-gray-800">${row.created_at}</td>
                          </tr>
                          <tr class="pb-3">
                            <td
                              class="text-muted min-w-125px w-125px">
                              Método de Pago
                            </td>
                            <td class="text-gray-800">
                              ${row.tip_pago}
                            </td>
                          </tr>
                        </table>
                      </div>
                      
                      
                      <div class="flex-equal">
                       <label class="text-muted">Observaciones</label>
                       <p class="">${row.observaciones || ''}</p>
                      </div>
                      
                    </div>

                    <div class="text-muted">
                      <a href="<?= base_url('sales/contract/generate/pagos/') ?>${row.referencia_id}/${row.pago_nro}" target="_blank" class="fw-bold text-gray-600 text-hover-primary me-2">Ver Recibo</a>
                    </div>
                    
                  </div>
                </div>

                <div class="separator separator-dashed"></div>
              `;
            });

            $("#kt_all_pagos").html(htmlContent);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      } else {
        $("#kt_all_pagos").html("");
      }
    });
  });


  const opcionesSub = {
    'Efectivo': ['Efectivo'],
    'Transferencia': ['Interbank', 'BCP'],
    'Pago con Tarjeta': ['Visa', 'Mastercard'],
    'Billetera Digital': ['Yape', 'Plin']
  };

  const metodoEl = document.getElementById('metodo');
  const submetEl = document.getElementById('submetodo');

  metodoEl.addEventListener('change', () => {
    const sel = metodoEl.value;
    const items = opcionesSub[sel] || [];

    let html = '<option disabled selected value="">Seleccionar Submétodo</option>';

    if (items.length) {
      items.forEach(opt => {
        html += `<option value="${opt}">${opt}</option>`;
      });
      submetEl.disabled = false;
    } else {
      html += '<option disabled value="">No hay opciones</option>';
      submetEl.disabled = true;
    }

    submetEl.innerHTML = html;
  });

  const form = document.querySelector("#kt_form_pagos");

  const validator = FormValidation.formValidation(form, {
    fields: {
      'fecha': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'metodo': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'submetodo': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'bono': {
        validators: {
          numeric: {
            message: 'Ingrese un monto válido',
            decimalSeparator: '.'
          },
          notEmpty: {
            message: "El campo es Obligatoria"
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

  const submitButton = document.querySelector('#kt_btn_submit_pagos');
  submitButton.addEventListener('click', function() {

    if (!validator) {
      return;
    }

    validator.validate().then(function(status) {
      console.log(status);

      if (status !== 'Valid') {
        return;
      }

      submitButton.setAttribute('data-kt-indicator', 'on');
      submitButton.disabled = true;

      fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(async response => {
          const data = await response.json();

          setTimeout(() => {
            submitButton.removeAttribute('data-kt-indicator');
            submitButton.disabled = false;

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
              // Éxito
              Swal.fire({
                text: data.message,
                icon: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                customClass: {
                  confirmButton: 'btn btn-primary'
                }
              }).then(() => {
                window.location.href = `<?= base_url('/') ?>${data.redirect}`
              });
            }
          }, 2000)
        })
        .catch(() => {
          // Si falla la petición
          setTimeout(() => {
            submitButton.removeAttribute('data-kt-indicator');
            submitButton.disabled = false;
            Swal.fire({
              text: 'No se pudo conectar al servidor',
              icon: 'error',
              buttonsStyling: false,
              confirmButtonText: 'Ok!'
            });
          }, 2000);
        })
    });
  })
</script>

<?= $this->endSection(); ?>