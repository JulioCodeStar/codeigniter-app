<!DOCTYPE html>
<html>

<head>
    <title>Entradas al Almacén</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
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
            font-size: 11pt;
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
            padding-top: 20px; /* Espacio para el ancla */
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
    </style>
</head>

<body>
    <div class="container" style="padding-top: 20px;">
        <!-- Información General -->
        <div class="info">
            <table>
                <tr>
                    <td style="width: 50%;"><strong>Fecha de Recepción:</strong> <?= fecha_dmy($data['fecha_recepcion']) ?></td>
                    <td style="width: 50%; text-align: right;"><strong>Proveedor / Origen:</strong> <?= $data['proveedor'] ?></td>
                </tr>
                <tr>
                    <td style="width: 50%;"><strong>Tipo / Descripción:</strong> <?= $data['tipo_descripcion'] ?></td>
                    <td style="width: 50%; text-align: right;"><strong>Sede:</strong> <?= $data['sede'] ?></td>
                </tr>
            </table>
        </div>

        <!-- Tabla Resumen de Productos -->
        <div class="section-title">(Tabla Resumen de Productos)</div>

        <table class="resumen-table">
            <thead>
                <tr>
                    <th style="width: 8%;">Ítem</th>
                    <th style="width: 15%;">Código</th>
                    <th style="width: 45%;">Descripción del Producto</th>
                    <th style="width: 12%;">Cantidad</th>
                    <th style="width: 20%;">Números de Serie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['productos'] as $producto): ?>
                    <tr>
                        <td><?= $producto['item'] ?></td>
                        <td><?= $producto['codigo'] ?></td>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $producto['cantidad'] ?></td>
                        <td>
                            <?php if ($producto['anexo']): ?>
                                <a href="#anexo-<?= $producto['anexo'] ?>"><?= $producto['numero_serie'] ?></a>
                            <?php else: ?>
                                <?= $producto['numero_serie'] ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Sección de Observaciones -->
        <div class="observaciones-section">

            <div class="observaciones-subtitle">Observaciones Generales</div>
            <div class="observaciones-content">
                <?= $data['observaciones'] ?>
            </div>
        </div>

        <!-- Sección de Anexos -->
        <div class="anexos-section">
            <?php foreach ($data['productos'] as $producto): ?>
                <?php if ($producto['anexo'] && !empty($producto['seriales'])): ?>
                    <div class="anexo-item" id="anexo-<?= $producto['anexo'] ?>">
                        <div class="anexo-header">Anexo <?= $producto['anexo'] ?>: Detalle de Números de Serie</div>
                        <a href="#" class="volver-resumen">Volver al Resumen</a>
                        
                        <div class="anexo-subheader">(Información del Producto)</div>

                        <div class="anexo-producto-info">
                            <div><strong>Producto:</strong> <?= $producto['nombre'] ?></div>
                            <div><strong>Código:</strong> <?= $producto['codigo'] ?></div>
                            <div><strong>Cantidad Total:</strong> <?= $producto['cantidad'] ?> Unidades</div>
                        </div>

                        <div class="anexo-lista-title">(Lista Detallada de Seriales en Columnas)</div>

                        <?php
                        $seriales = $producto['seriales'];
                        $cols = 5; // Número de columnas deseado
                        $totalSeriales = count($seriales);
                        $rows = ceil($totalSeriales / $cols);
                        ?>

                        <table class="seriales-table">
                            <tbody>
                                <?php for ($row = 0; $row < $rows; $row++): ?>
                                    <tr>
                                        <?php for ($col = 0; $col < $cols; $col++): ?>
                                            <?php
                                            $index = $row + ($col * $rows);
                                            // Ajuste para última columna incompleta
                                            if ($col == $cols - 1 && ($totalSeriales % $rows) > 0) {
                                                $maxIndexLastCol = $rows * ($cols - 1) + ($totalSeriales % $rows);
                                                if ($index >= $maxIndexLastCol) {
                                                    continue;
                                                }
                                            }
                                            ?>
                                            <td class="serial-cell" style="font-size: 12pt;">
                                                <?php if ($index < $totalSeriales): ?>
                                                    <?= ($index + 1) ?>. <?= $seriales[$index]['serial'] ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Ejemplo de producto sin seriales -->
            <?php foreach ($data['productos'] as $producto): ?>
                <?php if ($producto['numero_serie'] === 'No Aplica'): ?>
                    <div class="anexo-item">
                        <div class="anexo-header">Anexo para <?= $producto['nombre'] ?></div>
                        <a href="#" class="volver-resumen">Volver al Resumen</a>

                        <div class="anexo-subheader">(Información del Producto)</div>

                        <div class="anexo-producto-info">
                            <div><strong>Producto:</strong> <?= $producto['nombre'] ?></div>
                            <div><strong>Código:</strong> <?= $producto['codigo'] ?></div>
                            <div><strong>Cantidad Total:</strong> <?= $producto['cantidad'] ?> Unidades</div>
                        </div>

                        <div class="no-aplica">
                            No aplica numeración de serie para este tipo de producto.
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script>
        // Función para manejar el desplazamiento suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Desplazamiento suave
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Botones para volver al resumen
        document.querySelectorAll('.volver-resumen').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>