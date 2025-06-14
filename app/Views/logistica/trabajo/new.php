<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Crear Orden de Trabajo | KYP BIOINGENIERIA

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

    <li class="breadcrumb-item text-muted">Nuevo</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-flush h-lg-100 mt-5">

    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-user-square fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            <h2>Agregar Nueva Orden de Trabajo</h2>
        </div>
    </div>

    <div class="card-body pt-5">

        <?= form_open('api/logistica/orden-trabajo/create', ['id' => 'kt_trabajo_new', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

        <!-- Nivel de Necesidad -->
        <div class="mb-3 fv-row">
            <label for="nivel_necesidad" class="form-label">Nivel de Necesidad</label>
            <select class="form-select" id="nivel_necesidad" name="nivel_necesidad">
                <option value="" selected disabled>Seleccione ⟶</option>
                <option value="Urgente">Urgente</option>
                <option value="Importante">Importante</option>
                <option value="Pendiente">Pendiente</option>
            </select>
        </div>

        <!-- Requerido Por -->
        <div class="mb-3 fv-row">
            <label for="area_responsable" class="form-label">Requerido Por</label>
            <select data-control="select2" data-placeholder="Seleccionar Area" class="form-select" id="area_responsable" name="area_responsable">
                <option value="" selected disabled>Seleccione ⟶</option>
                <option value="Front Desk">Front Desk</option>
                <option value="Biomecánica">Biomecánica</option>
                <option value="Administración Lima">Administración Lima</option>
                <option value="Administración Arequipa">Administración Arequipa</option>
                <option value="Administración Chiclayo">Administración Chiclayo</option>
                <option value="Logística">Logística</option>
                <option value="Producción">Producción</option>
                <option value="Marketing">Marketing</option>
                <option value="Sistemas">Sistemas</option>
                <option value="Desarrollo Tecnológico">Desarrollo Tecnológico</option>
                <option value="Ventas">Ventas</option>
                <option value="Limpieza">Limpieza</option>
                <option value="Estética">Estética</option>
                <option value="Fisioterapia">Fisioterapia</option>
                <option value="Área Textil">Área Textil</option>
                <option value="RRHH">RRHH</option>
            </select>
        </div>

        <!-- Aprobado Por -->
        <div class="mb-3 fv-row">
            <label for="aprobado_por" class="form-label">Aprobado Por</label>
            <input type="text" class="form-control" id="aprobado_por" name="aprobado_por" placeholder="Ingrese nombre">
        </div>

        <!-- Actividad a Realizar -->
        <div class="mb-3 fv-row">
            <label for="actividad" class="form-label">Actividad a Realizar</label>
            <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Detalle de la actividad">
        </div>

        <!-- Descripción -->
        <div class="mb-3 fv-row">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Describa la tarea o requerimiento"></textarea>
        </div>

        <!-- Requerido A -->
        <div class="mb-3 fv-row">
            <label for="requerido_a" class="form-label">Requerido A</label>
            <select data-control="select2" data-placeholder="Seleccionar Area" class="form-select" id="requerido_a" name="requerido_a">
                <option value="" selected disabled>Seleccione ⟶</option>
                <option value="Front Desk">Front Desk</option>
                <option value="Biomecánica">Biomecánica</option>
                <option value="Administración Lima">Administración Lima</option>
                <option value="Administración Arequipa">Administración Arequipa</option>
                <option value="Administración Chiclayo">Administración Chiclayo</option>
                <option value="Logística">Logística</option>
                <option value="Producción">Producción</option>
                <option value="Marketing">Marketing</option>
                <option value="Sistemas">Sistemas</option>
                <option value="Desarrollo Tecnológico">Desarrollo Tecnológico</option>
                <option value="Ventas">Ventas</option>
                <option value="Limpieza">Limpieza</option>
                <option value="Estética">Estética</option>
                <option value="Fisioterapia">Fisioterapia</option>
                <option value="Área Textil">Área Textil</option>
                <option value="RRHH">RRHH</option>
            </select>
        </div>

        <!-- Responsable de la Ejecución -->
        <div class="mb-3 fv-row">
            <label for="responsable" class="form-label">Responsable de la Ejecución</label>
            <input type="text" class="form-control" id="responsable" name="responsable" placeholder="Nombre del responsable">
        </div>

        <!-- Fecha Estimada de Entrega -->
        <div class="mb-4 fv-row">
            <label for="tiempo_ejecucion" class="form-label">Fecha estimada de entrega</label>
            <input type="date" class="form-control" id="tiempo_ejecucion" name="tiempo_ejecucion">
        </div>

        <!-- Botón -->
        <button id="kt_submit_form_trabajo" type="submit" class="btn btn-primary">
            <span class="indicator-label">
                Guardar
            </span>
            <span class="indicator-progress">
                Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>

        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<?= csrf_scripts_basic() ?>
<script>
    const form = document.querySelector("#kt_trabajo_new");

    const validator = FormValidation.formValidation(form, {
        fields: {
            'nivel_necesidad': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },

            'area_responsable': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },

            'nivel_necesidad': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'area_responsable': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'aprobado_por': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'actividad': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'requerido_a': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'responsable': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
            'tiempo_ejecucion': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    }
                }
            },
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

    const submit = document.querySelector('#kt_submit_form_trabajo');
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
                            text: data.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok!',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        }).then(() => {
                            window.location.href = '<?= base_url('logistica/orden-trabajo') ?>';
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

        })
    });
</script>
<?= $this->endSection(); ?>