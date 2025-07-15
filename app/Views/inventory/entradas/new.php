<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Entradas | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>

<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Entradas al Almacén - <?= $sedes['sucursal'] ?>
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Entradas</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Agregar Entrada</li>

</ul>

<?= $this->endSection(); ?>


<?= $this->section('content_inventory'); ?>

<div class="card card-flush h-lg-100 mt-5">
    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-parcel fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
            <h2>Agregar Nueva Entrada</h2>
        </div>
    </div>

    <div class="card-body pt-5">
        <?= form_open('api/inventory/entries/create', ['id' => 'kt_submit_form_entry', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>
        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Información Básica</label>

            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="tipo" class="form-label required">Tipo de Entrada</label>
                    <select data-control="select2" data-placeholder="Seleccionar Tipo de Entrada" name="tipo" id="tipo" class="form-select">
                        <option value="">Seleccionar Tipo de Entrada</option>
                        <option value="Factura">Factura</option>
                        <option value="Stock">Stock</option>
                        <option value="Compra">Compra</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="proveedor" class="form-label">Proveedor/Origen</label>
                    <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Nombre del Proveedor o Sede de Origen" />
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="descripcion" class="form-label required">Número de Factura/Stock</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ej: FAC-00 / Llenado de Stock" />
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="fecha_recepcion" class="form-label required">Fecha de Recepción</label>
                    <input type="date" name="fecha_recepcion" id="fecha_recepcion" class="form-control" />
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="responsable" class="form-label required">Responsable de Recepción</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Nombre del Responsable de Recepción" />
                </div>
            </div>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Agregar Productos</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="producto_id" class="form-label required">Producto</label>
                    <select data-control="select2" data-placeholder="Seleccionar Producto"
                        name="producto_id" id="producto_id" class="form-select">
                        <option value="">Seleccionar Producto</option>
                        <?php foreach ($products as $product): ?>
                            <option
                                value="<?= $product['id'] ?>"
                                data-req-series="<?= $product['requiere_serie'] ? '1' : '0' ?>">
                                <?= $product['codigo'] ?> – <?= $product['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="cantidad" class="form-label required">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad"
                        class="form-control" placeholder="Cantidad" />
                </div>
            </div>

            <!-- NUEVO BLOQUE: NÚMEROS DE SERIE -->
            <div id="serieContainer" class="row g-4" style="display:none;">
                <div class="col-12 fv-row">
                    <label class="form-label fs-6 fw-bold text-gray-700 mb-2">Números de Serie</label>
                    <div class="d-flex gap-8 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                name="serieMode" id="serieAuto" value="auto" checked>
                            <label class="form-check-label" for="serieAuto">
                                Generar automáticamente
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                name="serieMode" id="serieManual" value="manual">
                            <label class="form-check-label" for="serieManual">
                                Ingresar manualmente
                            </label>
                        </div>
                    </div>

                    <!-- Sección Automática -->
                    <div id="autoSection" class="card card-flush mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="ki-duotone ki-information fs-2 text-warning me-2">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                                <h6 class="mb-0">Números de Serie Automáticos</h6>
                            </div>
                            <p class="text-gray-600 mb-3">
                                Se generarán automáticamente <strong><span id="autoCount">6</span></strong> números de serie:
                            </p>
                            <div id="autoBadges" class="d-flex flex-wrap gap-2">
                                <!-- Ejemplo estático; tú lo llenas dinámicamente -->
                                <span class="badge badge-light-primary">LIN-SIL-L016-LIM</span>
                                <span class="badge badge-light-primary">LIN-SIL-L017-LIM</span>
                                <span class="badge badge-light-primary">LIN-SIL-L018-LIM</span>
                                <span class="badge badge-light-primary">LIN-SIL-L019-LIM</span>
                                <span class="badge badge-light-primary">LIN-SIL-L020-LIM</span>
                                <span class="badge badge-light-primary">LIN-SIL-L021-LIM</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Manual -->
                    <div id="manualSection" class="card card-flush mb-4 d-none">
                        <div class="card-body">
                            <!-- ALERTA DINÁMICA -->
                            <div id="manualAlertPlaceholder"></div>

                            <div class="d-flex align-items-center mb-2">
                                <i class="ki-duotone ki-information fs-2 text-info me-2">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                                <h6 class="mb-0">Números de Serie Manuales</h6>
                            </div>
                            <p class="text-gray-600 mb-4">Ingresa los números uno a uno o en lote:</p>

                            <!-- Ingreso uno a uno -->
                            <div class="input-group mb-3">
                                <input type="text" id="manualInput" class="form-control" placeholder="Ingresa número de serie">
                                <button class="btn btn-dark" type="button" id="addSerialBtn">
                                    <i class="ki-duotone ki-plus fs-3"></i> Agregar
                                </button>
                            </div>
                            <!-- Ingreso múltiple -->
                            <label class="form-label small">O pega múltiples (uno por línea) y presiona ENTER:</label>
                            <textarea id="manualBatch" rows="3" class="form-control mb-3"
                                placeholder="Pega los números aquí, uno por línea"></textarea>

                            <!-- Badges de los ya agregados -->
                            <div id="manualBadges" class="d-flex flex-wrap gap-2">
                                <!-- badges generados -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button id="kt_add_product" type="button" class="btn btn-dark" disabled>
                Agregar Productos
            </button>

        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Productos a Ingresar</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <table class="table align-middle table-row-dashed fs-6 gy-3" id="listaProductos">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="">#</th>
                        <th class="text-start pe-3 min-w-100px">Código</th>
                        <th class="text-start pe-3">Producto</th>
                        <th class="text-center pe-3">Cantidad</th>
                        <th class="pe-3">Números de Serie</th>
                        <th class="text-end pe-3 min-w-100px">Acciones</th>
                    </tr>
                </thead>
                <tbody class="fw-bold" id="listaProductosBody">

                </tbody>
            </table>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Observaciones</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <textarea name="observacion" id="observacion" class="form-control" placeholder="Notas Adicionales para la entrada"></textarea>
        </div>


        <button id="kt_submit_button_entry" type="button" class="btn btn-primary">
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


<?= $this->section('scripts_inventory'); ?>
<?= csrf_scripts_basic() ?>
<script>
    $(document).ready(function() {
        // Inicializa Select2
        $('#producto_id').select2();

        const $select = $('#producto_id');
        const $serieCont = $('#serieContainer');
        const $btn = $('#kt_add_product');

        function updateUI() {
            const val = $select.val();
            // Habilita el botón sólo si hay valor
            $btn.prop('disabled', !val);

            // Si hay opción seleccionada, chequea data-req-series
            const $opt = $select.find('option:selected');
            const needs = $opt.data('req-series') == 1;
            $serieCont.toggle(needs);
        }

        // Al cambiar la selección...
        $select.on('change', updateUI);

        // Por si hay un valor preseleccionado (edición)
        updateUI();
    });

    document.querySelectorAll('input[name="serieMode"]').forEach(radio => {
        radio.addEventListener('change', e => {
            const auto = document.getElementById('autoSection');
            const man = document.getElementById('manualSection');
            if (e.target.value === 'auto') {
                auto.classList.remove('d-none');
                man.classList.add('d-none');
            } else {
                auto.classList.add('d-none');
                man.classList.remove('d-none');
            }
        });
    });

    $(function() {
        const $selectProd = $('#producto_id');
        const $cantidad = $('#cantidad');
        const $autoCount = $('#autoCount');
        const $autoBadges = $('#autoBadges');
        const $serieAutoRb = $('#serieAuto');

        // Función que pide al backend los seriales y actualiza el DOM
        function fetchSeriales() {
            const pid = $selectProd.val();
            const qty = parseInt($cantidad.val(), 10);

            // Sólo si está en modo "auto" y hay product + qty válidos
            if (!$serieAutoRb.is(':checked') || !pid || !qty || qty <= 0) {
                $autoCount.text('0');
                $autoBadges.empty();
                return;
            }

            // Llamada AJAX
            $.getJSON(
                '<?= base_url("api/inventory/entries/get-auto-serials") ?>', {
                    product_id: pid,
                    quantity: qty
                },
                function(resp) {
                    // Actualiza el contador
                    $autoCount.text(resp.count);
                    // Limpia viejos badges
                    $autoBadges.empty();
                    // Por cada serial, añade un badge
                    resp.serials.forEach(serial => {
                        $('<span>')
                            .addClass('badge badge-light-primary')
                            .text(serial)
                            .appendTo($autoBadges);
                    });
                }
            );
        }

        // Dispara cuando cambie el producto
        $selectProd.on('change', fetchSeriales);
        // Dispara cuando cambie la cantidad
        $cantidad.on('input', fetchSeriales);
        // También si el usuario cambia de “Auto” a “Manual” o viceversa
        $serieAutoRb.on('change', fetchSeriales);

        // Y al cargar la página (en caso de edición)
        fetchSeriales();
    });

    $(function() {
        const $alertPH = $('#manualAlertPlaceholder');
        const $manualIn = $('#manualInput');
        const $addBtn = $('#addSerialBtn');
        const $batch = $('#manualBatch');
        const $badges = $('#manualBadges');

        function showManualAlert(msg) {
            const tpl = $(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Atención:</strong> ${msg}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            `);
            $alertPH.html(tpl);
            setTimeout(() => tpl.alert('close'), 4000);
        }

        function isDuplicateClient(code) {
            return $badges.find(`span[data-code="${code}"]`).length > 0;
        }

        function addBadge(code) {
            const $b = $(`
                <span class="badge badge-primary d-flex align-items-center" data-code="${code}">
                <span class="me-2">${code}</span>
                <button type="button" class="btn-close btn-close-white btn-sm ms-auto" aria-label="Close"></button>
                </span>
            `);
            $b.find('button').on('click', () => $b.remove());
            $badges.append($b);
        }


        // Verifica un único serial contra la BD y luego lo agrega
        function checkAndAdd(code) {
            // Si ya existe en cliente, no pregunta al servidor
            if (isDuplicateClient(code)) {
                showManualAlert(`El serial "${code}" ya fue agregado.`);
                return;
            }

            $.post({
                url: '<?= base_url("api/inventory/entries/check-serial") ?>',
                data: {
                    serial: code
                },
                dataType: 'json'
            }).done(resp => {
                if (resp.exists) {
                    showManualAlert(`El serial "${code}" ya existe en la base de datos.`);
                } else {
                    addBadge(code);
                }
            }).fail(() => {
                showManualAlert('Error al validar el serial en el servidor.');
            });
        }

        // Botón Agregar (uno a uno)
        $addBtn.on('click', () => {
            const code = $manualIn.val().trim();
            if (!code) return;
            checkAndAdd(code);
            $manualIn.val('');
        });

        // Pegado masivo y ENTER
        $batch.on('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                const lines = $batch.val()
                    .split('\n')
                    .map(l => l.trim())
                    .filter(Boolean);
                if (!lines.length) return;

                // Usamos el endpoint batch si quieres optimizar:
                $.ajax({
                    url: '<?= base_url("api/inventory/entries/check-serials") ?>',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        serials: lines
                    }),
                    dataType: 'json'
                }).done(resp => {
                    // primero los que ya existen en BD
                    (resp.exists || []).forEach(code => {
                        showManualAlert(`El serial "${code}" ya existe en la base de datos.`);
                    });
                    // luego los nuevos que podemos agregar (y no dupliquen en cliente)
                    (resp.nonexists || []).forEach(code => {
                        if (isDuplicateClient(code)) {
                            showManualAlert(`El serial "${code}" ya fue agregado.`);
                        } else {
                            addBadge(code);
                        }
                    });
                }).fail(() => {
                    showManualAlert('Error al validar lote en el servidor.');
                });

                $batch.val('');
            }
        });
    });

    $(function() {
        // Elementos clave
        const $select = $('#producto_id');
        const $cantidad = $('#cantidad');
        const $serieCont = $('#serieContainer');
        const $autoCount = $('#autoCount');
        const $autoBadges = $('#autoBadges');
        const $manualBadges = $('#manualBadges');
        const $modeRadio = $('input[name="serieMode"]');
        const $addBtn = $('#kt_add_product');
        const $tbody = $('#listaProductosBody');

        //
        // 1) Sección Automática: fetch + render + actualizar botón
        //
        function fetchSeriales() {
            const pid = $select.val();
            const qty = parseInt($cantidad.val(), 10) || 0;
            if (!$('#serieAuto').is(':checked') || !pid || qty <= 0) {
                $autoCount.text('0');
                $autoBadges.empty();
                updateAddBtn();
                return;
            }
            $.getJSON('<?= base_url("api/inventory/entries/get-auto-serials") ?>', {
                product_id: pid,
                quantity: qty
            }, resp => {
                $autoCount.text(resp.count);
                $autoBadges.empty();
                resp.serials.forEach(serial => {
                    $('<span>')
                        .addClass('badge badge-light-primary me-1 mb-1')
                        .attr('data-code', serial)
                        .text(serial)
                        .appendTo($autoBadges);
                });
                updateAddBtn();
            });
        }

        // disparadores
        $select.on('change', fetchSeriales);
        $cantidad.on('input', fetchSeriales);
        $('#serieAuto, #serieManual').on('change', () => {
            toggleSerieContainer();
            fetchSeriales();
        });
        fetchSeriales();

        //
        // 2) Sección Manual: validación batch + agregar badge + actualizar botón
        //
        const $batch = $('#manualBatch');
        const $alertPH = $('#manualAlertPlaceholder');

        function showManualAlert(msg) {
            const tpl = $(`
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Atención:</strong> ${msg}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `);
            $alertPH.html(tpl);
            setTimeout(() => tpl.alert('close'), 4000);
        }

        function addManualBadge(code) {
            // valida duplicado cliente
            if ($manualBadges.find(`span[data-code="${code}"]`).length) {
                showManualAlert(`El serial "${code}" ya fue agregado.`);
                return;
            }
            // valida BD
            $.post('<?= base_url("api/inventory/entries/check-serial") ?>', {
                serial: code
            }, resp => {
                if (resp.exists) {
                    showManualAlert(`El serial "${code}" ya existe en la base de datos.`);
                } else {
                    const $b = $(`
                        <span class="badge bg-danger text-white d-flex align-items-center me-1 mb-1" data-code="${code}">
                            <span class="me-1">${code}</span>
                            <i class="ki-duotone ki-cross fs-5 cursor-pointer"></i>
                        </span>
                    `);
                    $b.find('i').on('click', () => {
                        $b.remove();
                        updateAddBtn();
                    });
                    $manualBadges.append($b);
                    updateAddBtn();
                }
            }, 'json').fail(() => {
                showManualAlert('Error validando en servidor.');
            });
        }

        // batch por ENTER
        $batch.on('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                const lines = $batch.val().split('\n').map(l => l.trim()).filter(Boolean);
                if (!lines.length) return;
                // check many
                $.ajax({
                    url: '<?= base_url("api/inventory/entries/check-serials") ?>',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        serials: lines
                    }),
                    dataType: 'json'
                }).done(resp => {
                    (resp.exists || []).forEach(code => showManualAlert(`El serial "${code}" ya existe en la base de datos.`));
                    (resp.nonexists || []).forEach(code => addManualBadge(code));
                }).fail(() => {
                    showManualAlert('Error validando lote en servidor.');
                });
                $batch.val('');
            }
        });

        //
        // 3) Mostrar/ocultar sección de series
        //
        function toggleSerieContainer() {
            const needs = $select.find('option:selected').data('req-series') == 1;
            $serieCont.toggle(needs);
        }

        //
        // 4) Activar/desactivar "Agregar Productos"
        //
        function updateAddBtn() {
            const pid = $select.val();
            const qty = parseInt($cantidad.val(), 10) || 0;
            let can = Boolean(pid) && qty > 0;
            if (can && $select.find('option:selected').data('req-series') == 1) {
                const mode = $modeRadio.filter(':checked').val();
                const cnt = (mode === 'auto' ?
                    $autoBadges :
                    $manualBadges
                ).find('span.badge').length;
                can = cnt === qty;
            }
            $addBtn.prop('disabled', !can);
        }
        $select.on('change', updateAddBtn);
        $cantidad.on('input', updateAddBtn);
        $modeRadio.on('change', updateAddBtn);
        updateAddBtn();

        //
        // 5) Agregar fila a la tabla
        //
        function reindex() {
            $tbody.find('tr').each((i, tr) => {
                $(tr).find('td').first().text(i + 1);
            });
        }

        $addBtn.on('click', e => {
            e.preventDefault();
            const prodOpt = $select.find('option:selected');
            const [code, name] = prodOpt.text().split(' – ');
            const qty = parseInt($cantidad.val(), 10);
            const reqSeries = prodOpt.data('req-series') == 1;
            // vals
            let vals = [];
            if (reqSeries) {
                const mode = $modeRadio.filter(':checked').val();
                const badges = (mode === 'auto' ? $autoBadges : $manualBadges).find('span.badge');
                vals = badges.map((i, el) => $(el).data('code')).get();
            }
            // duplicados global
            const existing = $tbody.find('span[data-code]').map((i, el) => $(el).data('code')).get();
            const dups = vals.filter(v => existing.includes(v));
            if (dups.length) {
                alert('No puedes agregar: ' + dups.join(', '));
                return;
            }
            // construir cell series
            let seriesHtml = '';
            if (reqSeries && vals.length > 0) {
                const maxVisible = 3;
                seriesHtml = `<div class="d-flex flex-wrap gap-1">`;
                vals.forEach((s, i) => {
                    // para los primeros 3, los mostramos
                    // para el resto, los marcamos con d-none, pero siguen en el DOM
                    const cls = i < maxVisible ?
                        'badge badge-light-primary me-1 mb-1' :
                        'badge badge-light-primary me-1 mb-1 d-none';
                    seriesHtml += `<span class="${cls}" data-code="${s}">${s}</span>`;
                });
                if (vals.length > maxVisible) {
                    const hidden = vals.length - maxVisible;
                    seriesHtml += `<span class="badge badge-light-dark me-1 mb-1">+${hidden} más</span>`;
                }
                seriesHtml += `</div>`;
                seriesHtml += `<div class="text-muted small mt-1">Total: ${vals.length} número${vals.length>1?'s':''} de serie</div>`;
            }
            // crear row
            const prodId = prodOpt.val();
            const row = $(`
                <tr data-product-id="${prodId}">
                    <td class="text-center"></td>
                    <td>${code}</td>
                    <td>${name}</td>
                    <td class="text-center">${qty}</td>
                    <td>${seriesHtml}</td>
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
            row.find('.delete-row').on('click', () => {
                row.remove();
                reindex();
                updateAddBtn();
            });
            $tbody.append(row);
            reindex();
            // limpiar
            $select.val('').trigger('change');
            $cantidad.val('');
            $autoBadges.empty();
            $manualBadges.empty();
            $autoCount.text('0');
            toggleSerieContainer();
            updateAddBtn();
        });

    });

    const form = document.querySelector("#kt_submit_form_entry");

    const validator = FormValidation.formValidation(form, {
        fields: {
            'tipo': {
                validators: {
                    notEmpty: {
                        message: 'El tipo es obligatorio'
                    }
                }
            },
            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'La descripción es obligatoria'
                    }
                }
            },
            'fecha_recepcion': {
                validators: {
                    notEmpty: {
                        message: 'La fecha de recepción es obligatoria'
                    }
                }
            },
            'responsable': {
                validators: {
                    notEmpty: {
                        message: 'El responsable es obligatorio'
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
    });

    const submitButton = document.querySelector("#kt_submit_button_entry");
    submitButton.addEventListener("click", (event) => {
        event.preventDefault();

        if (!validator) {
            return;
        }

        const rows = document.querySelectorAll('#listaProductosBody tr');
        if (rows.length === 0) {
            alert('No se agregaron productos');
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            const executeFetch = async () => {
                try {
                    const filas = Array.from(document.querySelectorAll('#listaProductosBody tr'));

                    // 2) Crea un nuevo FormData y vuelca los datos básicos
                    const formData = new FormData(form);

                    // 3) Vacía posibles viejos arrays (si tus inputs originales tenían `name="producto_id[]"`)
                    formData.delete('producto_id[]');
                    formData.delete('cantidad[]');
                    formData.delete('serials[]'); // opcional, si lo tienes
                    // O bien, no uses name[] en tus selects originales y te ahorras este paso.

                    // 4) Por cada fila, añade producto_id[], cantidad[] y serials[index][]
                    filas.forEach((tr, idx) => {
                        const $tr = $(tr);
                        const pid = $tr.data('product-id');
                        const cantidad = parseInt($tr.find('td').eq(3).text(), 10);

                        formData.append('producto_id[]', pid);
                        formData.append('cantidad[]', cantidad);

                        // Recolecta los seriales de los <span data-code>
                        $tr.find('td').eq(4).find('span.badge[data-code]').each((i, badge) => {
                            const code = $(badge).data('code');
                            // serials[0][], serials[1][], …
                            formData.append(`serials[${idx}][]`, code);
                        });
                    });

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        }
                    });

                    if (response.status === 403) {
                        await updateCsrfToken();
                        return executeFetch();
                    }

                    const data = await response.json();

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
                            window.location.href = '<?= base_url('inventory/entries') ?>';
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