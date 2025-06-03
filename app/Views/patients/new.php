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

  <li class="breadcrumb-item text-muted">
    <a href="<?= base_url('patient') ?>" class="text-muted text-hover-primary">Listado</a>
  </li>

  <li class="breadcrumb-item">
    <span class="bullet bg-gray-500 w-5px h-2px"></span>
  </li>

  <li class="breadcrumb-item text-muted">Registro</li>

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
      <h2>Agregar Nuevo Paciente</h2>
    </div>


  </div>
  <div class="card-body pt-5">
    <?= form_open('api/patient/create', ['id' => 'kt_patient_new', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

    <!-- begin::DATOS PERSONALES -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">1. Datos Personales</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-3 mb-4">
          <label for="nombres" class="required form-label">Nombres del Paciente</label>
          <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres del Paciente" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="apellidos" class="required form-label">Apellidos del Paciente</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos del Paciente" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="dni" class="required form-label">Identificación del Paciente</label>
          <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI - C.E." />
        </div>

        <div class="col-md-3 mb-4">
          <label for="edad" class="required form-label">Edad del Paciente</label>
          <input type="number" name="edad" id="edad" class="form-control" placeholder="Ej. 18" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="genero" class="required form-label">Género del Paciente</label>
          <select class="form-select" id="genero" name="genero" aria-label="Select example">
            <option disabled selected value="">Seleccionar Genero</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>

        <div class="col-md-3 mb-4">
          <label for="contacto" class="required form-label">Contacto del Paciente</label>
          <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Ej. 999999999" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="fecha_nac" class="required form-label">Nacimiento del Paciente</label>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="sede" class="required form-label">Sede de Atención</label>
          <select class="form-select" name="sede" id="sede" aria-label="Select example">
            <option disabled selected value="">Seleccionar Sede</option>
            <option value="Lima">Lima</option>
            <option value="Arequipa">Arequipa</option>
            <option value="Chiclayo">Chiclayo</option>
          </select>
        </div>

        <div class="col-md-6 mb-4">
          <label for="direccion" class="required form-label">Dirección y Distrito del Paciente</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ej: Calle B | Los Olivos" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="nacionalidad" class="required form-label">Nacionalidad del Paciente</label>
          <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" placeholder="Distrito del Paciente" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="correo" class="form-label">Correo del Paciente</label>
          <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo del Paciente" />
        </div>

      </div>
    </div>
    <!-- end::DATOS PERSONALES -->


    <!-- begin::REFERENCIAS -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">2. Referencias</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">

        <div class="col-md-3 mb-4">
          <label for="vendedor" class="required form-label">Vendedor(a)</label>
          <input type="text" name="vendedor" id="vendedor" list="vendedor_list" class="form-control" placeholder="" />
          <datalist id="vendedor_list">
            <option value="Yessenia Anaí Cuya Sarango">
            <option value="Misael Fernandez Nizama">
          </datalist>
        </div>

        <div class="col-md-3 mb-4">
          <label for="canal" class="required form-label">Canal de Referencia</label>
          <select class="form-select" name="canal" id="canal" aria-label="Select example">
            <option disabled selected value="">Seleccionar Genero</option>
            <option value="Facebook">Facebook</option>
            <option value="Youtube">Youtube</option>
            <option value="TikTok">TikTok</option>
            <option value="Instagram">Instagram</option>
            <option value="Página Web">Página Web</option>
            <option value="Recomendaciones">Recomendaciones</option>
          </select>
        </div>

        <div class="col-md-3 mb-4">
          <label for="otro_contacto" class="form-label">Otro Contacto del Paciente</label>
          <input type="text" name="otro_contacto" id="otro_contacto" class="form-control" placeholder="ej. 999999999" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="nombres" class="form-label">Nombres del Contacto</label>
          <input type="text" name="nombre_contacto" id="nombre_contacto" class="form-control" placeholder="Nombres del Contacto" />
        </div>

      </div>

    </div>
    <!-- end::REFERENCIAS -->


    <!-- begin::DATOS TÉCNICOS -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">2. Datos Técnicos</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        
        <div class="col-md-4 mb-4">
          <label for="tiempo_ampu" class="required form-label">Tiempo de Amputación del Paciente</label>
          <select class="form-select" name="tiempo_ampu" id="tiempo_ampu" aria-label="Select example">
            <option disabled selected value="">Seleccionar Tiempo Amputacion</option>
            <option value="0 - 4 Meses">0 - 4 Meses</option>
            <option value="4 - 8 Meses">4 - 8 Meses</option>
            <option value="8 - 12 Meses">8 - 12 Meses</option>
            <option value="1 - 3 Años">1 - 3 Años</option>
            <option value="3 - 5 Años">3 - 5 Años</option>
            <option value="5 Años a más">5 Años a más</option>
          </select>
        </div>

        <div class="col-md-4 mb-4">
          <label for="motivo" class="required form-label">Motivo de Amputación del Paciente</label>
          <select class="form-select" name="motivo" id="motivo" aria-label="Select example">
            <option disabled selected value="">Seleccionar Motivo Amputacion</option>
            <option value="Congénito">Congénito</option>
            <option value="Accidente">Accidente</option>
            <option value="Enfermedad">Enfermedad</option>
          </select>
        </div>

        <div class="col-md-4 mb-4">
          <label for="tipPaciente" class="required form-label">Tipo de Paciente</label>
          <select class="form-select" name="tipPaciente" id="tipPaciente" aria-label="Select example">
            <option disabled selected value="">Seleccionar Tipo de Paciente</option>
            <option value="Regular">Regular</option>
            <option value="Donación">Donación</option>
            <option value="Recomendado">Recomendado</option>
            <optgroup label="Hospital del Estado">
              <option value="Estado | ES SALUD">Estado | ES SALUD</option>
              <option value="Estado | MINSA">Estado | MINSA</option>
            </optgroup>
          </select>
        </div>

        <div class="col-md-4 mb-4" id="grupoRecom" style="display: none;">
          <label for="RecomDoc" class="required form-label">Doctor Recomendado</label>
          <input type="text" name="RecomDoc" id="RecomDoc" class="form-control"
            placeholder="Doctor Recomendado" readonly />
        </div>
      </div>
    </div>
    <!-- end::DATOS TÉCNICOS -->


    <!-- begin::DATOS TÉCNICOS -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">3. Datos Médicos</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-6 mb-4">
          <label for="afecciones" class="form-label">Afecciones del Paciente</label>
          <input type="text" name="afecciones" id="afecciones" class="form-control" placeholder="Afecciones del Paciente" />
        </div>

        <div class="col-md-6 mb-4">
          <label for="alergias" class="form-label">Alergias del Paciente</label>
          <input type="text" name="alergias" id="alergias" class="form-control" placeholder="Alergias del Paciente" />
        </div>
      </div>

    </div>
    <!-- end::DATOS TÉCNICOS -->

    <!-- begin::DATOS TÉCNICOS -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">4. Datos Adicionales</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-12 mb-4">
          <label for="observacion" class="form-label">Observaciones</label>
          <textarea name="observacion" id="observacion" class="form-control" style="height: 100px;"></textarea>
        </div>
      </div>
    </div>
    <!-- end::DATOS TÉCNICOS -->


    <button id="kt_submit_form_patient" type="submit" class="btn btn-primary">
      <span class="indicator-label">
        Guardar
      </span>
      <span class="indicator-progress">
        Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
      </span>
    </button>



    <?= form_close(); ?>
  </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts') ?>

<script>
  const form = document.querySelector("#kt_patient_new");

  const validator = FormValidation.formValidation(form, {
    fields: {
      'nombres': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'apellidos': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'dni': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          },
          regexp: {
            regexp: /^[0-9]+$/,
            message: 'Solo se permite números'
          },
          stringLength: {
            min: 5,
            max: 10,
            message: 'El número debe máximos 10 dígitos'
          }
        }
      },

      'edad': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'genero': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'contacto': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          },
          regexp: {
            regexp: /^[0-9]+$/,
            message: 'Solo se permite números'
          },
          stringLength: {
            min: 9,
            max: 9,
            message: 'El número debe máximos 9 dígitos'
          }
        }
      },

      'fecha_nac': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'sede': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'direccion': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'distrito': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'vendedor': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'otro_contacto': {
        validators: {
          regexp: {
            regexp: /^[0-9]+$/,
            message: 'Solo se permite números'
          },
          stringLength: {
            min: 9,
            max: 9,
            message: 'El número debe máximos 9 dígitos'
          }
        }
      },

      'canal': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'tiempo_ampu': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'motivo': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'tipPaciente': {
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

  const submitButton = document.querySelector('#kt_submit_form_patient');
  submitButton.addEventListener('click', function(e) {
    e.preventDefault();

    if (!validator) {
      return;
    }

    validator.validate().then(function(status) {
      if (status !== 'Valid') {
        return;
      }

      // 1. Activar spinner y desactivar botón
      submitButton.setAttribute('data-kt-indicator', 'on');
      submitButton.disabled = true;

      // 2. Enviamos la petición AJAX
      fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(async response => {
          const data = await response.json();

          // 3. Esperar al menos 2 s antes de quitar el spinner
          setTimeout(() => {
            submitButton.removeAttribute('data-kt-indicator');
            submitButton.disabled = false;

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
                window.location.href = '<?= base_url('patient') ?>';
              });
            }
          }, 2000);
        })
        .catch(() => {
          // Si falla la petición
          setTimeout(() => {
            submitButton.removeAttribute('data-kt-indicator');
            submitButton.disabled = false;
            Swal.fire({
              text: 'No se pudo conectar al servidor',
              icon: 'error',
              buttonsStyling: false,
              confirmButtonText: 'Ok!'
            });
          }, 2000);
        });
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const selectTipo = document.getElementById('tipPaciente');
    const grupoRecom = document.getElementById('grupoRecom');
    const inputRecom = document.getElementById('RecomDoc');

    selectTipo.addEventListener('change', function() {
      if (this.value === 'Recomendado') {
        grupoRecom.style.display = 'block';
        inputRecom.removeAttribute('readonly');
      } else {
        grupoRecom.style.display = 'none';
        inputRecom.setAttribute('readonly', 'readonly');
        inputRecom.value = '';
      }
    });
  });
</script>

<?= $this->endSection(); ?>