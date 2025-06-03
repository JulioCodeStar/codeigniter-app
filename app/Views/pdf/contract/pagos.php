<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago - <?= $trabajo ?></title>

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
            font-size: 9.5pt;
            text-align: justify;
        }

        .new-page {
            page-break-before: always;
            padding-top: 70px;
        }

        .signature-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 33.33%;
            padding: 10px;
            text-align: center;
            font-size: 14px;
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
            font-size: 14px;
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

        .payment-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 20px 0;
            font-size: 9.5pt;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .payment-table thead {
            background: linear-gradient(to right, #216E71, #1a5a5c);
            color: white;
        }

        .payment-table th {
            padding: 10px 15px;
            text-align: left;
            font-weight: 600;
        }

        .payment-table th:first-child {
            border-top-left-radius: 8px;
        }

        .payment-table th:last-child {
            border-top-right-radius: 8px;
        }

        .payment-table td {
            padding: 10px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .payment-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .payment-table tbody tr:last-child td {
            border-bottom: none;
        }

        .payment-table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 8px;
        }

        .payment-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 8px;
        }

        .total-row {
            background-color: #e6fffa !important;
            font-weight: bold;
            color: #065f46;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-compact">
            <h4>RECIBO DE PAGOS <?= $trabajo ?></h4>
        </div>

        <div class="data-compact">
            <div class="section-title">DATOS:</div>
            <p>Nombres del Paciente: <strong><?= $paciente ?></strong></p>
            <p>Fecha del Contrato: <strong><?= $fecha_inicio ?></strong></p>
        </div>

        <div class="data-compact">
            <div class="section-title">PAGOS:</div>
            <p>Conste por el presente que la empresa <strong>KYP BIO INGEN SAC</strong>, identificado con RUC 20600880081, UBICADA EN Calle Max Palma Arrúe 119, Los Olivos, recibí del Paciente <strong><?= $paciente ?></strong>, identificado con <strong>DNI <?= $dni ?></strong> los siguientes montos:</p>

            <p>Por el pago de una <strong><?= $trabajo ?></strong>.</p>

            <table class="payment-table">
                <thead>
                    <tr>
                        <th style="width: 70%">DESCRIPCIÓN</th>
                        <th style="width: 30%">MONTO (S/.)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Valor total de la prótesis</td>
                        <td>S/. <?= moneda($monto_total) ?></td>
                    </tr>
                    <?php foreach ($pagos as $value) : ?>
                    <tr>
                        <td>Pago <?= $value['pago_nro'] == 1 ? 'Inicial' : $value['pago_nro'] ?> recibido el <?= fecha_dmy($value['created_at']) ?></td>
                        <td>S/. <?= moneda($value['monto']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td>Saldo pendiente</td>
                        <td>S/. <?= moneda($monto_total - array_sum(array_column($pagos, 'monto'))) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="data-compact">
            <p>Para constancia <strong>SE FIRMA LA PRESENTE</strong></p>
            <p>Fecha: <?= $fecha ?></p>
            <p><strong>Recibí Conforme:</strong></p>

            <table class="signature-table">
                <tr>
                    <td>
                        <div class="signature-content">
                            <hr class="signature-line">
                            <div class="signature-name">KYP BIO INGEN SAC</div>
                            <div>ADMINISTRACIÓN</div>
                        </div>
                    </td>
                    <td>
                        <div class="signature-content">
                            <img src="<?= base_url('assets/media/img/firma_digital.png') ?>" class="signature-img" alt="Firma KYP">
                            <hr class="signature-line">
                            <div class="signature-name">KYP BIO INGEN SAC</div>
                            <div>GERENCIA</div>
                        </div>
                    </td>
                    <td>
                        <div class="signature-content">
                            <hr class="signature-line">
                            <div class="signature-name"><?= $paciente ?></div>
                            <div>EL CLIENTE</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</body>

</html>