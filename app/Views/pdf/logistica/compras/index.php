<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Orden de Compra</title>
    <style>
        /* Estilos compatibles con MPDF */
        body {
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            background-color: #ffffff;
            padding: 20px;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Encabezado */
        .header-top {
            width: 100%;
            padding: 0 20px 10px;
            border-bottom: 2px solid #2563eb;
            margin-bottom: 20px;
        }

        .order-title {
            font-size: 20pt;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }

        .order-meta {
            margin-top: 5px;
        }

        .order-number {
            display: inline-block;
            background: #dbeafe;
            color: #64748b;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 11pt;
        }

        .order-date {
            color: #64748b;
            font-size: 10pt;
            margin-top: 3px;
        }

        /* Secciones de información */
        .section {
            width: 100%;
            margin-bottom: 0px;
        }

        .section-title {
            background: #216E71;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            border-radius: 4px 4px 0 0;
        }

        .info-card {
            border-top: none;
            padding: 15px;
            border-radius: 0 0 4px 4px;
        }

        .info-row {
            margin-bottom: 8px;
            width: 100%;
        }

        .info-label {
            width: 150px;
            display: inline-block;
            font-weight: bold;
            color: #1e293b;
            vertical-align: top;
        }

        .info-value {
            display: inline-block;
            width: calc(100% - 160px);
        }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .detail-row td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
            padding-top: 15px;
            padding-bottom: 15px;
        }


        .detail-hd th {
            background-color: rgb(195, 224, 225);
            text-align: left;
            padding: 12px 15px;
            font-weight: bold;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
        }

        .sub-table {
            width: 100%;
            margin-top: 8px;
        }

        .sub-table td {
            border: none;
            padding: 3px 0;
            font-size: 9pt;
        }

        .sub-label {
            font-weight: bold;
            color: #64748b;
            width: 90px;
            display: inline-block;
        }

        /* Totales */
        .total-row {
            font-weight: bold;
            color: #1e293b;
        }

        .total-row td {
            background: rgb(195, 224, 225);
            border-top: 2px solid #e2e8f0;
            border-bottom: none;
            padding: 15px;
        }

        .total-label {
            text-align: right;
            padding-right: 20px;
        }

        /* Firmas */
        .signature-section {
            width: 100%;
            margin-top: 40px;
        }

        .signature-box {
            width: 45%;
            display: inline-block;
            text-align: center;
            margin-right: 8%;
        }

        .signature-box:last-child {
            margin-right: 0;
        }

        .signature-line {
            height: 1px;
            background: #e2e8f0;
            margin: 40px 0 10px;
            position: relative;
        }

        .signature-label {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 0 15px;
            color: #64748b;
            font-size: 9pt;
        }

        .signature-title {
            color: #1e293b;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Información del proveedor y orden -->
        <div class="section" style="padding-top: 80px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                        <div style="font-weight: bold;">Información del Proveedor</div>
                        <div class="info-card">
                            <div class="info-row">
                                <span class="info-label">Empresa:</span>
                                <span class="info-value">Servicios Técnicos Especializados S.A.</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Contacto:</span>
                                <span class="info-value">Ing. Carlos Mendoza</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Correo:</span>
                                <span class="info-value">contacto@serviciostecnicos.com</span>
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top; padding-left: 10px; text-align: left;">
                        <div style="font-weight: bold;">Información de la Compra</div>
                        <div class="info-card">
                            <div class="info-row">
                                <span class="info-label">Área Solicitante:</span>
                                <span class="info-value"><?= $compra['area'] ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Forma de Pago:</span>
                                <span class="info-value"><?= $compra['forma_pago'] ?></span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Detalle de la orden -->
        <div class="section">
            <div class="section-title">Detalle de la Orden</div>
            <table>
                <thead>
                    <tr class="detail-hd">
                        <th style="width: 10%;">Cant.</th>
                        <th style="width: 13%">Unidad</th>
                        <th style="width: 35%">Detalle</th>
                        <th style="width: 12%">Precio Unit.</th>
                        <th style="width: 12%">Fecha Solic.</th>
                        <th style="width: 12%">Fecha Entrega</th>
                        <th style="width: 12%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr class="detail-row">
                            <td><?= $item['cantidad'] ?></td>
                            <td><?= $item['unidad'] ?></td>
                            <td>
                                <div><?= $item['nombre'] ?></div>
                                <table class="sub-table">
                                    <tr>
                                        <td><span class="sub-label">Necesidad:</span> <?= $item['necesidad'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><span class="sub-label">Concepto:</span> <?= $item['concepto'] ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?= moneda($item['precio']) ?></td>
                            <td><?= fecha_dmy($item['fecha_sol']) ?></td>
                            <td><?= fecha_dmy($item['fecha_ent']) ?></td>
                            <td><?= moneda($item['total']) ?></td>
                        </tr>
                    <?php } ?>

                    <tr class="total-row">
                        <td colspan="6" class="total-label" style="font-weight: bold;">TOTAL</td>
                        <td style="font-weight: bold;"><?= ($compra['moneda'] == 'PEN') ? 'S/. ' . moneda($compra['total']) : '$ ' . moneda($compra['total'])  ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Firmas -->
        <table class="signature-table" style="width: 100%; margin-top: 40px; border-top: 2px solid #e2e8f0; padding-top: 20px;">
            <tr>
                <td style="width: 50%; text-align: center; padding: 0 20px;">
                    <div style="height: 1px; margin: 40px 0 10px; position: relative;">
                        <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 15px; color: #64748b; font-size: 9pt;">
                            FIRMA
                        </div>
                    </div>
                    <div style="color: #1e293b; font-weight: bold; margin-bottom: 5px;"><?= $compra['area'] ?></div>
                </td>
                <td style="width: 50%; text-align: center; padding: 0 20px;">
                    <div style="height: 1px; margin: 40px 0 10px; position: relative;">
                        <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 15px; color: #64748b; font-size: 9pt;">
                            FIRMA
                        </div>
                    </div>
                    <div style="color: #1e293b; font-weight: bold; margin-bottom: 5px;">Administración</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>