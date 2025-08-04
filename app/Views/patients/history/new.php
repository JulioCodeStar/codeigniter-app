<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Historial de Pacientes | KYP BIOINGENIERIA

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
        <a href="<?= base_url('history') ?>" class="text-muted text-hover-primary">Historial</a>
    </li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Nuevo</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="mt-5">
    <?= form_open('api/history/create', ['id' => 'kt_patient_history_new', 'class' => 'card fv-form fv-row', 'autocomplete' => 'off']) ?>
    <div class="card-header border-0 pt-6">
        <h2 class="card-title">Registro del Proceso:<strong> <?= esc($getData['nombre']) ?></strong></h2>
        <label for=""><?= esc($getData['paciente']) . ' | ' . $getData['cod_paciente'] ?></label>
    </div>
    <div class="card-body">
        <?= form_hidden('cod_paciente',   esc($getData['cod_paciente'])) ?>
        <?= form_hidden('history_patient_process_id', esc($getData['id'])) ?>
        <div class="row">
            <div class="col-md-4 fv-row">
                <div class="mb-6">
                    <label class="form-label">Fecha del registro</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?= date('Y-m-d') ?>" />
                </div>
            </div>

            <div class="col-md-4 fv-row">
                <div class="mb-6">
                    <label class="form-label">Encargado</label>
                    <input type="text" class="form-control" name="tecnico" id="tecnico" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-6">
                    <label class="form-label">Evaluación Técnica</label>
                    <textarea class="form-control" rows="4" placeholder="Describe la evaluación técnica realizada.." name="evaluacion_tecnica" id="evaluacion_tecnica"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-6">
                    <label class="form-label">Diagnóstico Técnico</label>
                    <textarea class="form-control" rows="4" placeholder="Describe el diagnóstico técnico.." name="diagnostico_tecnico" id="diagnostico_tecnico"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-6">
                    <label class="form-label">Prueba, Ajustes y Observaciones</label>
                    <textarea class="form-control" rows="4" placeholder="Describe las pruebas realizadas y ajustes necesarios.." name="prueba_ajuste_observacion" id="prueba_ajuste_observacion"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-6">
                    <label class="form-label">Observaciones Adicionales</label>
                    <textarea class="form-control" rows="4" placeholder="Observaciones generales, comentarios del paciente, etc.." name="observacion_adicional" id="observacion_adicional"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <!--begin::Label-->
            <label class="col-lg-2 col-form-label text-lg-right">Imagenes del Proceso:</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-10">
                <!--begin::Dropzone-->
                <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_3">
                    <!--begin::Controls-->
                    <div class="dropzone-panel mb-lg-0 mb-2">
                        <a class="dropzone-select btn btn-sm btn-dark me-2">Adjuntar archivos</a>
                        <a class="dropzone-remove-all btn btn-sm btn-light-danger">Eliminar todo</a>
                    </div>
                    <!--end::Controls-->

                    <!--begin::Items-->
                    <div class="dropzone-items wm-200px">
                        <div class="dropzone-item" style="display:none">
                            <!--begin::File-->
                            <div class="dropzone-file">
                                <div class="dropzone-filename" title="some_image_file_name.jpg">
                                    <span data-dz-name>some_image_file_name.jpg</span>
                                    <strong>(<span data-dz-size>340kb</span>)</strong>
                                </div>

                                <div class="dropzone-error" data-dz-errormessage></div>
                            </div>
                            <!--end::File-->

                            <!--begin::Progress-->
                            <div class="dropzone-progress">
                                <div class="progress">
                                    <div
                                        class="progress-bar bg-primary"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                    </div>
                                </div>
                            </div>
                            <!--end::Progress-->

                            <!--begin::Toolbar-->
                            <div class="dropzone-toolbar">
                                <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Dropzone-->

                <!--begin::Hint-->
                <span class="form-text text-muted">El tamaño máximo de archivo es 5 MB y el número máximo de archivos es 4.</span>
                <span class="form-text text-muted">Formatos soportados: JPG, PNG.</span>
                <!--end::Hint-->
            </div>
            <!--end::Col-->
        </div>

        <button id="kt_submit_form_patient_history" type="submit" class="btn btn-primary mt-6 me-2">
            <span class="indicator-label">
                Guardar
            </span>
            <span class="indicator-progress">
                Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>

        <button type="button" class="btn btn-light mt-6" onclick="window.history.back()">Volver</button>
    </div>
    <?= form_close() ?>
</div>
<?= $this->endSection(); ?>


<?= $this->section('scripts') ?>
<script>
    Dropzone.autoDiscover = false;

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector("#kt_patient_history_new");
        const submitButton = document.querySelector("#kt_submit_form_patient_history");
        const dropzoneEl = document.querySelector("#kt_dropzonejs_example_3");
        const id = "#kt_dropzonejs_example_3";

        const validator = FormValidation.formValidation(form, {
            fields: {
                'fecha': {
                    validators: {
                        notEmpty: {
                            message: 'El campo es Obligatorio'
                        }
                    }
                },
                'tecnico': {
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

        // set the preview element template
        const previewNode = dropzoneEl.querySelector(".dropzone-item");
        previewNode.id = "";
        const previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        const myDropzone = new Dropzone(dropzoneEl, {
            url: form.action,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 4,
            maxFiles: 4,
            maxFilesize: 5,
            acceptedFiles: 'image/jpeg,image/png',
            previewTemplate: previewTemplate,
            previewsContainer: id + " .dropzone-items",
            clickable: id + " .dropzone-select",

            init: function() {
                const dz = this;

                submitButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (!validator) return;

                    validator.validate().then(function(status) {
                        if (status !== 'Valid') {
                            return;
                        }

                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        // si hay archivos encolados, los procesamos
                        if (dz.getQueuedFiles().length) {
                            dz.processQueue();
                        } else {
                            setTimeout(() => {
                                executeFetch();
                            }, 2000);
                        }
                    });
                });

                dz.on('addedfile', function(file) {
                    const dropzoneItems = dropzoneEl.querySelectorAll('.dropzone-item');
                    dropzoneItems.forEach(dropzoneItem => {
                        dropzoneItem.style.display = '';
                    });
                });

                dz.on("totaluploadprogress", function(progress) {
                    const progressBars = dropzoneEl.querySelectorAll('.progress-bar');
                    progressBars.forEach(progressBar => {
                        progressBar.style.width = progress + "%";
                    });
                });

                // Antes de enviar cada batch, agregamos los campos del form
                dz.on('sendingmultiple', function(files, xhr, formData) {
                    // Recorremos todos los inputs/textarea del form y los añadimos a formData
                    new FormData(form).forEach((value, key) => {
                        formData.append(key, value);
                    });
                });

                dz.on("sending", function(file) {
                    // Show the total progress bar when upload starts
                    const progressBars = dropzoneEl.querySelectorAll('.progress-bar');
                    progressBars.forEach(progressBar => {
                        progressBar.style.opacity = "1";
                    });
                });

                // Hide the total progress bar when nothing"s uploading anymore
                dz.on("complete", function(progress) {
                    const progressBars = dropzoneEl.querySelectorAll('.dz-complete');

                    setTimeout(function() {
                        progressBars.forEach(progressBar => {
                            progressBar.querySelector('.progress-bar').style.opacity = "0";
                            progressBar.querySelector('.progress').style.opacity = "0";
                        });
                    }, 300);
                });

                dz.on('successmultiple', function(files, response) {
                    // aquí manejas el éxito: rediriges o muestras mensaje
                    Swal.fire({
                        text: response.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'Ok!',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    }).then(() => {
                        window.history.back();
                    });
                });

                dz.on('errormultiple', function(files, response) {
                    Swal.fire({
                        text: response.message,
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Ok!',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                });

                const executeFetch = async () => {
                    try {
                        const data = {};
                        new FormData(form).forEach((v, k) => data[k] = v);
                        fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(data)
                            })
                            .then(r => r.json())
                            .then(json => {
                                if (json.status === 201) {
                                    Swal.fire({
                                        text: json.message,
                                        icon: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: 'Ok!',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        }
                                    }).then(() => {
                                        window.history.back();
                                    });
                                } else {
                                    Swal.fire({
                                        text: json.message,
                                        icon: 'error',
                                        buttonsStyling: false,
                                        confirmButtonText: 'Ok!',
                                        customClass: {
                                            confirmButton: 'btn btn-danger'
                                        }
                                    });
                                }
                            })
                            .catch(err => alert('Error de red: ' + err));
                    } catch (error) {
                        console.error(error);
                    } finally {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    }

                }
            }

        });
    });

</script>
<?= $this->endSection(); ?>