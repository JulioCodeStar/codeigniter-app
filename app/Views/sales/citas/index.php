<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Citas - KYP Bioingeniería
<?= $this->endSection(); ?>


<?= $this->section('content_sales'); ?>

<div class="col-xl-12">
  <div class="card">
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
        <div class="d-flex justify-content-end">

          <a href="#" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#create_citas">
            <i class="ki-duotone ki-plus fs-2">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>Agregar Cita
          </a>

        </div>
        <!--end::Toolbar-->
      </div>
      <!--end::Card toolbar-->
    </div>

    <div class="card-body">
      <!--begin::Table-->
      <table class="table align-middle table-row-dashed fs-6 gy-5" id="tblCitas">
        <!--begin::Table head-->
        <thead class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
          <tr>
            <th class="min-w-50px text-center">N°</th>
            <th class="min-w-100px">Paciente</th>
            <th class="min-w-80px">Monto</th>
            <th class="min-w-150px">Descripción</th>
            <th class="min-w-80px">Fecha</th>
            <th class="text-end min-w-80px">Acciones</th>
          </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-ray-600 fw-semibold">
          <?php foreach ($cita as $index => $row) { ?>
            <tr>
              <td class="text-center"><?= $index + 1 ?></td>
              <td class="d-flex flex-column">
                <h5><?= mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></h5>
                <p class="text-muted">Código: <?= $row['cod_paciente'] ?></p>
              </td>
              <td class="">
                <span class="badge badge-light-primary badge-lg">
                  <?= ($row['moneda'] == 'PEN' ? 'S/.' : '$') . ' ' . moneda($row['monto']) ?>
                </span>
              </td>
              <td class="text-muted">
                <p><?= $row['observaciones'] ?></p>
              </td>
              <td>
                <?= fecha_dmy($row['created_at']) ?>
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
                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#eliminarCitasModal" data-bs-url="<?= base_url('api/sales/citas/delete/') . $row['id'] ?>">
                      Eliminar
                    </a>
                  </div>
                  <!--end::Menu item-->

                  <div class="menu-item px-3">
                    <a href="<?= base_url('sales/citas/generate/' . $row['id']) ?>" target="_blank" class="menu-link px-3">
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
  </div>
</div>

<div class="modal fade" tabindex="-1" id="create_citas">
  <div class="modal-dialog modal-dialog-centered mw-650px">
    <?= form_open('api/sales/citas/create', ['id' => 'kt_form_citas', 'class' => 'fv-row modal-content', 'autocomplete' => 'off']) ?>

    <div class="modal-header">
      <h3 class="modal-title">Agregar Nueva Cita</h3>

      <!--begin::Close-->
      <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
      </div>
      <!--end::Close-->
    </div>

    <div class="modal-body">

      <div class="row g-4">

        <div class="col-md-4 mb-4 fv-row">
          <label for="fecha" class="required form-label">Fecha</label>
          <input type="date" name="fecha" id="fecha" class="form-control" />
        </div>

        <div class="col-md-8 mb-4 fv-row">
          <label for="paciente" class="required form-label">Paciente</label>
          <select name="paciente" id="paciente" aria-label="Select a Patient" data-control="select2" data-dropdown-parent="#create_citas" data-placeholder="Select an option" data-allow-clear="true" class="form-select">
            <option value=""></option>
            <?php foreach ($patient as $row) { ?>
              <option value="<?= $row['id'] ?>"><?= $row['cod_paciente'] . ' - ' . mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></option>
            <?php } ?>
          </select>
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
          <label for="bono" class="required form-label">Monto</label>
          <div class="input-group mb-3">
            <!-- Select al inicio -->
            <select class="form-select" id="moneda" name="moneda" aria-label="Selecciona opción">
              <option value="PEN" selected>S/.</option>
              <option value="USD">$</option>
            </select>

            <!-- Input de texto -->
            <input type="text" class="form-control w-50" id="bono" name="bono" placeholder="Monto" aria-label="Texto de entrada">
          </div>

        </div>

        <div class="col-md-12 mb-4 fv-row">
          <label for="obs" class="form-label">Descripción</label>
          <textarea name="observacion" id="observacion" class="form-control" style="height: 100px;"></textarea>
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="kt_btn_submit_citas">
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


<!--begin::Eliminar Pagos-->
<div class="modal fade" tabindex="-1" id="eliminarCitasModal" aria-hidden="true">
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


<?= $this->endSection(); ?>


<?= $this->section('scripts_sales'); ?>
<script>
  const KTDatatables = function() {
    let dt_cita;

    const initDatatable = () => {
      dt_cita = $("#tblCitas").DataTable({
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

    const handleSearch = () => {
      const filter = document.querySelector('[data-kt-citas-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt_cita.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearch();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });

  const eliminarPagosModal = document.querySelector("#eliminarCitasModal");
  if (eliminarPagosModal) {
    eliminarPagosModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-bs-url');

      const form = eliminarPagosModal.querySelector("#form-eliminar");
      form.setAttribute('action', url);
    })
  }

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

  const form = document.querySelector("#kt_form_citas");

  const validator = FormValidation.formValidation(form, {
    fields: {
      'paciente': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

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
      },

      'observacion': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },
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

  const submitButton = document.querySelector('#kt_btn_submit_citas');
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