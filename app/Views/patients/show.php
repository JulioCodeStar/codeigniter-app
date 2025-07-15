<?php
$opcionesTiempo = [
  ''            => 'Seleccionar Tiempo Amputación',
  '0 - 4 Meses' => '0 - 4 Meses',
  '4 - 8 Meses' => '4 - 8 Meses',
  '8 - 12 Meses' => '8 - 12 Meses',
  '1 - 3 Años'  => '1 - 3 Años',
  '3 - 5 Años'  => '3 - 5 Años',
  '5 Años a más' => '5 Años a más',
];
$opcionesMotivo = [
  ''            => 'Seleccionar Motivo Amputación',
  'Congénito'   => 'Congénito',
  'Accidente'   => 'Accidente',
  'Enfermedad'  => 'Enfermedad',
];
$opcionesTipo = [
  ''                   => 'Seleccionar Tipo de Paciente',
  'Regular'            => 'Regular',
  'Donación'           => 'Donación',
  'Recomendado'        => 'Recomendado',
  'Estado | ES SALUD'  => 'Estado | ES SALUD',
  'Estado | MINSA'     => 'Estado | MINSA',
];

$valorTipo = $get['tip_paciente'] ?? '';
?>


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

  <li class="breadcrumb-item text-muted">Modificar</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>


<div class="card card-flush h-lg-100 my-5">
  <div class="card-header pt-7">
    <div class="card-title">
      <i class="ki-duotone ki-user-square fs-1 me-2">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
      </i>
      <h2>Modificar Paciente</h2>
    </div>


  </div>
  <div class="card-body pt-5">
    <?= form_open('api/patient/edit/' . $id, ['id' => 'kt_patient_edit', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>

    <input type="hidden" id="id_paciente" name="id_paciente" value="<?= $id ?>" readonly>

    <!-- begin::TIPO DE PACIENTE -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">1. Tipo de Paciente</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-4 mb-4">
          <label for="tipPaciente" class="required form-label">El paciente proviene de :</label>
          <select class="form-select" name="tipPaciente" id="tipPaciente" aria-label="Select example">
            <option disabled selected value="">Seleccionar Tipo de Paciente</option>
            <option value="Regular" <?= ($get['tip_paciente'] === 'Regular') ? 'selected' : '' ?>>Regular</option>
            <option value="Donación" <?= ($get['tip_paciente'] === 'Donación') ? 'selected' : '' ?>>Donación</option>
            <option value="Recomendado" <?= ($get['tip_paciente'] === 'Recomendado') ? 'selected' : '' ?>>Recomendado</option>
            <optgroup label="Hospital del Estado">
              <option value="Estado | ES SALUD" <?= ($get['tip_paciente'] === 'Estado | ES SALUD') ? 'selected' : '' ?>>Estado | ES SALUD</option>
              <option value="Estado | MINSA" <?= ($get['tip_paciente'] === 'Estado | MINSA') ? 'selected' : '' ?>>Estado | MINSA</option>
            </optgroup>
          </select>
        </div>

        <div class="col-md-4 mb-4" id="grupoRegular1" style="display: <?= ($get['tip_paciente'] === 'Regular') ? 'block' : 'none' ?>;">
          <label for="financiacion" class="required form-label">¿El paciente financia su prótesis?</label>
          <select class="form-select" name="financiacion" id="financiacion" aria-label="Select example">
            <option disabled selected value="">Seleccionar</option>
            <option value="Si" <?= ($get['financia_protesis'] === 'Si') ? 'selected' : '' ?>>Si</option>
            <option value="No" <?= ($get['financia_protesis'] === 'No') ? 'selected' : '' ?>>No</option>
          </select>
        </div>

        <div class="col-md-4 mb-4" id="grupoRegular2" style="display: <?= ($get['financia_protesis'] === 'No') ? 'block' : 'none' ?>;">
          <label for="entidad_financiera" class="required form-label">Entidad Financiera</label>
          <input type="text" name="entidad_financiera" id="entidad_financiera" class="form-control"
            placeholder="Entidad Financiera" value="<?= $get['entidad_financiera'] ?>" />
        </div>

        <div class="col-md-4 mb-4" id="grupoRegular3" style="display: <?= ($get['financia_protesis'] === 'No') ? 'block' : 'none' ?>;">
          <label for="contacto_financiero" class="required form-label">Contacto Financiero</label>
          <input type="text" name="contacto_financiero" id="contacto_financiero" class="form-control"
            placeholder="Contacto Financiero" value="<?= $get['contacto_financiera'] ?>" />
        </div>

        <div class="col-md-4 mb-4" id="grupoRegular4" style="display: <?= ($get['financia_protesis'] === 'No') ? 'block' : 'none' ?>;">
          <label for="telefono_financiero" class="required form-label">Telefono Financiero</label>
          <input type="text" name="telefono_financiero" id="telefono_financiero" class="form-control"
            placeholder="Telefono Financiero" value="<?= $get['telefono_financiera'] ?>" />
        </div>


        <div class="col-md-4 mb-4" id="grupoHospital" style="display: <?= ($get['tip_paciente'] === 'Estado | ES SALUD' || $get['tip_paciente'] === 'Estado | MINSA') ? 'block' : 'none' ?>;">
          <label for="hospital" class="required form-label">Nombre del Hospital</label>
          <input type="text" name="hospital" id="hospital" class="form-control"
            placeholder="Nombre del Hospital" value="<?= $get['nombre_hospital'] ?>" readonly />
        </div>

      </div>

      <div class="row g-4">
        <div class="col-md-4 mb-4">
          <label for="mayor_edad" class="required form-label">¿Paciente es mayor de edad?</label>
          <select class="form-select" name="mayor_edad" id="mayor_edad" aria-label="Select example">
            <option disabled selected value="">Seleccionar</option>
            <option value="Si" <?= ($get['mayor_edad'] === 'Si') ? 'selected' : '' ?>>Si</option>
            <option value="No" <?= ($get['mayor_edad'] === 'No') ? 'selected' : '' ?>>No</option>
          </select>
        </div>

        <div class="col-md-4 mb-4">
          <label for="presencia_amputacion" class="required form-label">¿Paciente presenta amputación?</label>
          <select class="form-select" name="presencia_amputacion" id="presencia_amputacion" aria-label="Select example">
            <option disabled selected value="">Seleccionar</option>
            <option value="Si" <?= ($get['presenta_ampu'] === 'Si') ? 'selected' : '' ?>>Si</option>
            <option value="No" <?= ($get['presenta_ampu'] === 'No') ? 'selected' : '' ?>>No</option>
          </select>
        </div>
      </div>
    </div>
    <!-- end::TIPO DE PACIENTE -->

    <!-- begin::DATOS PERSONALES -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">2. Datos Personales</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-3 mb-4">
          <label for="nombres" class="required form-label">Nombres</label>
          <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" value="<?= $get['nombres'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="apellidos" class="required form-label">Apellidos</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" value="<?= $get['apellidos'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="dni" class="required form-label">Identificación</label>
          <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI - C.E." value="<?= $get['dni'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="edad" class="required form-label">Edad</label>
          <input type="number" name="edad" id="edad" class="form-control" placeholder="Ej. 18" value="<?= $get['edad'] ?>" />
        </div>

        <div class="col-md-3 mb-4" id="grupoMayorEdad1" style="display: <?= ($get['mayor_edad'] === 'No') ? 'block' : 'none' ?>;">
          <label for="nombre_apoderado" class="required form-label">Nombre del Apoderado</label>
          <input type="text" name="nombre_apoderado" id="nombre_apoderado" class="form-control" placeholder="Nombre del Apoderado" value="<?= $get['nombres_apoderado'] ?>" />
        </div>

        <div class="col-md-3 mb-4" id="grupoMayorEdad2" style="display: <?= ($get['mayor_edad'] === 'No') ? 'block' : 'none' ?>;">
          <label for="apellido_apoderado" class="required form-label">Apellido del Apoderado</label>
          <input type="text" name="apellido_apoderado" id="apellido_apoderado" class="form-control" placeholder="Apellido del Apoderado" value="<?= $get['apellidos_apoderado'] ?>" />
        </div>

        <div class="col-md-3 mb-4" id="grupoMayorEdad3" style="display: <?= ($get['mayor_edad'] === 'No') ? 'block' : 'none' ?>;">
          <label for="dni_apoderado" class="required form-label">DNI . C.E. del Apoderado</label>
          <input type="text" name="dni_apoderado" id="dni_apoderado" class="form-control" placeholder="DNI . C.E. del Apoderado" value="<?= $get['dni_apoderado'] ?>" />
        </div>

        <div class="col-md-3 mb-4" id="grupoMayorEdad4" style="display: <?= ($get['mayor_edad'] === 'No') ? 'block' : 'none' ?>;">
          <label for="vinculo_apoderado" class="required form-label">Vinculo del Apoderado</label>
          <input type="text" name="vinculo_apoderado" id="vinculo_apoderado" class="form-control" placeholder="Vinculo del Apoderado" value="<?= $get['vinculo_apoderado'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="genero" class="required form-label">Género</label>
          <select class="form-select" id="genero" name="genero" aria-label="Select example">
            <option disabled selected value="">Seleccionar Genero</option>
            <option value="Masculino" <?= ($get['genero'] === 'Masculino') ? 'selected' : '' ?>>Masculino</option>
            <option value="Femenino" <?= ($get['genero'] === 'Femenino') ? 'selected' : '' ?>>Femenino</option>
          </select>
        </div>

        <div class="col-md-3 mb-4">
          <label for="contacto" class="required form-label">Contacto</label>
          <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Ej. 999999999" value="<?= $get['contacto'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="fecha_nac" class="required form-label">Nacimiento</label>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" value="<?= $get['fecha_nacimiento'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="sede" class="required form-label">Sede de Atención</label>
          <select class="form-select" name="sede" id="sede" aria-label="Select example">
            <option disabled selected value="">Seleccionar Sede</option>
            <option value="Lima" <?= ($get['sede'] === 'Lima') ? 'selected' : '' ?>>Lima</option>
            <option value="Arequipa" <?= ($get['sede'] === 'Arequipa') ? 'selected' : '' ?>>Arequipa</option>
            <option value="Chiclayo" <?= ($get['sede'] === 'Chiclayo') ? 'selected' : '' ?>>Chiclayo</option>
          </select>
        </div>

        <div class="col-md-6 mb-4">
          <label for="direccion" class="required form-label">Dirección y Distrito</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ej: Calle B | Los Olivos" value="<?= $get['direccion'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="distrito" class="required form-label">Nacionalidad</label>
          <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" placeholder="Nacionalidad" value="<?= $get['nacionalidad'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" value="<?= $get['email'] ?>" />
        </div>

        <div class="col-md-3 mb-4">
          <label for="otro_contacto" class="form-label">Telefono Emergencia</label>
          <input type="text" name="otro_contacto" id="otro_contacto" class="form-control" placeholder="ej. 999999999" value="<?= $get['otro_contacto'] ?>" />
        </div>

        <div class="col-md-4 mb-4">
          <label for="nombres" class="form-label">Nombres y Apellidos de Emergencia</label>
          <input type="text" name="nombre_contacto" id="nombre_contacto" class="form-control" placeholder="Nombres y Apellidos de Emergencia" value="<?= $get['nombre_contacto'] ?>" />
        </div>

      </div>
    </div>
    <!-- end::DATOS PERSONALES -->

    <!-- begin::DATOS TÉCNICOS -->
    <div class="mb-8">

      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">3. Datos Técnicos</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">

        <div class="col-md-4 mb-4">
          <label for="usa_protesis" class="required form-label">¿El paciente usa prótesis?</label>
          <select class="form-select" name="usa_protesis" id="usa_protesis" aria-label="Select example">
            <option disabled selected value="">Seleccionar</option>
            <option value="Si" <?= ($get['usa_protesis'] === 'Si') ? 'selected' : '' ?>>Si</option>
            <option value="No" <?= ($get['usa_protesis'] === 'No') ? 'selected' : '' ?>>No</option>
          </select>
        </div>

        <div class="col-md-4 mb-4">
          <label for="enfermedad_preexistente" class="required form-label">¿El paciente presenta una enfermedad preexistente?</label>
          <input type="text" name="enfermedad_preexistente" id="enfermedad_preexistente" class="form-control" placeholder="Enfermedad Preexistente" value="<?= $get['enfermedad'] ?>" />
        </div>

        <div class="col-md-4 mb-4">
          <label for="time_ampu" class="required form-label">Tiempo de Amputación</label>
          <select class="form-select" name="time_ampu" id="time_ampu" aria-label="Select example">
            <option disabled selected value="">Seleccionar Tiempo</option>
            <option value="Sin Amputacion" <?= ($get['time_ampu'] === 'Sin Amputacion') ? 'selected' : '' ?>>Sin Amputacion</option>
            <option value="0 - 4 Meses" <?= ($get['time_ampu'] === '0 - 4 Meses') ? 'selected' : '' ?>>0 - 4 Meses</option>
            <option value="4 - 8 Meses" <?= ($get['time_ampu'] === '4 - 8 Meses') ? 'selected' : '' ?>>4 - 8 Meses</option>
            <option value="8 - 12 Meses" <?= ($get['time_ampu'] === '8 - 12 Meses') ? 'selected' : '' ?>>8 - 12 Meses</option>
            <option value="1 - 3 Años" <?= ($get['time_ampu'] === '1 - 3 Años') ? 'selected' : '' ?>>1 - 3 Años</option>
            <option value="3 - 5 Años" <?= ($get['time_ampu'] === '3 - 5 Años') ? 'selected' : '' ?>>3 - 5 Años</option>
            <option value="5 Años a más" <?= ($get['time_ampu'] === '5 Años a más') ? 'selected' : '' ?>>5 Años a más</option>
          </select>
        </div>

        <div class="col-md-4 mb-4" id="grupoExpectativa" style="display: <?= ($get['time_ampu'] === 'Sin Amputacion') ? 'block' : 'none' ?>;">
          <label for="expectativa" class="required form-label">Expectativa de Amputación</label>
          <input type="text" name="expectativa" id="expectativa" class="form-control" placeholder="Expectativa de Amputacion" value="<?= $get['expectativa'] ?>" />
        </div>

        <div class="col-md-4 mb-4">
          <label for="motivo" class="required form-label">Motivo de Amputación</label>
          <select class="form-select" name="motivo" id="motivo" aria-label="Select example">
            <option disabled selected value="">Seleccionar Motivo</option>
            <option value="Congénito" <?= ($get['motivo_amputacion'] === 'Congénito') ? 'selected' : '' ?>>Congénito</option>
            <option value="Accidente" <?= ($get['motivo_amputacion'] === 'Accidente') ? 'selected' : '' ?>>Accidente</option>
            <option value="Enfermedad" <?= ($get['motivo_amputacion'] === 'Enfermedad') ? 'selected' : '' ?>>Enfermedad</option>
          </select>
        </div>
      </div>
    </div>
    <!-- end::DATOS TÉCNICOS -->

    <!-- begin::REFERENCIA -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">4. Referencias</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-4 mb-4">
          <label for="vendedor" class="required form-label">Vendedor(a) o recomendación del especialista</label>
          <input type="text" name="vendedor" id="vendedor" list="vendedor_list" class="form-control" placeholder="" value="<?= $get['vendedor'] ?>" />
          <datalist id="vendedor_list">
            <option value="Yessenia Anaí Cuya Sarango">
            <option value="Misael Fernandez Nizama">
          </datalist>
        </div>

        <div class="col-md-4 mb-4">
          <label for="canal" class="required form-label">Canal de Referencia</label>
          <select class="form-select" name="canal" id="canal" aria-label="Select example">
            <option disabled selected value="">Seleccionar Genero</option>
            <option value="Facebook" <?= ($get['canal'] === 'Facebook') ? 'selected' : '' ?>>Facebook</option>
            <option value="Youtube" <?= ($get['canal'] === 'Youtube') ? 'selected' : '' ?>>Youtube</option>
            <option value="TikTok" <?= ($get['canal'] === 'TikTok') ? 'selected' : '' ?>>TikTok</option>
            <option value="Instagram" <?= ($get['canal'] === 'Instagram') ? 'selected' : '' ?>>Instagram</option>
            <option value="Página Web" <?= ($get['canal'] === 'Página Web') ? 'selected' : '' ?>>Página Web</option>
            <option value="Recomendaciones" <?= ($get['canal'] === 'Recomendaciones') ? 'selected' : '' ?>>Recomendaciones</option>
          </select>
        </div>


      </div>
    </div>

    <!-- end::REFERENCIA -->

    <!-- begin::DATOS ADICIONALES -->
    <div class="mb-8">
      <label class="form-label fs-6 fw-bold text-gray-700 mb-3">5. Datos Adicionales</label>

      <div class="separator separator-dashed my-2 mb-4"></div>

      <div class="row g-4">
        <div class="col-md-12 mb-4">
          <label for="observacion" class="form-label">Observaciones del Paciente</label>
          <textarea name="observacion" id="observacion" class="form-control" rows="3" placeholder="Observaciones del Paciente"><?= $get['observaciones'] ?></textarea>
        </div>
      </div>
    </div>
    <!-- end::DATOS ADICIONALES -->

    <button type="submit" class="btn btn-primary" id="kt_submit_form_patient">
      <span class="indicator-label">Guardar Cambios</span>
      <span class="indicator-progress">Por favor espere...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>

  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
  const form = document.querySelector("#kt_patient_edit");

  const validator = FormValidation.formValidation(form, {
    fields: {

      'tipPaciente': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'mayor_edad': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'presencia_amputacion': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

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

      'usa_protesis': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'enfermedad_preexistente': {
        validators: {
          notEmpty: {
            message: 'El campo es Obligatorio'
          }
        }
      },

      'time_ampu': {
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
    const grupoHospital = document.getElementById('grupoHospital');
    const inputHospital = document.getElementById('hospital');
    const grupoRegular1 = document.getElementById('grupoRegular1');
    const grupoRegular2 = document.getElementById('grupoRegular2');
    const grupoRegular3 = document.getElementById('grupoRegular3');
    const grupoRegular4 = document.getElementById('grupoRegular4');


    const financiacion = document.getElementById('financiacion');
    const entidad_financiera = document.getElementById('entidad_financiera');
    const contacto_financiero = document.getElementById('contacto_financiero');
    const telefono_financiero = document.getElementById('telefono_financiero');


    const grupoMayorEdad1 = document.getElementById('grupoMayorEdad1');
    const grupoMayorEdad2 = document.getElementById('grupoMayorEdad2');
    const grupoMayorEdad3 = document.getElementById('grupoMayorEdad3');
    const grupoMayorEdad4 = document.getElementById('grupoMayorEdad4');
    const nombre_apoderado = document.getElementById('nombre_apoderado');
    const apellido_apoderado = document.getElementById('apellido_apoderado');
    const dni_apoderado = document.getElementById('dni_apoderado');
    const vinculo_apoderado = document.getElementById('vinculo_apoderado');
    const mayor_edad = document.getElementById('mayor_edad');


    const tiempo_ampu = document.getElementById('time_ampu');
    const grupoExpectativa = document.getElementById('grupoExpectativa');

    selectTipo.addEventListener('change', function() {
      if (this.value === 'Estado | ES SALUD' || this.value === 'Estado | MINSA') {
        grupoHospital.style.display = 'block';
        inputHospital.value = this.value === 'Estado | ES SALUD' ? 'ES SALUD' : 'MINSA';
        inputHospital.removeAttribute('readonly');
        grupoRegular1.style.display = 'none';
        grupoRegular2.style.display = 'none';
        grupoRegular3.style.display = 'none';
        grupoRegular4.style.display = 'none';
      } else if (this.value === 'Regular') {
        grupoRegular1.style.display = 'block';
        grupoHospital.style.display = 'none';
        inputHospital.setAttribute('readonly', 'readonly');
        inputHospital.value = '';
      } else {
        grupoHospital.style.display = 'none';
        inputHospital.setAttribute('readonly', 'readonly');
        inputHospital.value = '';
        grupoRegular1.style.display = 'none';
        grupoRegular2.style.display = 'none';
        grupoRegular3.style.display = 'none';
        grupoRegular4.style.display = 'none';
      }

      // Actualizar campos de financiación si están visibles
      if (financiacion && financiacion.value === 'No') {
        grupoRegular2.style.display = 'block';
        grupoRegular3.style.display = 'block';
        grupoRegular4.style.display = 'block';
      } else {
        grupoRegular2.style.display = 'none';
        grupoRegular3.style.display = 'none';
        grupoRegular4.style.display = 'none';
      }
    });

    financiacion.addEventListener('change', function() {
      const financiacionValue = this.value;

      // Mostrar/ocultar campos según la selección
      if (financiacionValue === 'No') {
        grupoRegular2.style.display = 'block';
        grupoRegular3.style.display = 'block';
        grupoRegular4.style.display = 'block';
      } else {
        grupoRegular2.style.display = 'none';
        grupoRegular3.style.display = 'none';
        grupoRegular4.style.display = 'none';
      }
    });

    mayor_edad.addEventListener('change', function() {
      const mayorEdadValue = this.value;

      // Mostrar/ocultar campos según la selección
      if (mayorEdadValue === 'No') {
        grupoMayorEdad1.style.display = 'block';
        grupoMayorEdad2.style.display = 'block';
        grupoMayorEdad3.style.display = 'block';
        grupoMayorEdad4.style.display = 'block';

        // Limpiar campos
        nombre_apoderado.value = '';
        apellido_apoderado.value = '';
        dni_apoderado.value = '';
        vinculo_apoderado.value = '';
      } else {
        grupoMayorEdad1.style.display = 'none';
        grupoMayorEdad2.style.display = 'none';
        grupoMayorEdad3.style.display = 'none';
        grupoMayorEdad4.style.display = 'none';
      }
    });

    tiempo_ampu.addEventListener('change', function() {
      const tiempo_ampuValue = this.value;

      // Mostrar/ocultar campos según la selección
      if (tiempo_ampuValue === 'Sin Amputacion') {
        grupoExpectativa.style.display = 'block';
      } else {
        grupoExpectativa.style.display = 'none';
      }
    });
  });
</script>

<?= $this->endSection(); ?>