<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Evaluación Estética</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 9.5pt;
            line-height: 1.3;
            color: #333;
            background-color: #fff;
            padding: 0;
            margin: 0;
        }
        
        .container {
            max-width: 190mm;
            margin: 0 auto;
            padding: 3mm;
        }
        
        .header {
            text-align: center;
            padding-top: 7mm;
            margin-bottom: 5mm;
            padding-bottom: 2mm;
            border-bottom: 1px solid #4a6572;
        }
        
        .header h1 {
            font-size: 11pt;
            font-weight: 600;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 1mm 0;
        }
        
        .paciente-info {
            margin-bottom: 4mm;
            padding-bottom: 2mm;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .paciente-name {
            font-size: 9pt;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            padding: 2mm;
            background-color: #f8f9fa;
            border-radius: 2px;
            border: 1px solid #e0e0e0;
            margin-bottom: 1mm;
        }
        
        .section {
            margin-bottom: 4mm;
        }
        
        .section-title {
            font-size: 9.5pt;
            font-weight: 600;
            color: #2c3e50;
            background-color: #f0f3f5;
            padding: 2mm 3mm;
            border-radius: 2px;
            margin-bottom: 2mm;
            border-left: 2px solid #4a6572;
        }
        
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1mm;
            font-size: 8.5pt;
        }
        
        .form-table td {
            padding: 2mm 2mm;
            border: 0.5px solid #e0e0e0;
            vertical-align: top;
            height: 7mm;
        }
        
        .field-title {
            width: 40%;
            font-weight: 500;
            background-color: #f8f9fa;
        }
        
        .field-value {
            width: 60%;
        }
        
        .field-value input, .field-value select {
            width: 100%;
            padding: 1.5mm;
            border: 1px solid #d1d1d1;
            border-radius: 2px;
            font-family: inherit;
            font-size: 8.5pt;
            background: #fff;
        }
        
        .field-value textarea {
            width: 100%;
            padding: 1.5mm;
            border: 1px solid #d1d1d1;
            border-radius: 2px;
            min-height: 15mm;
            resize: none;
            font-family: inherit;
            font-size: 8.5pt;
            background: #fff;
        }
        
        .comments-section {
            margin-top: 3mm;
        }
        
        .comments-section textarea {
            width: 100%;
            min-height: 20mm;
            padding: 2mm;
            border: 1px solid #d1d1d1;
            border-radius: 2px;
            font-family: inherit;
            font-size: 8.5pt;
            background: #fff;
        }
        
        .signature-area {
            margin-top: 4mm;
            padding-top: 2mm;
            border-top: 1px dashed #ccc;
            text-align: center;
        }
        
        .signature-line {
            display: inline-block;
            width: 70mm;
            border-bottom: 1px solid #666;
            margin: 10mm 0 2mm;
        }
        
        .footer {
            text-align: center;
            font-size: 7.5pt;
            color: #666;
            margin-top: 3mm;
            padding-top: 2mm;
            border-top: 0.5px solid #e0e0e0;
        }
        
        .compact-row td {
            padding: 1.5mm 2mm !important;
            height: 6mm;
        }

        .field-value-text {
            padding: 2mm;
            border: 1px solid #d1d1d1;
            border-radius: 2px;
            font-family: inherit;
            font-size: 8.5pt;
            background: #fff;
            width: 100%;
            height: 20mm;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FICHA DE EVALUACIÓN ESTÉTICA</h1>
        </div>
        
        <div class="paciente-info">
            <div class="paciente-name"><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos']) ?></div>
        </div>
        
        <div class="section">
            <div class="section-title">INFORMACIÓN DE LA PRÓTESIS</div>
            <table class="form-table">
                <tr>
                    <td class="field-title">Tipo de Prótesis:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Propósito de la Prótesis:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Color de la Prótesis Deseado:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Material Preferido:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr class="compact-row">
                    <td class="field-title">Fecha Estimada de Uso:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <div class="section-title">INFORMACIÓN MÉDICA</div>
            <table class="form-table">
                <tr>
                    <td class="field-title">Causa de la Pérdida:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Extensión de la Pérdida:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr class="compact-row">
                    <td class="field-title">Existencia de Condiciones Médicas Relevantes:</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <div class="section-title">EXPECTATIVA DEL PACIENTE</div>
            <table class="form-table">
                <tr>
                    <td class="field-title">¿Qué espera lograr con la prótesis?</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr>
                    <td class="field-title">¿Preferencia sobre la apariencia de la prótesis?</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
                <tr class="compact-row">
                    <td class="field-title">¿Cuál es su nivel de actividad diaria?</td>
                    <td class="field-value">
                        
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="comments-section">
            <div class="section-title">COMENTARIOS ADICIONALES</div>
            <div class="field-value-text">
                
            </div>
        </div>
        
        <div class="footer">
            <p>Ficha generada el <?php echo date('d/m/Y'); ?> | Documento confidencial</p>
        </div>
    </div>
</body>
</html>