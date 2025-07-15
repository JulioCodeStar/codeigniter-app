<?= $this->extend('layouts/production/layouts/template'); ?>

<?php
// Helper: mapea estado → color “clave” de Bootstrap
function mapEstado($estado)
{
  switch (mb_strtolower($estado)) {
    case 'pendiente':
      return ['color' => 'warning', 'text' => 'dark'];
    case 'en producción':
      return ['color' => 'primary', 'text' => 'light'];
    case 'ensamblando':
      return ['color' => 'info', 'text' => 'dark'];
    case 'terminado':
      return ['color' => 'success', 'text' => 'light'];
    case 'entregado':
      return ['color' => 'success', 'text' => 'light'];
    default:
      return ['color' => 'light', 'text' => 'dark'];
  }
}
?>

<?= $this->section('title_production'); ?>
Inicio | Producción - LIMP
<?= $this->endSection(); ?>

<?= $this->section('toolbar_production'); ?>
<h1
  class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
  Sistema de Gestión de Producción
</h1>

<ul
  class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

  <li class="breadcrumb-item text-muted">Control avanzado con seguimiento individual de items</li>

</ul>
<?= $this->endSection(); ?>

<?= $this->section('content_production'); ?>
<div class="row g-3">
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body text-center">
        <!-- Icono (puedes usar Bootstrap Icons u otro) -->
        <i class="bi bi-box-seam fs-2"></i>
        <h5 class="card-title mt-2">Tipos de Productos</h5>
        <h2 class="fw-bold"><?= $products ?></h2>
        <p class="text-muted mb-0">Catálogo</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-journal-text fs-2"></i>
        <h5 class="card-title mt-2">Órdenes</h5>
        <h2 class="fw-bold"><?= $orders ?></h2>
        <p class="text-muted mb-0">Activas</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-graph-up-arrow fs-2"></i>
        <h5 class="card-title mt-2">Productos Por Serie</h5>
        <h2 class="fw-bold"><?= $series ?></h2>
        <p class="text-muted mb-0">Total</p>
      </div>
    </div>
  </div>
</div>

<!-- Segunda fila: 5 tarjetas -->
<div class="row g-3 mt-3">
  <!-- Usamos .col para que las 5 tarjetas ocupen igual espacio -->
  <div class="col">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-clock-history fs-2 text-warning"></i>
        <h5 class="card-title mt-2">Pendientes</h5>
        <h2 class="fw-bold"><?= $countPending ?></h2>
        <p class="text-muted mb-0">Por iniciar</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-box-arrow-in-down fs-2 text-primary"></i>
        <h5 class="card-title mt-2">Producción</h5>
        <h2 class="fw-bold"><?= $countProduction ?></h2>
        <p class="text-muted mb-0">En proceso</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-tools fs-2 text-warning"></i>
        <h5 class="card-title mt-2">Ensamblaje</h5>
        <h2 class="fw-bold"><?= $countAssembly ?></h2>
        <p class="text-muted mb-0">Armando</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-check2-circle fs-2 text-success"></i>
        <h5 class="card-title mt-2">Terminados</h5>
        <h2 class="fw-bold"><?= $countCompleted ?></h2>
        <p class="text-muted mb-0">Listos</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div class="card-body text-center">
        <i class="bi bi-truck fs-2 text-purple"></i>
        <h5 class="card-title mt-2">Entregados</h5>
        <h2 class="fw-bold"><?= $countDelivered ?></h2>
        <p class="text-muted mb-0">Completados</p>
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mt-3">
  <!-- Entregas Hoy -->
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title d-flex align-items-center">
          <i class="bi bi-calendar-event fs-2 text-primary me-2"></i>
          <strong>Entregas Hoy</strong>
        </h5>
      </div>
      <div class="card-body">
      <?php if (empty($ordersDueToday)): ?>
        <!-- Empty state -->
        <div class="d-flex flex-column align-items-center justify-content-center py-5">
          <i class="bi bi-check-circle-fill fs-1 text-success"></i>
          <p class="text-muted mt-3 mb-0">No hay entregas programadas para hoy</p>
        </div>
      <?php else: ?>
        <div class="dt-container dt-bootstrap5 dt-empty-footer">
          <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable">
            <tbody>
              <?php foreach ($ordersDueToday as $order):
                $m = mapEstado($order['item_estado']);
              ?>
                <tr>
                  <td>
                    <div class="position-relative ps-6 pe-3 py-2">
                      <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 badge-primary"></div>

                      <!-- Código y fecha -->
                      <div class="d-flex align-items-center mb-1">
                        <span class="badge badge-primary"><?= esc($order['codigo']) ?></span>
                        <small class="text-gray-600 ms-2">
                          <?= fecha_dmy($order['fecha_entrega']) ?>
                        </small>
                      </div>

                      <!-- Nombre del paciente o externo -->
                      <div class="mb-1">
                        <?= $order['paciente_id']
                          ? esc($order['paciente_nombre'] . ' ' . $order['paciente_apellidos'])
                          : esc($order['nombre_externo']) ?>
                      </div>

                      <!-- Aquí los datos extra: producto, cantidad y estado -->
                      <div class="mb-1">
                        <strong>Producto:</strong>
                        <?= esc($order['producto_nombre'] ?? '—') ?>
                        <span class="ms-3"><strong>Cant.:</strong>
                          <?= esc($order['item_cantidad'] ?? '—') ?></span>
                        <span class="ms-3 badge bg-<?= $m['color'] ?> text-<?= $m['text'] ?>">
                          <?= esc($order['item_estado']) ?>
                        </span>
                      </div>

                      <!-- Tipo de orden -->
                      <p class="text-gray-600 mb-0"><?= esc($order['tip_orden']) ?></p>
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
  <!-- Órdenes Atrasadas -->
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title d-flex align-items-center">
          <i class="bi bi-exclamation-triangle-fill fs-2 text-danger me-2"></i>
          <strong>Órdenes Atrasadas</strong>
        </h5>
      </div>
      <div class="card-body">
      <?php if (empty($overdueOrders)): ?>
        <!-- Empty state -->
        <div class="d-flex flex-column align-items-center justify-content-center py-5">
          <i class="bi bi-check-circle-fill fs-1 text-success"></i>
          <p class="text-muted mt-3 mb-0">No hay órdenes atrasadas</p>
        </div>
      <?php else: ?>
        <div class="dt-container dt-bootstrap5 dt-empty-footer">
          <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable">
            <tbody>
              <?php foreach ($overdueOrders as $order):
                $m = mapEstado($order['item_estado']);
              ?>
                <tr>
                  <td>
                    <div class="position-relative ps-6 pe-3 py-2">
                      <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 badge-danger"></div>

                      <!-- Código y fecha -->
                      <div class="d-flex align-items-center mb-1">
                        <span class="badge badge-danger"><?= esc($order['codigo']) ?></span>
                        <small class="text-gray-600 ms-2">
                          <?= fecha_dmy($order['fecha_entrega']) ?>
                        </small>
                      </div>

                      <!-- Nombre del paciente o externo -->
                      <div class="mb-1">
                        <?= $order['paciente_id']
                          ? esc($order['paciente_nombre'] . ' ' . $order['paciente_apellidos'])
                          : esc($order['nombre_externo']) ?>
                      </div>

                      <!-- Aquí los datos extra: producto, cantidad y estado -->
                      <div class="mb-1">
                        <strong>Producto:</strong>
                        <?= esc($order['producto_nombre'] ?? '—') ?>
                        <span class="ms-3"><strong>Cant.:</strong>
                          <?= esc($order['item_cantidad'] ?? '—') ?></span>
                        <span class="ms-3 badge bg-<?= $m['color'] ?> text-<?= $m['text'] ?>">
                          <?= esc($order['item_estado']) ?>
                        </span>
                      </div>

                      <!-- Tipo de orden -->
                      <p class="text-gray-600 mb-0"><?= esc($order['tip_orden']) ?></p>
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

<div class="card mt-5">
  <div class="card-body">
    <h5 class="card-title">Distribución por Tipo de Orden</h5>
    <div class="row g-3 mt-3">

      <!-- Paciente -->
      <div class="col-6 col-md-3">
        <div class="card h-100">
          <div class="card-body text-center">
            <h2 class="fw-bold mb-1"><?= $countPatient ?></h2>
            <p class="mb-2">Paciente</p>
          </div>
        </div>
      </div>

      <!-- Proyecto -->
      <div class="col-6 col-md-3">
        <div class="card h-100">
          <div class="card-body text-center">
            <h2 class="fw-bold mb-1"><?= $countProject ?></h2>
            <p class="mb-2">Proyecto</p>
          </div>
        </div>
      </div>

      <!-- Prueba -->
      <div class="col-6 col-md-3">
        <div class="card h-100">
          <div class="card-body text-center">
            <h2 class="fw-bold mb-1"><?= $countTest ?></h2>
            <p class="mb-2">Prueba</p>
          </div>
        </div>
      </div>

      <!-- Stock -->
      <div class="col-6 col-md-3">
        <div class="card h-100">
          <div class="card-body text-center">
            <h2 class="fw-bold mb-1"><?= $countStock ?></h2>
            <p class="mb-2">Stock</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection(); ?>



<?= $this->section('scripts_production'); ?>

<script>

</script>

<?= $this->endSection(); ?>