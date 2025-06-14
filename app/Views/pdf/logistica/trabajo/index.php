<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Trabajo</title>
    <style>
        body {
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            font-size: 10pt;
            background-color: #ffffff;
            padding: 20px;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding-top: 90px;
        }

        .info-block {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: bold;
            color: #1e293b;
            display: block;
            margin-bottom: 3px;
        }

        .info-value {
            color: #555;
            background: #f9fafb;
            border: 1px solid #e2e8f0;
            padding: 8px;
            border-radius: 4px;
        }

        .urgent {
            background-color: #FFEBEE;
            color: #C62828;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .signature-table {
            width: 100%;
            margin-top: 40px;
            border-top: 2px solid #e2e8f0;
            padding-top: 20px;
        }

        .signature-table td {
            width: 33.33%;
            text-align: center;
            padding: 0 10px;
            vertical-align: top;
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

        <!-- Campos uno debajo del otro -->
        <div class="info-block">
            <label class="info-label">Nivel de Necesidad:</label>
            <div class="info-value"><span class="<?= $trabajo['necesidad'] == 'Urgente' ? 'urgent' : '' ?>"><?= mb_strtoupper($trabajo['necesidad']); ?></span></div>
        </div>

        <div class="info-block">
            <label class="info-label">Requerido Por:</label>
            <div class="info-value"><?= $trabajo['area_responsable']; ?></div>
        </div>

        <div class="info-block">
            <label class="info-label">Aprobado Por:</label>
            <div class="info-value"><?= $trabajo['aprobado_por']; ?></div>
        </div>

        <div class="info-block">
            <label class="info-label">Actividad a Realizar:</label>
            <div class="info-value"><?= $trabajo['actividad']; ?></div>
        </div>

        <div class="info-block">
            <label class="info-label">Descripción:</label>
            <div class="info-value"><?= $trabajo['descripcion']; ?></div>
        </div>

        <div class="info-block">
            <label class="info-label">Requerido A:</label>
            <div class="info-value"><?= $trabajo['requerido_a']; ?></div>
        </div>

        <div class="info-block">
            <label class="info-label">Responsable de la Ejecución:</label>
            <div class="info-value"><?= $trabajo['responsable']; ?></div>
        </div>

        <div class="info-block">
            <label class="info-label">Fecha estimada de entrega:</label>
            <div class="info-value"><?= fecha_spanish($trabajo['tiempo_eje']); ?></div>
        </div>

        <!-- Firmas -->
        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-line">
                        <div class="signature-label">FIRMA</div>
                    </div>
                    <div class="signature-title"><?= $trabajo['area_responsable']; ?></div>
                    <div><?= $trabajo['aprobado_por']; ?></div>
                </td>
                <td>
                    <div class="signature-line">
                        <div class="signature-label">FIRMA</div>
                    </div>
                    <div class="signature-title">Administración</div>
                </td>
                <td>
                    <div class="signature-line">
                        <div class="signature-label">FIRMA</div>
                    </div>
                    <div class="signature-title"><?= $trabajo['requerido_a']; ?></div>
                    <div><?= $trabajo['responsable']; ?></div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
