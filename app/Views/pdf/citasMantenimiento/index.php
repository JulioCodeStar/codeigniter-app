<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo - KYP BIOINGEN S.A.C</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .container {
            padding: 15mm;
        }

        .header {
            width: 100%;
            border-bottom: 1px solid #999;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header table {
            width: 100%;
        }

        .logo {
            width: 90px;
        }

        .left-info p,
        .right-info p {
            margin: 2px 0;
        }

        .title {
            font-size: 16pt;
            font-weight: bold;
        }

        .table-content {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table-content th {
            background-color: #f0f0f0;
            color: #000;
            padding: 5px;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .table-content td {
            padding: 6px;
            border: 1px solid #ccc;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 11pt;
            margin-top: 10px;
        }

        .signatures {
            width: 100%;
            margin-top: 60px;
            text-align: center;
        }

        .signatures td {
            width: 50%;
        }

        .signature-line {
            margin-top: 30px;
            border-top: 1px solid #000;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        .observation {
            margin-top: 25px;
        }

        .observation p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td class="left-info" style="width: 60%;">
                        <img style="padding-bottom: 10px;" class="logo" src="<?= base_url('assets/media/img/encabezado.png'); ?>" alt="Logo">
                        <p><strong>KYP BIOINGEN S.A.C</strong></p>
                        <p>Cal. Max Palma Arrúe Nro. 119</p>
                        <p><strong>Nombre:</strong> <?= mb_strtoupper($cita[0]['nombres'] . ' ' . $cita[0]['apellidos']) ?></p>
                        <p><strong>DNI:</strong> <?= $cita[0]['dni'] ?></p>
                    </td>
                    <td class="right-info" style="width: 40%; text-align: right;">
                        <p class="title">RECIBO</p>
                        <p><strong>Código:</strong> <?= $cita[0]['cod_paciente'] ?></p>
                        <p><strong>Fecha:</strong> <?= fecha_dmy($cita[0]['created_at']) ?></p>
                        <p><strong>Servicio:</strong> <?= mb_strtoupper($cita[0]['modulo']) ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <table class="table-content">
            <thead>
                <tr>
                    <th style="width: 70%;">Descripción</th>
                    <th style="width: 30%;">Sub-Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $cita[0]['observaciones'] ?></td>
                    <td>S/. <?= moneda($cita[0]['monto']) ?></td>
                </tr>
            </tbody>
        </table>

        <p class="total">TOTAL: S/. <?= moneda($cita[0]['monto']) ?></p>

        <table class="signatures">
            <tr>
                <td>
                    <hr style="border: 1px solid #000; width: 70%;">
                    Administración
                </td>
                <td>
                    <hr style="border: 1px solid #000; width: 70%;">
                    <?= mb_strtoupper($cita[0]['nombres'] . ' ' . $cita[0]['apellidos']) ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td class="left-info" style="width: 60%;">
                        <img style="padding-bottom: 10px;" class="logo" src="<?= base_url('assets/media/img/encabezado.png'); ?>" alt="Logo">
                        <p><strong>KYP BIOINGEN S.A.C</strong></p>
                        <p>Cal. Max Palma Arrúe Nro. 119</p>
                        <p><strong>Nombre:</strong> <?= mb_strtoupper($cita[0]['nombres'] . ' ' . $cita[0]['apellidos']) ?></p>
                        <p><strong>DNI:</strong> <?= $cita[0]['dni'] ?></p>
                    </td>
                    <td class="right-info" style="width: 40%; text-align: right;">
                        <p class="title">RECIBO</p>
                        <p><strong>Código:</strong> <?= $cita[0]['cod_paciente'] ?></p>
                        <p><strong>Fecha:</strong> <?= fecha_dmy($cita[0]['created_at']) ?></p>
                        <p><strong>Servicio:</strong> <?= mb_strtoupper($cita[0]['modulo']) ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <table class="table-content">
            <thead>
                <tr>
                    <th style="width: 70%;">Descripción</th>
                    <th style="width: 30%;">Sub-Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $cita[0]['observaciones'] ?></td>
                    <td>S/. <?= moneda($cita[0]['monto']) ?></td>
                </tr>
            </tbody>
        </table>

        <p class="total">TOTAL: S/. <?= moneda($cita[0]['monto']) ?></p>

        <table class="signatures">
            <tr>
                <td>
                    <hr style="border: 1px solid #000; width: 70%;">
                    Administración
                </td>
                <td>
                    <hr style="border: 1px solid #000; width: 70%;">
                    <?= mb_strtoupper($cita[0]['nombres'] . ' ' . $cita[0]['apellidos']) ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
