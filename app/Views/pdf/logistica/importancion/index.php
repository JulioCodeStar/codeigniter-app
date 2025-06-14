<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resumen de Importación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0 20px;
        }

        .card {
            /* border: 1px solid #ccc; */
            padding: 5px;
            padding-top: 40px;
            /* espacio después del header */
            margin-bottom: 20px;
            page-break-inside: avoid;
            /* evita cortes dentro */
        }

        .card-header {
            background-color: #f2f2f2;
            padding: 6px 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-body {
            margin-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 9pt;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 9pt;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .subtotal {
            text-align: right;
            font-weight: bold;
            margin-top: 8px;
        }

        .web {
            word-break: break-word;
        }
    </style>
</head>

<body>

    <?php foreach ($items as $i => $item): ?>
        <div class="card" style="padding-top: <?= $i > 0 ? '6px' : '60px' ?>;">
            <div style="border: 1px solid #ccc; padding: 5px;">
                <div class="card-header">Proveedor <?= $item['proveedor']['proveedor'] ?></div>
                <div class="card-body">
                    <div class="info-row">
                        <div>
                            <div><strong>País:</strong> <?= $item['proveedor']['pais'] ?></div>
                            <div><strong>Vendedor:</strong> <?= $item['proveedor']['vendedor'] ?></div>
                            <div><strong>Teléfono:</strong> <?= $item['proveedor']['telefono'] ?></div>
                        </div>
                        <div>
                            <div><strong>Web:</strong>
                                <a href="<?= $item['proveedor']['pagina_web'] ?>" target="_blank">Ver enlace</a>
                            </div>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Producto</th>
                                <th>Descripción</th>
                                <th>Enlace</th>
                                <th>Precio Unit.</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td style="text-align: center; "><?= $item['producto']['cantidad'] ?></td>
                                <td style="text-align: center; "><?= $item['producto']['unidad'] ?></td>
                                <td><?= $item['producto']['nombre'] ?></td>
                                <td><?= $item['producto']['descripcion'] ?></td>
                                <td><a href="<?= $item['producto']['link'] ?>" target="_blank">Ver enlace</a></td>
                                <td style="text-align: right;"><?= ($importacion['moneda'] == 'PEN') ? 'S/' : '$' ?> <?= moneda($item['producto']['precio']) ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="subtotal">Subtotal: <?= ($importacion['moneda'] == 'PEN') ? 'S/' : '$' ?> <?= moneda($item['producto']['total']) ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</body>

</html>