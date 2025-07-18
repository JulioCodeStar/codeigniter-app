<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Ordenes de Requerimientos | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>


<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Requerimientos como Origen de la Sede <?= $sedes['sucursal'] ?>
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Requerimientos</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Nuevo Requerimiento</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content_inventory'); ?>

<div class="card card-flush h-lg-100 mt-5">
    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-delivery-24 fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
            </i>
            <h2>Nuevo Requerimiento Interno Manual</h2>
        </div>
    </div>

    <div class="card-body pt-5">

        <?= form_open('api/inventory/requirements/create', ['id' => 'kt_submit_form_requirements', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>
        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Información Básica</label>

            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="area" class="form-label required">Area Solicitante</label>
                    <select data-control="select2" data-placeholder="Seleccionar Area Solicitante" name="area" id="area" class="form-select">
                        <option value="">Seleccionar Area Solicitante</option>
                        <?php foreach ($areas as $area): ?>
                            <option value="<?= $area['id']; ?>"><?= esc($area['nombres']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div class="col-md-6 mb-4 fv-row">
                    <label for="solicitante" class="form-label required">Nombre del Solicitante</label>
                    <input type="text" name="solicitante" id="solicitante" class="form-control" placeholder="Nombre del Solicitante" />
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="fecha_entrega" class="form-label required">Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" placeholder="Fecha de Entrega" />
                </div>

            </div>
        </div>

        <div id="itemForm" class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Items Solicitados</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <!-- Producto -->
                <div class="col-md-3 fv-row">
                    <label class="form-label required">Producto</label>
                    <select id="reqProducto" name="producto_id[]" class="form-select" data-control="select2">
                        <option value="">Seleccionar Producto</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id']; ?>"><?= $product['codigo'] . ' - ' . esc($product['nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tipo -->
                <div class="col-md-3 fv-row">
                    <label class="form-label required">Tipo</label>
                    <select id="reqTipo" name="tipo[]" class="form-select" data-control="select2">
                        <option value="">Seleccionar Tipo</option>
                        <option value="Paciente">Paciente</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Stock">Stock</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>

                <!-- Descripción condicional -->
                <div class="col-md-4 fv-row" id="divPaciente" style="display:none;">
                    <label class="form-label required">Paciente</label>
                    <select id="reqPaciente" name="descripcion[]" class="form-select" data-control="select2">
                        <option value="">Seleccionar Paciente</option>
                        <?php foreach ($patients as $patient): ?>
                            <option value="<?= $patient['id']; ?>"><?= $patient['cod_paciente'] . ' - ' . mb_strtoupper($patient['nombres']) . ' ' . mb_strtoupper($patient['apellidos']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 fv-row" id="divOtros" style="display:none;">
                    <label class="form-label required">Doctor, Stock o Otros</label>
                    <input type="text" id="reqDesc" name="descripcion[]" class="form-control" placeholder="Detalle..." />
                </div>

                <!-- Cantidad -->
                <div class="col-md-2 fv-row">
                    <label class="form-label required">Cantidad</label>
                    <input type="number" id="reqCantidad" name="cantidad[]" class="form-control" placeholder="Cant." min="1" />
                </div>

                <div class="col-md-6 fv-row">
                    <label class="form-label required">F.V. o F.C - Descripcion</label>
                    <input type="text" id="reqObservacion" name="observacion[]" class="form-control" placeholder="F.V. o F.C - Descripcion..." />
                </div>

                <!-- Botón Agregar Item -->
                <div class="col-12 text-start">
                    <button id="addItemBtn" class="btn btn-dark" disabled>
                        <i class="ki-duotone ki-plus fs-3"></i> Agregar Item
                    </button>
                </div>
            </div>

        </div>

        <div class="mb-8">

            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Productos Requeridos</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <!-- Tabla de ítems -->
            <div id="itemsTableWrapper" class="" style="display:none;">
                <table class="table align-middle table-row-dashed fs-6 gy-3">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Tipo</th>
                            <th>Pcte - dtor o tipo</th>
                            <th>F.V. o F.C - Descripcion</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold" id="itemsTableBody"></tbody>
                </table>
            </div>
        </div>

        <input type="hidden" name="items" id="itemsInput" value="[]">
        <button id="kt_submit_button_requirements" type="button" class="btn btn-primary">
            <span class="indicator-label">
                Enviar Requerimiento
            </span>
            <span class="indicator-progress">
                Enviando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>

        <?= form_close() ?>
    </div>
</div>


<?= $this->endSection(); ?>


<?= $this->section('scripts_inventory'); ?>
<?= csrf_scripts_basic() ?>
<script>
    $(function() {
        const $producto = $('#reqProducto');
        const $tipo = $('#reqTipo');
        const $paciente = $('#reqPaciente');
        const $otros = $('#reqDesc');
        const $divPac = $('#divPaciente');
        const $divOtr = $('#divOtros');
        const $cantidad = $('#reqCantidad');
        const $btn = $('#addItemBtn');
        const $tableW = $('#itemsTableWrapper');
        const $tbody = $('#itemsTableBody');
        const $obs = $('#reqObservacion');
        let idx = 0;

        // Inicializa todos los Select2
        $producto.select2({
            placeholder: 'Producto',
            width: '100%'
        });
        $tipo.select2({
            placeholder: 'Tipo',
            width: '100%'
        });
        $paciente.select2({
            placeholder: 'Paciente',
            width: '100%'
        });

        // Mostrar/ocultar campo “Descripción” según tipo
        $tipo.on('change', function() {
            const val = $(this).val();
            // reset campos
            $divPac.hide();
            $divOtr.hide();
            $paciente.val(null).trigger('change');
            $otros.val('');
            // show
            if (val === 'Paciente') return $divPac.show();
            if (val === 'Stock' || val === 'Otros' || val === 'Doctor') return $divOtr.show();
        });

        // Habilita/deshabilita botón de “Agregar Item”
        function updateAddBtn() {
            const hasProd = !!$producto.val();
            const hasTipo = !!$tipo.val();
            const cant = parseInt($cantidad.val(), 10) || 0;
            let hasDesc = false;

            if ($tipo.val() === 'Paciente') {
                hasDesc = !!$paciente.val();
            } else if ($tipo.val() === 'Stock' || $tipo.val() === 'Otros' || $tipo.val() === 'Doctor') {
                hasDesc = $otros.val().trim().length > 0;
            }

            $btn.prop('disabled', !(hasProd && hasTipo && hasDesc && cant > 0));
        }

        // listeners para activación en vivo
        $producto.on('change', updateAddBtn);
        $tipo.on('change', updateAddBtn);
        $paciente.on('change', updateAddBtn);
        $otros.on('input', updateAddBtn);
        $cantidad.on('input', updateAddBtn);
        $obs.on('input', updateAddBtn);

        // Agregar fila a la tabla
        $btn.on('click', function(e) {
            e.preventDefault();
            // recoge valores
            const prodId = $producto.val();
            const prodText = $producto.find('option:selected').text();
            const tipoVal = $tipo.val();
            const qty = parseInt($cantidad.val(), 10);
            let descVal = '';
            let descVal_id = '';

            if (tipoVal === 'Paciente') {
                descVal = $paciente.val();
                descVal_id = $paciente.find('option:selected').text();
            } else {
                descVal = $otros.val().trim();
                descVal_id = $otros.val().trim();
            }
            const obsVal = $obs.val().trim();
            // construye HTML de la fila con hidden inputs
            const $row = $(`
                <tr
                data-pid="${prodId}"
                data-tipo="${tipoVal}"
                data-desc="${descVal}"
                data-qty="${qty}"
                data-obs="${obsVal}"
                >
                    <td>${++idx}</td>
                    <td>${prodText}</td>
                    <td class="text-center">${qty}</td>
                    <td>${tipoVal}</td>
                    <td>${descVal_id}</td>
                    <td>${obsVal}</td>
                    <td class="text-end">
                        <button type="button" class="btn btn-icon btn-sm btn-light-danger delete-row">
                            <i class="ki-duotone ki-trash">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </button>
                    </td>
                </tr>
            `);

            // evento de eliminar fila
            $row.find('.delete-row').on('click', function() {
                $row.remove();
                // reindexar
                idx = 0;
                $tbody.find('tr').each((i, tr) => {
                    $(tr).find('td').first().text(i + 1);
                    idx = i + 1;
                });
                if (idx === 0) $tableW.hide();
            });

            // añade, muestra tabla y limpia formulario
            $tbody.append($row);
            $tableW.show();

            // reset form
            $producto.val(null).trigger('change');
            $tipo.val(null).trigger('change');
            $cantidad.val('');
            $paciente.val(null).trigger('change');
            $otros.val('');
            $obs.val('');
            updateAddBtn();
        });
    });

    const form = document.querySelector("#kt_submit_form_requirements");
    const itemsInput = document.getElementById('itemsInput');
    const getRows = () => document.querySelectorAll('#itemsTableBody tr');
    const validator = FormValidation.formValidation(form, {
        fields: {
            'area': {
                validators: {
                    notEmpty: {
                        message: 'El campo Area es obligatorio'
                    }
                }
            },
            'solicitante': {
                validators: {
                    notEmpty: {
                        message: 'El campo Solicitante es obligatorio'
                    }
                }
            }
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                leValidClass: ''
            })
        }
    })

    const submitButton = document.querySelector("#kt_submit_button_requirements")
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (!validator) {
            return;
        }

        const rows = getRows();
        if (rows.length === 0) {
            Swal.fire({
                text: 'No hay items para enviar',
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok!',
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            const items = Array.from(document.querySelectorAll('#itemsTableBody tr')).map(tr => ({
                product_id: tr.dataset.pid,
                tipo: tr.dataset.tipo,
                descripcion: tr.dataset.desc,
                cantidad: parseInt(tr.dataset.qty, 10),
                observacion: tr.dataset.obs,
            }));

            // 2) Volcar como JSON en el hidden
            document.getElementById('itemsInput').value = JSON.stringify(items);


            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            const executeFetch = async () => {
                try {
                    const fd = new FormData(form);
                    const res = await fetch(form.action, {
                        method: 'POST',
                        body: fd,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        }
                    });

                    if (res.status === 403) {
                        await updateCsrfToken();
                        return executeFetch();
                    }

                    const data = await res.json();
                    if (!res.ok || data.status >= 400) {
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
                            window.location.href = '<?= base_url('inventory/requirements') ?>';
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            }

            setTimeout(executeFetch, 2000);
        });
    });
</script>
<?= $this->endSection(); ?>