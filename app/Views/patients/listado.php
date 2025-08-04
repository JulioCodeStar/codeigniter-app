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

  <li class="breadcrumb-item text-muted">Gestión de Pacientes</li>

  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>

  <li class="breadcrumb-item text-muted">Listado</li>

</ul>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<!--begin::Card-->
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
        <input type="text" data-kt-patient-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Paciente" />
      </div>
      <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        <!--begin::Export-->
        <button type="button" class="btn btn-light-warning me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
          <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
          Exportar
        </button>

        <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="copy">
              Copy to clipboard
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="excel">
              Export as Excel
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="csv">
              Export as CSV
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-export="pdf">
              Export as PDF
            </a>
          </div>
          <!--end::Menu item-->
        </div>
        <!--end::Export-->

        <div id="kt_datatable_example_buttons" class="d-none"></div>

        <a type="button" class="btn btn-primary" href="<?= base_url('patient/new') ?>">
          <i class="ki-duotone ki-plus fs-2"></i>Agregar Paciente</a>
      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Card toolbar-->
  </div>
  <!--end::Card header-->
  <!--begin::Card body-->
  <div class="card-body py-4">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_patient">
      <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
          <th class="min-w-125px text-center">#Código</th>
          <th class="min-w-125px">Nombres y Apellidos</th>
          <th class="min-w-125px text-center">DNI</th>
          <th class="min-w-125px text-center">Contacto</th>
          <th class="min-w-125px">Estado</th>
          <th class="min-w-100px">Garantía</th>
          <th class="text-end min-w-100px">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-ray-600 fw-semibold">
        <?php foreach ($list as $row) { ?>
          <tr>
            <td class="text-center">
              <span class="badge badge-secondary badge-lg"><?= $row['cod_paciente'] ?></span>
            </td>
            <td><?= mb_strtoupper($row['nombres'] . ' ' . $row['apellidos']) ?></td>
            <td class="text-center"><?= $row['dni'] ?></td>
            <td class="text-center">
              <a href="https://wa.me/51<?= $row['contacto'] ?>" target="_blank" class="btn btn-link btn-color-success btn-active-color-primary">
                <i class="ki-outline ki-whatsapp fs-2"></i>
                <?= $row['contacto'] ?>
              </a>
            </td>
            <td><span class="badge badge-light-primary badge-lg">historial de procesos</span></td>
            <td><span class="badge badge-<?=
                                          $row['estado_contrato'] == 'activa' ? 'success' : ($row['estado_contrato'] == 'sin contrato' ? 'primary' : 'danger')
                                          ?>">
                <?= ucfirst($row['estado_contrato']) ?>
              </span></td>
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
                  <a href="<?= base_url('patient/show/' . $row['id']) ?>" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                    Editar
                  </a>
                </div>

                <div class="menu-item px-3">
                  <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-url="<?= base_url('api/patient/delete/' . $row['id']) ?>">
                    Eliminar
                  </a>
                </div>

                <div class="menu-item px-3">
                  <a href="<?= base_url('patient/generate/' . $row['id']) ?>" target="_blank" class="menu-link px-3">
                    Ver Ficha
                  </a>
                </div>

                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-offset="0,5">

                  <a href="#" class="menu-link px-3">
                    <span class="menu-title">Evaluación</span>
                    <span class="menu-arrow"></span>
                  </a>

                  <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-offset="0,5">

                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">Miembro Superior</span>
                        <span class="menu-arrow"></span>
                      </a>

                      <div class="menu-sub menu-sub-dropdown w-200px py-4">
                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/mano-parcial') ?>" target="_blank" class="menu-link px-3">
                            Mano Parcial
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/falange-mecanica') ?>" target="_blank" class="menu-link px-3">
                            Falange Mecánica
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/transradial') ?>" target="_blank" class="menu-link px-3">
                            Transradial
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/transhumeral') ?>" target="_blank" class="menu-link px-3">
                            Transhumeral
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/desarticulado-hombro') ?>" target="_blank" class="menu-link px-3">
                            Desarticulado de Hombro
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-offset="0,5">

                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">Miembro Inferior</span>
                        <span class="menu-arrow"></span>
                      </a>

                      <div class="menu-sub menu-sub-dropdown w-200px py-4">
                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/transfemoral') ?>" target="_blank" class="menu-link px-3">
                            Transfemoral | Rodilla
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/transtibial') ?>" target="_blank" class="menu-link px-3">
                            Transtibial | Syme
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/cadera') ?>" target="_blank" class="menu-link px-3">
                            Cadera
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/pie') ?>" target="_blank" class="menu-link px-3">
                            Chopart | Linsfrack | Metatarsal
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/bilateral-transfemoral') ?>" target="_blank" class="menu-link px-3">
                            Bil. Transfemoral
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/bilateral-transtibial') ?>" target="_blank" class="menu-link px-3">
                            Bil. Transtibial
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="menu-item px-3">
                      <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/estetica') ?>" target="_blank" class="menu-link px-3">
                        Estética
                      </a>
                    </div>
                  </div>
                </div>

                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-offset="0,5">

                  <a href="#" class="menu-link px-3">
                    <span class="menu-title">Medidas</span>
                    <span class="menu-arrow"></span>
                  </a>

                  <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-offset="0,5">

                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">Miembro Superior</span>
                        <span class="menu-arrow"></span>
                      </a>

                      <div class="menu-sub menu-sub-dropdown w-200px py-4">
                        <div class="menu-item px-3">
                          <a href="<?= base_url('patient/generate_evaluacion/' . $row['id'] . '/mano-parcial') ?>" target="_blank" class="menu-link px-3">
                            Mano Parcial
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Falange Mecánica
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Transradial
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="# target=" _blank" class="menu-link px-3">
                            Transhumeral
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Desarticulado de Hombro
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-offset="0,5">

                      <a href="#" class="menu-link px-3">
                        <span class="menu-title">Miembro Inferior</span>
                        <span class="menu-arrow"></span>
                      </a>

                      <div class="menu-sub menu-sub-dropdown w-200px py-4">
                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Transfemoral | Rodilla
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Transtibial | Syme
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Cadera
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Chopart | Linsfrack
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Metatarsal
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Bil. Transfemoral
                          </a>
                        </div>

                        <div class="menu-item px-3">
                          <a href="#" target="_blank" class="menu-link px-3">
                            Bil. Transtibial
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="menu-item px-3">
                      <a href="#" target="_blank" class="menu-link px-3">
                        Estética
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!--end::Table-->
  </div>
  <!--end::Card body-->
</div>
<!--end::Card-->


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
        <p>¿Deseas Eliminar a este paciente del sistema?</p>
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


<?= $this->section('scripts') ?>
<script>
  const KTDataTablesPatient = function() {

    let dt;
    const form = document.querySelector("#kt_form_delete");

    const initDatatable = () => {
      dt = $("#kt_table_patient").DataTable({
        searchDelay: 500,
        responsive: true,
        processing: true,
        order: [
          [0, 'desc']
        ],
        "language": {
          "url": "<?= base_url('assets/i18n/Spanish.json') ?>"
        }
      });
    }

    const exportButtons = () => {
      const documentTitle = 'Pacientes';
      const columnasAExportar = [0, 1, 2, 3, 4, 5];
      const buttons = new $.fn.dataTable.Buttons(dt, {
        buttons: [{
            extend: 'copyHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          },
          {
            extend: 'excelHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          },
          {
            extend: 'csvHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          },
          {
            extend: 'pdfHtml5',
            title: documentTitle,
            exportOptions: {
              columns: columnasAExportar
            }
          }
        ]
      }).container().appendTo($('#kt_datatable_example_buttons'));

      // Hook dropdown menu click event to datatable export buttons
      const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
      exportButtons.forEach(exportButton => {
        exportButton.addEventListener('click', e => {
          e.preventDefault();

          // Get clicked export value
          const exportValue = e.target.getAttribute('data-kt-export');
          const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

          // Trigger click event on hidden datatable export buttons
          target.click();
        });
      });
    }

    const handleSearchPatient = () => {
      const filter = document.querySelector('[data-kt-patient-table-filter="search"]');
      filter.addEventListener('keyup', function(e) {
        dt.search(e.target.value).draw();
      });
    }

    return {
      init: function() {
        initDatatable();
        handleSearchPatient();
        exportButtons();
      }
    }

  }();

  KTUtil.onDOMContentLoaded(function() {
    KTDataTablesPatient.init();
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