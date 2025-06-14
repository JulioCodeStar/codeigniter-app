<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Orden de Trabajo | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Logística
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Orden de Trabajo</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Listado</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card mt-5">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-trabajo-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Orden de Trabajo" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a type="button" class="btn btn-primary" href="<?= base_url('logistica/orden-trabajo/new') ?>">
                    <i class="ki-duotone ki-plus fs-2"></i>Agregar Orden de Trabajo</a>
            </div>
        </div>
    </div>

    <div class="card-body py-4">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_trabajo">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">Código</th>
                    <th class="min-w-125px">Actividad</th>
                    <th class="min-w-125px">Requerido A</th>
                    <th class="min-w-125px">Fecha</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($trabajos as $trabajo) : ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary"><?= $trabajo['codigo'] ?></span>
                        </td>
                        <td><?= $trabajo['actividad'] ?></td>
                        <td><?= $trabajo['requerido_a'] ?></td>
                        <td><?= fecha_dmy($trabajo['created_at']) ?></td>
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
                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#deleteTrabajoModal" data-bs-url="<?= base_url('api/logistica/orden-trabajo/delete/' . $trabajo['id']) ?>">Eliminar</a>
                                </div>

                                <div class="menu-item px-3">
                                    <a href="<?= base_url('api/logistica/orden-trabajo/generate/' . $trabajo['id']) ?>" target="_blank" class="menu-link px-3">Pdf</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!--begin::Modal Eliminar -->
<div class="modal fade" tabindex="-1" id="deleteTrabajoModal" aria-hidden="true">
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
                <p>¿Deseas Eliminar a esta orden de trabajo del sistema?</p>
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
<!--end::Modal Eliminar -->

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    const KTDatatables = function() {
        let dt_trabajo;

        const initDatatable = () => {
            dt_trabajo = $("#kt_table_trabajo").DataTable({
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

        const handleSearchTrabajo = () => {
            const filter = document.querySelector('[data-kt-trabajo-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt_trabajo.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchTrabajo();
            }
        }
    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDatatables.init();
    });

    const eliminarModal = document.querySelector("#deleteTrabajoModal");
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