<?= $this->extend('layouts/template'); ?>


<?= $this->section('title'); ?>

 Gestion de Pacientes | KYP BIOINGENIERIA

 <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
  <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-6">
      <!--begin::Title-->
      <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Mantenimiento de Pacientes</h1>
      <!--end::Title-->
      <!--begin::Breadcrumb-->
      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Pacientes</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-500 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Gestión de Pacientes</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-500 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Registro</li>
        <!--end::Item-->
      </ul>
      <!--end::Breadcrumb-->


    </div>
    <!-- <div class="d-flex align-items-center gap-2 gap-lg-3">
            
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                <i class="ki-duotone ki-plus fs-2"></i>Agregar Paciente</button>
            
        </div> -->
  </div>
</div>

<div class="card card-flush h-lg-100">
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
          <label for="direccion" class="required form-label">Dirección del Paciente</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección del Paciente" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="distrito" class="required form-label">Distrito del Paciente</label>
          <input type="text" name="distrito" id="distrito" class="form-control" placeholder="Distrito del Paciente" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="correo" class="form-label">Correo del Paciente</label>
          <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo del Paciente" />
        </div>

        <div class="col-md-4 mb-4">
          <label for="vendedor" class="required form-label">Vendedor(a)</label>
          <input type="text" name="vendedor" id="vendedor" list="vendedor_list" class="form-control" placeholder="" />
          <datalist id="vendedor_list">
            <option value="Yessenia Anaí Cuya Sarango">
            <option value="Misael Fernandez Nizama">
          </datalist>
        </div>

        <div class="col-md-3 mb-4">
          <label for="otro_contacto" class="form-label">Otro Contacto del Paciente</label>
          <input type="text" name="otro_contacto" id="otro_contacto" class="form-control" placeholder="ej. 999999999" />
        </div>
      </div>
    </div>
    <!-- end::DATOS PERSONALES -->


    <!-- begin::DATOS TÉCNICOS -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">2. Datos Técnicos</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-4 mb-4">
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

        <div class="col-md-4 mb-4">
          <label for="tiempo_ampu" class="required form-label">Tiempo de Amputación del Paciente</label>
          <input type="text" name="tiempo_ampu" id="tiempo_ampu" class="form-control" placeholder="Tiempo de Amputación del Paciente" />
        </div>

        <div class="col-md-4 mb-4">
          <label for="motivo" class="required form-label">Motivo de Amputación del Paciente</label>
          <input type="text" name="motivo" id="motivo" class="form-control" placeholder="Motivo de Amputación del Paciente" />
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
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
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
              customClass: { confirmButton: 'btn btn-danger' }
            });
          } else {
            // Éxito
            Swal.fire({
              text: data.message,
              icon: 'success',
              buttonsStyling: false,
              confirmButtonText: 'Ok!',
              customClass: { confirmButton: 'btn btn-primary' }
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

</script>

<?= $this->endSection(); ?>