<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Contratos - KYP Bioingeniería
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
      Registrar Nueva Venta de Accesorio
    </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul
      class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
        <a
          href="<?= base_url('sales/accesorios') ?>"
          class="text-muted text-hover-primary">Ventas Accesorios</a>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
        Ventas
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

<div class="card card-flush h-lg-100 mt-6">
  <div class="card-header pt-7">
    <div class="card-title">
      <i class="ki-duotone ki-tag fs-2hx text-gray-600 me-2">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
      </i>
      <h2>Ventas Accesorios</h2>
    </div>

  </div>

  <div class="card-body pt-5">
    <?= form_open('api/sales/accesorios/create', ['id' => 'kt_form_accesorios', 'class' => 'fv-row', 'autocomplete' => 'off']) ?>

    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">1. Buscar Paciente</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-6 mb-4 fv-row">
          <label for="paciente_id" class="required form-label">Paciente</label>
          <select name="paciente_id" id="paciente_id" aria-label="Select a Patient" data-control="select2" data-placeholder="Seleccionar Paciente" class="form-select form-select-solid">
            <option value=""></option>
            <?php foreach ($get as $row) { ?>
              <option value="<?= $row['paciente_id'] ?>"><?= $row['cod_paciente'] . ' - ' . mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">2. Escojer Cotización</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4" id="list_invoice" class="fv-row">

      </div>
    </div>

    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">3. Método de Pagos</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-4 mb-4">
          <select class="form-select" id="metodo" name="metodo" aria-label="Select example">
            <option disabled selected value="">Seleccionar Método</option>
            <option value="Efectivo">Efectivo</option>
            <option value="Transferencia">Transferencia</option>
            <option value="Pago con Tarjeta">Pago con Tarjeta</option>
            <option value="Billetera Digital">Billetera Digital</option>
          </select>
        </div>

        <div class="col-md-4 mb-4">
          <select class="form-select" id="submetodo" name="submetodo" aria-label="Select example">
            <option disabled selected value="">Seleccionar Método</option>>
          </select>
        </div>
      </div>
    </div>

    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">4. Monto de Adelanto</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-3 fv-row">
          <label for="bono" class="required form-label">Adelanto</label>
          <input type="text" name="bono" id="bono" class="form-control" placeholder="Monto Adelanto" />
          <input type="hidden" name="total" id="total" class="form-control" readonly />
          <input type="hidden" name="id_cotizacion" id="id_cotizacion" class="form-control" readonly />
          <input type="hidden" name="moneda" id="moneda" class="form-control" readonly />
        </div>

        <div class="col-md-3 d-flex justify-content-center">
          <div class="d-flex flex-column align-items-start h-100 pt-7">
            <strong>
              <p class="mb-1" id="MontoTotalP">Monto Total </p>
            </strong>
            <p class="mb-0" id="DeudaP">Deuda</p>
          </div>
        </div>
      </div>
    </div>

    <button id="kt_submit_form_accesorios" type="button" class="btn btn-primary">
      <span class="indicator-label">
        Guardar
      </span>
      <span class="indicator-progress">
        Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
      </span>
    </button>

    <?= form_close() ?>
  </div>
</div>

<?= $this->endSection(); ?>




<?= $this->section('scripts_sales'); ?>

<script>
  $(document).ready(function() {
    $('#paciente_id').on('change', function() {
      const pacienteId = $(this).val();

      if (pacienteId) {
        $.ajax({
          url: `<?= base_url('api/sales/list-component/') ?>${pacienteId}`,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            let htmlContent = '';
            response.forEach(invoice => {
              let itemsHTML = '';
              invoice.items.forEach(component => {
                itemsHTML += `<li>${component}</li>`
              })

              htmlContent += `
                <div class="col-md-6 mb-4 invoice-row">
                  <input type="radio" class="btn-check" name="cotizacion[]" value="${invoice.id}" id="cotizacion_${invoice.id}" />
                  <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-5" for="cotizacion_${invoice.id}">
                    <span class="d-block fw-semibold text-start w-100">
                      <span class="text-gray-900 fw-bold d-block fs-3">${invoice.cod_cotizacion} - ${invoice.nombres} ${invoice.apellidos}</span>
                      <span class="text-muted fw-semibold fs-6 mb-2 d-block">${invoice.trabajo} - ${invoice.moneda} ${invoice.monto_final}</span>

                      <div class="text-gray-700 fs-7 mb-2">
                        <span class="d-block"><strong>Cotizador: ${invoice.encargado}</strong></span>
                      </div>

                      <div class="text-gray-700 fs-7 mb-2">
                        <span class="d-block"><strong>Componentes:</strong></span>
                        <ul class="ps-3 mt-1" style="columns: 2; column-gap: 20px;">
                          ${itemsHTML}
                        </ul>
                      </div>

                      <div class="text-gray-700 fs-7 mb-2">
                        <span class="d-block"><strong>Diagnóstico:</strong></span>
                        <p>${invoice.diagnostico}</p>
                      </div>

                      <span class="text-gray-600 fs-8 mt-2 d-block">Fecha: ${invoice.fecha_formateada}</span>
                    </span>
                  </label>
                </div>
              `
            });
            $('#list_invoice').html(htmlContent);
          },
          error: function(xhr, status, error) {
            console.error(error);
            $('#lista-pacientes').html('<div class="alert alert-danger">Error al cargar los datos</div>');
          }
        });
      } else {
        $('#lista-pacientes').html('');
      }
    });

    $(document).on('change', 'input[name="cotizacion[]"]', function() {
      if (this.checked) {
        $.ajax({
          url: `<?= base_url('api/sales/get-list/') ?>${this.value}`,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $("#moneda").val(response.moneda);
            $("#total").val(response.monto_final);
            $("#id_cotizacion").val(response.id);
            $("#MontoTotalP").html(`
              Monto Total: ${response.moneda} ${response.monto_final}
            `);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        })
      }
    });

    document.getElementById('bono').addEventListener('input', CalcularAdelanto);
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

  function CalcularAdelanto() {
    const adelanto = parseFloat(document.getElementById("bono").value) || 0;
    const total = parseFloat(document.getElementById("total").value) || 0;

    const deuda = total - adelanto;

    document.getElementById("DeudaP").innerText = 'Deuda: ' + deuda.toFixed(2)

  }

  function ErrorsCheckBox() {
    // Selecciona todas las tarjetas de factura
    const rows = document.querySelectorAll(".invoice-row");
    let tieneErrores = false;

    // Recorre cada tarjeta
    rows.forEach(row => {
      // Encuentra el checkbox dentro de ella
      const checkbox = row.querySelector('input[name="cotizacion[]"]');
      // Si no está marcado...
      if (!checkbox.checked) {
        checkbox.classList.add('is-invalid');
        tieneErrores = true;
      } else {
        checkbox.classList.remove('is-invalid');
      }
    });

    // Si hubo al menos un error, muestro alerta y devuelvo false
    if (tieneErrores) {
      Swal.fire({
        text: 'Selecciona al menos una Cotización',
        icon: 'warning',
        confirmButtonText: 'Entendido',
        buttonsStyling: false,
        customClass: {
          confirmButton: 'btn btn-warning'
        }
      });
      return false;
    }

    return true;
  }

  const form = document.querySelector("#kt_form_accesorios");

  const validator = FormValidation.formValidation(form, {
    fields: {
      'paciente_id': {
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
          notEmpty: {
            message: "El campo es Obligatorio"
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

  const submit = document.querySelector("#kt_submit_form_accesorios");
  submit.addEventListener('click', function(event) {
    event.preventDefault();

    if (!validator) {
      return;
    }

    // if (!ErrorsCheckBox()) {
    //   return; // ⬅️⬅️⬅️ si hay errores no sigo
    // }

    validator.validate().then(function(status) {
      if (status !== 'Valid') {
        return;
      }

      submit.setAttribute('data-kt-indicator', 'on');
      submit.disabled = true;

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
            submit.removeAttribute('data-kt-indicator');
            submit.disabled = false;

            if (!response.ok || data.status >= 400) {
              // Error
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
          }, 2000);
      })
      .catch(() => {
          // Si falla la petición
          setTimeout(() => {
            submit.removeAttribute('data-kt-indicator');
            submit.disabled = false;
            Swal.fire({
              text: 'No se pudo conectar al servidor',
              icon: 'error',
              buttonsStyling: false,
              confirmButtonText: 'Ok!'
            });
          }, 2000);
        });
    });
  })
</script>

<?= $this->endSection(); ?>