<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Gestion de Pacientes | KYP BIOINGENIERIA

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

    <li class="breadcrumb-item text-muted">Resumen</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<button class="btn btn-dark btn-sm mt-5">
    <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
    <span class="ms-1">Descargar Historial Completo</span>
</button>

<div class="card mt-5">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title">Información del Paciente</h3>
    </div>
    <div class="card-body py-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h6 class="text-muted mb-1">Paciente</h6>
                <p class="mb-0"><?= mb_strtoupper($getData['paciente']) . ' | ' . $getData['cod_paciente'] ?></p>
            </div>

            <div class="col-md-4 mb-3">
                <h6 class="text-muted mb-1">Tipo de Trabajo</h6>
                <p class="mb-0"><?= $getData['trabajo'] ?></p>
            </div>

            <!-- Estado General -->
            <div class="col-md-4 mb-3">
                <h6 class="text-muted mb-1">Estado General</h6>
                <span class="badge badge-<?= $getData['estado_general'] === 'En Proceso' ? 'warning' : 'success' ?>"><?= $getData['estado_general'] ?></span>
            </div>

            <!-- Proceso Actual -->
            <div class="col-md-4 mb-3">
                <h6 class="text-muted mb-1">Proceso Actual</h6>
                <p class="mb-0 fw-semibold"><?= $getData['proceso_actual'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-5">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title">Procesos del Tratamiento</h3>
    </div>
    <div class="card-body py-4">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_history_process">
            <thead>
                <tr class="fw-bold fs-5 text-gray-800">
                    <th>Proceso</th>
                    <th>Estado</th>
                    <th>Registros</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php foreach ($processes as $p): ?>
                    <tr>
                        <td>
                            <?php if ($p->estado === 'Completado'): ?>
                                <i class="ki-duotone ki-check-circle text-success fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            <?php else: ?>
                                <i class="ki-duotone ki-time text-warning fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            <?php endif ?>
                            <?= esc($p->proceso) ?>
                        </td>
                        <td>
                            <span class="badge <?= $p->estado === 'Completado' ? 'badge-success' : 'badge-warning' ?>">
                                <?= esc($p->estado) ?>
                            </span>
                        </td>
                        <td><?= esc($p->registros) ?> registro(s)</td>
                        <td class="text-end">
                            <a href="<?= base_url("history/new/{$p->id}") ?>"
                                class="btn btn-sm btn-dark">
                                <i class="bi bi-plus-lg"></i> Agregar registro
                            </a>
                            <?php if ($p->estado === 'En Proceso' && (int) $p->registros > 0): ?>
                                <button id="completeProcess" type="button" class="btn btn-success btn-sm" data-url="<?= base_url("api/history/completar-proceso/{$p->id}") ?>">
                                    <span class="indicator-label">
                                        <i class="bi bi-check2-circle"></i> Completar Proceso
                                    </span>
                                    <span class="indicator-progress">
                                        Completando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-5">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title">Historial de Registros</h3>
        <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <input type="text" data-kt-history-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Registro" />
        </div>
    </div>
    <div class="card-body py-4">
        <table class="table align-middle table-striped fs-6 gy-5" id="kt_table_history_register">
            <thead>
                <tr class="fw-bold fs-5 text-gray-800">
                    <th>Fecha</th>
                    <th>Proceso</th>
                    <th>Imágenes</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                <?php foreach ($historyRegisters as $r): ?>
                    <tr>
                        <td><?= esc(fecha_spanish($r->fecha)) ?></td>
                        <td>
                            <span class="badge bg-light-primary text-primary"><?= esc($r->proceso) ?></span>
                        </td>
                        <td>
                            <i class="bi bi-image"></i> <?= esc($r->imagenes) ?>
                        </td>
                        <td class="text-end">
                            <a href="#"
                                class="btn btn-sm btn-light btn-active-primary me-2 btn-ver-detalle"
                                data-bs-toggle="modal"
                                data-bs-target="#viewRegisterModal"
                                data-register-id="<?= $r->id ?>">
                                <i class="bi bi-eye"></i> Ver detalle
                            </a>
                            <a href="<?= base_url("api/history/generate/{$r->id}") ?>"
                                target="_blank"
                                class="btn btn-sm btn-secondary">
                                <i class="bi bi-download"></i> PDF
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="viewRegisterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- HEADER sin fondo coloreado -->
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Registro - <span id="viewHistoryData"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 fv-row">
                        <div class="mb-6">
                            <label class="form-label text-gray-600">Fecha del registro</label>
                            <p id="fecha"></p>
                        </div>
                    </div>

                    <div class="col-md-4 fv-row">
                        <div class="mb-6">
                            <label class="form-label text-gray-600">Encargado</label>
                            <p id="tecnico"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label class="form-label text-gray-600">Evaluación Técnica</label>
                            <p id="evaluacion_tecnica"></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-6">
                            <label class="form-label text-gray-600">Diagnóstico Técnico</label>
                            <p id="diagnostico_tecnico"></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-6">
                            <label class="form-label text-gray-600">Prueba, Ajustes y Observaciones</label>
                            <p id="prueba_ajuste_observacion"></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-6">
                            <label class="form-label text-gray-600">Observaciones Adicionales</label>
                            <p id="observacion_adicional"></p>
                        </div>
                    </div>
                </div>

                <p class="mt-6">
                    <label class="form-label text-gray-600">Imágenes</label>
                <div id="imagenes"></div>
                </p>

            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>


<?= $this->section('scripts') ?>
<script>
    const KTDataTablesHistory = function() {

        let dt;

        const initDatatable = () => {
            dt = $("#kt_table_history_register").DataTable({
                searchDelay: 500,
                processing: true,
                order: [
                    [3, 'desc']
                ],
                "language": {
                    "url": "<?= base_url('assets/i18n/Spanish.json') ?>"
                }
            });
        }

        const handleSearchHistory = () => {
            const filter = document.querySelector('[data-kt-history-table-filter="search"]');
            filter.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        return {
            init: function() {
                initDatatable();
                handleSearchHistory();
            }
        }

    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDataTablesHistory.init();
    });

    const buttonComplete = document.querySelector("#completeProcess");

    if (buttonComplete) {
        buttonComplete.addEventListener("click", function(e) {
            e.preventDefault();
            buttonComplete.setAttribute('data-kt-indicator', 'on');
            buttonComplete.disabled = true;

            const executeFetch = async () => {
                try {
                    const response = await fetch(buttonComplete.dataset.url, {
                        method: 'POST',
                    })

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
                    console.log(error);
                } finally {
                    buttonComplete.removeAttribute('data-kt-indicator');
                    buttonComplete.disabled = false;
                }
            }

            setTimeout(executeFetch, 2000);

        });
    }

    document.addEventListener('DOMContentLoaded', () => {


        const modalEl = document.querySelector('#viewRegisterModal');
        const modal = new bootstrap.Modal(modalEl);

        document.querySelectorAll('.btn-ver-detalle').forEach(btn => {
            btn.addEventListener('click', async (event) => {
                event.preventDefault();
                const id = event.currentTarget.dataset.registerId;

                const res = await fetch(`<?= base_url('api/history/ver-registro/') ?>${id}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!res.ok) {
                    return alert('No se pudo cargar el registro.');
                }
                const data = await res.json();

                document.getElementById('viewHistoryData').textContent = data.paciente + ' | ' + data.cod_paciente;
                document.getElementById('fecha').textContent = data.fecha;
                document.getElementById('tecnico').textContent = data.tecnico;
                document.getElementById('evaluacion_tecnica').textContent = data.evaluacion;
                document.getElementById('diagnostico_tecnico').textContent = data.diagnostico;
                document.getElementById('prueba_ajuste_observacion').textContent = data.pruebas;
                document.getElementById('observacion_adicional').textContent = data.observaciones;

                const imagesContainer = document.getElementById('imagenes');
                // Clear existing images
                imagesContainer.innerHTML = '';

                // Create a row for images
                const row = document.createElement('div');
                row.className = 'row g-3';

                // Create a column for each image
                data.imagenes.forEach((image, index) => {
                    const col = document.createElement('div');
                    col.className = 'col-md-6';

                    const img = document.createElement('img');
                    img.src = `<?= base_url('') ?>${image['ruta_imagen']}`;
                    img.className = 'img-fluid';
                    img.alt = 'Imagen del registro';
                    img.style = 'max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 8px;';

                    col.appendChild(img);
                    row.appendChild(col);
                });

                imagesContainer.appendChild(row);
            });
        });
    });
</script>
<?= $this->endSection(); ?>