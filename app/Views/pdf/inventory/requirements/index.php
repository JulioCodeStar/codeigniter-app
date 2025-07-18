<!DOCTYPE html>
<html lang="en">

<head>
    <title>Requerimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            padding: 20px;
            margin: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
        }

        .info td {
            padding: 8px 0;
            vertical-align: top;
            font-size: 12pt;
        }

        /* Sección de Tabla Resumen */
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .explanation {
            font-size: 10pt;
            margin-bottom: 15px;
            color: #666;
        }

        .resumen-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10pt;
        }

        .resumen-table th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
        }

        .resumen-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .resumen-table td:nth-child(3) {
            text-align: left;
        }

        .resumen-table a {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }

        .resumen-table a:hover {
            text-decoration: underline;
        }

        .export-button {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            font-size: 9pt;
            display: inline-block;
        }

        /* Sección de Observaciones */
        .observaciones-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .observaciones-title {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .observaciones-subtitle {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .observaciones-content {
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
            font-size: 10pt;
            min-height: 60px;
        }

        /* Sección de Anexos */
        .anexos-section {
            padding-top: 30px;
            page-break-before: always;
        }

        .anexos-title {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .anexos-explanation {
            font-size: 10pt;
            margin-bottom: 20px;
            color: #666;
        }

        .anexo-item {
            margin-bottom: 30px;
            page-break-inside: avoid;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .anexo-header {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 10px;
            color: #0066cc;
        }

        .anexo-subheader {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .anexo-producto-info {
            margin-bottom: 15px;
            font-size: 10pt;
        }

        .anexo-producto-info div {
            margin-bottom: 3px;
        }

        .anexo-lista-title {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .anexo-lista-explanation {
            font-size: 10pt;
            margin-bottom: 10px;
            color: #666;
        }

        .seriales-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-top: 10px;
        }

        .seriales-table td {
            width: 20%;
            padding: 3px 8px;
            border: none;
            vertical-align: top;
        }

        .no-aplica {
            text-align: center;
            font-style: italic;
            color: #666;
        }

        /* Botón para volver al resumen */
        .volver-resumen {
            display: inline-block;
            margin-top: 15px;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 9pt;
            color: #333;
            text-decoration: none;
        }

        .volver-resumen:hover {
            background-color: #e0e0e0;
        }

        /* Firmas */
        .signatures-section {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #eee;
        }

        .signatures-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 25px;
            color: #333;
        }

        .signatures-grid {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .signature-cell {
            width: 50%;
            padding: 15px;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            width: 80%;
            height: 1px;
            background: #333;
            margin: 0 auto 15px;
        }

        .signature-label {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 11pt;
        }

        .signature-info {
            font-size: 10pt;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container" style="padding-top: 20px;">
        <div class="info">
            <table>
                <tr>
                    <td style="width: 70%;">Envío desde <strong><?= $sede_destino ?></strong> con destino a <strong><?= $sede_origen ?></strong></td>
                </tr>
                <tr>
                    <td style="width: 50%;"><strong>Area Solicitante: </strong> <?= $area ?></td>
                    <td style="width: 50%; text-align: right;"><strong>Nombre Solicitante:</strong> <?= $nombre_solicitante ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; "><strong>Fecha de envío:</strong> <?= fecha_dmy($fecha_entrega) ?></td>
                </tr>
            </table>
        </div>

        <!-- Tabla Resumen de Productos -->
        <div class="section-title">(Tabla Resumen de Productos)</div>

        <table class="resumen-table">
            <thead>
                <tr>
                    <th style="width: 8%;">Ítem</th>
                    <th style="width: 25%;">Descripción del Producto</th>
                    <th style="width: 12%;">Cantidad</th>
                    <th style="width: 30%;">Pcte - dtor o tipo</th>
                    <th style="width: 30%;">F.V. o F.C - Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $productNames[$item['product_id']] ?? 'Producto no encontrado' ?></td>
                        <td><?= $item['cantidad'] ?></td>
                        <td>
                            <?php
                            if ($item['tipo'] === 'Paciente') {
                                echo mb_strtoupper($pacienteNames[$item['descripcion']]) ?? 'Paciente no encontrado';
                            } else {
                                echo $item['descripcion'];
                            }
                            ?>
                        </td>
                        <td><?= $item['observacion'] ?? 'N/A' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Sección de Firmas -->
        <div class="signatures-section">
            <div class="signatures-title">FIRMAS DE CONFORMIDAD</div>
            <table class="signatures-grid">
                <tr>
                    <td class="signature-cell">
                        <div class="signature-label">Área Solicitante</div>
                        <div class="signature-line"></div>
                        <div class="signature-info">
                            <strong><?= $area ?></strong><br>
                            Nombre: <?= $nombre_solicitante ?><br>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>