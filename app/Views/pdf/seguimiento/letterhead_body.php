<html>

<head>
  <title>CONSTANCIA DE RECEPCIÓN DE PRODUCTOS</title>

  <style>
    body {
      font-family: helvetica;
      font-size: 11pt;
    }

    .container {
      margin-left: 60px;
      margin-right: 60px;
      margin-top: 40px;
      font-size: 10pt;
    }

    .container>p {
      text-align: justify;
    }

    .table-responsive {
      margin-top: 40px;
    }

    .firmas {
      margin-top: 40px;
    }
  </style>

</head>

<body>
  <h2 style="text-align: center;">CONSTANCIA DE RECEPCIÓN DE PRODUCTOS</h2>

  <div class="container">
    <strong style="text-align: justify;" class="text-muted">Área de Almacén y Logística – KYP Bioingeniería</strong>
    <p class="text-muted"><strong>Fecha de Recepción:</strong> <?= $reception_date ?></p>
    <p class="text-muted"><strong>Tipo de Producto:</strong> <?= $product_name ?></p>
    <p><strong>Cantidad de Unidades:</strong> <?= $serial_count ?></p>
    <p><strong>Documento de referencia:</strong> Carta de Liberación de Producto – Código: <?= $codigo ?></p>

    <div class="table-responsive">
      <table
        style="
          width:100%; 
          border-collapse:collapse; 
          font-family:sans-serif; 
          font-size:10pt;
        ">
        <thead>
          <tr>
            <th style="
              border:1px solid #ddd;
              background-color:#164a92;
              color:#ffffff;
              padding:6px;
              text-align:center;
            ">
              N°
            </th>
            <th style="
              border:1px solid #ddd;
              background-color:#164a92;
              color:#ffffff;
              padding:6px;
              text-align:center;
            ">
              Código / N° Serie
            </th>
            <th style="
              border:1px solid #ddd;
              background-color:#164a92;
              color:#ffffff;
              padding:6px;
              text-align:center;
            ">
              Especificaciones
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($serials as $index => $serial): ?>
          <tr>
            <td style="
              border:1px solid #ddd;
              padding:6px;
              text-align:center;
            ">
              <?= $index + 1 ?>
            </td>
            <td style="
              border:1px solid #ddd;
              padding:6px;
              text-align:center;
            ">
              <?= $serial['numero_serie_production'] ?>
            </td>
            <td style="
              border:1px solid #ddd;
              padding:6px;
              text-align:center;
            ">
              <?= $serial['especificaciones'] ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>

    <div class="firmas">
      <p style="padding-bottom: 10px;"><strong>Recibido por:</strong></p>
      <table>
        <tr>
          <td>Nombre:</td>
          <td>_________________________________</td>
        </tr>
        <tr>
          <td>Cargo:</td>
          <td>_________________________________</td>
        </tr>
        <tr>
          <td>Firma:</td>
          <td>_________________________________</td>
        </tr>
      </table>
    </div>

    <div class="firmas">
      <p style="padding-bottom: 10px;"><strong>Entregado por:</strong></p>
      <table>
        <tr>
          <td><?php
            switch($area) {
              case 'Desarrollo Tecnológico':
                echo 'Noe Colla Muñoz';
                break;
              case 'Producción':
                echo 'Carlos Espinoza';
                break;
              case 'Textil':
                echo 'Camila';
                break;
              default:
                echo $area;
            }
            ?></td>
        </tr>
        <tr>
          <td><?php
            switch($area) {
              case 'Desarrollo Tecnológico':
                echo 'Jefe del Área de Desarrollo Tecnológico';
                break;
              case 'Producción':
                echo 'Jefe del Área de Producción';
                break;
              case 'Textil':
                echo 'Área Textil';
                break;
              default:
                echo $area;
            }
            ?></td>
        </tr>
        <tr>
          <td>Firma: _________________________________</td>
        </tr>
      </table>
    </div>

  </div>

</body>

</html>