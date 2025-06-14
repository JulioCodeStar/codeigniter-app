<?php $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>
Roles y Permisos - Editar | KYP BIOINGENIERIA
<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>
<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Gestor de Roles y Permisos
</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    <li class="breadcrumb-item text-muted">Autenticación</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Roles</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Editar</li>
</ul>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body py-10 px-lg-17">
        <?= form_open(base_url("api/auth/roles/edit/" . esc($rol['id'])), ['id' => 'kt_form_edit_role', 'autocomplete' => 'off']); ?>

        <div class="mb-7">
            <label class="required fs-6 fw-semibold mb-2">Nombre del Rol</label>
            <input type="text" name="nombre" class="form-control form-control-solid" value="<?= esc($rol['nombre']) ?>" required />
        </div>

        <div class="mb-7">
            <label class="fs-6 fw-semibold mb-2">Descripción</label>
            <textarea name="descripcion" class="form-control form-control-solid" rows="2"><?= esc($rol['descripcion']) ?></textarea>
        </div>

        <div class="mb-10">
            <label class="fs-6 fw-bold mb-5">Permisos</label>
            <?php foreach ($modulos as $seccion): ?>
                <div class="mb-7 border p-4 rounded">
                    <h5 class="fw-bold mb-3 text-primary">Sección: <?= esc($seccion['titulo']) ?></h5>

                    <?php foreach ($seccion['subsecciones'] as $sub): ?>
                        <div class="mb-3">
                            <div class="mb-2 fw-semibold text-gray-700">Subsección: <?= esc($sub['titulo']) ?></div>

                            <div class="row">
                                <?php foreach ($sub['permisos'] as $perm): ?>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input class="form-check-input" type="checkbox" name="permisos[]" value="<?= esc($perm['clave']) ?>" id="perm_<?= esc($perm['clave']) ?>"
                                                <?= in_array($perm['clave'], $permisosMarcados) ? 'checked' : '' ?> />
                                            <label class="form-check-label" for="perm_<?= esc($perm['clave']) ?>">
                                                <?= esc($perm['nombre']) ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <button type="click" id="submit_edit_role" class="btn btn-primary">
                <span class="indicator-label">Actualizar</span>
                <span class="indicator-progress">Guardando...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>

        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= csrf_scripts_basic() ?>
<script>
    const formEditRole = document.querySelector("#kt_form_edit_role");

    const validatorEditRole = FormValidation.formValidation(formEditRole, {
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                        message: "El nombre del rol es obligatorio"
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: ".mb-7",
                eleInvalidClass: "",
                eleValidClass: ""
            })
        }
    });

    const submitButton = formEditRole.querySelector('#submit_edit_role');

    submitButton.addEventListener("click", function(e) {
        e.preventDefault();

        if (!validatorEditRole) return;

        validatorEditRole.validate().then(function(status) {
            if (status == 'Valid') {
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                const executeFetch = async () => {
                    try {
                        const response = await fetch(formEditRole.action, {
                            method: 'POST',
                            body: new FormData(formEditRole),
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': getCsrfToken()
                            }
                        });

                        if (response.status === 403) {
                            await updateCsrfToken();
                            return executeFetch(); // Reintenta
                        }

                        const data = await response.json();

                        if (!response.ok || data.status >= 400) {
                            Swal.fire({
                                text: data.message || 'Error al actualizar',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
                            });
                        } else {
                            Swal.fire({
                                text: data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Entendido',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                preConfirm: () => {
                                    if (data.redirect) {
                                        window.location.href = `<?= base_url('users/') ?>${data.redirect}`;
                                    }
                                }
                            });
                        }

                    } catch (error) {
                        console.error('Error:', error);
                    } finally {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    }
                };

                setTimeout(executeFetch, 1000);
            }
        });
    });
</script>
<?= $this->endSection(); ?>