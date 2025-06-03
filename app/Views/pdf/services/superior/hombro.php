<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha de Evaluación Transradial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.3;
            color: #333;
            background-color: #fff;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 180mm;
            margin: 0 auto;
            padding: 3mm;
            padding-top: 10mm;
        }

        .header {
            text-align: center;
            margin-bottom: 4mm;
            padding-bottom: 2mm;
            border-bottom: 1px solid #2c3e50;
        }

        .header h1 {
            font-size: 11pt;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            margin: 1mm 0;
            letter-spacing: 0.5px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3mm;
        }

        .info-table td {
            padding: 2mm 1mm;
            vertical-align: baseline;
        }

        .info-label {
            width: 20%;
            font-weight: bold;
            padding-right: 1mm;
        }

        .section {
            margin-bottom: 4mm;
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

        .eval-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2mm;
        }

        .eval-table td {
            padding: 1.5mm 1mm;
            vertical-align: baseline;
        }

        .eval-label {
            width: 50%;
            font-weight: 500;
        }

        .underline-field {
            font-family: monospace;
            letter-spacing: 1.5px;
            color: #333;
        }

        .checkbox-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2mm 0;
        }

        .checkbox-table td {
            padding: 1.5mm 0;
            text-align: center;
            border: 0.5px solid #e0e0e0;
        }

        .checkbox-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .checkbox-item input {
            margin-bottom: 0.5mm;
            transform: scale(1.2);
        }

        .textarea-field {
            width: 100%;
            min-height: 15mm;
            padding: 2mm;
            border: 1px solid #d1d1d1;
            font-family: inherit;
            font-size: 9pt;
            background: #fff;
            margin-top: 1mm;
        }

        .price-section {
            display: flex;
            align-items: baseline;
            margin-top: 3mm;
        }

        .price-label {
            font-weight: bold;
            margin-right: 2mm;
        }

        .signature-area {
            margin-top: 8mm;
            padding-top: 3mm;
            border-top: 1px dashed #ccc;
            text-align: center;
        }

        .signature-line {
            display: inline-block;
            width: 70mm;
            border-bottom: 1px solid #666;
            margin: 8mm 0 2mm;
        }

        .line-uso {
            width: 100%;
            border-bottom: 1px solid #666;
            margin: 8mm 0 2mm;
        }

        .footer {
            text-align: center;
            font-size: 8pt;
            color: #666;
            margin-top: 4mm;
            padding-top: 2mm;
            border-top: 0.5px solid #e0e0e0;
        }

        .double-line {
            font-family: monospace;
            letter-spacing: 1.5px;
            display: block;
            margin-bottom: 1mm;
            color: #333;
        }

        .new-page {
            padding-top: 10mm;
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>FICHA DE EVALUACIÓN DESARTICULADO DE HOMBRO / INTERESCÁPILO TORÁCICO</h1>
        </div>

        <table class="info-table">
            <tr>
                <td class="info-label">PACIENTE:</td>
                <td><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos']) ?></td>
            </tr>
            <tr>
                <td class="info-label">LADO:</td>
                <td class="">_____________</td>
            </tr>
            <tr>
                <td class="info-label">EDAD:</td>
                <td class="">_____________</td>
            </tr>
        </table>

        <div class="section">
            <div class="section-title">USO DE LA PRÓTESIS PARA:</div>
            <div class="">
                <div class="line-uso"></div>
                <div class="line-uso"></div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">EVALUACIONES</div>
            <table class="eval-table">
                <tr>
                    <td class="eval-label">Sensibilidad:</td>
                    <td class="">_________________________</td>
                </tr>
                <tr>
                    <td class="eval-label">Nivel de Amputación:</td>
                    <td class="">_________________________</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">MEDIDAS</div>
            <table class="eval-table">
                <tr>
                    <td class="eval-label">1. Acrinión - Epicóndilo:</td>
                    <td class="">______________________________________________</td>
                </tr>
                <tr>
                    <td class="eval-label">2. Epicóndilo - Punta dedo pulgar:</td>
                    <td class="">______________________________________________</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">OBSERVACIONES Y ANOTACIONES:</div>
            <div class="">
                <div class="line-uso"></div>
                <div class="line-uso"></div>
                <div class="line-uso"></div>
                <div class="line-uso"></div>
            </div>
        </div>

        <div class="section">
            <div class="price-section">
                <div class="price-label">PRECIO ESTIMADO:</div>
                <div class="line-uso"></div>
            </div>
        </div>
    </div>
</body>