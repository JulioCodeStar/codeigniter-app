<!DOCTYPE html>
<html lang="en">

<head>
    <title>CARTA DE LIBERACIÓN DE PRODUCTO</title>

    <style>
        body {
            font-family: helvetica;
            font-size: 11pt;
        }

        .container {
            margin-left: 60px;
            margin-right: 60px;
            margin-top: 40px;
            font-size: 10pt;
        }

        .container>p {
            text-align: justify;
        }

        .table-responsive {
            margin-top: 40px;
        }

        .firmas {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">CARTA DE LIBERACIÓN DE PRODUCTO</h2>

    <div class="container">
        <strong style="text-align: justify;" class="text-muted"><?php
                switch ($area) {
                    case 'Desarrollo Tecnológico':
                        echo 'Área de Desarrollo Tecnológico';
                        break;
                    case 'Producción':
                        echo 'Área de Producción';
                        break;
                    case 'Textil':
                        echo 'Área de Textil';
                        break;
                    default:
                        echo $area;
                }
            ?> – LIMP
        </strong>

        <p class="text-muted"><strong>Código:</strong> <?= $codigo ?></p>
        <p class="text-muted"><strong>Tipo de Producto:</strong> <?= $product_name ?></p>
        <p><strong>Cantidad de Unidades:</strong> <?= $serial_count ?></p>

        <p>Se certifica que los productos descritos a continuación han sido ensamblados, verificados y aprobados conforme a los protocolos internos de calidad de LIMP. Se autoriza su liberación para ingreso al área de almacén, estando listos para su uso clínico.</p>

        <div class="table-responsive">
            <table style="
                width:100%; 
                border-collapse:collapse; 
                font-family:sans-serif; 
                font-size:10pt;
            ">
                <thead>
                    <tr>
                        <th style="
                            border:1px solid #ddd;
                            background-color:#164a92;
                            color:#ffffff;
                            padding:6px;
                            text-align:center;
                        ">
                            N°
                        </th>
                        <th style="
                            border:1px solid #ddd;
                            background-color:#164a92;
                            color:#ffffff;
                            padding:6px;
                            text-align:center;
                        ">
                            Código / N° Serie
                        </th>
                        <th style="
                            border:1px solid #ddd;
                            background-color:#164a92;
                            color:#ffffff;
                            padding:6px;
                            text-align:center;
                        ">
                            Especificaciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($serials as $index => $serial): ?>
                        <tr>
                            <td style="
                                border:1px solid #ddd;
                                padding:6px;
                                text-align:center;
                            ">
                                <?= $index + 1 ?>
                            </td>
                            <td style="
                                border:1px solid #ddd;
                                padding:6px;
                                text-align:center;
                            ">
                                <?= $serial['numero_serie_production'] ?>
                            </td>
                            <td style="
                                border:1px solid #ddd;
                                padding:6px;
                                text-align:center;
                            ">
                                <?= $serial['especificaciones'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <div class="firmas">
            <p style="padding-bottom: 10px;"><strong>Atentamente,</strong></p>
            <table>
                <tr>
                    <td><?php
                        switch ($area) {
                            case 'Desarrollo Tecnológico':
                                echo 'Noe Colla Muñoz';
                                break;
                            case 'Producción':
                                echo 'Carlos Espinoza';
                                break;
                            case 'Textil':
                                echo 'Camila';
                                break;
                            default:
                                echo $area;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td><?php
                        switch ($area) {
                            case 'Desarrollo Tecnológico':
                                echo 'Jefe del Área de Desarrollo Tecnológico';
                                break;
                            case 'Producción':
                                echo 'Jefe del Área de Producción';
                                break;
                            case 'Textil':
                                echo 'Área Textil';
                                break;
                            default:
                                echo $area;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>LIMP</td>
                </tr>
            </table>

            <p style="padding-top: 20px;">Firma: _________________________</p>
        </div>
    </div>
</body>

</html>