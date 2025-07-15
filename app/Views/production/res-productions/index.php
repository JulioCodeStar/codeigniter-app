<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Seguimiento de Producción | KYP BIOINGENIERIA

<?= $this->endSection(); ?>


<?= $this->section('toolbar'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Panel de Recepción - Vista Detallada
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Control completo con historial y seguimiento en tiempo real</li>


</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Nav Tabs -->
<ul class="nav nav-tabs  mb-4" role="tablist">
    <li class="nav-item">
        <a
            class="nav-link active"
            data-bs-toggle="tab"
            href="#resumen"
            role="tab">Resumen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#entregas" role="tab">Entregas Hoy</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#atrasados" role="tab">Atrasados</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#busqueda" role="tab">Búsqueda</a>
    </li>
</ul>

<div class="tab-content">
    <!-- === Pestaña Resumen === -->
    <div class="tab-pane fade show active" id="resumen" role="tabpanel">
        <div class="row g-4">
            <?php foreach ($stats as $area): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fs-2 mb-4">
                                <i class="bi bi-building fs-4 me-2"></i>
                                <?= esc($area['name']) ?>
                            </h5>

                            <div class="d-flex mb-3">
                                <div class="flex-fill text-center p-2 bg-light rounded">
                                    <h2 class="mb-1"><?= $area['products'] ?></h2>
                                    <small class="text-muted">Productos por Serie</small>
                                </div>
                                <div class="flex-fill text-center p-2 bg-light-primary rounded ms-2">
                                    <h2 class="mb-1"><?= $area['orders'] ?></h2>
                                    <small>Órdene(s)</small>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-4">
                                <?php foreach ($stateMap as $label => $badgeClass): ?>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <?= esc($label) ?>:
                                        <span class="badge badge-<?= $badgeClass ?> rounded-pill">
                                            <?= esc($area['stateCounts'][$label] ?? 0) ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- === Resumen Entregas Hoy === -->
    <div class="tab-pane fade" id="entregas" role="tabpanel">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-event fs-4 text-primary me-2"></i>
                        <h5 class="mb-0 fs-3">Entregas Hoy</h5>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($ordersDueToday)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-check-circle fs-1 text-success"></i>
                            <p class="text-muted mt-3 mb-0">
                                No hay entregas programadas para hoy
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="dt-container dt-bootstrap5 dt-empty-footer">
                            <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable">
                                <tbody>
                                    <?php foreach ($ordersDueToday as $order):
                                        $displayName = $order['paciente_id']
                                            ? trim($order['paciente_nombre'] . ' ' . $order['paciente_apellidos'])
                                            : $order['nombre_externo'];
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="position-relative ps-6 pe-3 py-2">
                                                    <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 badge-primary"></div>
                                                    <div class="p-3 mb-3 d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-semibold mb-1"><?= esc($displayName) ?></p>
                                                            <div class="mb-1">
                                                                <span class="badge badge-<?= $order['tip_orden'] === 'Paciente' ? 'primary' : ($order['tip_orden'] === 'Proyecto' ? 'success' : ($order['tip_orden'] === 'Pruebas' ? 'warning' : 'dark')) ?>">
                                                                    <?= esc($order['tip_orden']) ?>
                                                                </span>
                                                                <small class="text-muted ms-2">
                                                                    <?= esc($order['area_respon']) ?>
                                                                </small>
                                                            </div>
                                                            <p class="text-danger mb-1">
                                                                Fecha entrega: <?= fecha_dmy($order['fecha_entrega']) ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?= esc($order['notas']) ?></p>
                                                        </div>
                                                        <div class="text-end">
                                                            <a
                                                                href="#"
                                                                class="btn btn-light-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#orderModal<?= $order['id'] ?>">
                                                                Ver Detalles
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <!-- === Resumen Entregas Atrasados === -->
    <div class="tab-pane fade" id="atrasados" role="tabpanel">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center text-danger">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill fs-4 text-danger me-2"></i>
                        <h5 class="mb-0 fs-3">Órdenes Atrasadas</h5>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($ordersOverdue)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-emoji-frown fs-1 text-danger"></i>
                            <p class="text-muted mt-3 mb-0">
                                No hay órdenes atrasadas
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="dt-container dt-bootstrap5 dt-empty-footer">
                            <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable">
                                <tbody>
                                    <?php foreach ($ordersOverdue as $order):
                                        $displayName = $order['paciente_id']
                                            ? trim($order['paciente_nombre'] . ' ' . $order['paciente_apellidos'])
                                            : $order['nombre_externo'];
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="position-relative ps-6 pe-3 py-2">
                                                    <!-- Barra lateral roja -->
                                                    <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-danger"></div>
                                                    <div class="p-3 mb-3 d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-semibold mb-1"><?= esc($displayName) ?></p>
                                                            <div class="mb-1">
                                                                <span class="badge badge-<?=
                                                                                            $order['tip_orden'] === 'Paciente' ? 'primary'
                                                                                                : ($order['tip_orden'] === 'Proyecto' ? 'success'
                                                                                                    : ($order['tip_orden'] === 'Pruebas' ? 'warning'
                                                                                                        : 'dark')) ?>">
                                                                    <?= esc($order['tip_orden']) ?>
                                                                </span>
                                                                <small class="text-muted ms-2">
                                                                    <?= esc($order['area_respon']) ?>
                                                                </small>
                                                            </div>
                                                            <p class="text-danger mb-1">
                                                                Fecha entrega: <?= fecha_dmy($order['fecha_entrega']) ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?= esc($order['notas']) ?></p>
                                                        </div>
                                                        <div class="text-end">
                                                            <a
                                                                href="#"
                                                                class="btn btn-light-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#orderModal<?= $order['id'] ?>">
                                                                Ver Detalles
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



    <!-- === Resumen Búsqueda === -->
    <div class="tab-pane fade show" id="busqueda" role="tabpanel">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Búsqueda Avanzada</h5>
                <input
                    type="text"
                    id="searchInput"
                    class="form-control mb-4"
                    placeholder="🔍 Buscar por nombre, tipo, área, código de serie...">

                <!-- Órdenes: oculto por defecto -->
                <div id="ordersResults" class="mb-4 d-none">
                    <h6>Órdenes (<span id="ordersCount">0</span>)</h6>
                    <div id="ordersList" class="list-group"></div>
                </div>

                <!-- Items: oculto por defecto -->
                <div id="itemsResults" class="d-none">
                    <h6>Items (<span id="itemsCount">0</span>)</h6>
                    <div id="itemsList" class="list-group"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php foreach (array_merge($ordersDueToday, $ordersOverdue) as $order):
    // Nombre a mostrar (paciente o externo)
    $displayName = $order['paciente_id']
        ? trim($order['paciente_nombre'] . ' ' . $order['paciente_apellidos'])
        : $order['nombre_externo'];

    // Clase para el badge de tipo de orden (ajusta colores si quieres)
    $typeClasses = [
        'Paciente' => 'badge badge-primary',
        'Proyecto' => 'badge badge-secondary',
        'Pruebas'  => 'badge badge-warning',
        'Stock'    => 'badge badge-dark',
    ];
    $typeClass = $typeClasses[$order['tip_orden']] ?? 'badge badge-secondary';

    // Badge de estado de la orden
    $isOverdue = in_array($order, $ordersOverdue, true);
    $statusBadge = $isOverdue
        ? '<span class="badge badge-danger">Atrasada</span>'
        : '<span class="badge badge-success">Activa</span>';
?>
    <div class="modal fade" id="orderModal<?= $order['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h5 class="modal-title mb-0">
                        Detalles de la Orden
                        <span class="badge badge-primary text-white ms-2">
                            <?= esc($order['codigo']) ?>
                        </span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Cabecera: nombre + tipo + área + estado -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-semibold mb-1"><?= esc($displayName) ?></h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge <?= $typeClass ?> text-uppercase">
                                    <?= esc($order['tip_orden']) ?>
                                </span>
                                <small class="text-muted"><?= esc($order['area_respon']) ?></small>
                            </div>
                        </div>
                        <?= $statusBadge ?>
                    </div>

                    <!-- Fechas -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Fecha Solicitud:</strong></p>
                            <p class="mb-0"><?= fecha_dmy($order['fecha_solicitud']) ?></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Fecha Entrega:</strong></p>
                            <p class="mb-0"><?= fecha_dmy($order['fecha_entrega']) ?></p>
                        </div>
                    </div>

                    <!-- Notas -->
                    <div class="mb-4">
                        <label class="form-label"><strong>Notas:</strong></label>
                        <textarea class="form-control" rows="2" readonly><?= esc($order['notas']) ?></textarea>
                    </div>

                    <!-- Items de la orden -->
                    <h6 class="mb-3">Items de esta Orden</h6>
                    <?php if (empty($order['items'])): ?>
                        <p class="text-muted">No hay items registrados.</p>
                    <?php else: ?>
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="border rounded p-3 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="mb-1"><strong><?= esc($item['producto_nombre']) ?></strong></p>
                                        <small>Cantidad: <?= esc($item['cantidad']) ?></small>
                                    </div>
                                    <span class="badge 
                                        <?php
                                        // mapea estado a clase Bootstrap
                                        $map = [
                                            'pendiente'     => 'badge-warning',
                                            'en producción' => 'badge-primary',
                                            'ensamblando'   => 'badge-info',
                                            'terminado'     => 'badge-success',
                                            'entregado'     => 'badge-success',
                                        ];
                                        echo $map[strtolower($item['estado'])] ?? 'badge-light';
                                        ?>
                                    ">
                                        <?= esc($item['estado']) ?>
                                    </span>
                                </div>

                                <!-- Aquí las unidades -->
                                <?php if (! empty($item['units'])): ?>
                                    <ul class="list-group">
                                        <?php foreach ($item['units'] as $unit): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div><strong>Serial:</strong> <?= esc($unit['numero_serie_production']) ?></div>
                                                    <small class="text-muted"><?= esc($unit['especificaciones']) ?></small>
                                                </div>
                                                <!-- Si quisieras un badge por unidad, podrías ponerlo aquí -->
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($allItems as $item):
    // Nombre a mostrar
    $name = $item['paciente_id']
        ? "{$item['paciente_nombre']} {$item['paciente_apellidos']}"
        : $item['nombre_externo'];

    // Clase para badge tipo “paciente” vs “proyecto”…
    $typeClasses = [
        'Paciente' => 'badge-primary',
        'Proyecto' => 'badge-secondary',
        'Pruebas'  => 'badge-warning',
        'Stock'    => 'badge-dark',
    ];
    $typeClass = $typeClasses[$item['tip_orden']] ?? 'badge-secondary';

    // Clase para badge de estado actual
    $stateClasses = [
        'pendiente'     => 'badge-warning',
        'en producción' => 'badge-primary',
        'ensamblando'   => 'badge-info',
        'terminado'     => 'badge-success',
        'entregado'     => 'badge-success',
    ];
    $itemStateClass = $stateClasses[strtolower($item['item_estado'])] ?? 'badge-light';

    // Mapa de estado → progreso
    $stateSteps = [
        'pendiente',
        'en producción',
        'ensamblando',
        'terminado',
        'entregado',
    ];

    // Normalizamos el estado a minúsculas
    $current = strtolower($item['item_estado']);

    // Buscamos el índice; si no existe, ponemos 0
    $idx = array_search($current, $stateSteps, true);
    if ($idx === false) {
        $idx = 0;
    }

    // Cálculo: índice / (nº estados - 1) * 100
    $item['progress'] = round($idx * 100 / (count($stateSteps) - 1));


    // Historial de estados (debes cargarlo en el controller)
    $history = $item['history'] ?? [
        ['estado' => 'pendiente', 'fecha' => '2024-01-20', 'actor' => 'Sistema', 'nota' => 'Orden creada'],
        ['estado' => 'en producción', 'fecha' => '2024-01-22', 'actor' => 'Noe Colla', 'nota' => 'Comenzó producción'],
    ];

    // Clase para barra de progreso
    $progressClasses = [
        'pendiente'     => 'bg-warning',
        'en producción' => 'bg-primary',
        'ensamblando'   => 'bg-info',
        'terminado'     => 'bg-success',
        'entregado'     => 'bg-success',
    ];
    $progressClass = $progressClasses[strtolower($item['item_estado'])] ?? 'bg-light';
?>
    <div class="modal fade" id="itemModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Detalles Completos del Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Cabecera con producto y usuario -->
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="fw-semibold mb-1"><?= esc($item['producto_nombre']) ?></h5>
                            <div class="mb-2">
                                <span class="badge <?= $typeClass ?> "><?= esc($item['tip_orden']) ?></span>
                                <span class="badge <?= $itemStateClass ?> ms-2"><?= esc($item['item_estado']) ?></span>
                            </div>
                            <small class="text-muted"><?= esc($name) ?></small>
                        </div>
                        <div class="text-end">
                            <p class="mb-1"><strong>Área</strong></p>
                            <p class="mb-3"><?= esc($item['area_respon']) ?></p>
                            <p class="mb-1"><strong>Cantidad</strong></p>
                            <p><?= count($item['units'] ?? []) ?></p>
                        </div>
                    </div>

                    <!-- Seriales y especificaciones -->
                    <div class="mb-4">
                        <p class="mb-1"><strong>Códigos de Serie:</strong></p>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <?php foreach ($item['units'] as $unit): ?>
                                <code><?= esc($unit['numero_serie_production']) ?> (<?= esc($unit['especificaciones']) ?>)</code>
                            <?php endforeach; ?>
                        </div>
                        <label class="form-label"><strong>Notas:</strong></label>
                        <textarea class="form-control" rows="2" readonly><?= esc($item['notas'] ?? '') ?></textarea>
                    </div>

                    <!-- Progreso -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Estado Actual:</small>
                            <small><?= esc($item['item_estado']) ?></small>
                        </div>
                        <div class="progress mb-3" style="height:6px;">
                            <div
                                class="progress-bar bg-primary"
                                role="progressbar"
                                style="width: <?= esc($item['progress']) ?>%;"
                                aria-valuenow="<?= esc($item['progress']) ?>"
                                aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <small class="d-flex justify-content-between">
                            <span>Pendiente</span>
                            <span>En Producción</span>
                            <span>Ensamblaje</span>
                            <span>Terminado</span>
                            <span>Entregado</span>
                        </small>
                        <small class="text-end w-100"><?= esc($item['progress']) ?>% Completado</small>
                    </div>

                    <!-- Historial de estados -->
                    <h6>Historial Completo de Estados</h6>
                    <div class="dt-container dt-bootstrap5 dt-empty-footer">
                        <?php foreach ($history as $h):
                            $hc = match ($h['estado']) {
                                'pendiente' => 'badge-warning',
                                'en producción' => 'badge-primary',
                                'ensamblando' => 'badge-primary',
                                'terminado' => 'badge-success',
                                'entregado' => 'badge-success',
                                'cancelado' => 'badge-danger',
                                default => 'badge-secondary'
                            };
                        ?>
                            <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable">
                                <tbody id="">
                                    <tr>
                                        <td>
                                            <div class="position-relative ps-6 pe-3 py-2">
                                                <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 <?= $hc ?>"></div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="badge <?= $hc ?>"><?= esc($h['estado']) ?></span>
                                                    <small class="text-gray-600 ms-2">
                                                        <?= esc(fecha_dmy($h['fecha'])) ?> por <?= esc($h['actor']) ?>
                                                    </small>
                                                </div>
                                                <div><?= esc($h['nota']) ?></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($allOrders as $order):
    // Nombre a mostrar (paciente o externo)
    $displayName = $order['paciente_id']
        ? trim($order['paciente_nombre'] . ' ' . $order['paciente_apellidos'])
        : $order['nombre_externo'];

    // Clase para el badge de tipo de orden (ajusta colores si quieres)
    $typeClasses = [
        'Paciente' => 'badge badge-primary',
        'Proyecto' => 'badge badge-secondary',
        'Pruebas'  => 'badge badge-warning',
        'Stock'    => 'badge badge-dark',
    ];
    $typeClass = $typeClasses[$order['tip_orden']] ?? 'badge badge-secondary';

    // Badge de estado de la orden
    $isOverdue = in_array($order, $ordersOverdue, true);
    $statusBadge = $isOverdue
        ? '<span class="badge badge-danger">Atrasada</span>'
        : '<span class="badge badge-success">Activa</span>';
?>
    <div class="modal fade" id="orderModalToday<?= $order['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h5 class="modal-title mb-0">
                        Detalles de la Orden
                        <span class="badge badge-primary text-white ms-2">
                            <?= esc($order['codigo']) ?>
                        </span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Cabecera: nombre + tipo + área + estado -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-semibold mb-1"><?= esc($displayName) ?></h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge <?= $typeClass ?> text-uppercase">
                                    <?= esc($order['tip_orden']) ?>
                                </span>
                                <small class="text-muted"><?= esc($order['area_respon']) ?></small>
                            </div>
                        </div>
                        <?= $statusBadge ?>
                    </div>

                    <!-- Fechas -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Fecha Solicitud:</strong></p>
                            <p class="mb-0"><?= fecha_dmy($order['fecha_solicitud']) ?></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Fecha Entrega:</strong></p>
                            <p class="mb-0"><?= fecha_dmy($order['fecha_entrega']) ?></p>
                        </div>
                    </div>

                    <!-- Notas -->
                    <div class="mb-4">
                        <label class="form-label"><strong>Notas:</strong></label>
                        <textarea class="form-control" rows="2" readonly><?= esc($order['notas']) ?></textarea>
                    </div>

                    <!-- Items de la orden -->
                    <h6 class="mb-3">Items de esta Orden</h6>
                    <?php if (empty($order['items'])): ?>
                        <p class="text-muted">No hay items registrados.</p>
                    <?php else: ?>
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="border rounded p-3 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="mb-1"><strong><?= esc($item['producto_nombre']) ?></strong></p>
                                        <small>Cantidad: <?= esc($item['cantidad']) ?></small>
                                    </div>
                                    <?php
                                    $map = [
                                        'pendiente'     => 'badge-warning',
                                        'en producción' => 'badge-primary',
                                        'ensamblando'   => 'badge-primary',
                                        'terminado'     => 'badge-success',
                                        'entregado'     => 'badge-success',
                                    ];
                                    $cls = $map[strtolower($item['estado'])] ?? 'badge-light';
                                    ?>
                                    <span class="badge <?= $cls ?>">
                                        <?= esc($item['estado']) ?>
                                    </span>
                                </div>

                                <!-- Unidades / Series -->
                                <?php if (! empty($item['units'])): ?>
                                    <ul class="list-group">
                                        <?php foreach ($item['units'] as $unit): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div><strong>Serial:</strong> <?= esc($unit['numero_serie_production']) ?></div>
                                                    <small class="text-muted"><?= esc($unit['especificaciones']) ?></small>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // Datos embebidos desde PHP
    const orders = <?= json_encode($allOrders, JSON_HEX_TAG) ?>;
    const items = <?= json_encode($allItems,  JSON_HEX_TAG) ?>;

    // Referencias al DOM
    const input = document.getElementById('searchInput');
    const ordersRes = document.getElementById('ordersResults');
    const itemsRes = document.getElementById('itemsResults');
    const oList = document.getElementById('ordersList');
    const iList = document.getElementById('itemsList');
    const oCount = document.getElementById('ordersCount');
    const iCount = document.getElementById('itemsCount');

    // Helper para nombre (paciente vs externo)
    function displayName(o) {
        return o.paciente_id ?
            `${o.paciente_nombre} ${o.paciente_apellidos}` :
            o.nombre_externo;
    }

    // Función que pinta un listado dado un array y un container
    function renderList(data, container, countElem, isOrder = true) {
        if (!data.length) {
            container.innerHTML = '<p class="text-muted">Sin resultados</p>';
        } else {
            container.innerHTML = data.map(o => {
                if (isOrder) {
                    return `
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-1 fw-semibold">${displayName(o)}</p>
                <small>
                  <span class="badge ${function() {
                    const map = {
                        'Paciente': 'badge-primary',
                        'Proyecto': 'badge-secondary',
                        'Pruebas': 'badge-warning',
                        'Stock': 'badge-dark'
                    };
                    return map[o.tip_orden] || 'badge-secondary';
                  }()} text-uppercase">${o.tip_orden}</span>
                  <span class="text-muted ms-2">${o.area_respon}</span><br>
                  Entrega: ${o.fecha_entrega}
                </small>
              </div>
              <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#orderModalToday${o.id}">
                Ver
              </button>

            </div>`;
                } else {
                    return `
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-1 fw-semibold">${o.producto_nombre}</p>
                <small>${displayName(o)}</small><br>
                <small>
                  <span class="badge ${function() {
                    const map = {
                        'pendiente': 'badge-warning',
                        'en producción': 'badge-primary',
                        'ensamblando': 'badge-primary',
                        'terminado': 'badge-success',
                        'entregado': 'badge-success'
                    };
                    return map[o.item_estado.toLowerCase()] || 'badge-light';
                  }()}">${o.item_estado}</span>
                  <code class="ms-2">${o.item_codigo || ''}</code>
                </small>
              </div>
              <a href="#"
                 class="btn btn-outline-primary btn-sm"
                 data-bs-toggle="modal"
                 data-bs-target="#itemModal${o.id}">
                Ver
              </a>
            </div>`;
                }
            }).join('');
        }
        countElem.textContent = data.length;
    }

    // Filtrado y show/hide
    function onSearch() {
        const q = input.value.trim().toLowerCase();

        if (q.length === 0) {
            // Si no hay nada escrito: ocultamos ambos
            ordersRes.classList.add('d-none');
            itemsRes.classList.add('d-none');
            return;
        }

        // Mostramos contenedores
        ordersRes.classList.remove('d-none');
        itemsRes.classList.remove('d-none');

        // Filtramos y pintamos
        const fo = orders.filter(o => {
            const hay = [
                displayName(o),
                o.tip_orden,
                o.area_respon,
                o.codigo
            ].join(' ').toLowerCase();
            return hay.includes(q);
        });
        renderList(fo, oList, oCount, true);

        const fi = items.filter(i => {
            const hay = [
                i.producto_nombre,
                displayName(i),
                i.item_estado,
                i.item_codigo || ''
            ].join(' ').toLowerCase();
            return hay.includes(q);
        });
        renderList(fi, iList, iCount, false);
    }

    // Escucha y debounce ligero
    let timer;
    input.addEventListener('input', () => {
        clearTimeout(timer);
        timer = setTimeout(onSearch, 150);
    });
</script>


<?= $this->endSection(); ?>