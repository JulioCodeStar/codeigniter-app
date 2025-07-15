<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Productos | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>

<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Catálogo de Productos
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Productos</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Listado</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content_inventory'); ?>

<div class="row my-5 g-4">
    <!-- Total Productos -->
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-box fs-1 text-primary me-3"></i>
                <div>
                    <div class="text-muted small">Total Productos</div>
                    <div class="h4 mb-0"><?= $totalProducts ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Con Número Serie -->
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-upc-scan fs-1 text-success me-3"></i>
                <div>
                    <div class="text-muted small">Productos Con Número Serie</div>
                    <div class="h4 mb-0"><?= $totalProductsWithSerialNumber ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Bajo -->
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-exclamation-triangle fs-1 text-warning me-3"></i>
                <div>
                    <div class="text-muted small">Stock Bajo</div>
                    <div class="h4 mb-0">1</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categorías -->
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-tags fs-1 text-purple me-3"></i>
                <div>
                    <div class="text-muted small">Categorías</div>
                    <div class="h4 mb-0"><?= $totalCategories ?></div>
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
                <input type="text" data-kt-product-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Producto" />
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

                <a type="button" class="btn btn-primary" href="<?= base_url('inventory/products/new') ?>">
                    <i class="ki-duotone ki-plus fs-2"></i>Agregar Producto</a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>

    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_product">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">#Código</th>
                    <th class="max-w-250px">Nombre del Producto</th>
                    <th class="min-w-125px text-center">Área</th>
                    <th class="text-center">Categoría</th>
                    <th class="text-center">Unidad</th>
                    <th class="min-w-125px  text-center">Stock Total</th>
                    <th class="text-center">N° Serie</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary badge-lg"><?= $product['codigo'] ?></span>
                        </td>
                        <td>
                            <?= $product['nombre'] ?>
                            <p class="text-muted small"><?= $product['descripcion'] ?></p>
                        </td>
                        <td class="text-center">
                            <?= $product['area_nombre'] ?>

                        </td>
                        <td class="text-center"><?= $product['categoria'] ?></td>
                        <td class="text-center"><?= $product['unidad_nombre'] ?></td>
                        <td class="text-center">
                            <div class="text-muted small">Min: <?= intval($product['stock_min']) ?> | Max: <?= intval($product['stock_max']) ?></div>
                        </td>
                        <td class="text-center">
                            <span class="badge <?= $product['requiere_serie'] ? 'badge-dark' : 'badge-light' ?> badge-lg"><?= $product['requiere_serie'] ? 'Sí' : 'No' ?></span>
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
                                    <a href="<?= base_url('api/inventory/products/show/' . $product['id']) ?>" class="menu-link px-3">Editar</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-url="<?= base_url('api/inventory/products/delete/' . $product['id']) ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <!--end::Table-->
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
                <p>¿Deseas Eliminar este producto del sistema?</p>
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
    const KTDataTablesProduct = function() {

        let dt;

        const initDatatable = () => {
            dt = $("#kt_table_product").DataTable({
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

        const handleSearchProduct = () => {
            const filter = document.querySelector('[data-kt-product-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchProduct();
            }
        }

    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDataTablesProduct.init();
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