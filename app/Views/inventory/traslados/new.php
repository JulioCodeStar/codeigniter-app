<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Traslados | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>

<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Traslados
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Traslados</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Agregar Traslado</li>

</ul>

<?= $this->endSection(); ?>

<style>
    /* Estilos para el recuadro de checkboxes */
    .series-scrollbox {
        max-height: 120px;
        overflow-y: auto;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 0.375rem;
        background: #f9f9f9;
    }

    .series-scrollbox .form-check {
        margin-bottom: 0.25rem;
    }
</style>

<?= $this->section('content_inventory'); ?>
<div class="card card-flush h-lg-100 mt-5">
    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-truck fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
            <h2 class="fw-bold">Agregar Traslado</h2>
        </div>
    </div>

    <div class="card-body">

        <?= form_open('api/inventory/traslados/create', ['id' => 'kt_form_traslado', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Buscar Requerimiento</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 fv-row">
                    <label for="requerimiento_id" class="form-label required">Requerimiento</label>
                    <select data-control="select2" data-placeholder="Seleccionar Requerimiento" name="requerimiento_id" id="requerimiento_id" class="form-select">
                        <option value="">Seleccionar Requerimiento</option>
                        <?php foreach ($requirements as $requirement): ?>
                            <option value="<?= $requirement['id'] ?>"><?= $requirement['codigo'] . ' / ' . $requirement['sede_origen'] . ' - ' . $requirement['area_solicitante'] . ' - ' . $requirement['nombre_solicitante'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Información Básica</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 fv-row">
                    <label for="sede_origen" class="form-label required">Sede de Origen</label>
                    <select data-control="select2" data-placeholder="Seleccionar Sede de Origen" name="sede_origen" id="sede_origen" class="form-select" disabled>
                        <option value="">Seleccionar Sede de Origen</option>
                        <?php foreach ($sedes as $sed): ?>
                            <option value="<?= $sed['id'] ?>"><?= $sed['sucursal'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 fv-row">
                    <label for="sede_destino" class="form-label required">Sede de Destino</label>
                    <select data-control="select2" data-placeholder="Seleccionar Sede de Destino" name="sede_destino" id="sede_destino" class="form-select" readonly>
                        <option value="">Seleccionar Sede de Destino</option>
                        <?php foreach ($sedes as $sed): ?>
                            <option value="<?= $sed['id'] ?>"><?= $sed['sucursal'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Productos a Trasladar</label>
            <p class="text-gray-500 pt-0">Productos cargados del Req. <span id="req_codigo"></span>. Verifique stock y series.</p>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <table class="table align-middle table-row-dashed fs-6 gy-3" id="listaProductos">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="">#</th>
                        <th class="text-start pe-3">Producto</th>
                        <th class="text-center pe-3">Cantidad</th>
                        <th class="text-center pe-3">stock Disponible</th>
                        <th class="pe-3">Series</th>
                    </tr>
                </thead>
                <tbody class="fw-bold" id="listaProductosBody">

                </tbody>
            </table>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Notas</label>
            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row">
                <div class="col-md-12">
                    <label for="detalles" class="form-label">Detalles del Transporte</label>
                    <textarea name="detalles" id="detalles" class="form-control" placeholder="Detalles del Transporte (opcional)" rows="3"></textarea>
                </div>
            </div>

        </div>

        <button id="kt_submit_button_traslado" type="button" class="btn btn-primary">
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
    document.addEventListener('DOMContentLoaded', function() {
        const $req = $('#requerimiento_id').select2({
            placeholder: 'Seleccionar Requerimiento',
            width: '100%'
        });
        const $sedeOrig = $('#sede_origen').select2({
            width: '100%'
        });
        const $sedeDest = $('#sede_destino').select2({
            width: '100%'
        });
        const $tbody = $('#listaProductosBody');
        const $req_codigo = $('#req_codigo');

        $req.on('change', function() {
            const id = $(this).val();
            if (!id) {
                $sedeOrig.val(null).trigger('change');
                $sedeDest.val(null).trigger('change');
                $tbody.empty();
                return;
            }

            $.getJSON(`<?= base_url('api/inventory/traslados/show-list/') ?>${id}`, function(resp) {
                    if (resp.status !== 200) {
                        return alert(resp.message || 'Error al cargar');
                    }
                    const req = resp.requerimiento;
                    const det = resp.details || [];

                    // Sedes
                    $sedeOrig.val(req.sede_origen).trigger('change');
                    $sedeDest.val(req.sede_destino).trigger('change');

                    // Generar filas
                    let html = '';
                    det.forEach((d, i) => {
                        html += `
                        <tr 
                            data-prod-id="${d.product_id}"
                            data-qty="${d.cantidad}"
                        >
                            <td class="text-center">${i+1}</td>
                            <td>${d.nombre}</td>
                            <td class="text-center">${d.cantidad}</td>
                            <td class="text-center">${d.stock_disponible}</td>
                            <td>
                                <div class="series-scrollbox"></div>
                                <div class="series-help text-muted small mt-1">
                                    Seleccionadas: <span class="sel-count">0</span> de ${d.cantidad}
                                </div>
                            </td>
                        </tr>`;
                    });
                    $tbody.html(html);
                    $req_codigo.text(req.codigo);

                    // Inyectar checkboxes o N/A
                    $tbody.find('tr').each(function(rowIdx) {
                        const $tr = $(this);
                        const d = det[rowIdx];
                        const $box = $tr.find('.series-scrollbox');
                        const maxQty = +$tr.data('qty');

                        if (!d.requires_serie || !Array.isArray(d.series) || !d.series.length) {
                            // No requiere serie
                            $box.html(`<span class="fw-semibold">N/A</span>`);
                            $tr.find('.series-help').hide();
                            return;
                        }

                        // Renderizar checkboxes
                        let cbHtml = '';
                        cbHtml += `<div class="card">
                        <div class="card-body card-scroll h-150px">
                        `;
                        d.series.forEach(s => {
                            const id = `chk_${rowIdx}_${s}`;
                            cbHtml += `
                                <div class="form-check mb-1">
                                    <input class="form-check-input series-chk" type="checkbox"
                                    id="${id}" value="${s}">
                                    <label class="form-check-label" for="${id}">${s}</label>
                                </div>`;
                        });
                        cbHtml += `</div></div>`;
                        $box.html(cbHtml);

                        // Manejador de cambio
                        $box.find('.series-chk').on('change', function() {
                            const $all = $box.find('.series-chk');
                            const sel = $box.find('.series-chk:checked').length;
                            $tr.find('.sel-count').text(sel);

                            if (sel >= maxQty) {
                                // deshabilita el resto
                                $all.each(function() {
                                    if (!this.checked) $(this).prop('disabled', true);
                                });
                            } else {
                                $all.prop('disabled', false);
                            }
                        });
                    });

                    // Eliminar fila
                    $tbody.find('.delete-row').on('click', function() {
                        $(this).closest('tr').remove();
                        $tbody.find('tr').each((i, tr) => {
                            $(tr).find('td').first().text(i + 1);
                        });
                    });

                })
                .fail(() => {
                    alert('Error comunicándose con el servidor');
                });
        });
    });

    const form = document.querySelector("#kt_form_traslado");

    const validator = FormValidation.formValidation(form, {
        fields: {
            'requerimiento_id': {
                validators: {
                    notEmpty: {
                        message: 'El requerimiento es obligatorio'
                    }
                }
            },
            'sede_origen': {
                validators: {
                    notEmpty: {
                        message: 'La sede de origen es obligatoria'
                    }
                }
            },
            'sede_destino': {
                validators: {
                    notEmpty: {
                        message: 'La sede de destino es obligatoria'
                    }
                }
            },
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

    const submitButton = document.querySelector("#kt_submit_button_traslado");
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (!validator) {
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            const items = [];
            document.querySelectorAll("#listaProductosBody tr").forEach(tr => {
                const productId = tr.dataset.prodId;
                const cantidad = tr.dataset.qty;
                const serials = [];
                // recogemos las series seleccionadas (si hay checkboxes)
                const seriales = Array.from(
                    tr.querySelectorAll('.series-chk:checked')
                ).map(cb => cb.value);

                items.push({
                    product_id: productId,
                    cantidad: cantidad,
                    serials: seriales
                });
            });

            if (items.length === 0) {
                Swal.fire({
                    text: 'No hay productos para trasladar',
                    icon: 'warning',
                    buttonsStyling: false,
                    confirmButtonText: 'Entendido',
                    customClass: {
                        confirmButton: 'btn btn-warning'
                    }
                });
                return;
            }

            const formData = new FormData(form);
            formData.append('items_traslate', JSON.stringify(items));


            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            const executeFetch = async () => {
                try {
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
                            window.location.href = '<?= base_url('inventory/traslados') ?>';
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