<?= $this->extend('layouts/production/layouts/template'); ?>

<?= $this->section('title_production'); ?>
Seguimiento de Items | Producción - LIMP
<?= $this->endSection(); ?>

<?= $this->section('toolbar_production'); ?>
<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Gestión de Producción
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Seguimiento de Items</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Listado</li>

</ul>
<?= $this->endSection(); ?>

<?= $this->section('content_production'); ?>
<div class="card card-flush h-lg-100 mt-5">
    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-filter fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <h2>Filtros de Búsqueda</h2>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-4">
                <label for="" class="form-label">Buscar</label>
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" id="filterSearch" data-kt-order-table-filter="search" class="form-control form-control-solid ps-13" placeholder="Buscar por producto, paciente, proyecto, prueba o stock, etc" />
                </div>
            </div>

            <div class="col-md-2">
            </div>

            <div class="col-md-3">
                <label for="filterState" class="form-label">Estado</label>
                <select name="filterState" id="filterState" class="form-select form-select-solid">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en producción">En Producción</option>
                    <option value="ensambladando">Ensambladando</option>
                    <option value="terminado">Terminado</option>
                    <option value="entregado">Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="filterType" class="form-label">Tipo de Orden</label>
                <select name="filterType" id="filterType" class="form-select form-select-solid">
                    <option value="">Todos los tipos</option>
                    <option value="Paciente">Paciente</option>
                    <option value="Proyecto">Proyecto</option>
                    <option value="Pruebas">Pruebas</option>
                    <option value="Stock">Stock</option>
                </select>
            </div>

        </div>
    </div>
</div>

<div class="row g-4 mt-5" id="cardContainer">
    <?php if (empty($ordenes)): ?>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body text-center text-muted">
                    <i class="bi bi-info-circle fs-2 mb-2"></i>
                    <p class="mb-0">No hay Ítems para seguimiento.</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($ordenes as $ordIndex => $ord):
            // Resolvemos nombre de paciente o nombre_externo
            $pac = $mapPacientes[$ord['paciente_id']] ?? null;
            $pacNombre = $pac
                ? esc($pac['nombres'] . ' ' . $pac['apellidos'])
                : esc($ord['nombre_externo']);
            $ordTipo = match ($ord['tip_orden']) {
                'Paciente' => ['nombre' => 'Paciente', 'clase' => 'badge badge-primary'],
                'Proyecto' => ['nombre' => 'Proyecto', 'clase' => 'badge badge-info'],
                'Pruebas' => ['nombre' => 'Pruebas', 'clase' => 'badge badge-secondary'],
                'Stock' => ['nombre' => 'Stock', 'clase' => 'badge badge-dark'],
                default => ['nombre' => 'Desconocido', 'clase' => 'badge badge-secondary']
            };
        ?>
            <?php foreach ($ord['items'] as $itIndex => $it):
                $prod = $mapProductos[$it['producto_id']] ?? null;
                $prodNombre = $prod
                    ? esc($prod['nombre'])
                    : 'Producto Desconocido';
                // Asumimos que $it['estado'] viene como texto “en-produccion” o similar
                $badgeClass = match ($it['estado']) {
                    'pendiente' => 'badge badge-warning',
                    'en produccion' => 'badge badge-info',
                    'ensamblando' => 'badge badge-primary',
                    'terminado' => 'badge badge-success',
                    'entregado' => 'badge badge-success',
                    'cancelado' => 'badge badge-danger',
                    default => 'badge badge-secondary'
                };
            ?>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6" data-state="<?= esc($it['estado']) ?>" data-type="<?= esc($ord['tip_orden']) ?>" data-search="<?= strtolower($prodNombre . ' ' . $pacNombre . ' ' . $it['cantidad'] . ' ' . implode(' ', array_column($it['serials'], 'code'))); ?>">
                    <div class="card mb-4 rounded">
                        <div class="card-body">
                            <!-- Header: título y badges -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?= $prodNombre ?></h5>
                                <div>
                                    <span class="<?= $ordTipo['clase'] ?>"><?= $ordTipo['nombre'] ?></span>
                                    <span class="<?= $badgeClass ?>"><?= esc($it['estado']) ?></span>
                                </div>
                            </div>
                            <!-- Subtítulo: paciente o nombre externo -->
                            <p class="text-muted mb-3"><?= $pacNombre ?></p>

                            <!-- Área & Cantidad -->
                            <div class="row mb-3">
                                <div class="col"><strong>Área:</strong> <?= esc($ord['area_respon']) ?></div>
                                <div class="col"><strong>Cantidad:</strong> <?= esc($it['cantidad']) ?></div>
                            </div>

                            <!-- Códigos de Serie -->
                            <div class="mb-2"><strong># Códigos de Serie:</strong></div>
                            <p class="mb-4">
                                <?php foreach ($it['serials'] as $unit): ?>
                                    <span class="me-2">
                                        <code><?= esc($unit['code']) ?></code> (
                                        <?= esc($unit['especificacion'] ?: '-') ?> )
                                    </span>
                                <?php endforeach; ?>
                            </p>

                            <?php if ($it['last_log']): ?>
                                <?php $log = $it['last_log']; ?>
                                <div class="mt-3 mb-5">
                                    <strong>Último cambio:</strong>
                                    <div class="bg-light p-2 rounded mt-1">
                                        <div class="d-flex align-items-center mb-1 text-muted">
                                            <i class="bi bi-clock me-1"></i> <?= esc(fecha_dmy($log['created_at'])) ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-1 text-muted">
                                            <i class="bi bi-person me-1"></i> <?= esc($log['usuario'] ?: 'Sistema') ?>
                                        </div>
                                        <div><?= esc($log['notas'] ?: '-') ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($it['estado'] === 'entregado'): ?>

                                <!-- . $it['item_id'] -->
                                <div class="d-flex">
                                    <a target="_blank" href="<?= base_url('production/follow-up/recepcion/' . $it['item_id']) ?>" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success w-100 me-2">
                                        Recepción de Productos
                                    </a>
                                    <a target="_blank" href="<?= base_url('production/follow-up/liberacion/' . $it['item_id']) ?>" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary w-100">
                                        Liberación de Productos
                                    </a>
                                </div>

                            <?php endif; ?>

                        </div>
                        <!-- Footer: botón Cambiar Estado y copiar -->
                        <div class="card-footer bg-transparent border-0 d-flex">
                            <button
                                type="button"
                                class="btn btn-dark flex-grow-1 btn-change-state"
                                data-order-index="<?= $ordIndex ?>"
                                data-item-index="<?= $itIndex ?>">
                                Cambiar Estado
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary ms-2 btn-history"
                                data-item-id="<?= $it['item_id'] ?>">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>


                    </div>
                </div>


            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-550px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial del Ítem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="historyModalBody">
                <!-- se inyecta aquí -->
            </div>
        </div>
    </div>
</div>

<!-- Modal: Cambiar Estado del Item -->
<div class="modal fade" id="changeStateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-650px">
        <?= form_open('api/production/follow-up/update-status', [
            'id'           => 'changeStateForm',
            'class'        => 'fv-row modal-content',
            'autocomplete' => 'off'
        ]) ?>
        <div class="modal-header">
            <h5 class="modal-title">Cambiar Estado del Ítem</h5>
            <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </button>
        </div>
        <div class="modal-body">
            <!-- Detalle del ítem -->
            <div class="bg-light rounded p-4 mb-5">
                <h6 id="csItemName" class="mb-1">Producto Nombre</h6>
                <p id="csItemPatient" class="text-muted mb-1">Juan Pérez</p>
                <p id="csItemCodes" class="mb-0"><strong>Códigos:</strong> LIN-2024-001</p>
            </div>

            <!-- Nuevo Estado -->
            <div class="fv-row mb-5">
                <label for="newState" class="form-label">Nuevo Estado</label>
                <select id="newState" name="new_state" class="form-select" required>
                    <option value="" disabled selected>Seleccionar estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en producción">En Producción</option>
                    <option value="ensamblando">Ensamblando</option>
                    <option value="terminado">Terminado</option>
                    <option value="entregado">Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>

            <!-- Responsable del Cambio -->
            <div class="fv-row mb-5">
                <label for="csResponsable" class="form-label">Responsable del Cambio</label>
                <select id="csResponsable" name="csResponsable" class="form-select" required>
                    <option value="" disabled selected>Seleccionar responsable</option>

                    <?= (session('production_user')['area'] === 'Desarrollo Tecnológico') ? '<option value="Noe Colla Muñoz">Noe Colla Muñoz</option>' : '' ?>
                    <?= (session('production_user')['area'] === 'Producción') ? '<option value="Carlos Espinoza">Carlos Espinoza</option>' : '' ?>
                    <?= (session('production_user')['area'] === 'Textil') ? '<option value="Camila">Camila</option>' : '' ?>
                </select>
            </div>

            <!-- Nota del Cambio -->
            <div class="fv-row mb-5">
                <label for="csNota" class="form-label">
                    Nota del Cambio <span class="text-danger">*</span>
                </label>
                <textarea id="csNota" name="csNota" rows="4"
                    class="form-control" placeholder="Describe el motivo del cambio..." required></textarea>
            </div>

            <input type="hidden" id="csItemId" name="item_id" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="csSaveBtn">
                <i class="ki-duotone ki-triangle fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <span class="indicator-label">
                    Actualizar Estado
                </span>
                <span class="indicator-progress">
                    Actualizando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>



<?= $this->endSection(); ?>



<?= $this->section('scripts_production'); ?>
<?= csrf_scripts_basic() ?>
<script>
    document.querySelectorAll('.btn-history').forEach(btn => {
        btn.addEventListener('click', async () => {
            const itemId = btn.getAttribute('data-item-id');
            const res = await fetch(`<?= base_url('api/production/follow-up/logs') ?>/${itemId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (!res.ok) return alert('No se pudo cargar el historial');
            const json = await res.json();

            const body = document.getElementById('historyModalBody');
            // Cabecera
            body.innerHTML = `
                <div class="border rounded p-3 mb-3">
                    <h6 class="mb-1">${json.item.nombre}</h6>
                    <p class="text-muted mb-1">
                    ${json.item.paciente || json.item.nombre_externo || 'Desconocido'}
                    </p>
                    <code class="bg-light p-2 rounded">${json.item.serie_principal || 'No aplica'}</code>
                </div>
                <h6 class="mb-2">Historial de Estados:</h6>

                <!-- Tabla única -->
                <div class="dt-container dt-bootstrap5 dt-empty-footer">
                    <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable">
                    <tbody id="historyTableBody"></tbody>
                    </table>
                </div>
            `;

            // Solo el <tbody>, metemos <tr> por cada log
            const tbody = document.getElementById('historyTableBody');
            json.logs.forEach(log => {
                const badgeColor = log.estado === 'pendiente' ?
                    'badge badge-warning' :
                    log.estado === 'en producción' ?
                    'badge badge-primary' :
                    log.estado === 'ensamblando' ?
                    'badge badge-primary' :
                    log.estado === 'terminado' || log.estado === 'entregado' ?
                    'badge badge-success' :
                    log.estado === 'cancelado' ?
                    'badge badge-danger' :
                    'badge badge-secondary';

                const barColor = badgeColor.replace('badge ', '');

                tbody.innerHTML += `
                    <tr>
                    <td>
                        <div class="position-relative ps-6 pe-3 py-2">
                        <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 ${barColor}"></div>
                        <div class="d-flex align-items-center mb-1">
                            <span class="${badgeColor}">${log.estado}</span>
                            <small class="text-gray-600 ms-2">
                            ${log.created_at} por ${log.usuario}
                            </small>
                        </div>
                        <div>${log.notas || ''}</div>
                        </div>
                    </td>
                    </tr>
                `;
            });

            new bootstrap.Modal(document.getElementById('historyModal')).show();
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        // 1) Serializa tus órdenes en JS
        const ordenesData = <?= json_encode($ordenes, JSON_HEX_TAG) ?>;

        // 2) Elementos del modal
        const changeModal = new bootstrap.Modal(document.getElementById('changeStateModal'));
        const form = document.getElementById('changeStateForm');
        const fldItemName = document.getElementById('csItemName');
        const fldPatient = document.getElementById('csItemPatient');
        const fldCodes = document.getElementById('csItemCodes');
        const fldNewState = document.getElementById('newState');
        const fldResp = document.getElementById('csResponsable');
        const fldNota = document.getElementById('csNota');
        const fldItemId = document.getElementById('csItemId');
        const saveBtn = document.getElementById('csSaveBtn');

        // 3) Al hacer click en Cambiar Estado…
        document.querySelectorAll('.btn-change-state').forEach(btn => {
            btn.addEventListener('click', () => {
                const ordIdx = parseInt(btn.getAttribute('data-order-index'));
                const itIdx = parseInt(btn.getAttribute('data-item-index'));
                const item = ordenesData[ordIdx].items[itIdx];
                const patient = ordenesData[ordIdx].paciente_id ?
                    (<?= json_encode($mapPacientes) ?>)[ordenesData[ordIdx].paciente_id] :
                    null;

                // Rellenar campos
                fldItemName.textContent = (<?= json_encode($mapProductos) ?>)[item.producto_id].nombre;
                const patientName = patient ?
                    `${patient.nombres} ${patient.apellidos}` :
                    ordenesData[ordIdx].nombre_externo || '–';
                fldPatient.textContent = patientName;
                // Mostrar códigos de serie con sus especificaciones
                const codesList = item.serials.map(s => {
                    return `${s.code}${s.especificacion ? ` (${s.especificacion})` : ''}`;
                }).join(', ');
                fldCodes.innerHTML = codesList ? `<strong>Códigos:</strong> <code>${codesList}</code>` : '<strong>Códigos:</strong> No aplica';

                fldNewState.value = item.estado;
                fldResp.value = '';
                fldNota.value = '';
                fldItemId.value = item.item_id;

                // Mostrar modal
                changeModal.show();
            });
        });

        // 4) Enviar el cambio de estado por AJAX
        const frm = document.querySelector("#changeStateForm");

        const validator = FormValidation.formValidation(frm, {
            fields: {
                new_state: {
                    validators: {
                        notEmpty: {
                            message: 'El campo nuevo estado es obligatorio'
                        }
                    }
                },

                csResponsable: {
                    validators: {
                        notEmpty: {
                            message: 'El campo responsable es obligatorio'
                        }
                    }
                },

                csNota: {
                    validators: {
                        notEmpty: {
                            message: 'El campo nota es obligatorio'
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

        const submit = document.querySelector("#csSaveBtn");

        submit.addEventListener('click', function(e) {
            e.preventDefault();
            if (!validator) return;

            validator.validate().then(function(status) {
                if (status !== 'Valid') {
                    return;
                }

                submit.setAttribute('data-kt-indicator', 'on');
                submit.disabled = true;

                const executeFecth = async () => {
                    try {
                        const response = await fetch(frm.action, {
                            method: 'POST',
                            body: new FormData(frm),
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
                                text: data.message || 'Producto creado correctamente',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }
                            }).then(() => {
                                window.location.href = '<?= base_url('production/follow-up') ?>';
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        submit.removeAttribute('data-kt-indicator');
                        submit.disabled = false;
                    }
                }

                setTimeout(executeFecth, 2000);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const inputSearch = document.getElementById('filterSearch');
        const selectState = document.getElementById('filterState');
        const selectType = document.getElementById('filterType');
        const cards = document.querySelectorAll('#cardContainer > .col-12');

        function applyFilters() {
            const term = inputSearch.value.toLowerCase().trim();
            const state = selectState.value;
            const type = selectType.value;

            cards.forEach(col => {
                const text = col.getAttribute('data-search');
                const s = col.getAttribute('data-state');
                const t = col.getAttribute('data-type');

                const matchesSearch = !term || text.includes(term);
                const matchesState = !state || s === state;
                const matchesType = !type || t === type;

                col.style.display = (matchesSearch && matchesState && matchesType) ?
                    '' :
                    'none';
            });
        }

        inputSearch.addEventListener('input', applyFilters);
        selectState.addEventListener('change', applyFilters);
        selectType.addEventListener('change', applyFilters);
    });
</script>
<?= $this->endSection(); ?>