<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Inicio | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>

<?= $this->section('toolbar_inventory'); ?>

<h1
  class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
  Dashboard - Sede <?= $activeSede['sucursal'] ?>
</h1>

<ul
  class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

  <li class="breadcrumb-item text-muted">Control de inventario y operaciones</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content_inventory'); ?>
<style>
  .card-custom {
    border-radius: 0.75rem;
    border: 1px solid #dee2e6;
    padding: 1.25rem;
  }

  .icon-box {
    position: absolute;
    top: 1rem;
    right: 1rem;
  }

  .icon-box svg {
    width: 1.5rem;
    height: 1.5rem;
    color: #6c757d;
  }

  .card-title {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
  }

  .card-number {
    font-size: 2rem;
    font-weight: bold;
  }

  .card-description {
    color: #6c757d;
    font-size: 0.9rem;
  }
</style>

<!-- MÉTRICAS -->
<div class="row my-5 g-4">
  <div class="col">
    <div class="card card-custom position-relative shadow-sm">
      <div class="icon-box">
        <i class="ki-duotone ki-parcel fs-2">
          <span class="path1"></span>
          <span class="path2"></span>
          <span class="path3"></span>
          <span class="path4"></span>
          <span class="path5"></span>
        </i>
      </div>
      <div class="card-body p-0">
        <h6 class="card-title">Total Productos</h6>
        <div class="card-number"><?= $totalProducts ?></div>
        <div class="card-description">Tipos de productos</div>
      </div>
    </div>

  </div>
  <div class="col">
    <div class="card card-custom position-relative shadow-sm">
      <div class="icon-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-warehouse h-4 w-4 text-primary">
          <path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"></path>
          <path d="M6 18h12"></path>
          <path d="M6 14h12"></path>
          <rect width="12" height="12" x="6" y="10"></rect>
        </svg>
      </div>
      <div class="card-body p-0">
        <h6 class="card-title">Stock Total</h6>
        <div class="card-number text-primary"><?= intval($totalStock) ?></div>
        <div class="card-description">En inventario</div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-custom position-relative shadow-sm">
      <div class="icon-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert h-4 w-4 text-warning">
          <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path>
          <path d="M12 9v4"></path>
          <path d="M12 17h.01"></path>
        </svg>
      </div>
      <div class="card-body p-0">
        <h6 class="card-title">Stock Bajo</h6>
        <div class="card-number text-warning"><?= intval($totalStockBajo) ?></div>
        <div class="card-description">Requieren reposición</div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-custom position-relative shadow-sm">
      <div class="icon-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down h-4 w-4 text-danger">
          <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline>
          <polyline points="16 17 22 17 22 11"></polyline>
        </svg>
      </div>
      <div class="card-body p-0">
        <h6 class="card-title">Stock Crítico</h6>
        <div class="card-number text-danger"><?= intval($totalStockCritico) ?></div>
        <div class="card-description">Atención urgente</div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-5 g-4">
  <div class="col">

  </div>

  <div class="col">

    <div class="card mt-5">
      <div class="card-body card-scroll ">
        <h5 class="text-danger">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert h-4 w-4 text-danger me-2">
            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path>
            <path d="M12 9v4"></path>
            <path d="M12 17h.01"></path>
          </svg>
          Stock Bajo — <?= esc($activeSede['sucursal']) ?>
        </h5>
        <p class="text-muted mb-4">Productos que requieren reposición en esta sede</p>

        <?php if (empty($items)): ?>
          <div class="alert alert-success">¡No hay productos con stock bajo!</div>
        <?php else: ?>
          <?php foreach ($items as $it):
            // Calcula % para la barra
            $pct = $it['stock_max'] > 0
              ? min(100, max(0, ($it['stock_actual'] / $it['stock_max']) * 100))
              : 0;
          ?>
            <div class="mb-4">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                  <h6 class="mb-0"><?= esc($it['nombre']) ?></h6>
                  <small class="text-muted"><?= esc($it['area']) ?></small>
                </div>
                <span class="badge badge-danger">
                  <?= intval($it['stock_actual']) ?> / <?= intval($it['stock_max']) ?>
                </span>
              </div>
              <div class="progress" style="height:6px;">
                <div
                  class="progress-bar bg-danger"
                  role="progressbar"
                  style="width: <?= round($pct, 1) ?>%;"
                  aria-valuenow="<?= $it['stock_actual'] ?>"
                  aria-valuemin="0"
                  aria-valuemax="<?= $it['stock_max'] ?>">
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>




<?= $this->endSection(); ?>



<?= $this->section('scripts_inventory'); ?>

<script>

</script>

<?= $this->endSection(); ?>