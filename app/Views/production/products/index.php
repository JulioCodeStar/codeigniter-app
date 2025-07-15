<?= $this->extend('layouts/production/layouts/template'); ?>

<?= $this->section('title_production'); ?>
Productos | Producción - LIMP
<?= $this->endSection(); ?>

<?= $this->section('toolbar_production'); ?>
<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Gestión de Producción
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

<?= $this->section('content_production'); ?>

<div class="card mt-5">
    <!--begin::Card header-->
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
            <div class="d-flex justify-content-end" data-kt-product-table-toolbar="base">
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
                    <div class="px-7 py-5" data-kt-product-table-filter="form">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Role:</label>
                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-table-filter="role" data-hide-search="true">
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
                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-table-filter="two-step" data-hide-search="true">
                                <option></option>
                                <option value="Enabled">Enabled</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-product-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-product-table-filter="filter">Apply</button>
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

                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_product">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Agregar Producto
                </a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_product">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="text-center">#Código</th>
                    <th class="min-w-125px">Nombre</th>
                    <th class="min-w-125px">Área</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary fs-6"><?= mb_strtoupper($product['codigo']) ?></span>
                        </td>
                        <td class="d-flex flex-column">
                            <h5><?= mb_strtoupper($product['nombre']) ?></h5>
                            <p class="text-muted"><?= $product['descripcion'] ?></p>
                        </td>
                        <td>
                            <span class="badge badge-light-info"><?= ($product['area']) ?></span>
                        </td>
                        <td class="text-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editarProductoModal" data-bs-url="<?= base_url('api/production/products/show/' . $product['id']) ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarProductoModal" data-bs-url="<?= base_url('api/production/products/delete/') . $product['id'] ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>


<!--begin::Agregar Producto-->
<div class="modal fade" tabindex="-1" id="kt_modal_add_product">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <?= form_open('api/production/products/create', ['id' => 'kt_form_product', 'class' => 'fv-row modal-content', 'autocomplete' => 'off']) ?>

        <div class="modal-header">
            <h3 class="modal-title">Agregar Nuevo Producto</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>

        <div class="modal-body">
            <div class="row g-4">
                <!-- Código -->
                <div class="col-12 col-md-6 fv-row">
                    <label for="codigo" class="form-label">Código</label>
                    <input
                        type="text"
                        class="form-control"
                        id="codigo"
                        name="codigo"
                        placeholder="Ingrese el código" />
                </div>

                <!-- Nombre -->
                <div class="col-12 col-md-6 fv-row">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese el nombre" />
                </div>

                <!-- Descripción -->
                <div class="col-12 fv-row">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        class="form-control"
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                        placeholder="Describa brevemente..."></textarea>
                </div>

                <!-- Select Área -->
                <div class="col-12 col-md-6 fv-row">
                    <label for="area" class="form-label">Área</label>
                    <select class="form-select" id="area" name="area">
                        <option value="" selected>Seleccione un área</option>
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
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="kt_btn_submit_product">
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
<!--end::Agregar Producto-->


<!--begin::Editar Producto-->
<div class="modal fade" tabindex="-1" id="editarProductoModal" aria-hidden="true">
    <div class="modal-dialog">
        <?= form_open('', ['id' => 'kt_form_product_edit', 'class' => 'fv-row modal-content', 'autocomplete' => 'off']) ?>

        <div class="modal-header">
            <h3 class="modal-title">Agregar Nuevo Producto</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>

        <div class="modal-body">
            <div class="row g-4">
                <!-- Código -->
                <div class="col-12 col-md-6 fv-row">
                    <label for="codigo" class="form-label">Código</label>
                    <input
                        type="text"
                        class="form-control"
                        id="codigo_edit"
                        name="codigo_edit"
                        placeholder="Ingrese el código" />
                </div>

                <!-- Nombre -->
                <div class="col-12 col-md-6 fv-row">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre_edit"
                        name="nombre_edit"
                        placeholder="Ingrese el nombre" />
                </div>

                <!-- Descripción -->
                <div class="col-12 fv-row">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        class="form-control"
                        id="descripcion_edit"
                        name="descripcion_edit"
                        rows="3"
                        placeholder="Describa brevemente..."></textarea>
                </div>

                <!-- Select Área -->
                <div class="col-12 col-md-6 fv-row">
                    <label for="area" class="form-label">Área</label>
                    <select class="form-select" id="area_edit" name="area_edit">
                        <option value="" selected>Seleccione un área</option>

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
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="kt_btn_submit_product">
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
<!--end::Editar Producto-->

<!--begin::Eliminar Producto-->
<div class="modal fade" tabindex="-1" id="eliminarProductoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content position-absolute">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Producto</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <p>¿Deseas eliminar este Producto?</p>
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
<!--end::Eliminar Producto-->

<?= $this->endSection(); ?>


<?= $this->section('scripts_production'); ?>
<?= csrf_scripts_basic() ?>
<script>
    const KTDatatables = function() {
        let dt_productos;

        const initDatatable = () => {

            dt_productos = $("#kt_table_product").DataTable({
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

        const handleSearchProduct = () => {
            const filter = document.querySelector('[data-kt-product-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt_productos.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchProduct();
            }
        }
    }();

    KTDatatables.init();

    const form = document.querySelector("#kt_form_product");

    const validator = FormValidation.formValidation(form, {
        fields: {
            codigo: {
                validators: {
                    notEmpty: {
                        message: 'El campo código es obligatorio'
                    }
                }
            },
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El campo nombre es obligatorio'
                    }
                }
            },
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'El campo descripción es obligatorio'
                    }
                }
            },
            area: {
                validators: {
                    notEmpty: {
                        message: 'El campo área es obligatorio'
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

    const submit = document.querySelector('#kt_btn_submit_product');

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
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
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

                    console.log(data);

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
                            window.location.href = '<?= base_url('production/products') ?>';
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

    const eliminarProductoModal = document.querySelector("#eliminarProductoModal");
    if (eliminarProductoModal) {
        eliminarProductoModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-bs-url');

            const form = eliminarProductoModal.querySelector("#form-eliminar");
            form.setAttribute('action', url);
        })
    }

    const editarProductoModal = document.querySelector("#editarProductoModal");
    if (editarProductoModal) {
        editarProductoModal.addEventListener('show.bs.modal', async (event) => {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-bs-url');

            try {
                const res = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await res.json();
                const product = result.data.product;

                // Completa los campos
                editarProductoModal.querySelector('[name="codigo_edit"]').value = product.codigo;
                editarProductoModal.querySelector('[name="nombre_edit"]').value = product.nombre;
                editarProductoModal.querySelector('[name="descripcion_edit"]').value = product.descripcion;
                editarProductoModal.querySelector('[name="area_edit"]').value = product.area;


                // Asigna la URL de envío para actualizar el usuario
                const form = editarProductoModal.querySelector("form");
                form.setAttribute('action', `<?= base_url('api/production/products/edit/') ?>/${product.id}`);

            } catch (err) {
                console.error('Error al cargar datos del usuario:', err);
            }
        })
    }
</script>

<?= $this->endSection(); ?>