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
                <h6 class="card-title">Total Requerimientos</h6>
                <div class="card-number"><?= $countRequirements ?></div>
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
                <div class="card-number"><?= $countRequirementsPending ?></div>
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
                <div class="card-number"><?= $countRequirementsApproved ?></div>
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
                <div class="card-number"><?= $countRequirementsTransit ?></div>
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
                <input type="text" data-kt-requirements-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Requerimiento" />
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

                <a type="button" class="btn btn-primary" href="<?= base_url('inventory/requirements/new') ?>">
                    <i class="ki-duotone ki-plus fs-2"></i>Registrar Requerimiento</a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>

    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_requirements">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">#Código</th>
                    <th class="max-w-50px">Fecha</th>
                    <th class="min-w-125px">Área Soli.</th>
                    <th class="min-w-125px">Nombre Soli.</th>
                    <th class="min-w-125px">Estado</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($requirements as $requirement) : ?>

                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary badge-lg">#<?= $requirement['codigo'] ?></span>
                        </td>
                        <td><?= fecha_dmy($requirement['created_at']) ?></td>
                        <td><?= $requirement['area_solicitante'] ?></td>
                        <td><?= $requirement['nombre_solicitante'] ?></td>
                        <td>
                            <?php
                            $badgeClass = match ($requirement['estado']) {
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
                                <?= $requirement['estado'] ?>
                            </span>
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
                                        data-requirement-id="<?= $requirement['id'] ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewRequirementModal">
                                        Ver
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-url="<?= base_url('api/inventory/requirements/delete/' . $requirement['id']) ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="<?= base_url('api/inventory/requirements/generate-pdf/' . $requirement['id']) ?>" target="_blank" class="menu-link px-3" >Pdf</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--end::Table-->
    </div>
</div>


<!-- Modal Ver Requerimiento -->
<div class="modal fade" id="viewRequirementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- HEADER sin fondo coloreado -->
            <div class="modal-header">
                <h5 class="modal-title">Detalle de Requerimiento <span class="badge badge-primary" id="viewRequirementCode">#</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- Cabecera de datos en fondo celeste claro -->
                <div class="p-4 mb-4 rounded bg-primary bg-opacity-10">
                    <dl class="row mb-0" id="viewRequirementDl"></dl>
                </div>

                <div class="table-responsive">
                    <!-- Tabla de detalles -->
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 3rem">#</th>
                                <th>Producto</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th class="text-center" style="width: 6rem">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="viewRequirementDetailsBody"></tbody>
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
                <p>¿Deseas Eliminar esta orden de requerimiento del sistema?</p>
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
    const KTDataTablesRequirements = function() {

        let dt;

        const initDatatable = () => {
            dt = $("#kt_table_requirements").DataTable({
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

        const handleSearchRequirements = () => {
            const filter = document.querySelector('[data-kt-requirements-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchRequirements();
            }
        }

    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDataTablesRequirements.init();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('viewRequirementModal');
        const modal = new bootstrap.Modal(modalEl);
        const codeLbl = modalEl.querySelector('#viewRequirementCode');
        const dl = modalEl.querySelector('#viewRequirementDl');
        const tbody = modalEl.querySelector('#viewRequirementDetailsBody');

        // Mapeo campo => etiqueta
        const headerMap = {
            area_solicitante: 'Área Solicitante',
            nombre_solicitante: 'Solicitante',
            sede_origen: 'Sede Origen',
            sede_destino: 'Sede Destino',
            estado: 'Estado',
            created_at: 'Creado el'
        };

        document.querySelectorAll('.view-requirement-button').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                const reqId = this.dataset.requirementId;

                // 1) Llamada AJAX
                const res = await fetch(`<?= base_url('api/inventory/requirements/show/') ?>${reqId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!res.ok) {
                    return Swal.fire({
                        icon: 'error',
                        text: 'No se pudo cargar el requerimiento'
                    });
                }
                const {
                    requirement,
                    details
                } = await res.json();

                // 2) Cabecera: código + <dl>
                codeLbl.textContent = `#${requirement.codigo}`;
                dl.innerHTML = Object.entries(headerMap).map(([field, label]) => {
                    let val = requirement[field] ?? '-';
                    // para fechas, formatea bonito
                    if (field === 'created_at' && val) {
                        val = new Date(val).toLocaleString('es-PE', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        }); //YYYY-MM-DD 
                    }
                    return `
                        <dt class="col-sm-3 mb-2 text-muted">${label}</dt>
                        <dd class="col-sm-9 mb-2 fw-semibold">${val}</dd>
                    `;
                }).join('');

                // 3) Detalles en la tabla
                tbody.innerHTML = details.map(d => `
                    <tr>
                        <td>${d.id}</td>
                        <td>${d.producto}</td>
                        <td>${d.tipo}</td>
                        <td>${d.descripcion}</td>
                        <td class="text-center">${d.cantidad}</td>
                    </tr>
                `).join('');

                // 4) Mostrar modal
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