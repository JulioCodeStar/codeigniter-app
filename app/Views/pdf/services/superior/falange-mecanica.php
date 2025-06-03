<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Evaluación Falange</title>
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

        .doc-info {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 12px;
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

        .info-value {
            background: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #d1d1d1;
            font-weight: 500;
            min-height: 40px;
            display: flex;
            align-items: center;
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

        .line-uso {
            width: 100%;
            border-bottom: 1px solid #666;
            margin: 8mm 0 2mm;
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
            width: 25%;
            font-weight: 500;
        }

        .measures-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .measures-table th {
            background: #2c3e50;
            color: white;
            font-weight: 500;
            padding: 10px;
            text-align: left;
        }

        .measures-table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .measures-table tr:nth-child(even) {
            background: #f5f7f9;
        }

        .finger-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d1d1;
            border-radius: 4px;
            background: white;
        }

        .textarea-field {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            border: 1px solid #d1d1d1;
            border-radius: 4px;
            font-family: inherit;
            font-size: 10pt;
            resize: vertical;
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

        .footer {
            text-align: center;
            font-size: 8pt;
            color: #666;
            margin-top: 4mm;
            padding-top: 2mm;
            border-top: 0.5px solid #e0e0e0;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>FICHA DE EVALUACIÓN MANO PARCIAL</h1>
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
                    <td class="eval-label">Movilidad:</td>
                    <td class="">_________________________</td>
                </tr>
                <tr>
                    <td class="eval-label">Sensibilidad:</td>
                    <td class="">_________________________</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">MEDIDAS</div>
            <table class="measures-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nivel de Amputación</th>
                        <th>Longitud del muñón (mm)</th>
                        <th>Longitud lado contralateral (mm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1. Pulgar</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Índice</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Medio</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Anular</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5. Meñique</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">OBSERVACIONES Y ANOTACIONES</div>
            <div class="line-uso"></div>
            <div class="line-uso"></div>
        </div>

        <div class="section">
            <div class="price-section">
                <div class="price-label">PRECIO ESTIMADO:</div>
                <div class="line-uso"></div>
            </div>
        </div>
        
        
        <div class="footer">
            <p>Ficha generada el <?= $fecha ?> | Página 1/1 | Documento confidencial</p>
        </div>
    </div>
</body>

</html>