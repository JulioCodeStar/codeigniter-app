<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ficha de Evaluación Amputación de Pie</title>
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
            padding: 10mm 3mm 3mm 3mm;
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

        .eval-table {
            width: 60%;
            border-collapse: collapse;
            margin-bottom: 2mm;
        }

        .eval-table td {
            padding: 1.5mm 1mm;
            vertical-align: baseline;
        }

        .eval-label {
            width: 40%;
            font-weight: 500;
        }

        .eval-nombre {
            width: 80%;
            font-weight: bold;
        }

        .section {
            margin-bottom: 4mm;
        }

        .section-medio {
            margin-bottom: 35px;
            padding: 20px;
            border-radius: 8px;
            background: #f8f9fa;
            border-left: 4px solid #3498db;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
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

        .eval-label-encaje {
            width: 100%;
            font-weight: 500;
            border: 1px;
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

        .new-page {
            padding-top: 10mm;
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div style="
        position: fixed;
        top: -60;
        left: -55;
        transform: translateX(-10%);
        width: 100%;
        opacity: 0.2;
        z-index: -1;">
        <img src="<?= $background ?>" style="width: 100%;">
    </div>
    <div class="container">
        <div class="header">
            <h1>FICHA DE EVALUACIÓN AMPUTACIÓN DE PIE</h1>
        </div>

        <table class="eval-table">
            <tr>
                <td class="eval-label">PACIENTE:</td>
                <td class="eval-nombre"><?= mb_strtoupper($paciente['nombres'] . ' ' . $paciente['apellidos']) ?></td>
                <td class="eval-label">MONTO TOTAL:</td>
                <td class="">______________________________</td>
            </tr>
        </table>

        <table class="eval-table">
            <tr>
                <td class="eval-label">PESO(KG): </td>
                <td class="eval-nombre">___________</td>
            </tr>
            <tr>
                <td class="eval-label">SELECCIÓN DE PRÓTESIS:</td>
                <td class="">( ) Chopart ( ) Linsfrack ( ) Metatarsal</td>
            </tr>
        </table>


    </div>
</body>

</html>