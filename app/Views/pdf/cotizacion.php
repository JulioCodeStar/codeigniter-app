<!DOCTYPE html>
<html>

<head>
  <style>
    @page {
      margin: 100px 40px 40px 40px;
    }

    @page header {
      odd-header-name: html_empresaHeader;
    }

    body {
      font-family: 'Arial', sans-serif;
      color: #333;
      font-size: 9.5pt;
    }

    .contizacion {
      max-width: 210mm;
      margin: 5mm auto;
      padding: 7mm;
    }

    .header-compact {
      text-align: center;
      padding-top: 10px;
      margin-bottom: 7px;
      padding-bottom: 2px;
      border-bottom: 1px solid #216E71;
    }

    .data-compact {
      font-size: 9.5pt;
      margin-top: 15px;
    }

    .metodos-pago {
      background: #f8f9fa;
      /* Color suave */
      border-radius: 8px;
      /* Bordes redondeados */
      padding: 15px;
      margin: 10px 0;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      /* Sutil profundidad */
    }

    .linea-separadora {
      border-top: 2px solid #216E71;
      margin: 20px 0;
    }
  </style>
</head>

<body>

  <htmlpageheader name="encabezado">
    <?= $template_header ?>
  </htmlpageheader>
  <sethtmlpageheader name="encabezado" value="on" show-this-page="1" />

  <div class="cotizacion">

    <div class="data-compact">
      <table width="100%" cellpadding="4" cellspacing="0" style="font-size: 9.5pt; padding-top: 30px;">
        <tr>
          <!-- Columna: Datos del Paciente -->
          <td width="60%" style="vertical-align: top;">
            <table>
              <tr>
                <td colspan="2" style="font-weight: bold; font-size: 10pt;">Paciente: </td>
              </tr>
              <tr>
                <td colspan="2" style="font-weight: bold;"><?= mb_strtoupper($get['nombres'] . ' ' . $get['apellidos']) ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Dirección:</td>
                <td><?= mb_strtoupper($get['direccion']) ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Teléfono:</td>
                <td><?= $get['contacto'] ?></td>
              </tr>
            </table>
          </td>

          <!-- Columna: Datos de Cotización -->
          <td width="40%" style="text-align: right; vertical-align: top;">
            <table align="right">
              <tr>
                <td colspan="2" style="font-weight: bold; font-size: 10pt;">Cotización</td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Fecha:</td>
                <td><?= fecha_dmy($get['fecha_now']) ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Boleta:</td>
                <td><?= $get['cod_cotizacion'] ?></td>
              </tr>
              <tr>
                <td style="font-weight: bold;">Exp. Fecha:</td>
                <td><?= fecha_dmy($get['fecha_exp']) ?></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>

    <div class="list-component" style="margin-top: 30px; font-size: 9.5pt;">

      <!-- Encabezado de la tabla -->
      <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse: collapse; border-bottom: 1px solid #216E71; padding-bottom: 20px;">
        <thead>
          <tr style="background-color: #f8f9fa; font-weight: bold; text-align: left;">
            <td style="width: 40%;">DESCRIPCIÓN DEL SERVICIO</td>
            <td style="width: 15%;">DÍAS(HÁBILES)</td>
            <td style="width: 15%;">CANTIDAD</td>
            <td style="width: 15%; text-align: right;">PRECIO T.</td>
          </tr>
        </thead>
        <tbody>
          <tr style="vertical-align: top;">
            <td style="font-weight: bold;"><?= mb_strtoupper($get['trabajo']) ?></td>
            <td style="text-align: center;">60</td>
            <td style="text-align: center;">1</td>
            <td style="text-align: right;"><?= ($get['moneda'] == 'PEN') ? 'S/. ' : '$ ' ?> <?= moneda($get['monto']) ?></td>
          </tr>
        </tbody>
      </table>

      <!-- Detalles del servicio -->
      <div style="margin-top: 10px; padding-right: 10px;">
        <strong>Componentes:</strong>
        <ul style="margin: 3px 0 10px 15px; padding: 0;">
          <?php foreach ($list as $row) { ?>
            <li><?= $row['cantidad'] . ' ' . $row['title'] . ': ' . $row['descripcion'] ?></li>
          <?php } ?>
        </ul>

        <strong>Procesos: </strong>


        <ul style="margin: 3px 0 10px 15px; padding: 0;">
          <?php foreach ($medidas[$get['servicio']] as $item): ?>
            <li><?= esc($item) ?></li>
          <?php endforeach; ?>
        </ul>




        <strong>Incluye:</strong>
        <ul style="margin: 3px 0 10px 15px; padding: 0;">
          <li>Garantía 1 año</li>
        </ul>
      </div>

      <div class="linea-separadora"></div>

      <table width="100%" cellpadding="6" cellspacing="0" style="margin-top: 15px; font-size: 9.5pt;">
        <tr>
          <!-- Métodos de Pago -->
          <td width="60%" valign="top" style="padding: 10px; background-color: #f8f9fa; border-radius: 6px;">
            <strong style="display: block; margin-bottom: 8px; color: #000;">MÉTODOS DE PAGO:</strong>

            <table cellpadding="4" cellspacing="0" style="width: 100%;">
              <tr>
                <td style="padding: 4px 0;">
                  <strong>Transferencias:</strong><br>
                  ▸ Interbank (Soles) 898-3003906137 - CCI: 003-898-003003906137-46<br>
                  ▸ BCP (A consultar)
                </td>
              </tr>
              <tr>
                <td style="padding: 4px 0;">
                  <strong>Tarjetas:</strong><br>
                  ▸ Crédito/Débito (+4.5% comisión)
                </td>
              </tr>
              <tr>
                <td style="padding: 4px 0;">
                  <strong>Digital:</strong><br>
                  ▸ Yape ▸ Plín ▸ Efectivo
                </td>
              </tr>
            </table>
          </td>

          <!-- Totales -->
          <td width="40%" valign="top">
            <table width="100%" cellpadding="4" cellspacing="0"
              style="border: 1px solid #dee2e6; border-radius: 6px; margin-left: 15px;">
              <tr>
                <td style="padding: 6px 8px; border-bottom: 1px solid #dee2e6;">
                  <strong>SubTotal:</strong>
                </td>
                <td style="padding: 6px 8px; border-bottom: 1px solid #dee2e6; text-align: right;">
                  <?= ($get['moneda'] == 'PEN') ? 'S/. ' : '$ ' ?> <?= moneda($get['monto']) ?>
                </td>
              </tr>
              <?php if ($get['igv'] == 1): ?>
                <tr>
                  <td style="padding: 6px 8px; border-bottom: 1px solid #dee2e6;">
                    <strong>IGV: (18)%</strong>
                  </td>
                  <td style="padding: 6px 8px; border-bottom: 1px solid #dee2e6; text-align: right;">
                    <?= ($get['moneda'] == 'PEN') ? 'S/. ' : '$ ' ?> <?= moneda($get['igv_valor']) ?>
                  </td>
                </tr>
              <?php endif; ?>

              <?php if ($get['aplica_descuento'] == 1): ?>
                <tr>
                  <td style="padding: 6px 8px; border-bottom: 1px solid #dee2e6;">
                    <strong>Descuento:</strong>
                  </td>
                  <td style="padding: 6px 8px; border-bottom: 1px solid #dee2e6; text-align: right;">
                    - <?= ($get['moneda'] == 'PEN') ? 'S/. ' : '$ ' ?> <?= moneda($get['descuento']) ?>
                  </td>
                </tr>
              <?php endif; ?>

              <tr>
                <td style="padding: 6px 8px;">
                  <strong>TOTAL:</strong>
                </td>
                <td style="padding: 6px 8px; text-align: right; color: #2c3e50; font-weight: bold;">
                  <?= ($get['moneda'] == 'PEN') ? 'S/. ' : '$ ' ?> <?= moneda($get['monto_final']) ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>


    </div>

    <div class="observaciones" style="margin-top: 15px; padding: 10px; border: 1px solid #dee2e6; border-radius: 6px; font-size: 9.5pt;">
      <h4 style="margin: 0 0 8px 0; color: #000; border-bottom: 1px solid #dee2e6; padding-bottom: 5px;">OBSERVACIONES</h4>

      <table cellpadding="4" cellspacing="0" style="width: 100%;">
        <tr>
          <td style="padding: 3px 0; vertical-align: top; width: 20px;">•</td>
          <td style="padding: 3px 0;"><?= $get['diagnostico'] ?></td>
        </tr>
      </table>
    </div>

  </div>

</body>

</html>