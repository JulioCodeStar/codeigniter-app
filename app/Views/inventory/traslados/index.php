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

    <li class="breadcrumb-item text-muted">Listado</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content_inventory'); ?>
<style>
    .card-custom {
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        padding: 1.25rem;
    }

    .icon-box {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .icon-box svg {
        width: 1.5rem;
        height: 1.5rem;
        color: #6c757d;
    }

    .card-title {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .card-number {
        font-size: 2rem;
        font-weight: bold;
    }

    .card-description {
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>

<!-- MÉTRICAS -->
<div class="row my-5 g-4">
    <div class="col">
        <div class="card card-custom position-relative shadow-sm">
            <div class="icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                </svg>
            </div>
            <div class="card-body p-0">
                <h6 class="card-title">Total Traslados</h6>
                <div class="card-number"><?= $totalTraslados ?></div>
            </div>
        </div>

    </div>
    <div class="col">
        <div class="card card-custom position-relative shadow-sm">
            <div class="icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-hexagon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                </svg>
            </div>
            <div class="card-body p-0">
                <h6 class="card-title">Pendientes de Aprobación</h6>
                <div class="card-number"><?= $totalPendientes ?></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-custom position-relative shadow-sm">
            <div class="icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" />
                    <path d="M9 12l2 2l4 -4" />
                </svg>
            </div>
            <div class="card-body p-0">
                <h6 class="card-title">Aprobados</h6>
                <div class="card-number"><?= $totalAprobados ?></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-custom position-relative shadow-sm">
            <div class="icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                </svg>
            </div>
            <div class="card-body p-0">
                <h6 class="card-title">En Traslado</h6>
                <div class="card-number"><?= $totalEnTraslado ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-5">
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-traslados-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Traslado" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filtros</button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Role:</label>
                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                                <option></option>
                                <option value="Administrator">Administrator</option>
                                <option value="Analyst">Analyst</option>
                                <option value="Developer">Developer</option>
                                <option value="Support">Support</option>
                                <option value="Trial">Trial</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="two-step" data-hide-search="true">
                                <option></option>
                                <option value="Enabled">Enabled</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                <!--begin::Export-->
                <button type="button" class="btn btn-light-primary me-3">
                    <i class="ki-duotone ki-exit-up fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Exportar</button>
                <!--end::Export-->

                <a type="button" class="btn btn-primary" href="<?= base_url('inventory/traslados/new') ?>">
                    <i class="ki-duotone ki-plus fs-2"></i>Agregar Traslado</a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>

    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_traslados">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">#Código</th>
                    <th class="max-w-50px">Fecha</th>
                    <th class="min-w-125px">Origen -> Destino</th>
                    <th class="min-w-125px"># ID Requerimiento</th>
                    <th class="min-w-125px"># ID Salida</th>
                    <th class="min-w-125px">Estado</th>
                    <th class="min-w-125px">Procesos</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($traslados as $traslado) : ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary"><?= $traslado['codigo'] ?></span>
                        </td>
                        <td><?= fecha_dmy($traslado['created_at']) ?></td>
                        <td> <span class="badge badge-dark"><?= $traslado['sede_origen'] ?></span> -> <span class="badge badge-dark"><?= $traslado['sede_destino'] ?></span></td>
                        <td>
                            <span class="badge badge-light-danger"><?= $traslado['codigo_requerimiento'] ?></span>
                        </td>
                        <td>
                            <span class="badge badge-light-info"><?= $traslado['codigo_salida'] ?></span>
                        </td>
                        <td>
                            <?php
                            $badgeClass = match ($traslado['estado']) {
                                'pendiente' => 'badge-light-warning',
                                'aprobado' => 'badge-light-success',
                                'empaquetando' => 'badge-light-info',
                                'en transito' => 'badge-light-primary',
                                'recibido' => 'badge-light-success',
                                'cancelado' => 'badge-light-danger',
                                default => 'badge-light-secondary'
                            };
                            ?>
                            <span class="badge <?= $badgeClass ?> badge-lg">
                                <?= $traslado['estado'] ?>
                            </span>
                        </td>
                        <td class="text-center">

                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                <?= esc($traslado['estado']) ?>
                                <span class="svg-icon fs-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>

                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">

                                <?php foreach ($allowedTransitions[$traslado['estado']] as $st): ?>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 change-status"
                                            data-id="<?= $traslado['id'] ?>"
                                            data-status="<?= $st ?>">
                                            <?= ucfirst($st) ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>

                                <!-- <div class="menu-item px-3">
                                    <a href="#"
                                        class="menu-link px-3 view-requirement-button"
                                        data-traslado-id="<?= $traslado['id'] ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewTrasladoModal">
                                        Ver
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-url="<?= base_url('api/inventory/traslados/delete/' . $traslado['id']) ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a>
                                </div> -->
                            </div>

                            <!-- <div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= esc($traslado['estado']) ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($allowedTransitions[$traslado['estado']] as $st): ?>
                                        <li>
                                            <a href="#" class="dropdown-item change-status"
                                                data-id="<?= $traslado['id'] ?>"
                                                data-status="<?= $st ?>">
                                                <?= ucfirst($st) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div> -->
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

                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="#"
                                        class="menu-link px-3 view-requirement-button"
                                        data-traslado-id="<?= $traslado['id'] ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewTrasladoModal">
                                        Ver
                                    </a>
                                </div>
                                <!-- <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-url="<? //= base_url('api/inventory/traslados/delete/' . $traslado['id']) ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a>
                                </div> -->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--end::Table-->
    </div>
</div>


<!-- Modal Ver Traslado -->
<div class="modal fade" id="viewTrasladoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Detalle de Traslado
                    <span class="badge badge-primary" id="viewTrasladoCode">#</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 mb-4 rounded bg-primary bg-opacity-10">
                    <dl class="row mb-0" id="viewTrasladoDl"></dl>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-3">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                <th>#</th>
                                <th>Código</th>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Series</th>
                            </tr>
                        </thead>
                        <tbody id="viewTrasladoDetailsBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" id="viewTrasladoSalida" target="_blank" class="btn btn-danger">Ver Salida</a>
                <a href="" id="viewTrasladoRequerimiento" target="_blank" class="btn btn-warning">Ver Requerimiento</a>
                <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>


<?= $this->section('scripts_inventory'); ?>
<script>
    const KTDataTablesTraslados = function() {

        let dt;

        const initDatatable = () => {
            dt = $("#kt_table_traslados").DataTable({
                searchDelay: 500,
                processing: true,
                order: [
                    [0, 'desc']
                ],
                "language": {
                    "url": "<?= base_url('assets/i18n/Spanish.json') ?>"
                }
            });
        }

        const handleSearchTraslados = () => {
            const filter = document.querySelector('[data-kt-traslados-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchTraslados();
            }
        }

    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDataTablesTraslados.init();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // 1) Etiquetas que queremos mostrar en el <dl>
        const headerFields = {
            sede_origen_nombre: 'Sede de Origen',
            sede_destino_nombre: 'Sede de Destino',
            area_solicitante_nombre: 'Área Solicitante',
            nombre_requerimiento: 'Requerimiento',
            created_at: 'Fecha del Traslado',
        };

        // 2) Referencias al DOM
        const modalEl = document.getElementById('viewTrasladoModal');
        const modal = new bootstrap.Modal(modalEl);
        const codeLbl = modalEl.querySelector('#viewTrasladoCode');
        const dl = modalEl.querySelector('#viewTrasladoDl');
        const tbody = modalEl.querySelector('#viewTrasladoDetailsBody');

        // 3) Cada botón “Ver” en la tabla
        document.querySelectorAll('.view-requirement-button').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                const trasladoId = this.dataset.trasladoId;
                if (!trasladoId) return;

                try {
                    // 3.1) Llamada AJAX
                    const res = await fetch(`<?= base_url('api/inventory/traslados/show/') ?>${trasladoId}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    console.log(res);
                    
                    const payload = await res.json();
                    if (!res.ok || payload.status !== 200) {
                        throw new Error(payload.message || 'Error al cargar el traslado');
                    }

                    // 3.2) Poner el código en el badge del título
                    codeLbl.textContent = `#${payload.traslado.codigo}`;

                    // 3.3) Rellenar el <dl> solo con los campos que definimos
                    let dlHtml = '';
                    for (const [field, label] of Object.entries(headerFields)) {
                        // payload.traslado[field] para todo menos el código
                        // el código lo tomamos de payload.codigo
                        const val = field === 'codigo' ?
                            payload.codigo :
                            (payload.traslado[field] ?? '-');
                        dlHtml += `
                            <dt class="col-sm-3 mb-2 text-muted">${label}</dt>
                            <dd class="col-sm-9 mb-2 fw-semibold">${val}</dd>
                        `;
                    }
                    dl.innerHTML = dlHtml;

                    // 3.4) Rellenar la tabla de productos y series
                    let rows = '';
                    payload.details.forEach((d, i) => {
                        let seriesHtml = '-';
                        if (Array.isArray(d.serials) && d.serials.length) {
                            seriesHtml = d.serials
                                .map(s => `<span class="badge badge-light-primary me-1 mb-1">${s}</span>`)
                                .join('');
                        }
                        rows += `
                            <tr>
                                <td>${i+1}</td>
                                <td>${d.codigo}</td>
                                <td>${d.nombre}</td>
                                <td class="text-center">${d.cantidad}</td>
                                <td class="text-center">${seriesHtml}</td>
                            </tr>
                        `;
                    });
                    tbody.innerHTML = rows;

                    document.getElementById('viewTrasladoSalida').href = `<?= base_url('api/inventory/exits/generate-pdf/') ?>${payload.id_salida}`;
                    document.getElementById('viewTrasladoRequerimiento').href = `<?= base_url('api/inventory/requirements/generate-pdf/') ?>${payload.traslado.requirement_id}`;

                    // 3.5) Mostrar el modal
                    modal.show();

                } catch (err) {
                    console.error(err);
                    Swal.fire({
                        text: err.message || 'Error al cargar el traslado',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Entendido',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.change-status').forEach(el => {
            el.addEventListener('click', async function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const status = this.dataset.status;

                // Confirmar
                const {
                    isConfirmed
                } = await Swal.fire({
                    text: `¿Cambiar estado a "${status}"?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, cambiar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                });
                if (!isConfirmed) return;

                // Mostrar loading después de confirmar
                Swal.fire({
                    title: 'Procesando...',
                    html: 'Guardando cambios... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    // Simular delay mínimo para mostrar el loading
                    await new Promise(resolve => setTimeout(resolve, 2000));

                    const res = await fetch(`<?= base_url('api/inventory/traslados/update-status/') ?>${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify({
                            status
                        })
                    });
                    const data = await res.json();
                    if (!res.ok || data.status >= 400) {
                        throw new Error(data.message || 'Error al cambiar estado');
                    }

                    // Mostrar mensaje de éxito
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

                } catch (err) {
                    console.error(err);
                    // Mostrar mensaje de error
                    Swal.fire({
                        text: err.message || 'Error de red',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Entendido',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>