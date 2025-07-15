<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      font-size: 9.5pt;
      line-height: 1.4;
      color: #333;
      margin: 0;
    }

    .ficha-registro {
      max-width: 210mm;
      margin: 5mm auto;
      padding: 7mm;
    }

    .header-compact {
      text-align: center;
      margin-bottom: 7px;
      padding-bottom: 2px;
      border-bottom: 1px solid #216E71;
    }

    .seccion-compact {
      margin: 12px 0;
      padding: 8px;
      background: #f8f9fa;
      border-radius: 4px;
    }

    .table-compact {
      font-size: 9pt;
      margin: 5px 0;
    }

    .table-compact td,
    .table-compact th {
      padding: 6px 8px;
      border: 0.5px solid #dee2e6;
    }

    .campo-titulo {
      background-color: #e9ecef;
      width: 25%;
      font-weight: 600;
    }

    .campo-titulo-2 {
      background-color: #e9ecef;
      width: 40%;
      font-weight: 600;
    }

    .observaciones-box {
      height: 80px;
      border: 1px dashed #6c757d;
      padding: 15px;
      margin-top: 10px;
    }

    .new-page {
      page-break-before: always;
      padding-top: 50px;
    }
  </style>
</head>

<body>
  <div class="ficha-registro">
    <div class="header-compact">
      <h2 style="color: #495057;">FICHA DE REGISTRO DE PACIENTES</h2>
    </div>

    <!-- Tipo de Paciente -->
    <div class="seccion-compact">
      <h3 style="color: #000; margin-bottom: 15px;">1. TIPO DE PACIENTE</h3>
      <table class="table-compact" style="width: 100%;">
        <tr>
          <td class="campo-titulo">Tipo de Paciente</td>
          <td colspan="3"><?= mb_strtoupper($paciente['tip_paciente']) ?> </td>
        </tr>
        <tr>
          <td class="campo-titulo">¿Paciente es mayor de edad?</td>
          <td colspan="3"><?= $paciente['mayor_edad'] ?></td>
        </tr>
        <tr>
          <td class="campo-titulo">¿Paciente presenta amputación?</td>
          <td colspan="3"><?= $paciente['presenta_ampu'] ?></td>
        </tr>
      </table>
    </div>

    <!-- Datos Básicos -->
    <div class="seccion-compact">
      <h3 style="color: #000; margin-bottom: 15px;">2. DATOS DEL PACIENTE</h3>
      <table class="table-compact" style="width: 100%;">
        <tr>
          <td class="campo-titulo">Nombres completos</td>
          <td colspan="3"><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos']) ?> </td>
        </tr>
        <tr>
          <td class="campo-titulo">DNI/C.E.</td>
          <td><?= $paciente['dni'] ?></td>
          <td class="campo-titulo">Celular</td>
          <td><?= $paciente['contacto'] ?></td>
        </tr>
        <tr>
          <td class="campo-titulo">Dirección y Distrito</td>
          <td colspan="3"><?= mb_strtoupper($paciente['direccion']) ?></td>
        </tr>
        <tr>
          <td class="campo-titulo">Nacionalidad</td>
          <td><?= $paciente['nacionalidad'] ?></td>
          <td class="campo-titulo">Sede de Atención</td>
          <td><?= $paciente['sede'] ?></td>
        </tr>
        <tr>
          <td class="campo-titulo">Fecha de nacimiento</td>
          <td><?= fecha_dmy($paciente['fecha_nacimiento']) ?></td>
          <td class="campo-titulo">Género</td>
          <td><?= $paciente['genero'] ?></td>
        </tr>
        <?php if (!empty($paciente['email'])): ?>
          <tr>
            <td class="campo-titulo">Correo electrónico</td>
            <td colspan="3"><?= $paciente['email'] ?></td>
          </tr>
        <?php endif; ?>
      </table>
    </div>

    <?php if ($paciente['mayor_edad'] === 'No'): ?>
      <!-- Datos Apoderados -->
      <div class="seccion-compact">
        <h3 style="color: #000; margin-bottom: 15px;">2.1. DATOS DEL APODERADO</h3>
        <table class="table-compact" style="width: 100%;">
          <tr>
            <td class="campo-titulo">Nombres completos</td>
            <td colspan="3"><?= mb_strtoupper($paciente['nombres_apoderado'] . ' ' . $paciente['apellidos_apoderado']) ?> </td>
          </tr>
          <tr>
            <td class="campo-titulo">DNI/C.E.</td>
            <td><?= $paciente['dni_apoderado'] ?></td>
            <td class="campo-titulo">Vinculo</td>
            <td><?= $paciente['vinculo_apoderado'] ?></td>
          </tr>
        </table>
      </div>
    <?php endif; ?>
    <!-- Datos Técnicos -->
    <div class="seccion-compact">
      <h3 style="color: #000; margin-bottom: 15px;">3. DATOS PARA PRÓTESIS</h3>
      <table class="table-compact" style="width: 100%;">
        <tr>
          <td class="campo-titulo-2">¿El paciente usa protésis?</td>
          <td colspan="2"><?= mb_strtoupper($paciente['usa_protesis']) ?></td>
        </tr>
        <tr>
          <td class="campo-titulo-2">¿El paciente presenta una enfermedad preexistente?</td>
          <td colspan="2"><?= mb_strtoupper($paciente['enfermedad']) ?></td>
        </tr>
        <tr>
          <td class="campo-titulo-2">Motivo de amputación</td>
          <td colspan="2"><?= mb_strtoupper($paciente['motivo_amputacion']) ?></td>
        </tr>
        <tr>
          <td class="campo-titulo-2">Tiempo de Amputación</td>
          <td colspan="2"><?= mb_strtoupper($paciente['time_ampu']) ?></td>
        </tr>
        <?php if ($paciente['time_ampu'] === 'Sin Amputacion'): ?>
          <tr>
            <td class="campo-titulo-2">Expectativa de Amputación</td>
            <td colspan="2"><?= mb_strtoupper($paciente['expectativa']) ?></td>
          </tr>
        <?php endif; ?>
      </table>
    </div>

  </div>

  <div class="new-page">
    <!-- Observaciones -->
    <div class="seccion-compact">
      <h3 style="color: #000; margin-bottom: 15px;">4. OBSERVACIONES</h3>
      <div class="observaciones-box">
        <p><?= mb_strtoupper($paciente['observaciones']) ?></p>
      </div>
    </div>

    <!-- Check List -->
    <div class="seccion-compact" style="page-break-inside: avoid;">
      <table class="table-compact" style="width: 100%; margin: 5px 0;">
        <tr>
          <td colspan="3" style="text-align: center; background: #dee2e6;">DOCUMENTOS ADJUNTOS</td>
        </tr>
        <tr>
          <td style="width: 33%;">☐ Ficha registro</td>
          <td style="width: 33%;">☐ DNI original</td>
          <td style="width: 34%;">☐ Cotización firmada</td>
        </tr>
        <tr>
          <td style="width: 33%;">☐ Consentimiento informado 1</td>
          <td style="width: 33%;">☐ Carta entrega fibra prueba</td>
          <td style="width: 34%;">☐ Contrato de servicios</td>
        </tr>
        <tr>
          <td style="width: 33%;">☐ Consentimiento informado 2</td>
          <td style="width: 33%;">☐ Carta entrega fibra carbono</td>
          <td style="width: 34%;">☐ Comprobantes de pago</td>
        </tr>
      </table>

      <div style="margin-top: 15px; font-size: 0.9em; color: #6c757d;">
        <strong>Nota:</strong> Marque con un check (✓) los documentos entregados/completados
      </div>
    </div>
  </div>

</body>

</html>