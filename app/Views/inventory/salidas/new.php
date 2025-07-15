<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Salidas | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>

<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Salidas al Almacén - <?= $sedes['sucursal'] ?>
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Salidas</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Agregar Salida</li>

</ul>

<?= $this->endSection(); ?>


<?= $this->section('content_inventory'); ?>

<div class="card card-flush h-lg-100 mt-5">
    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-delivery-2 fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
                <span class="path6"></span>
                <span class="path7"></span>
                <span class="path8"></span>
                <span class="path9"></span>
            </i>
            <h2>Agregar Nueva Salida</h2>
        </div>
    </div>

    <div class="card-body">
        <?= form_open('api/inventory/exits/create', ['id' => 'kt_submit_form_exit', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>
        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Información Básica</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="area_solicitante" class="form-label required">Área Solicitante</label>
                    <select data-control="select2" data-placeholder="Seleccionar Área Solicitante" name="area_solicitante" id="area_solicitante" class="form-select">
                        <option value="">Seleccionar Área Solicitante</option>
                        <?php foreach ($areas as $area): ?>
                            <option value="<?= $area['id'] ?>"><?= $area['nombres'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="solicitante" class="form-label required">Solicitante</label>
                    <select data-control="select2" data-placeholder="Seleccionar Solicitante" name="solicitante" id="solicitante" class="form-select">
                        <option value="">Seleccionar Solicitante</option>
                        <option value="Percy Maguiña Vargas">Percy Maguiña Vargas</option>
                        <option value="Ado Martin Torres Monteza">Ado Martin Torres Monteza</option>
                        <option value="Carlos Espinoza">Carlos Espinoza</option>
                        <option value="Julio Vargas Tello">Julio Vargas Tello</option>
                        <option value="Noe Colla">Noe Colla</option>
                        <option value="Patricia Pinto">Patricia Pinto</option>
                        <option value="Karem Chávez Villanueva">Karem Chávez Villanueva</option>
                        <option value="Rony Mallqui Alvarado">Rony Mallqui Alvarado</option>
                        <option value="Paula Patiño Silva">Paula Patiño Silva</option>
                        <option value="Yessenia Cuya Sarango">Yessenia Cuya Sarango</option>
                        <option value="Zuleik Robles Ortiz">Zuleik Robles Ortiz</option>
                        <option value="Michael Milla Agreda">Michael Milla Agreda</option>
                        <option value="Brenda Cueva Sulca">Brenda Cueva Sulca</option>
                        <option value="Misael Fernández">Misael Fernández</option>
                        <option value="Marina Gilvonio">Marina Gilvonio</option>
                        <option value="Malena Gastelú">Malena Gastelú</option>
                        <option value="Diego Ascensios">Diego Ascensios</option>
                        <option value="Jhayr Villanueva">Jhayr Villanueva</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="responsable_almacen" class="form-label required">Responsable de Almacén</label>
                    <select data-control="select2" data-placeholder="Seleccionar Responsable de Almacén" name="responsable_almacen" id="responsable_almacen" class="form-select">
                        <option value="">Seleccionar Responsable de Almacén</option>
                        <option value="Brenda Cueva Sulca">Brenda Cueva Sulca</option>
                        <option value="Camila Reyes">Camila Reyes</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="fecha_salida" class="form-label required">Fecha de Salida</label>
                    <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" />
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="tipo" class="form-label required">Tipo de Salida</label>
                    <select data-control="select2" data-placeholder="Seleccionar Tipo de Salida" name="tipo" id="tipo" class="form-select">
                        <option value="">Seleccionar Tipo de Salida</option>
                        <option value="Paciente">Paciente</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Pruebas">Pruebas</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row" style="display: none;" id="nombre_paciente_div">
                    <label for="nombre_paciente" class="form-label required">Nombre del Paciente</label>
                    <select data-control="select2" data-placeholder="Seleccionar Nombre del Paciente" name="nombre_paciente" id="nombre_paciente" class="form-select">
                        <option value="">Seleccionar Nombre del Paciente</option>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?= $paciente['id'] ?>"><?= $paciente['cod_paciente'] . ' - ' . $paciente['nombres'] . ' ' . $paciente['apellidos'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row" style="display: none;" id="nombre_proyecto_div">
                    <label for="nombre_proyecto" class="form-label required">Nombre del Proyecto</label>
                    <input type="text" name="nombre_proyecto" id="nombre_proyecto" class="form-control" placeholder="Ej: Proyecto de Investigación" />
                </div>
            </div>


        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">
                Agregar Productos (Stock disponible en <?= esc($sedes['sucursal']) ?>)
            </label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="producto_id" class="form-label required">Producto</label>
                    <select data-control="select2" data-placeholder="Seleccionar Producto"
                        name="producto_id" id="producto_id" class="form-select">
                        <option value="">Seleccionar Producto</option>
                        <?php foreach ($products_stock as $product): ?>
                            <option
                                value="<?= $product['id'] ?>"
                                data-req-series="<?= $product['requiere_serie'] ? '1' : '0' ?>"
                                data-stock="<?= $product['stock'] ?>">
                                <?= esc($product['codigo'] . ' – ' . $product['nombre'] . ' (Stock: ' . $product['stock'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="cantidad" class="form-label required">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad"
                        class="form-control" placeholder="Cantidad" min="1" />
                </div>
            </div>

            <!-- contenedor dinámico de series -->
            <div id="serieContainer" class="row g-4" style="display: none;">
                <div class="col-12 fv-row">
                    <label class="form-label fs-6 fw-bold text-gray-700 mb-2">
                        Números de Serie a Entregar (Disponibles en <?= esc($sedes['sucursal']) ?>)
                    </label>
                    <div id="seriesInputs"></div>
                    <div id="serieHelp" class="form-text text-muted mt-1 mb-4"></div>
                </div>
            </div>

            <button id="kt_add_product" type="button" class="btn btn-dark" disabled>
                Agregar Producto
            </button>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Productos a Entregar</label>
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

            <textarea name="observacion" id="observacion" class="form-control" placeholder="Notas Adicionales para la salida"></textarea>
        </div>

        <button id="kt_submit_button_exit" type="button" class="btn btn-primary">
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
        // Inicializa Select2 en tu “tipo”
        $('#tipo').select2({
            placeholder: 'Seleccionar Tipo de Salida',
            width: '100%'
        });

        // Inicializa Select2 en el select de paciente también
        $('#nombre_paciente').select2({
            placeholder: 'Seleccionar Nombre del Paciente',
            width: '100%'
        });

        // Escucha cambios en “tipo”
        $('#tipo').on('change', function() {
            const val = $(this).val();
            // Por defecto oculta ambos
            $('#nombre_paciente_div').hide();
            $('#nombre_proyecto_div').hide();

            if (val === 'Paciente') {
                // Muestra el select de pacientes
                $('#nombre_paciente_div').show();
                // Opcional: limpia el input de proyecto
                $('#nombre_proyecto').val('');
            } else {
                // Muestra el input de proyecto
                $('#nombre_proyecto_div').show();
                // Opcional: limpia el select de paciente y su Select2
                $('#nombre_paciente').val(null).trigger('change');
            }
            // Para “Pruebas” o cualquier otro valor, deja todo oculto
        });

        // Si quisieras manejar un valor preseleccionado al cargar la página:
        $('#tipo').trigger('change');
    });

    $(function() {
        const sedeId = <?= session('inventory_user')['sede_id'] ?>;
        const $prod = $('#producto_id');
        const $qty = $('#cantidad');
        const $serieCont = $('#serieContainer');
        const $seriesInputs = $('#seriesInputs');
        const $help = $('#serieHelp');
        const $btn = $('#kt_add_product');
        const $tbody = $('#listaProductosBody');
        let rowCount = 0;

        // Select2 para producto
        $prod.select2({
            placeholder: 'Seleccionar Producto',
            width: '100%'
        });

        const prodRequiresSeries = () =>
            $prod.find('option:selected').data('req-series') == 1;

        // renderizamos un solo multi-select
        function renderSeriesInputs() {
            $seriesInputs.empty();
            const n = parseInt($qty.val(), 10) || 0;

            if (!prodRequiresSeries() || n < 1) {
                $serieCont.hide();
                $help.text('');
                updateAddButton();
                return;
            }

            $serieCont.show();
            $help.text(`Seleccione ${n} número(s) de serie para la cantidad solicitada`);

            const $sel = $(`
                <select class="form-select mb-2 series-select" multiple="multiple">
                </select>
            `);
            $seriesInputs.append($sel);

            // Select2 AJAX con límite máximo
            $sel.select2({
                placeholder: 'Seleccionar número de serie',
                width: '100%',
                multiple: true,
                maximumSelectionLength: n,
                ajax: {
                    url: '<?= base_url("api/inventory/exits/available-series") ?>',
                    dataType: 'json',
                    delay: 200,
                    data: params => ({
                        product_id: $prod.val(),
                        sede_id: sedeId,
                        q: params.term
                    }),
                    processResults: data => ({
                        results: data.map(s => ({
                            id: s.serial,
                            text: s.serial
                        }))
                    })
                }
            }).on('select2:select select2:unselect', function(e) {
                const selValue = e.params.data.id;
                // check duplicados globales (entre filas)
                const allSelected = $(this).val() || [];
                // no duplicados dentro de sí mismo, porque select2 bloquea excedentes
                updateAddButton();
            });
        }

        // activar/desactivar botón
        function updateAddButton() {
            const pid = $prod.val();
            const qty = parseInt($qty.val(), 10) || 0;
            if (!pid || qty < 1) return $btn.prop('disabled', true);
            if (!prodRequiresSeries()) return $btn.prop('disabled', false);

            // lee el array directamente
            const sel = $seriesInputs.find('select.series-select').val() || [];
            $btn.prop('disabled', sel.length !== qty);
        }

        // reindex
        function reindex() {
            $tbody.find('tr').each((i, tr) => {
                $(tr).find('td').first().text(i + 1);
            });
        }

        // eventos
        $prod.on('change', () => {
            $qty.val('');
            renderSeriesInputs();
        });
        $qty.on('input', function() {
            // valida stock
            const stock = parseInt($prod.find('option:selected').data('stock'), 10) || 0;
            let val = parseInt(this.value, 10) || 0;
            if (val > stock) {
                val = stock;
                this.value = stock;
                const tpl = $(`
                    <div class="alert alert-warning alert-dismissible fade show mt-2">
                    <strong>Atención:</strong> Sólo hay ${stock} disponibles.
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
                $help.html(tpl);
                setTimeout(() => tpl.alert('close'), 4000);
            } else {
                $help.text(`Seleccione ${val} número(s) de serie para la cantidad solicitada`);
            }
            renderSeriesInputs();
        });

        $btn.on('click', e => {
            e.preventDefault();
            const pid = $prod.val();
            const qty = parseInt($qty.val(), 10);
            const txt = $prod.find('option:selected').text().split(' (')[0];
            const [code, name] = txt.split(' – ');
            const serials = $seriesInputs.find('select').val() || [];

            // validaciones
            if (!pid || qty < 1) return alert('Selecciona producto y cantidad válida.');
            if (prodRequiresSeries() && serials.length !== qty)
                return alert(`Debes seleccionar ${qty} número(s) de serie.`);

            // chequeo duplicados globales
            const existing = $tbody.find('span[data-code]').map((i, el) => $(el).data('code')).get();
            const dup = serials.filter(s => existing.includes(s));
            if (dup.length) return alert('Ya añadiste: ' + dup.join(', '));

            // hidden inputs y badges
            let seriesHtml = '-',
                hidden = '';
            if (prodRequiresSeries()) {
                seriesHtml = '<div class="d-flex flex-wrap gap-1">';
                serials.forEach(s => {
                    seriesHtml += `<span class="badge badge-light-primary me-1 mb-1" data-code="${s}">${s}</span>`;
                    hidden += `<input type="hidden" name="serials[${rowCount}][]" value="${s}">`;
                });
                seriesHtml += '</div>';
            }
            // hidden prod/cant
            hidden += `<input type="hidden" name="producto_id[]" value="${pid}">`;
            hidden += `<input type="hidden" name="cantidad[]"     value="${qty}">`;

            const $row = $(`
                <tr>
                    <td class="text-center"></td>
                    <td>${code}${hidden}</td>
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

            $row.find('.delete-row').on('click', () => {
                $row.remove();
                reindex();
                updateAddButton();
            });

            $tbody.append($row);
            reindex();
            rowCount++;

            // limpiar
            $prod.val('').trigger('change');
            $qty.val('');
            $seriesInputs.empty();
            $serieCont.hide();
            $help.text('');
            updateAddButton();
        });
    });

    const form = document.getElementById('kt_submit_form_exit');
    const $tbodyRows = () => document.querySelectorAll('#listaProductosBody tr');

    const validator = FormValidation.formValidation(form, {
        fields: {
            'area_solicitante': {
                validators: {
                    notEmpty: {
                        message: 'El área solicitante es obligatoria'
                    }
                }
            },
            'solicitante': {
                validators: {
                    notEmpty: {
                        message: 'El solicitante es obligatorio'
                    }
                }
            },
            'responsable_almacen': {
                validators: {
                    notEmpty: {
                        message: 'El responsable del almacén es obligatorio'
                    }
                }
            },
            'fecha_salida': {
                validators: {
                    notEmpty: {
                        message: 'La fecha de salida es obligatoria'
                    }
                }
            },
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

    const submitButton = document.getElementById('kt_submit_button_exit');
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        if (!validator) {
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            if ($tbodyRows().length === 0) {
                Swal.fire({
                    text: 'Debes agregar al menos un producto a la lista.',
                    icon: 'warning',
                    buttonsStyling: false,
                    confirmButtonText: 'Entendido',
                    customClass: {
                        confirmButton: 'btn btn-warning'
                    }
                });
                return;
            }

            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            const executeFetch = async () => {
                try {
                    const formData = new FormData(form);

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
                            window.location.href = '<?= base_url('inventory/exits') ?>';
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