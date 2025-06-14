<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Carta de Conformidad</title>
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
            <h4>Ref.: CARTA DE CONFORMIDAD</h4>
        </div>

        <div class="data-compact">
            <p>Estimado(a) Sr(a). <?= $paciente ?>, </p>
            <p>En KYP Bio Ingen, estamos emocionados de ser parte de este paso importante en su vida
                y agradecemos sinceramente su confianza en nuestros servicios.</p>
        </div>

        <div class="data-compact">
            <strong>Detalles de la Prótesis Entregada:</strong>

            <p>Tipo de Prótesis: <?= $trabajo ?></p>
            <p>Fabricante: KYP BIO INGEN SAC</p>
            <ul>
                <?php foreach ($items as $item) : ?>
                    <li><?= $item['descripcion'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="data-compact">
            <p>Nos esforzamos por proporcionar productos que no solo sean funcionales y duraderos, sino también cómodos y adaptados a sus necesidades individuales. Esperamos que esta prótesis contribuya significativamente a mejorar su calidad de vida.</p>
        </div>

        <div class="data-compact">
            <p>Al finalizar tu periodo de prueba, pasaremos al cambio de tu encaje PROVICIONAL a un
                encaje en FIBRA DE CARBONO, contribuyendo a que tu nuevo encaje se adapte mejor con
                tus nuevas medidas y las correcciones necesarias.</p>

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