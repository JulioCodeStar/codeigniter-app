<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Gestion de Pacientes - Carta de Consentimiento | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Mantenimiento de Pacientes
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Pacientes</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">
        <a href="<?= base_url('consentimiento') ?>" class="text-muted text-hover-primary">Carta de Consentimiento</a>
    </li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Modificar</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= form_open('api/consentimiento/update/' . $consentimiento['id'], ['id' => 'kt_consen_form_update', 'class' => 'fv-row mt-5', 'autocomplete' => 'off']) ?>
<div class="d-flex flex-column flex-lg-row">
    <!-- begin::Content -->
    <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
        <div class="card card-flush h-lg-100">
            <div class="card-header pt-7">
                <div class="card-title">
                    <i class="ki-duotone ki-user-square fs-1 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900"><?= $cod_paciente ?> | <?= $paciente ?></span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6"><?= $trabajo ?></span>
                    </h3>
                </div>
            </div>
            <div class="card-body p-12">
                <div class="table-responsive mb-10">
                    <?php $items = json_decode($consentimiento['items'], true); ?>
                    <!--begin::Table-->
                    <table class="table g-5 gs-0 mb-0 fw-bold text-gray-700" data-kt-element="items">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="border-bottom fs-7 fw-bold text-gray-700 text-uppercase">
                                <th class="min-w-300px w-900px">Item</th>
                                <th colspan="2" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                                <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                    <td class="pe-7 d-flex flex-column gap-2">
                                        <input type="text" class="form-control  form-control-solid" name="description[]" id="description[]" placeholder="Descripción" value="<?= $item['descripcion'] ?>" />
                                    </td>
                                    <td colspan="2" class="pt-5 text-end">
                                        <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <!--end::Table body-->
                        <!--begin::Table foot-->
                        <tfoot>
                            <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                                <th class="text-primary">
                                    <button class="btn btn-link py-1" data-kt-element="add-item">Agregar Item</button>
                                </th>
                            </tr>
                        </tfoot>
                        <!--end::Table foot-->
                    </table>
                </div>

                <!--begin::Item template-->
                <table class="table d-none" data-kt-element="item-template">

                    <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                        <td class="pe-7 d-flex flex-column gap-2">
                            <input type="text" class="form-control form-control-solid" id="decription[]" name="description[]" placeholder="Descripción" />
                        </td>
                        <td colspan="2" class="pt-5 text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                <i class="ki-duotone ki-trash fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                        </td>
                    </tr>

                </table>
                <table class="table d-none" data-kt-element="empty-template">
                    <tr data-kt-element="empty">
                        <th colspan="5" class="text-muted text-center py-10">No items</th>
                    </tr>
                </table>
                <!--end::Item template-->

                <input type="hidden" name="contrato_id" id="contrato_id" value="<?= $id ?>">
            </div>
        </div>
    </div>
    <!-- end::Content -->

    <!-- begin::Sidebar -->
    <div class="flex-lg-auto min-w-lg-300px">
        <div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-900">Información del Documento</span>
                </h3>
            </div>
            <div class="card-body p-10">
                <div class="mb-10 fv-row">
                    <label class="form-label fw-bold fs-6 text-gray-700 required">Fecha de Entrega</label>
                    <input type="date" class="form-control form-control-solid" name="fecha_entrega" id="fecha_entrega" value="<?= date('Y-m-d', strtotime($consentimiento['fecha_entrega'])) ?>" required />
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label fw-bold fs-6 text-gray-700 required">Fecha de Creación</label>
                    <input type="date" class="form-control form-control-solid" name="created_at" id="created_at" value="<?= date('Y-m-d', strtotime($consentimiento['created_at'])) ?>" required />
                </div>

                <div class="separator separator-dashed mb-8"></div>

                <div class="mb-2">
                    <a href="<?= base_url('api/consentimiento/carta_provisional/' . $id) ?>" target="_blank" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary w-100" id="kt_provicional_submit_button">
                        Carta Provisional
                    </a>
                </div>

                <div class="mb-2">
                    <a href="<?= base_url('api/consentimiento/carta_final/' . $id) ?>" target="_blank" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger w-100" id="kt_entrega_submit_button">
                        Carta Final
                    </a>
                </div>

                <div class="mb-10">
                    <a href="<?= base_url('api/consentimiento/imagen/' . $id) ?>" target="_blank" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success w-100" id="kt_entrega_submit_button">
                        Carta Imagen
                    </a>
                </div>

                <div class="separator separator-dashed mb-8"></div>

                <div class="mb-0">
                    <button type="button" href="#" class="btn btn-primary w-100" id="kt_consen_submit_button">
                        <i class="ki-duotone ki-triangle fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <span class="indicator-label">
                            Actualizar
                        </span>
                        <span class="indicator-progress">
                            Actualizando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- end::Sidebar -->
</div>
<?= form_close() ?>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<?= csrf_scripts_basic() ?>
<script>
    const KTAppCartaConsen = (function() {
        let form;
        const verificarItems = () => {
            const tbody = form.querySelector('tbody');
            if (tbody.querySelectorAll('[data-kt-element="item"]').length === 0) {
                // Si no hay ítems, se podría agregar una fila vacía o mensaje
                const filaVacia = document.createElement('tr');
                filaVacia.innerHTML = `<td colspan="3" class="text-muted text-center">No hay ítems</td>`;
                filaVacia.setAttribute('data-kt-element', 'empty');
                tbody.appendChild(filaVacia);
            } else {
                // Elimina la fila vacía si ya hay ítems
                const filaVacia = tbody.querySelector('[data-kt-element="empty"]');
                if (filaVacia) filaVacia.remove();
            }
        };

        // 👉 Inicializar el módulo
        const init = () => {
            form = document.querySelector("#kt_consen_form_update");

            // 🔘 Agregar nuevo ítem
            form.querySelector('[data-kt-element="add-item"]').addEventListener("click", (e) => {
                e.preventDefault();
                const plantilla = form.querySelector('[data-kt-element="item-template"] tr').cloneNode(true);
                form.querySelector("tbody").appendChild(plantilla);
                verificarItems();
            });

            // 🗑️ Eliminar ítem
            form.addEventListener("click", function(e) {
                if (e.target.closest('[data-kt-element="remove-item"]')) {
                    e.preventDefault();
                    e.target.closest('[data-kt-element="item"]').remove();
                    verificarItems();
                }
            });
        };

        return {
            init
        };
    })();

    KTUtil.onDOMContentLoaded(function() {
        KTAppCartaConsen.init();
    });

    const form_data = document.querySelector('#kt_consen_form_update');

    const validator = FormValidation.formValidation(form_data, {
        fields: {
            fecha_entrega: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de entrega es obligatoria'
                    }
                }
            },

            created_at: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de creación es obligatoria'
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

    const submit = document.querySelector('#kt_consen_submit_button');
    submit.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validator) return;

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            submit.setAttribute('data-kt-indicator', 'on');
            submit.disabled = true;

            const executeFetch = async () => {
                try {
                    const response = await fetch(form_data.action, {
                        method: 'POST',
                        body: new FormData(form_data),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        },
                    })

                    if (response.status === 403) {
                        await updateCsrfToken();
                        return executeFetch();
                    }

                    const data = await response.json();

                    if (data.status === 201) {
                        Swal.fire({
                            text: data.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok!',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            text: data.message,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok!',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }
                } catch (error) {
                    console.error(error);
                } finally {
                    submit.removeAttribute('data-kt-indicator');
                    submit.disabled = false;
                }
            };

            setTimeout(executeFetch, 2000);
        })
    });
</script>
<?= $this->endSection(); ?>