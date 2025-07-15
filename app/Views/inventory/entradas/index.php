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

    <li class="breadcrumb-item text-muted">Listado</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content_inventory'); ?>

<div class="row my-5 g-4">
    <!-- Entradas Hoy -->
    <div class="col-6 col-md-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-box fs-1 text-warning me-3"></i>
                <div>
                    <div class="text-muted small">Entradas Hoy</div>
                    <div class="h4 mb-0"><?= $totalEntries ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Esta Semana -->
    <div class="col-6 col-md-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="ki-duotone ki-calendar-tick fs-1 text-success me-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                    <span class="path6"></span>
                </i>
                <div>
                    <div class="text-muted small">Entradas Esta Semana</div>
                    <div class="h4 mb-0"><?= count($entriesThisWeek['this_week']['entries']) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sede Activa -->
    <div class="col-6 col-md-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="ki-duotone ki-home fs-1 text-primary me-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <div>
                    <div class="text-muted small">Sede Activa</div>
                    <div class="h4 mb-0"><?= $sedes['sucursal'] ?></div>
                </div>
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
                <input type="text" data-kt-entries-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Entrada" />
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

                <a type="button" class="btn btn-primary" href="<?= base_url('inventory/entries/new') ?>">
                    <i class="ki-duotone ki-plus fs-2"></i>Agregar Entrada</a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>

    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_entries">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">#Código</th>
                    <th class="max-w-50px">Fecha</th>
                    <th class="min-w-125px">Tipo / Descripción</th>
                    <th class="min-w-125px">Proveedor</th>
                    <th class="min-w-125px">Responsable</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($entries as $entry) { ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary" data-code="<?= $entry['codigo'] ?>"><?= $entry['codigo'] ?></span>
                        </td>
                        <td>
                            <?= fecha_dmy($entry['fecha_recepcion']) ?>
                        </td>
                        <td>
                            <h5><?= $entry['tipo'] ?></h5>
                            <p class="text-gray-600 fs-7"><?= $entry['descripcion'] ?></p>
                        </td>
                        <td><?= ($entry['proveedor'] == null) ? 'N/A' : $entry['proveedor'] ?></td>
                        <td><?= $entry['responsable'] ?></td>
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
                                        class="menu-link px-3 view-entry-button"
                                        data-entry-id="<?= $entry['id'] ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewEntryModal">Ver</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-url="<?= base_url('api/inventory/entries/delete/' . $entry['id']) ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="<?= base_url('api/inventory/entries/generate-pdf/' . $entry['id']) ?>" target="_blank" class="menu-link px-3">Pdf</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end::Table-->
    </div>
</div>

<!-- Modal Ver Entrada -->
<div class="modal fade" id="viewEntryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- HEADER sin fondo coloreado -->
            <div class="modal-header">
                <h5 class="modal-title">Detalle de Entrada <span class="badge badge-primary" id="viewEntryCode">#</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- Cabecera de datos en fondo celeste claro -->
                <div class="p-4 mb-4 rounded bg-primary bg-opacity-10">
                    <dl class="row mb-0" id="viewEntryDl"></dl>
                </div>

                <div class="table-responsive">
                    <!-- Tabla de detalles -->
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 3rem">#</th>
                                <th>Código</th>
                                <th>Producto</th>
                                <th class="text-center" style="width: 6rem">Cantidad</th>
                                <th class="text-center">Series</th>
                            </tr>
                        </thead>
                        <tbody id="viewDetailsBody"></tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>


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
                <p>¿Deseas Eliminar esta entrada del sistema?</p>
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


<?= $this->section('scripts_inventory'); ?>

<script>
    const KTDataTablesEntries = function() {

        let dt;

        const initDatatable = () => {
            dt = $("#kt_table_entries").DataTable({
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

        const handleSearchEntries = () => {
            const filter = document.querySelector('[data-kt-entries-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchEntries();
            }
        }

    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDataTablesEntries.init();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Mapa campo => etiqueta para <dl>
        const entryFields = {
            tipo: 'Tipo',
            descripcion: 'Descripción',
            fecha_recepcion: 'Fecha de Recepción',
            responsable: 'Responsable de Recepción',
            proveedor: 'Proveedor',
            observacion: 'Observaciones',
        };

        const modalEl = document.getElementById('viewEntryModal');
        const modal = new bootstrap.Modal(modalEl);
        const dl = document.getElementById('viewEntryDl');
        const tbody = document.getElementById('viewDetailsBody');
        const codeLbl = document.getElementById('viewEntryCode');

        document.querySelectorAll('.view-entry-button').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                const entryId = this.dataset.entryId;

                // 1) Traemos JSON
                const res = await fetch(`<?= base_url('api/inventory/entries/show/') ?>${entryId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!res.ok) {
                    return alert('No se pudo cargar la entrada.');
                }
                const {
                    entry,
                    details
                } = await res.json();

                // 2) Rellenar <dl>
                codeLbl.textContent = `#${entry.codigo}`;
                dl.innerHTML = Object.entries(entryFields).map(([key, label]) => {
                    const val = entry[key] ?? '-';
                    return `
                        <dt class="col-sm-3 mb-2 text-muted">${label}</dt>
                        <dd class="col-sm-9 mb-2 fw-semibold">${val}</dd>
                    `;
                }).join('');

                // 3) Rellenar tabla
                tbody.innerHTML = details.map((d, i) => {
                    // badges series
                    let seriesHtml = '-';
                    if (Array.isArray(d.serials) && d.serials.length) {
                        seriesHtml = d.serials
                            .map(s => `<span class="badge badge-primary me-1 mb-1">${s}</span>`)
                            .join('');
                    }
                    return `
                        <tr>
                            <td>${i+1}</td>
                            <td>${d.codigo}</td>
                            <td>${d.nombre}</td>
                            <td class="text-center">${d.cantidad}</td>
                            <td class="text-center">${seriesHtml}</td>
                        </tr>
                    `;
                }).join('');

                // 4) Mostrar
                modal.show();
            });
        });
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
</script>

<?= $this->endSection(); ?>