<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Proveedores | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Logística
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Orden de Compra</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Proveedores</li>

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
                <input type="text" data-kt-proveedor-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Proveedor" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createProveedor">
                    <i class="ki-duotone ki-plus fs-2"></i>Agregar Proveedor</a>
            </div>

            <div class="modal fade" id="createProveedor" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_form_proveedor_header">
                            <h2 class="fw-bold">Agregar Proveedor</h2>

                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>

                        <div class="modal-body px-5 my-7">

                            <?= form_open('api/logistica/proveedor/create', ['id' => 'kt_form_proveedor', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_form_proveedor_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_form_proveedor_header" data-kt-scroll-wrappers="#kt_form_proveedor_scroll" data-kt-scroll-offset="300px">

                                <div class="fv-row row mb-7">
                                    <div class="col-6">
                                        <label class="required fw-semibold fs-6 mb-2">Nombre del Proveedor</label>

                                        <input
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="Nombre del Proveedor" />
                                    </div>

                                    <div class="col-6">
                                        <label class="required fw-semibold fs-6 mb-2">Nombre de la Empresa</label>
                                        <input
                                            type="text"
                                            name="empresa"
                                            id="empresa"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="Nombre de la Empresa" />
                                    </div>

                                </div>

                                <div class="fv-row row mb-7">

                                    <div class="col-6">
                                        <label class="required fw-semibold fs-6 mb-2">Telefono</label>
                                        <input
                                            type="text"
                                            name="telefono"
                                            id="telefono"
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            placeholder="Telefono" />
                                    </div>

                                    <div class="col-6">
                                        <label class="fw-semibold fs-6 mb-2">Correo</label>

                                        <input
                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                            type="email"
                                            placeholder="Correo"
                                            id="correo"
                                            name="correo" />
                                    </div>
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Producto</label>
                                    <input
                                        type="text"
                                        name="producto"
                                        id="producto"
                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Producto" />
                                </div>
                            </div>
                            <div class="text-center pt-10">
                                <button
                                    type="reset"
                                    class="btn btn-light me-3"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button
                                    type="click"
                                    id="kt_submit_form_proveedor"
                                    class="btn btn-primary">
                                    <span class="indicator-label">Guardar</span>
                                    <span class="indicator-progress">Guardando...
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body py-4">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_proveedores">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">N°</th>
                    <th class="min-w-125px">Nombres Proveedor</th>
                    <th class="min-w-125px">Producto</th>
                    <th class="min-w-125px">Empresa</th>
                    <th class="min-w-125px">Contacto</th>
                    <th class="min-w-100px">Correo</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($proveedores as $index => $proveedor) : ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= $proveedor['nombre'] ?></td>
                        <td><?= $proveedor['producto'] ?></td>
                        <td><?= $proveedor['empresa'] ?></td>
                        <td><?= $proveedor['telefono'] ?></td>
                        <td><?= $proveedor['email'] ?></td>
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
                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#editProveedor" data-bs-url="<?= base_url('api/logistica/proveedor/show/' . $proveedor['id']) ?>">Editar</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#deleteProveedorModal" data-bs-url="<?= base_url('api/logistica/proveedor/delete/' . $proveedor['id']) ?>">Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- begin::Modal Editar Proveedor -->
<div class="modal fade" id="editProveedor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_form_edit_proveedor_header">
                <h2 class="fw-bold">Editar Proveedor</h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            <div class="modal-body px-5 my-7">

                <?= form_open('', ['id' => 'kt_form_edit_proveedor', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_form_edit_proveedor_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_form_edit_proveedor_header" data-kt-scroll-wrappers="#kt_form_edit_proveedor_scroll" data-kt-scroll-offset="300px">

                    <div class="fv-row row mb-7">
                        <div class="col-6">
                            <label class="required fw-semibold fs-6 mb-2">Nombre del Proveedor</label>

                            <input
                                type="text"
                                name="nombre_edit"
                                id="nombre_edit"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nombre del Proveedor" />
                        </div>

                        <div class="col-6">
                            <label class="required fw-semibold fs-6 mb-2">Nombre de la Empresa</label>
                            <input
                                type="text"
                                name="empresa_edit"
                                id="empresa_edit"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nombre de la Empresa" />
                        </div>

                    </div>

                    <div class="fv-row row mb-7">

                        <div class="col-6">
                            <label class="required fw-semibold fs-6 mb-2">Telefono</label>
                            <input
                                type="text"
                                name="telefono_edit"
                                id="telefono_edit"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Telefono" />
                        </div>

                        <div class="col-6">
                            <label class="fw-semibold fs-6 mb-2">Correo</label>

                            <input
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                type="email"
                                placeholder="Correo"
                                id="correo_edit"
                                name="correo_edit" />
                        </div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Producto</label>
                        <input
                            type="text"
                            name="producto_edit"
                            id="producto_edit"
                            class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="Producto" />
                    </div>
                </div>
                <div class="text-center pt-10">
                    <button
                        type="reset"
                        class="btn btn-light me-3"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button
                        type="click"
                        id="kt_submit_form_edit_proveedor"
                        class="btn btn-primary">
                        <span class="indicator-label">Guardar</span>
                        <span class="indicator-progress">Guardando...
                            <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- end::Modal Editar Proveedor -->

<!--begin::Modal Eliminar -->
<div class="modal fade" tabindex="-1" id="deleteProveedorModal" aria-hidden="true">
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
                <p>¿Deseas Eliminar a este proveedor del sistema?</p>
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
<?= csrf_scripts_basic() ?>
<script>
    const KTDatatables = function() {
        let dt_proveedores;

        const initDatatable = () => {
            dt_proveedores = $("#kt_table_proveedores").DataTable({
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

        const handleSearchProveedores = () => {
            const filter = document.querySelector('[data-kt-proveedor-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt_proveedores.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchProveedores();
            }
        }
    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDatatables.init();
    });

    const form = document.querySelector('#kt_form_proveedor');

    const validator = FormValidation.formValidation(form, {
        fields: {
            'nombre': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
                    }
                }
            },

            'empresa': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
                    }
                }
            },

            'telefono': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
                    }
                }
            },

            'producto': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
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

    const submit = document.querySelector('#kt_submit_form_proveedor');
    submit.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validator) return;

        validator.validate().then(function(status) {
            if (status == 'Valid') {
                submit.setAttribute('data-kt-indicator', 'on');
                submit.disabled = true;

                const executeFetch = async () => {
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

                        if (response.status === 201) {
                            Swal.fire({
                                text: data.message || 'Registro exitoso',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                preConfirm: () => {
                                    if (data.redirect == 'proveedor') {
                                        location.reload();
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                text: data.message || 'Error en el servidor',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
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
            }
        });
    });

    const editarModal = document.querySelector("#editProveedor");
    if (editarModal) {
        editarModal.addEventListener('show.bs.modal', async (event) => {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-bs-url');

            try {
                const res = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await res.json();
                const proveedor = result.data;

                // Completa los campos
                editarModal.querySelector('[name="nombre_edit"]').value = proveedor.nombre;
                editarModal.querySelector('[name="empresa_edit"]').value = proveedor.empresa;
                editarModal.querySelector('[name="telefono_edit"]').value = proveedor.telefono;
                editarModal.querySelector('[name="correo_edit"]').value = proveedor.email;
                editarModal.querySelector('[name="producto_edit"]').value = proveedor.producto;

                // Asigna la URL de envío para actualizar el usuario
                const form = editarModal.querySelector("form");
                form.setAttribute('action', `<?= base_url('api/logistica/proveedor/edit/') ?>/${proveedor.id}`);

            } catch (err) {
                console.error('Error al cargar datos del proveedor:', err);
            }
        });
    }

    const frm_edit = document.querySelector("#kt_form_edit_proveedor");
    const validator_edit = FormValidation.formValidation(form, {
        fields: {
            'nombre_edit': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
                    }
                }
            },

            'empresa_edit': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
                    }
                }
            },

            'telefono_edit': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
                    }
                }
            },

            'producto_edit': {
                validators: {
                    notEmpty: {
                        message: 'El campo es Obligatorio'
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

    const submit_edit = document.querySelector('#kt_submit_form_edit_proveedor');
    submit_edit.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validator_edit) return;

        validator_edit.validate().then(function(status) {
            if (status == 'Valid') {
                submit_edit.setAttribute('data-kt-indicator', 'on');
                submit_edit.disabled = true;

                const executeFetch = async () => {
                    try {
                        const response = await fetch(frm_edit.action, {
                            method: 'POST',
                            body: new FormData(frm_edit),
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

                        if (response.status === 201) {
                            Swal.fire({
                                text: data.message || 'Registro exitoso',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                preConfirm: () => {
                                    if (data.redirect == 'proveedor') {
                                        location.reload();
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                text: data.message || 'Error en el servidor',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        submit_edit.removeAttribute('data-kt-indicator');
                        submit_edit.disabled = false;
                    }
                };

                setTimeout(executeFetch, 2000);
            }
        });
    });

    const eliminarModal = document.querySelector("#deleteProveedorModal");
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