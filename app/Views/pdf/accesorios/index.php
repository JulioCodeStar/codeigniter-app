<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Carta de Entrega</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        .container {
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
            font-size: 10.5pt;
            text-align: justify;
        }

        .new-page {
            page-break-before: always;
            padding-top: 70px;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            font-size: 9.5pt;
            padding: 10px 30px;
            vertical-align: bottom;
            height: 120px;
        }

        .signature-content {
            position: relative;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto 5px auto;
        }

        .signature-name {
            font-weight: bold;
            font-size: 9.5pt;
            margin-top: 5px;
        }

        .signature-img {
            display: block;
            position: absolute;
            bottom: 30px;
            left: 0;
            right: 0;
            margin: 0 auto;
            max-width: 20%;
        }

        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #2c3e50;
            background-color: #f5f7f9;
            padding: 2mm 3mm;
            margin-bottom: 2mm;
            border-left: 3px solid #2c3e50;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-compact">
            <h4>CARTA DE ENTREGA</h4>
        </div>

        <div class="data-compact">
            <p>Estimado(a) Sr(a). <?= $paciente ?>, </p>
            <p>En KYP BIO INGEN SAC, dejamos constancia de que el producto ha sido entregado en óptimas condiciones, cumpliendo con los estándares de calidad establecidos por nuestra empresa. Nos aseguramos de que cada detalle haya sido verificado cuidadosamente para garantizar su satisfacción.</p>
        </div>

        <div class="data-compact">
            <strong>Detalles de la Prótesis Entregada:</strong>
            <p>Tipo de Accesorios: <?= $trabajo ?></p>
            <p>Fabricante: KYP BIO INGEN SAC</p>
            <ul>
                <?php foreach ($id_coti as $item) : ?>
                    <li><?= $item['cantidad'] . ' ' . $item['title'] . ': ' . $item['descripcion'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="data-compact">
            <p>Agradecemos sinceramente la confianza depositada en nosotros al adquirir este producto. Es nuestro compromiso continuar brindando soluciones de la más alta calidad, respaldadas por nuestro enfoque en la excelencia y el servicio al cliente. Gracias por su compra y por ser parte de nuestra comunidad de pacientes.</p>
        </div>

        <div class="data-compact">
            <p>Atentamente,</p>
        </div>

        <div class="data-compact">
            <table class="signature-table">
                <tr>
                    <td>
                        <div class="signature-content">
                            <hr class="signature-line">
                            <div class="signature-name">ADMINISTRACIÓN</div>
                            <div>KYP BIO INGEN SAC</div>
                            <div></div>
                        </div>
                    </td>
                    <td>
                        <div class="signature-content">
                            <hr class="signature-line">
                            <div class="signature-name"><?= $paciente ?></div>
                            <div>DNI: <?= $dni ?></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>