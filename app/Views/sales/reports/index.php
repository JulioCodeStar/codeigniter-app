<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Reportes | Caja Ventas - KYP Bioingeniería
<?= $this->endSection(); ?>


<?= $this->section('content_sales'); ?>
<div
  id="kt_app_toolbar_container"
  class="card mb-5 pt-6 border rounded p-5">
  <?= form_open(
    'api/sales/reports/get-beetween',
    [
      'class' => 'row align-items-center justify-content-between gx-3 fv-row',
      'id'    => 'kt_form_reports'
    ]
  ) ?>

  <!-- IZQUIERDA: Select + Datepicker -->
  <div class="col-auto d-flex align-items-center gap-3">
    <?php
    $sedesPermitidas = sedes_permitidas_reporte();
    $tieneTodas = count($sedesPermitidas) === count($sede);
    ?>

    <div class="w-200px">
      <select
        class="form-select"
        id="sede"
        name="sede"
        data-control="select2"
        data-placeholder="Seleccione Sede">
        <option disabled value="" selected>Seleccione Sede</option>

        <?php foreach ($sede as $row): ?>
          <?php if (in_array($row['id'], $sedesPermitidas)): ?>
            <option value="<?= $row['id'] ?>">
              <?= esc($row['sucursal']) ?>
            </option>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($tieneTodas): ?>
          <option value="todas">Todas las Sedes</option>
        <?php endif; ?>
      </select>
    </div>


    <div class="position-relative d-flex align-items-center w-300px fv-row">
      <input
        type="text"
        class="form-control fw-bold ps-12 flatpickr-input"
        id="kt_daterangepicker_4"
        readonly />
      <i class="ki-duotone ki-calendar position-absolute ms-4 end-1 fs-3">
        <span class="path1"></span>
        <span class="path2"></span>
      </i>
    </div>

    <input type="hidden" name="fecha_inicio" id="fecha_inicio">
    <input type="hidden" name="fecha_fin" id="fecha_fin">
  </div>

  <!-- DERECHA: Botones -->
  <div class="col-auto d-flex align-items-center gap-3">
    <button
      type="button"
      class="btn btn-success fw-bold"
      id="kt_btn_exportar">
      <i class="ki-duotone ki-file-added fs-3">
        <span class="path1"></span>
        <span class="path2"></span>
      </i>
      <span class="indicator-label">Generar Reporte</span>
      <span class="indicator-progress">
        Generando...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
      </span>
    </button>

    <button
      type="button"
      class="btn btn-primary fw-bold"
      id="kt_btn_buscar">
      <i class="ki-duotone ki-magnifier fs-3">
        <span class="path1"></span>
        <span class="path2"></span>
      </i>
      <span class="indicator-label">Buscar</span>
      <span class="indicator-progress">
        Buscando...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
      </span>
    </button>
  </div>

  <?= form_close() ?>
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
          <h2 class="me-2 mb-0" id="ventas-soles">S/ </h2>
          <small class="text-muted mb-1" id="ventas-dolares">$ </small>
        </div>

        <!-- Detalle -->
        <p class="mb-3">
          <small class="text-muted">
            Total: venta(s)<br>
            <span id="ventas-count-soles"></span> en soles, <span id="ventas-count-dolares"></span> en dólares
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
          <h2 class="me-2 mb-0" id="contratos-soles">S/ </h2>
          <small class="text-muted mb-1" id="contratos-dolares">$ </small>
        </div>

        <!-- Detalle -->
        <p class="mb-3">
          <small class="text-muted">
            Total: contrato(s)<br>
            <span id="contratos-count-soles"></span> en soles, <span id="contratos-count-dolares"></span> en dólares
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
          <h2 class="me-2 mb-0" id="pagos-soles">S/ </h2>
          <small class="text-muted mb-1" id="pagos-dolares">$ </small>
        </div>

        <!-- Detalle -->
        <p class="mb-3">
          <small class="text-muted">
            Total: pagos recibidos<br>
            <span id="pagos-count-soles"></span> en soles, <span id="pagos-count-dolares"></span> en dólares
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
          <h2 class="me-2 mb-0" id="citas-total"></h2>
        </div>

        <!-- Detalle de citas y montos -->
        <p class="mb-3">
          <small class="text-muted">
            <span id="citas-count"></span> citas | <span id="mantenimientos-count"></span> mant.<br>
            Pagos Realizados: <span id="citas-mant-soles"></span> | <span id="citas-mant-dolares"></span>
          </small>
        </p>
      </div>
    </div>
  </div>
</div>


<!--begin::Navbar-->
<div class="card mb-6 mb-xl-9 my-5">
  <div class="card-body pb-0">
    <!--begin::Nav-->
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
          <span class="nav-text fw-semibold fs-4 mb-3">Pagos de Ventas</span>
          <span
            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
        </a>
      </li>
      <li class="nav-item p-0 ms-0 me-8">
        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_3">
          <span class="nav-text fw-semibold fs-4 mb-3">Contratos </span>
          <span
            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
        </a>
      </li>
      <li class="nav-item p-0 ms-0 me-8">
        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_4">
          <span class="nav-text fw-semibold fs-4 mb-3">Pagos de Contratos </span>
          <span
            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
        </a>
      </li>
      <li class="nav-item np-0 ms-0 me-8">
        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_5">
          <span class="nav-text fw-semibold fs-4 mb-3">Citas </span>
          <span
            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
        </a>
      </li>
      <li class="nav-item p-0 ms-0 me-8">
        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_tab_pane_6">
          <span class="nav-text fw-semibold fs-4 mb-3">Mantenimientos </span>
          <span
            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
        </a>
      </li>
    </ul>
    <!--end::Nav-->
  </div>
</div>
<!--end::Navbar-->

<!--begin::Table-->
<div class="card card-flush mt-6 mt-xl-9">

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
      <div class="card-header mt-5">
        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bold mb-1">Ventas del día</h3>
          <div class="fs-6 text-gray-500" id="range">

          </div>
        </div>
        <!--begin::Card title-->
      </div>

      <div class="card-body pt-0">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
          <table
            id="kt_table_ventas"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
              <tr>
                <th class="min-w-50px text-center">N°</th>
                <th class="min-w-20px">Código</th>
                <th class="min-w-150px">Paciente</th>
                <th class="min-w-80px">Monto</th>
                <th class="min-w-80px">Fecha</th>
                <th class="min-w-80px text-center">Sede</th>
                <th class="text-end min-w-80px">Acciones</th>
              </tr>
            </thead>
            <tbody class="fs-6">

            </tbody>
          </table>
          <!--end::Table-->
        </div>
        <!--end::Table container-->
      </div>
    </div>

    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
      <div class="card-header mt-5">
        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bold mb-1">Pagos Ventas del día</h3>
          <div class="fs-6 text-gray-500" id="range">

          </div>
        </div>
        <!--begin::Card title-->
      </div>

      <div class="card-body pt-0">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
          <table
            id="kt_table_pagos_ventas"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
              <tr>
                <th class="min-w-50px text-center">N°</th>
                <th class="min-w-20px">Código</th>
                <th class="min-w-150px">Paciente</th>
                <th class="min-w-80px">Monto</th>
                <th class="min-w-80px">Fecha</th>
                <th class="min-w-80px text-center">Sede</th>
                <th class="text-end min-w-80px">Acciones</th>
              </tr>
            </thead>
            <tbody class="fs-6">

            </tbody>
          </table>
          <!--end::Table-->
        </div>
        <!--end::Table container-->
      </div>
    </div>

    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
      <div class="card-header mt-5">
        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bold mb-1">Contratos del día</h3>
          <div class="fs-6 text-gray-500" id="range">

          </div>
        </div>
        <!--begin::Card title-->
      </div>

      <div class="card-body pt-0">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
          <table
            id="kt_table_contratos"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
              <tr>
                <th class="min-w-50px text-center">N°</th>
                <th class="min-w-20px">Código</th>
                <th class="min-w-150px">Paciente</th>
                <th class="min-w-80px">Monto</th>
                <th class="min-w-80px">Fecha</th>
                <th class="min-w-80px text-center">Sede</th>
                <th class="text-end min-w-80px">Acciones</th>
              </tr>
            </thead>
            <tbody class="fs-6">

            </tbody>
          </table>
          <!--end::Table-->
        </div>
        <!--end::Table container-->
      </div>
    </div>

    <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
      <div class="card-header mt-5">
        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bold mb-1">Pagos de Contratos del día</h3>
          <div class="fs-6 text-gray-500" id="range">

          </div>
        </div>
        <!--begin::Card title-->
      </div>

      <div class="card-body pt-0">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
          <table
            id="kt_table_pagos_contratos"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
              <tr>
                <th class="min-w-50px text-center">N°</th>
                <th class="min-w-20px">Código</th>
                <th class="min-w-150px">Paciente</th>
                <th class="min-w-80px">Monto</th>
                <th class="min-w-80px">Fecha</th>
                <th class="min-w-80px text-center">Sede</th>
                <th class="text-end min-w-80px">Acciones</th>
              </tr>
            </thead>
            <tbody class="fs-6">

            </tbody>
          </table>
          <!--end::Table-->
        </div>
        <!--end::Table container-->
      </div>
    </div>

    <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
      <div class="card-header mt-5">
        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bold mb-1">Citas del día</h3>
          <div class="fs-6 text-gray-500" id="range">

          </div>
        </div>
        <!--begin::Card title-->
      </div>

      <div class="card-body pt-0">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
          <table
            id="kt_table_citas"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
              <tr>
                <th class="min-w-25px text-center">N°</th>
                <th>Paciente</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Monto Total</th>
                <th style="width: 350px; white-space: nowrap;">Descripcion</th>
                <th class="min-w-80px text-center">Sede</th>
                <th class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody class="fs-6">

            </tbody>
          </table>
          <!--end::Table-->
        </div>
        <!--end::Table container-->
      </div>
    </div>

    <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
      <div class="card-header mt-5">

        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bold mb-1">Mantenimientos del día</h3>
          <div class="fs-6 text-gray-500" id="range">

          </div>
        </div>
        <!--begin::Card title-->
      </div>

      <div class="card-body pt-0">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
          <table
            id="kt_table_mantenimiento"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
              <tr>
                <th class="min-w-25px text-center">N°</th>
                <th>Paciente</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Monto Total</th>
                <th style="width: 350px; white-space: nowrap;">Descripcion</th>
                <th class="min-w-80px text-center">Sede</th>
                <th class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody class="fs-6">

            </tbody>
          </table>
          <!--end::Table-->
        </div>
        <!--end::Table container-->
      </div>
    </div>
  </div>

</div>

<?= $this->endSection(); ?>




<?= $this->section('scripts_sales'); ?>
<?= csrf_scripts_basic() ?>

<script>
  const KTDatatables = function() {
    let dt_ventas;
    let dt_pagos_ventas;
    let dt_contratos;
    let dt_pagos_contratos;
    let dt_pagos_citas;
    let dt_pagos_mantenimiento;

    const initDatatable = () => {

      dt_ventas = $("#kt_table_ventas").DataTable({
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

      dt_pagos_ventas = $("#kt_table_pagos_ventas").DataTable({
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

      dt_contratos = $("#kt_table_contratos").DataTable({
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

      dt_pagos_contratos = $("#kt_table_pagos_contratos").DataTable({
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

      dt_pagos_citas = $("#kt_table_citas").DataTable({
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

      dt_pagos_mantenimiento = $("#kt_table_mantenimiento").DataTable({
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

    // const handleSearchPagos = () => {
    //   const filter = document.querySelector('[data-kt-pagos-table-filter="search"]');
    //   filter.addEventListener('keyup', function(e) {
    //     dt_pago.search(e.target.value).draw();
    //   });
    // }

    return {
      init: function() {
        initDatatable();
      }
    }
  }();


  KTUtil.onDOMContentLoaded(function() {
    KTDatatables.init();
  });

  // 1. Establece el locale de Moment a español
  moment.locale('es');

  // 2. Inicializa el date range picker en vacío
  $("#kt_daterangepicker_4").daterangepicker({
    autoUpdateInput: false, // ← evita que se rellene al inicializar
    opens: 'right',
    ranges: {
      "Hoy": [moment(), moment()],
      "Ayer": [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 Días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 Días": [moment().subtract(29, "days"), moment()],
      "Este Mes": [moment().startOf("month"), moment().endOf("month")],
      "Mes Anterior": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
    },
    locale: {
      format: "DD/MM/YYYY",
      applyLabel: "Aplicar",
      cancelLabel: "Cancelar",
      fromLabel: "Desde",
      toLabel: "Hasta",
      customRangeLabel: "Personalizado",
      daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
      monthNames: [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
      ],
      firstDay: 1
    }
  });

  // 3. Al aplicar un rango, escribe las fechas en DD/MM/YYYY
  $("#kt_daterangepicker_4").on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
      picker.startDate.format('DD/MM/YYYY') +
      ' - ' +
      picker.endDate.format('DD/MM/YYYY')
    );

    document.querySelector('#fecha_inicio').value = picker.startDate.format('YYYY-MM-DD');
    document.querySelector('#fecha_fin').value = picker.endDate.format('YYYY-MM-DD');
  });

  // 4. Si se cancela (se pulsa Cancelar), deja el campo vacío
  $("#kt_daterangepicker_4").on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    document.querySelector('#fecha_inicio').value = '';
    document.querySelector('#fecha_fin').value = '';
  });

  const frm = document.querySelector("#kt_form_reports");

  const validator = FormValidation.formValidation(frm, {
    fields: {
      'sede': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'kt_daterangepicker_4': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
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

  const submit = document.querySelector("#kt_btn_buscar");
  submit.addEventListener('click', function() {

    if (!validator) {
      return;
    }

    validator.validate().then(function(status) {
      if (status !== 'Valid') {
        return;
      }

      submit.setAttribute('data-kt-indicator', 'on');
      submit.disabled = true;

      const executeFetch = async () => {
        try {
          const response = await fetch(frm.action, {
            method: 'POST',
            body: new FormData(frm),
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': getCsrfToken() // Usar helper aquí
            }
          });

          if (response.status === 403) {
            await updateCsrfToken(); // Usar helper aquí
            return executeFetch(); // Reintentar
          }

          const data = await response.json();
          console.log(data);
          document.querySelectorAll('#range').forEach(el => {
            el.innerHTML = `${data.start}   -   ${data.end}`;
          });
          actualizarTablas(data);
          actualizarCard(data);


        } catch (error) {
          console.error('Error:', error);
        } finally {
          submit.removeAttribute('data-kt-indicator');
          submit.disabled = false;
        }
      };

      setTimeout(executeFetch, 2000);
    });
  });

  const generateExcel = document.querySelector('#kt_btn_exportar');
  generateExcel.addEventListener('click', function() {
    if (!validator) {
      return;
    }

    validator.validate().then(function(status) {
      if (status !== 'Valid') {
        return;
      }

      generateExcel.setAttribute('data-kt-indicator', 'on');
      generateExcel.disabled = true;

      const executeFetchExcel = async () => {
        try {
          const response = await fetch("<?= base_url('api/sales/reports/generate') ?>", {
            method: 'POST',
            body: new FormData(frm),
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': getCsrfToken()
            }
          });

          if (response.status === 403) {
            await updateCsrfToken();
            return executeFetchExcel(); // reintenta
          }

          if (!response.ok) throw new Error('Servidor respondió ' + response.status);

          // ① Recibimos el binario
          const blob = await response.blob();

          // ② Creamos URL temporal
          const url = window.URL.createObjectURL(blob);

          // ③ Disparamos la descarga
          const a = document.createElement('a');
          a.href = url;
          a.download = `reporte_contratos_${Date.now()}.xlsx`;
          document.body.appendChild(a);
          a.click();
          a.remove();
          window.URL.revokeObjectURL(url);

        } catch (err) {
          console.error(err);
        } finally {
          generateExcel.removeAttribute('data-kt-indicator');
          generateExcel.disabled = false;
        }
      };

      setTimeout(executeFetchExcel, 2000);
    });
  });

  function actualizarTablas(data) {
    // Tabla Ventas
    const tbodyVentas = document.querySelector('#kt_table_ventas tbody');
    tbodyVentas.innerHTML = data.table.ventas.map((venta, index) => `
        <tr>
            <td class="text-center">
              <span class="badge badge-light-primary badge-lg">      
                ${venta.n_boleta}
              </span>
            </td>
            <td><span class="badge badge-warning badge-lg">${venta.cod_paciente}</span></td>
            <td class="d-flex flex-column">
              <h5>${venta.paciente}</h5>
              <p class="text-muted">${venta.trabajo}</p>
            </td>
            <td>
              <span class="badge badge-light-success badge-lg">      
                ${venta.moneda} ${venta.monto_format}
              </span>
            </td>
            <td>${venta.fecha}</td>
            <td class="text-center">
              <span class="badge badge-light-info badge-lg">${venta.sede}</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-sm btn-icon btn-dark">
                <i class="fas fa-envelope-open-text fs-4"></i>
              </a>
            </td>
        </tr>
    `).join('');

    const tbodyPagosVentas = document.querySelector('#kt_table_pagos_ventas tbody');
    tbodyPagosVentas.innerHTML = data.table.pagos_ventas.map((venta, index) => `
        <tr>
            <td class="text-center">
              ${index + 1}
            </td>
            <td><span class="badge badge-warning badge-lg">${venta.cod_paciente}</span></td>
            <td class="d-flex flex-column">
              <h5>${venta.paciente}</h5>
              <p class="text-muted">${venta.trabajo}</p>
            </td>
            <td>
              <span class="badge badge-light-success badge-lg">      
                ${venta.moneda} ${venta.monto_format}
              </span>
            </td>
            <td>${venta.fecha}</td>
            <td class="text-center">
              <span class="badge badge-light-info badge-lg">${venta.sede}</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-sm btn-icon btn-dark">
                <i class="fas fa-envelope-open-text fs-4"></i>
              </a>
            </td>
        </tr>
    `).join('');

    const tbodyContratos = document.querySelector('#kt_table_contratos tbody');
    tbodyContratos.innerHTML = data.table.contratos.map((contrato, index) => `
        <tr>
            <td class="text-center">
              ${index + 1}
            </td>
            <td><span class="badge badge-warning badge-lg">${contrato.cod_paciente}</span></td>
            <td class="d-flex flex-column">
              <h5>${contrato.paciente}</h5>
              <p class="text-muted">${contrato.trabajo}</p>
            </td>
            <td>
              <span class="badge badge-light-success badge-lg">      
                ${contrato.moneda} ${contrato.monto_format}
              </span>
            </td>
            <td>${contrato.fecha}</td>
            <td class="text-center">
              <span class="badge badge-light-info badge-lg">${contrato.sede}</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-sm btn-icon btn-dark">
                <i class="fas fa-envelope-open-text fs-4"></i>
              </a>
            </td>
        </tr>
    `).join('');

    const tbodyPagosContratos = document.querySelector('#kt_table_pagos_contratos tbody');
    tbodyPagosContratos.innerHTML = data.table.pagos_contratos.map((pago_contrato, index) => `
        <tr>
            <td class="text-center">
              ${index + 1}
            </td>
            <td><span class="badge badge-warning badge-lg">${pago_contrato.cod_paciente}</span></td>
            <td class="d-flex flex-column">
              <h5>${pago_contrato.paciente}</h5>
              <p class="text-muted">${pago_contrato.trabajo}</p>
            </td>
            <td>
              <span class="badge badge-light-success badge-lg">      
                ${pago_contrato.moneda} ${pago_contrato.monto_format}
              </span>
            </td>
            <td>${pago_contrato.fecha}</td>
            <td class="text-center">
              <span class="badge badge-light-info badge-lg">${pago_contrato.sede}</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-sm btn-icon btn-dark">
                <i class="fas fa-envelope-open-text fs-4"></i>
              </a>
            </td>
        </tr>
    `).join('');

    const tbodyCitas = document.querySelector('#kt_table_citas tbody');
    tbodyCitas.innerHTML = data.table.citas.map((citas, index) => `
        <tr>
            <td class="text-center">
              ${index + 1}
            </td>
            <td class="d-flex flex-column">
              <h5>${citas.paciente}</h5>
              <p class="text-muted">Código: ${citas.cod_paciente}</p>
            </td>
            <td class="text-center">${citas.fecha}</td>
            <td class="text-center">
              <span class="badge badge-light-success badge-lg">      
                ${citas.moneda} ${citas.monto_format}
              </span>
            </td>
            <td class="text-muted">
                ${citas.descripcion}
            </td>
            <td class="text-center">
              <span class="badge badge-light-info badge-lg">${citas.sede}</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-sm btn-icon btn-dark">
                <i class="fas fa-envelope-open-text fs-4"></i>
              </a>
            </td>
        </tr>
    `).join('');

    const tbodyMantenimiento = document.querySelector('#kt_table_mantenimiento tbody');
    tbodyMantenimiento.innerHTML = data.table.mantenimiento.map((managment, index) => `
        <tr>
            <td class="text-center">
              ${index + 1}
            </td>
            <td class="d-flex flex-column">
              <h5>${managment.paciente}</h5>
              <p class="text-muted">Código: ${managment.cod_paciente} | ${managment.trabajo}</p>
            </td>
            <td class="text-center">${managment.fecha}</td>
            <td class="text-center">
              <span class="badge badge-light-success badge-lg">      
                ${managment.moneda} ${managment.monto_format}
              </span>
            </td>
            <td class="text-muted">
                ${managment.descripcion}
            </td>
            <td class="text-center">
              <span class="badge badge-light-info badge-lg">${managment.sede}</span>
            </td>
            <td class="text-end">
              <a href="#" class="btn btn-sm btn-icon btn-dark">
                <i class="fas fa-envelope-open-text fs-4"></i>
              </a>
            </td>
        </tr>
    `).join('');
  }

  function actualizarCard(data) {
    // Ventas
    document.getElementById('ventas-soles').textContent = `S/ ${data.resumen.total_venta_pen}`;
    document.getElementById('ventas-dolares').textContent = `$ ${data.resumen.total_venta_usd}`;
    document.getElementById('ventas-count-soles').textContent = data.resumen.count_ventas_soles;
    document.getElementById('ventas-count-dolares').textContent = data.resumen.count_ventas_dolares;

    // Contratos
    document.getElementById('contratos-soles').textContent = `S/ ${data.resumen.total_contrato_pen}`;
    document.getElementById('contratos-dolares').textContent = `$ ${data.resumen.total_contrato_usd}`;
    document.getElementById('contratos-count-soles').textContent = data.resumen.count_contract_soles;
    document.getElementById('contratos-count-dolares').textContent = data.resumen.count_contract_dolares;

    // Pagos
    document.getElementById('pagos-soles').textContent = `S/ ${data.resumen.pagos_total_pen}`;
    document.getElementById('pagos-dolares').textContent = `$ ${data.resumen.pagos_total_usd}`;
    document.getElementById('pagos-count-soles').textContent = data.resumen.count_pagos_soles;
    document.getElementById('pagos-count-dolares').textContent = data.resumen.count_pagos_dolares;

    // Citas y Mantenimientos
    document.getElementById('citas-total').textContent = data.resumen.count_cita_manag;
    document.getElementById('citas-count').textContent = data.resumen.count_cita;
    document.getElementById('mantenimientos-count').textContent = data.resumen.count_manag;
    document.getElementById('citas-mant-soles').textContent = `S/ ${data.resumen.pagos_total_citas_managment_pen}`;
    document.getElementById('citas-mant-dolares').textContent = `$ ${data.resumen.pagos_total_citas_managment_usd}`;
  }
</script>

<?= $this->endSection(); ?>