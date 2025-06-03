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

  <li class="breadcrumb-item text-muted">Cotizaciones</li>

  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>

  <li class="breadcrumb-item text-muted">
    <a href="<?= base_url('invoice') ?>" class="text-muted text-hover-primary">Listado</a>
  </li>

  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>

  <li class="breadcrumb-item text-muted">Modificar</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>


<?= form_open('api/invoice/edit/' . $get['id'], ['id' => 'kt_invoice_form', 'class' => 'fv-row mt-5', 'autocomplete' => 'off']) ?>
<div class="d-flex flex-column flex-lg-row">
  <!--begin::Content-->
  <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
    <!--begin::Card-->
    <div class="card">
      <!--begin::Card body-->
      <div class="card-body p-12">

        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start flex-xxl-row">
          <!--begin::Input group-->
          <div class="d-flex align-items-center flex-equal fw-row me-4 order-2" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Fecha de Cotización">
            <!--begin::Date-->
            <div class="fs-6 fw-bold text-gray-700 text-nowrap required">Fecha:</div>
            <!--end::Date-->
            <!--begin::Input-->
            <div class="position-relative d-flex align-items-center w-150px fv-row">
              <!--begin::Datepicker-->
              <input type="date" class="form-control form-control-transparent fw-bold pe-5" placeholder="Select date" name="fecha_now" id="fecha_now" value="<?= date('Y-m-d', strtotime($get['fecha_now'])) ?>" />
              <!--end::Datepicker-->
            </div>
            <!--end::Input-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4">
            <span class="fs-2x fw-bold text-gray-800">N° <?= $get['cod_cotizacion'] ?></span>

          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Fecha de Expiración">
            <!--begin::Date-->
            <div class="fs-6 fw-bold text-gray-700 text-nowrap required">Fecha Exp.:</div>
            <!--end::Date-->
            <!--begin::Input-->
            <div class="position-relative d-flex align-items-center w-150px fv-row">
              <!--begin::Datepicker-->
              <input type="date" class="form-control form-control-transparent fw-bold pe-5" placeholder="Select date" name="fecha_exp" id="fecha_exp" value="<?= date('Y-m-d', strtotime($get['fecha_exp'])) ?>" />
              <!--end::Datepicker-->
            </div>
            <!--end::Input-->
          </div>
          <!--end::Input group-->
        </div>
        <!--end::Top-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-10"></div>
        <!--end::Separator-->
        <!--begin::Wrapper-->
        <div class="mb-0">
          <!--begin::Row-->
          <div class="row gx-10 mb-5">

            <!--begin::Col-->
            <div class="col-lg-6">
              <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Paciente</label>
              <!--begin::Input group-->
              <div class="mb-5 fv-row">
                <select name="paciente_id" id="paciente_id" aria-label="Select a Patient" data-control="select2" data-placeholder="Seleccionar Paciente" class="form-select form-select-solid">
                  <option value=""></option>
                  <?php foreach ($paciente as $row) { ?>
                    <option <?= ($get['id_paciente'] == $row['id'] ? 'selected' : '') ?> value="<?= $row['id'] ?>"><?= $row['cod_paciente'] . ' - ' . mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></option>
                  <?php } ?>
                </select>
              </div>
              <!--end::Input group-->


            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-lg-6">
              <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Servicio & Trabajo</label>
              <!--begin::Input group-->
              <div class="mb-5 fv-row">
                <select name="select-servicio" id="select-servicio" aria-label="Select a Services" data-control="select2" data-placeholder="Seleccionar Servicio" class="form-select form-select-solid" onchange="OnchangeJob();">
                  <option value=""></option>
                  <?php foreach ($service as $row) { ?>
                    <option <?= ($get['id_servicio'] == $row['id'] ? 'selected' : '') ?> value="<?= $row['id'] ?>"><?= mb_strtoupper($row['descripcion']) ?></option>
                  <?php } ?>
                </select>
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="mb-5 fv-row">
                <select name="select-trabajo" id="select-trabajo" aria-label="Select a Jobs" data-control="select2" data-placeholder="Seleccionar Trabajo" class="form-select form-select-solid" onchange="Components();">
                  <?php foreach ($job as $row) { ?>
                    <option <?= ($get['id_trabajo'] == $row['id'] ? 'selected' : '') ?> value="<?= $row['id'] ?>"><?= mb_strtoupper($row['descripcion']) ?></option>
                  <?php } ?>
                </select>
              </div>
              <!--end::Input group-->

            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Table wrapper-->
          <div class="table-responsive mb-10">
            <!--begin::Table-->
            <table class="table g-5 gs-0 mb-0 fw-bold text-gray-700" data-kt-element="items">
              <!--begin::Table head-->
              <thead>
                <tr class="border-bottom fs-7 fw-bold text-gray-700 text-uppercase">
                  <th class="min-w-300px w-900px">Item</th>
                  <th class="min-w-100px w-100px">Cant.</th>
                  <th colspan="2" class="text-end">Action</th>
                </tr>
              </thead>
              <!--end::Table head-->
              <!--begin::Table body-->
              <tbody>
                <?php foreach ($list as $row) { ?>
                  <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                    <td class="pe-7 d-flex flex-column gap-2">
                      <input type="text" class="form-control  form-control-solid me-2" name="title[]" id="title[]" placeholder="Item name" value="<?= $row['title'] ?>" />
                      <input type="text" class="form-control  form-control-solid" name="description[]" id="description[]" placeholder="Description" value="<?= $row['descripcion'] ?>" />
                    </td>
                    <td class="ps-0">
                      <input class="form-control form-control-solid" type="number" min="1" name="cantidad[]" id="cantidad[]" placeholder="1" value="1" data-kt-element="quantity" value="<?= $row['cantidad'] ?>" />
                    </td>
                    <td colspan="2" class="pt-5 text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                        <i class="ki-duotone ki-trash fs-3">
                          <span class="path1"></span>
                          <span class="path2"></span>
                          <span class="path3"></span>
                          <span class="path4"></span>
                          <span class="path5"></span>
                        </i>
                      </button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
              <!--end::Table body-->
              <!--begin::Table foot-->
              <tfoot>
                <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                  <th class="text-primary">
                    <button class="btn btn-link py-1" data-kt-element="add-item">Agregar Item</button>
                  </th>
                  <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                    <div class="d-flex flex-column align-items-start fv-row">
                      <div class="fs-5 mb-10 required">Subtotal</div>
                      <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="igv" name="igv" <?= ($get['igv'] == 1) ? 'checked' : '' ?>>
                        <label class="form-check-label fs-7" for="igv">IGV (18%)</label>
                      </div>
                      <div class="d-flex align-items-center gap-2 ">
                        <label class="form-label mb-0">Descuento</label>
                      </div>
                    </div>
                  </th>
                  <th colspan="1" class="border-bottom border-bottom-dashed text-end">
                    <div class="mb-3 fv-row">
                      <input type="text" id="subtotal" class="form-control w-100px form-control-solid mb-4" name="subtotal" placeholder="0.00" value="<?= $get['monto'] ?>" />
                    </div>
                    <div class="text-muted small mb-6">IGV: <span id="monto-igv"><?= $get['igv_valor'] ?></span></div>
                    <input type="hidden" readonly name="igv_coti" id="igv_coti" value="<?= $get['igv_valor'] ?>">
                    <input type="number" id="descuento" name="descuento" class="form-control form-control-sm w-100px" placeholder="" step="0.01" value="<?= $get['descuento'] ?>">
                    
                  </th>
                </tr>
                <tr class="align-top fw-bold text-gray-700">
                  <th></th>
                  <th colspan="2" class="fs-4 ps-0">Total</th>
                  <th colspan="2" class="text-end fs-4 text-nowrap">
                    <span id="total"><?= $get['monto_final'] ?></span>
                    <input type="hidden" readonly name="total_coti" id="total_coti" value="<?= $get['monto_final'] ?>">
                  </th>
                </tr>
              </tfoot>
              <!--end::Table foot-->
            </table>
          </div>
          <!--end::Table-->

          <!--begin::Item template-->
          <table class="table d-none" data-kt-element="item-template">
            <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
              <td class="pe-7 d-flex flex-column gap-2">
                <input type="text" class="form-control form-control-solid me-2" name="title[]" id="title[]" placeholder="Item name" />
                <input type="text" class="form-control form-control-solid" id="decription[]" name="description[]" placeholder="Description" />
              </td>
              <td class="ps-0">
                <input class="form-control form-control-solid" type="number" min="1" name="cantidad[]" placeholder="1" value="1" data-kt-element="quantity" />
              </td>
              <td colspan="2" class="pt-5 text-end">
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                  <i class="ki-duotone ki-trash fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                  </i>
                </button>
              </td>
            </tr>
          </table>
          <table class="table d-none" data-kt-element="empty-template">
            <tr data-kt-element="empty">
              <th colspan="5" class="text-muted text-center py-10">No items</th>
            </tr>
          </table>
          <!--end::Item template-->

          <!--begin::Notes-->
          <div class="mb-2">
            <label class="form-label fs-6 fw-bold text-gray-700">Diagnóstico Técnico</label>
            <textarea name="diagnostico" id="diagnostico" class="form-control form-control-solid " rows="3" placeholder="(Cotización)"><?= $get['diagnostico'] ?></textarea>
          </div>

          <div class="mb-0">
            <label class="form-label fs-6 fw-bold text-gray-700">Ajustes Técnicos</label>
            <textarea name="ajustes" id="ajustes" class="form-control form-control-solid " rows="3" placeholder="(Contrato)"><?= $get['ajustes'] ?></textarea>
          </div>
          <!--end::Notes-->
        </div>
        <!--end::Wrapper-->

      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
  <!--end::Content-->

  <!--begin::Sidebar-->
  <div class="flex-lg-auto min-w-lg-300px">
    <!--begin::Card-->
    <div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
      <!--begin::Card body-->
      <div class="card-body p-10">

        <div class="mb-10 fv-row">
          <label class="form-label fw-bold fs-6 text-gray-700 required">Evaluación</label>
          <!--end::Label-->
          <!--begin::Select-->
          <select name="apto" id="apto" aria-label="Select a Timezone" data-control="select2" data-placeholder="Seleccionar Evaluación" class="form-select form-select-solid">
            <option disabled value=""></option>
            <option <?= ($get['aprobacion'] == 'Apto') ? 'selected' : '' ?> value="Apto">
              Apto
            </option>
            <option <?= ($get['aprobacion'] == 'No Apto') ? 'selected' : '' ?> value="No Apto">
              No Apto
            </option>
          </select>
        </div>

        <div class="separator separator-dashed mb-8"></div>


        <!--begin::Input group-->
        <div class="mb-10 fv-row">
          <!--begin::Label-->
          <label class="form-label fw-bold fs-6 text-gray-700 required">Moneda</label>
          <!--end::Label-->
          <!--begin::Select-->
          <select name="moneda" id="moneda" aria-label="Select a Timezone" data-control="select2" data-placeholder="Seleccionar Moneda" class="form-select form-select-solid">
            <option value=""></option>
            <option <?= ($get['moneda'] == 'USD') ? 'selected' : '' ?> data-kt-flag="flags/united-states.svg" value="USD">
              <b>USD</b>&nbsp;-&nbsp;USA dollar
            </option>
            <option <?= ($get['moneda'] == 'PEN') ? 'selected' : '' ?> data-kt-flag="flags/united-states.svg" value="PEN">
              <b>PEN</b>&nbsp;-&nbsp;PE soles
            </option>
          </select>
          <!--end::Select-->
        </div>
        <!--end::Input group-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mb-8"></div>
        <!--end::Separator-->
        <!--begin::Input group-->
        <div class="mb-8">

          <div class="fv-row mb-4">
            <label class="form-label fw-bold fs-6 text-gray-700 required">Encargado</label>
            <input type="text" class="form-control form-control-solid mb-3" name="encargado" id="encargado" placeholder="Encargado Cotización" value="<?= $get['encargado'] ?>" />
          </div>

          <div class="fv-row">
            <label class="form-label fw-bold fs-6 text-gray-700">Peso (kg.)</label>
            <input type="text" class="form-control form-control-solid" name="peso" id="peso" placeholder="(opcional)" <?= $get['peso'] ?> />
          </div>
        </div>
        <!--end::Input group-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mb-8"></div>
        <!--end::Separator-->
        <!--begin::Actions-->
        <div class="mb-0">
          <button type="submit" href="#" class="btn btn-primary w-100" id="kt_invoice_submit_button">
            <i class="ki-duotone ki-triangle fs-3">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
            </i>
            <span class="indicator-label">
              Modificar
            </span>
            <span class="indicator-progress">
              Modificando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
          </button>

        </div>
        <!--end::Actions-->
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
  <!--end::Sidebar-->
</div>
<?= form_close(); ?>



<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
  const KTAppInvoicesCreate = (function() {
    let form; // Referencia al formulario principal

    // 👉 Función para verificar si hay ítems o mostrar mensaje vacío
    const verificarItems = () => {
      const tbody = form.querySelector('tbody');
      if (tbody.querySelectorAll('[data-kt-element="item"]').length === 0) {
        // Si no hay ítems, se podría agregar una fila vacía o mensaje
        const filaVacia = document.createElement('tr');
        filaVacia.innerHTML = `<td colspan="3" class="text-muted text-center">No hay ítems</td>`;
        filaVacia.setAttribute('data-kt-element', 'empty');
        tbody.appendChild(filaVacia);
      } else {
        // Elimina la fila vacía si ya hay ítems
        const filaVacia = tbody.querySelector('[data-kt-element="empty"]');
        if (filaVacia) filaVacia.remove();
      }
    };

    // 👉 Inicializar el módulo
    const init = () => {
      form = document.querySelector("#kt_invoice_form");

      // 🔘 Agregar nuevo ítem
      form.querySelector('[data-kt-element="add-item"]').addEventListener("click", (e) => {
        e.preventDefault();
        const plantilla = form.querySelector('[data-kt-element="item-template"] tr').cloneNode(true);
        form.querySelector("tbody").appendChild(plantilla);
        verificarItems();
      });

      // 🗑️ Eliminar ítem
      form.addEventListener("click", function(e) {
        if (e.target.closest('[data-kt-element="remove-item"]')) {
          e.preventDefault();
          e.target.closest('[data-kt-element="item"]').remove();
          verificarItems();
        }
      });
    };

    return {
      init
    };
  })();

  // Ejecutar al cargar DOM
  KTUtil.onDOMContentLoaded(function() {
    KTAppInvoicesCreate.init();
  });

  function OnchangeJob() {
    const selectServicio = document.getElementById('select-servicio');
    const selectTrabajo = document.getElementById('select-trabajo');

    const servicioId = selectServicio.value;

    if (servicioId) {
      // Hacer petición AJAX
      fetch(`<?= base_url('api/invoice/getServiceJob') ?>/${servicioId}`)
        .then(response => response.json())
        .then(data => {
          // Limpiar opciones actuales
          selectTrabajo.innerHTML = '<option value=""></option>';

          // Agregar nuevas opciones
          data.forEach(trabajo => {
            const option = document.createElement('option');
            option.value = trabajo.id;
            option.textContent = trabajo.descripcion.toUpperCase();;
            selectTrabajo.appendChild(option);
          });

          // Actualizar Select2
          $(selectTrabajo).trigger('change.select2');
        });
    } else {
      selectTrabajo.innerHTML = '<option value=""></option>';
      $(selectTrabajo).trigger('change.select2');
    }
  }

  function Components() {
    const job_id = document.querySelector("#select-trabajo").value;
    const url = `<?= base_url('api/invoice/components') ?>/${job_id}`;

    if (!job_id) return;

    fetch(url)
      .then((res) => res.json())
      .then((data) => {
        console.log(data);

        const tbody = document.querySelector('[data-kt-element="items"] tbody');

        // Limpiar filas anteriores
        tbody.innerHTML = '';

        data.forEach((comp) => {
          const row = document.createElement("tr");
          row.setAttribute("data-kt-element", "item");
          row.classList.add("border-bottom", "border-bottom-dashed");


          // Generar options del datalist
          let datalistOptions = '';
          if (comp.items && Array.isArray(comp.items)) {
            comp.items.forEach(item => {
              datalistOptions += `<option value="${item}"></option>`;
            });
          }

          row.innerHTML = `
          <td class="pe-7 d-flex flex-column gap-2">
            <input type="text" class="form-control form-control-solid me-2" name="title[]" value="${comp.description || ''}" placeholder="Item name" />
            <input list="coti_list_${comp.id}" type="text" class="form-control form-control-solid" name="description[]" placeholder="Description" />
            <datalist id="coti_list_${comp.id}">
              ${datalistOptions}
            </datalist>
          </td>
          <td class="ps-0">
            <input class="form-control form-control-solid" type="number" min="1" name="cantidad[]" value="${comp.cantidad}" data-kt-element="quantity" />
          </td>
          <td colspan="2" class="pt-5 text-end">
            <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
              <i class="ki-duotone ki-trash fs-3">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
              </i>
            </button>
          </td>
        `;

          tbody.appendChild(row);
        });
      });

  }

  function calcularTotalDesdeSubtotal() {
    const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
    const descuento = parseFloat(document.getElementById('descuento').value) || 0;
    const aplicaIgv = document.getElementById('igv').checked;

    const igv = aplicaIgv ? subtotal * 0.18 : 0;
    const total = subtotal + igv - descuento;

    // Mostrar resultados
    document.getElementById('monto-igv').innerText = igv.toFixed(2);
    document.getElementById('igv_coti').value = igv.toFixed(2);
    document.getElementById('total').innerText = total.toFixed(2);
    document.getElementById('total_coti').value = total.toFixed(2);
  }

  function ErrorsListComponenst() {
    const tbody = form.querySelector('[data-kt-element="items"] tbody');
    const rows = tbody.querySelectorAll('[data-kt-element="item"]');
    let tieneErrores = false;

    rows.forEach(row => {
      const desc = row.querySelector('[name="description[]"]');
      const cantidad = row.querySelector('[name="cantidad[]"]');
      const valorDesc = desc.value.trim();
      const valorCant = parseFloat(cantidad.value);

      if (!valorDesc || isNaN(valorCant) || valorCant <= 0) {
        desc.classList.add('is-invalid');
        cantidad.classList.add('is-invalid');
        tieneErrores = true;
      } else {
        desc.classList.remove('is-invalid');
        cantidad.classList.remove('is-invalid');
      }
    });

    if (tieneErrores) {
      Swal.fire({
        text: 'Completa todos los ítems de descripción y cantidad correctamente.',
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

  document.addEventListener("DOMContentLoaded", () => {
    document.getElementById('subtotal').addEventListener('input', calcularTotalDesdeSubtotal);
    document.getElementById('descuento').addEventListener('input', calcularTotalDesdeSubtotal);
    document.getElementById('igv').addEventListener('change', calcularTotalDesdeSubtotal);
  });

  const form = document.querySelector("#kt_invoice_form");

  const validator = FormValidation.formValidation(form, {
    fields: {
      'fecha_now': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'fecha_exp': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'paciente_id': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'select-servicio': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'select-trabajo': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'subtotal': {
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

      'descuento': {
        validators: {
          numeric: {
            message: 'Solo se permiten números',
            decimalSeparator: '.', // Usa '.' como separador decimal
            thousandsSeparator: ',' // Opcional (para miles)
          },
        }
      },

      'moneda': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'peso': {
        validators: {
          numeric: {
            message: 'Ingrese un peso válido',
            decimalSeparator: '.'
          },
          greaterThan: {
            min: 0,
            message: 'El peso no puede ser negativo'
          }
        }
      },

      'encargado': {
        validators: {
          notEmpty: {
            message: "El campo es Obligatorio"
          }
        }
      },

      'apto': {
        alidators: {
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

  const submit = document.querySelector("#kt_invoice_submit_button");
  submit.addEventListener('click', function(e) {
    e.preventDefault();

    if (!validator) {
      return;
    }

    if (!ErrorsListComponenst()) {
      return; // ⬅️⬅️⬅️ si hay errores no sigo
    }

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

          // 3. Esperar al menos 2 s antes de quitar el spinner
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
                window.location.href = '<?= base_url('invoice') ?>';
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
  });
</script>

<?= $this->endSection(); ?>