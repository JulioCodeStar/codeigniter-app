<?= $this->extend('layouts/production/layouts/template'); ?>

<?= $this->section('title_production'); ?>
Órdenes de Producción | Producción - LIMP
<?= $this->endSection(); ?>

<?= $this->section('toolbar_production'); ?>
<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Gestión de Producción
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Órdenes de Producción</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Listado</li>

</ul>
<?= $this->endSection(); ?>


<?= $this->section('content_production'); ?>

<div class="card mt-5">
    <div class="card-header border-0 py-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-order-table-filter="search" class="form-control form-control-solid w-450px ps-13" placeholder="Buscar por código, paciente, proyecto, prueba o stock, etc" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-order-table-toolbar="base">


                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_order">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Agregar Orden
                </a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
</div>

<div class="row g-4 mt-5" id="cardContainer">

    <?php if (empty($ordenes)): ?>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body text-center text-muted">
                    <i class="bi bi-info-circle fs-2 mb-2"></i>
                    <p class="mb-0">No hay Órdenes de Producción.</p>
                </div>
            </div>
        </div>

    <?php else: ?>

        <?php foreach ($ordenes as $ordIndex => $ord):
            $pac = $mapPacientes[$ord['paciente_id']] ?? null;
        ?>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Header: paciente y badges -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0">
                                <?= $pac
                                    ? esc($pac['nombres'] . ' ' . $pac['apellidos'])
                                    : esc($ord['nombre_externo']) ?>
                                <p class="mb-0 text-muted fs-7">N°: <?= esc($ord['codigo']) ?></p>
                            </h5>

                            <div>
                                <span class="badge me-1 <?= match (esc($ord['tip_orden'])) {
                                        'Paciente' => 'badge-primary',
                                        'Proyecto' => 'badge-info',
                                        'Pruebas' => 'badge-warning',
                                        'Stock' => 'badge-dark',
                                        default => 'badge-secondary'
                                    } ?>">
                                    <?= esc($ord['tip_orden']) ?>
                                </span>
                                <span class="badge <?= match (esc($ord['estado'])) {
                                        'activo' => 'badge-success',
                                        'atrasado' => 'badge-danger',
                                        'terminado' => 'badge-primary',
                                        default => 'badge-secondary'
                                    } ?>">
                                    <?= esc($ord['estado']) ?>
                                </span>

                                <a href="#" class="btn btn-link btn-color-danger btn-active-color-primary ms-5 " data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-url="<?= base_url('api/production/orders/delete/' . $ord['id']) ?>">
                                    <i class="ki-duotone ki-trash fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </a>
                            </div>
                        </div>

                        <!-- Subheader: área y fechas -->
                        <div class="row text-muted mb-4">
                            <div class="col-auto d-flex align-items-center">
                                <i class="bi bi-building me-1"></i>
                                <small><?= esc($ord['area_respon']) ?></small>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <i class="bi bi-calendar2-event me-1"></i>
                                <small>
                                    <strong>Solicitud</strong>
                                    <?= fecha_dmy($ord['fecha_solicitud']) ?>
                                </small>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <i class="bi bi-calendar2-check me-1"></i>
                                <small>
                                    <strong>Entrega</strong>
                                    <?= fecha_dmy($ord['fecha_entrega']) ?>
                                </small>
                            </div>
                        </div>

                        <!-- Items -->
                        <h6 class="mb-2">Items:</h6>
                        <?php foreach ($ord['items'] as $itIndex => $it):
                            $prod  = $mapProductos[$it['producto_id']] ?? null;
                            $codes = $it['codigos'];
                            // primeros dos inline
                            $inline = array_slice($codes, 0, 2);
                        ?>
                            <div class="border rounded p-3 mb-4 position-relative">
                                <span class="badge position-absolute text-white top-0 end-0 m-2" style="background-color: <?= match ($it['estado']) {
                                                                                                                                'pendiente' => '#ffc107',
                                                                                                                                'en produccion' => '#1a79d8',
                                                                                                                                'ensambladando' => '#5f88b1',
                                                                                                                                'terminado' => '#198754',
                                                                                                                                'entregado' => '#2ef243',
                                                                                                                                'cancelado' => '#dc3545',
                                                                                                                                default => '#6c757d'
                                                                                                                            } ?>">
                                    <?= esc($it['estado']) ?>
                                </span>
                                <h6 class="mb-1">
                                    <?= $prod
                                        ? esc($prod['nombre'])
                                        : 'Sin Producto' ?>
                                </h6>
                                <p class="mb-2 text-gray-600">
                                    Cantidad: <?= esc($it['cantidad']) ?>
                                </p>
                                <?php
                                // Preparo los códigos con sus especificaciones
                                $codes = $it['codigos'];
                                // Tomo sólo los dos primeros para mostrar inline
                                $inline = array_slice($codes, 0, 2);
                                foreach ($inline as $codeObj): ?>
                                    <span class="me-2">
                                        <code><?= esc($codeObj['code']) ?></code>(<?= esc($codeObj['especificacion'] ?: '-') ?>)
                                    </span>
                                <?php endforeach; ?>

                                <?php if (count($codes) > 2): ?>
                                    <a href="#"
                                        class="text-decoration-none"
                                        data-bs-toggle="modal"
                                        data-bs-target="#codesModal"
                                        data-order-index="<?= $ordIndex ?>"
                                        data-item-index="<?= $itIndex ?>">
                                        Ver más
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Notas -->
                        <h6 class="mb-1">Notas:</h6>
                        <div class="bg-light rounded p-3">
                            <?= esc($ord['notas'] ?: '-') ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<!-- Modal para ver todos los códigos -->
<div class="modal fade" id="codesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Códigos de Serie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="codesModalBody">
                <!-- Se rellenará vía JavaScript -->
            </div>
        </div>
    </div>
</div>


<!-- begin::Modal Create Order -->
<div class="modal fade" tabindex="-1" id="kt_modal_add_order">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-850px">
        <?= form_open('api/production/orders/create', ['id' => 'kt_form_order', 'class' => 'fv-row modal-content', 'autocomplete' => 'off']) ?>
        <div class="modal-header">
            <h3 class="modal-title">Agregar Nueva Orden de Producción</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>
        <div class="modal-body">
            <div class="row g-4">
                <div class="col-md-6 fv-row">
                    <label for="type_order" class="required form-label">Tipo de Orden</label>
                    <select class="form-select" name="type_order" id="type_order" aria-label="Select example" onchange="toggleFields(this.value)">
                        <option disabled selected value="">Seleccionar</option>
                        <option value="Paciente">Paciente</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Pruebas">Pruebas</option>
                        <option value="Stock">Stock</option>
                    </select>
                </div>

                <div class="col-md-6 fv-row" style="display: none;" id="DivPatient">
                    <label for="patient_id" class="required form-label">Paciente</label>
                    <select class="form-select" name="patient_id" id="patient_id" data-control="select2" data-placeholder="Seleccionar Paciente" aria-label="Select Patient">
                        <option value=""></option>
                        <?php foreach ($patients as $row) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['cod_paciente'] . ' - ' . mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-6 fv-row" style="display: block;" id="DivInput">
                    <label for="input_field" class="required form-label">Nombre del Proyecto/Pruebas/Stock</label>
                    <input type="text" class="form-control" name="input_field" id="input_field" placeholder="Ingrese el nombre">
                </div>

                <div class="col-md-12 fv-row">
                    <label for="area_respon" class="required form-label">Área Responsable</label>
                    <select class="form-select" name="area_respon" id="area_respon" aria-label="Select example">
                        <option value="" selected disabled>Seleccione un área</option>
                        <?php if (session('production_user')['area'] == 'Producción') : ?>
                            <option value="Producción">Producción</option>
                        <?php endif; ?>
                        <?php if (session('production_user')['area'] == 'Desarrollo Tecnológico') : ?>
                            <option value="Desarrollo Tecnológico">Desarrollo Tecnológico</option>
                        <?php endif; ?>
                        <?php if (session('production_user')['area'] == 'Textil') : ?>
                            <option value="Textil">Textil</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-6 fv-row">
                    <label for="fecha_solicitud" class="required form-label">Fecha de Solicitud</label>
                    <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" placeholder="Ingrese la fecha">
                </div>

                <div class="col-md-6 fv-row">
                    <label for="fecha_entrega" class="required form-label">Fecha de Entrega</label>
                    <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" placeholder="Ingrese la fecha">
                </div>

                <div class="col-md-12 fv-row">
                    <label for="notas" class="form-label">Notas</label>
                    <textarea
                        class="form-control"
                        id="notas"
                        name="notas"
                        rows="3"
                        placeholder="Describa brevemente..."></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Items de la Orden</label>
                    <div class="bg-light p-5 rounded mb-4">
                        <div class="row g-2 align-items-end">
                            <!-- Producto -->
                            <div class="col-md-6 fv-row">
                                <label for="item_producto" class="form-label small">Producto</label>
                                <select class="form-select" id="item_producto" name="item_producto" data-control="select2" data-placeholder="Seleccionar Producto">
                                    <option value=""></option>
                                    <!-- Opciones dinámicas -->
                                    <?php foreach ($products as $row) { ?>
                                        <option value="<?= $row['id'] ?>" data-code="<?= $row['codigo'] ?>"><?= $row['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- Cantidad -->
                            <div class="col-md-2 fv-row">
                                <label for="item_cantidad" class="form-label small">Cantidad</label>
                                <input type="number" class="form-control" id="item_cantidad"
                                    name="item_cantidad" min="1">
                            </div>
                            <!-- Especificaciones -->
                            <div class="col-md-2 fv-row">
                                <!-- <label for="item_especificaciones" class="form-label small">Especificaciones</label>
                                <input type="text" class="form-control" id="item_especificaciones"
                                    name="item_especificaciones"
                                    placeholder="Talla, color, características especial"> -->
                            </div>
                            <!-- Botón Agregar -->
                            <div class="col-md-2 d-grid">
                                <button type="button" class="btn btn-dark mt-1" id="btnAgregarItem">
                                    <i class="bi bi-plus-lg me-1"></i> Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12" id="serialContainer" style="display:none;">
                    <div class="bg-light-primary p-3 rounded">
                        <strong># Códigos de serie que se generarán:</strong>
                        <div id="serialCodes" class="mt-2"></div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="addedItemsContainer"></div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="kt_btn_submit_order">
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
<!-- end::Modal Create Order -->

<!--begin::Modal Delete-->
<div class="modal fade" tabindex="-1" id="eliminarModal" aria-hidden="true">
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
                <p>¿Deseas Eliminar esta orden de producción del sistema?</p>
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
<!--end::Modal Delete-->

<?= $this->endSection(); ?>



<?= $this->section('scripts_production'); ?>
<?= csrf_scripts_basic() ?>
<script>
    // 1) Serializamos $ordenes en JS
    const ordenesData = <?= json_encode($ordenes, JSON_HEX_TAG) ?>;

    // 2) Listener para el modal
    document.getElementById('codesModal')
        .addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const ordIdx = parseInt(button.getAttribute('data-order-index'), 10);
            const itemIdx = parseInt(button.getAttribute('data-item-index'), 10);
            const body = this.querySelector('#codesModalBody');

            // 3) Sacamos el array de códigos para esta orden y este item
            const codes = ordenesData[ordIdx]
                .items[itemIdx]
                .codigos;

            // 4) Renderizamos
            body.innerHTML = codes.map(c => `
            <div class="d-flex justify-content-between py-1 border-bottom">
                <code>${c.code}</code>
                <small>${c.especificacion || '-'}</small>
            </div>
            `).join('');
        });


    function toggleFields(value) {
        if (value === 'Paciente') {
            document.getElementById('DivPatient').style.display = 'block';
            document.getElementById('DivInput').style.display = 'none';
            document.querySelector("#input_field").value = '';
        } else {
            document.getElementById('DivPatient').style.display = 'none';
            document.getElementById('DivInput').style.display = 'block';
            document.querySelector("#input_field").value = '';
        }

        if (value === 'Stock') {
            document.querySelector("#input_field").value = 'Stock para Almacén';
        }
    }

    let currentSerials = [];
    const items = [];

    document.addEventListener('DOMContentLoaded', () => {
        const productoSel = document.getElementById('item_producto');
        const cantidadInput = document.getElementById('item_cantidad');
        const specsInput = document.getElementById('item_especificaciones');
        const btnAgregar = document.getElementById('btnAgregarItem');
        const serialContainer = document.getElementById('serialContainer');
        const serialCodesDiv = document.getElementById('serialCodes');
        const addedContainer = document.getElementById('addedItemsContainer');

        const form = document.querySelector("#kt_form_order");

        async function updateSerials() {
            const productId = productoSel.value;
            const qty = parseInt(cantidadInput.value) || 0;
            if (!productId || qty < 1) {
                serialContainer.style.display = 'none';
                return;
            }

            try {
                // Preparar los datos del formulario
                const formData = new FormData();
                formData.append('product_id', productId);
                formData.append('quantity', qty);

                // Realizar la petición
                const res = await fetch("<?= base_url('api/production/orders/preview-serials') ?>", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                });

                if (!res.ok) throw new Error('Error en el servidor');

                const json = await res.json();
                currentSerials = json.serials || [];

                // Render del preview
                serialCodesDiv.innerHTML = currentSerials
                    .map((code, idx) => `
                    <div class="d-flex align-items-center mb-1">
                        <code class="me-2">${code}</code>
                        <input
                        type="text"
                        class="form-control form-control-sm"
                        placeholder="Especificación"
                        data-code-index="${idx}"
                        >
                    </div>
                `).join('');
                serialContainer.style.display = 'block';

                return currentSerials;

            } catch (err) {
                console.error('Error al actualizar serials:', err);
                serialContainer.style.display = 'none';
                currentSerials = [];

                // Mostrar mensaje de error al usuario
                alert('Error al obtener los códigos de serie. Por favor, inténtelo de nuevo.');
            }
        }

        function renderAddedItems() {
            if (!items.length) {
                addedContainer.innerHTML = `<p class="text-muted fst-italic">No hay items agregados.</p>`;
                return;
            }
            addedContainer.innerHTML = '';

            items.forEach((item, idx) => {
                const div = document.createElement('div');
                div.className = 'bg-light p-3 rounded mb-3';

                // Para cada código+especificación creamos un pequeño bloque
                const codesHtml = item.codigos.map(c => `
                    <div class="d-flex align-items-center mb-1">
                        <code class="flex-shrink-0 me-2">${c.code}</code>
                        <small class="text-gray-600">${c.especificacion || ''}</small>
                    </div>
                `).join('');

                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1">${item.nombre}</h6>
                            <p class="mb-2 text-gray-600">
                                Cantidad: ${item.cantidad} |
                                Especificaciones generales: ${item.especificaciones || 'N/A'}
                            </p>
                        </div>
                        <button type="button" class="btn btn-icon btn-danger btn-sm ms-3" data-index="${idx}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="border rounded p-3 bg-white">
                        ${codesHtml}
                    </div>
                `;

                // Asociar el evento de borrado
                div.querySelector('button').addEventListener('click', () => {
                    items.splice(idx, 1);
                    renderAddedItems();
                });

                addedContainer.appendChild(div);
            });
        }


        btnAgregar.addEventListener('click', async (event) => {
            event.preventDefault();

            // 1️⃣ Validaciones básicas
            const opt = productoSel.selectedOptions[0];
            const qty = parseInt(cantidadInput.value, 10) || 0;
            if (!opt.value || qty < 1 || currentSerials.length === 0) {
                return;
            }

            // 2️⃣ Actualizar el “last” en el <option>
            const last = parseInt(opt.dataset.last, 10) || 0;
            opt.dataset.last = last + qty;

            // 3️⃣ Capturar la especificación de cada código (input[data-code-index])
            const specInputs = serialCodesDiv.querySelectorAll('input[data-code-index]');
            const codesWithSpecs = currentSerials.map((code, idx) => ({
                code,
                especificacion: specInputs[idx]?.value.trim() || null
            }));

            // 4️⃣ Guardar el ítem en el array
            items.push({
                id: opt.value,
                nombre: opt.textContent,
                cantidad: qty,
                codigos: codesWithSpecs
            });
            console.log(items);

            // 5️⃣ Redibujar la lista de items agregados
            renderAddedItems();

            // 6️⃣ Limpiar campos y preview
            $("#item_producto").val('').trigger('change');
            cantidadInput.value = '';
            serialCodesDiv.innerHTML = '';
            serialContainer.style.display = 'none';
            currentSerials = [];
        });



        productoSel.addEventListener('change', updateSerials);
        cantidadInput.addEventListener('input', updateSerials);

        renderAddedItems();
    });

    const frm = document.querySelector("#kt_form_order");

    const validator = FormValidation.formValidation(frm, {
        fields: {
            type_order: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de orden'
                    }
                }
            },
            area_respon: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un área responsable'
                    }
                }
            },
            fecha_solicitud: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una fecha de solicitud'
                    }
                }
            },
            fecha_entrega: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una fecha de entrega'
                    }
                }
            },
            notas: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese notas'
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

    const submit = document.querySelector("#kt_btn_submit_order")
    submit.addEventListener("click", async (event) => {
        event.preventDefault();
        if (!validator) return;

        if (items.length === 0) {
            alert('Por favor, agregue al menos un ítem');
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            submit.setAttribute('data-kt-indicator', 'on');
            submit.disabled = true;

            const formData = new FormData(frm);
            formData.append('items', JSON.stringify(items));

            const executeFetch = async () => {
                try {
                    const response = await fetch(frm.action, {
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
                            window.location.href = '<?= base_url('production/orders') ?>';
                        });
                    }

                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    submit.removeAttribute('data-kt-indicator');
                    submit.disabled = false;
                }
            };

            setTimeout(executeFetch, 2000);
        })
    });

    const eliminarModal = document.querySelector("#eliminarModal");
    if (eliminarModal) {
        eliminarModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-bs-url');

            const form = eliminarModal.querySelector("#form-eliminar");
            form.setAttribute('action', url);
        })
    }

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('[data-kt-order-table-filter="search"]');
        const cards = document.querySelectorAll('#cardContainer > div');

        searchInput.addEventListener('input', e => {
            const term = e.target.value.toLowerCase().trim();

            cards.forEach(col => {
                // Buscamos en todo el texto de la card
                const cardText = col.textContent.toLowerCase();
                // Si coincide, mostramos; si no, ocultamos
                col.style.display = cardText.includes(term) ? '' : 'none';
            });
        });
    });
</script>
<?= $this->endSection(); ?>