<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Control de Stock | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>


<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Inventario y Stock
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Control y verificación de existencias</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content_inventory'); ?>

<!-- FILTROS Y BÚSQUEDA -->
<div class="card my-5">
    <div class="card-header">
        <div class="card-title">
            <i class="bi bi-funnel-fill fs-2 me-2 text-dark"></i>
            <h2>Filtros y Búsqueda</h2>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3">
            <!-- búsqueda libre -->
            <div class="col-md-5">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-inventory-table-filter="search" class="form-control form-control-solid ps-13" placeholder="Buscar por nombre o código" />
                </div>
            </div>

            <!-- filtro por área -->
            <div class="col-md-3">
                <select id="filterArea"
                    data-kt-inventory-table-filter="area"
                    class="form-select form-select-solid"
                    data-control="select2"
                    data-placeholder="Seleccionar Área">
                    <option value=""></option>
                    <?php foreach ($areas as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= esc($a['nombres']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- filtro por sede -->
            <div class="col-md-3">
                <select id="filterSede"
                    data-kt-inventory-table-filter="sede"
                    class="form-select form-select-solid"
                    data-control="select2"
                    data-placeholder="Seleccionar Sede">
                    <option value=""></option>
                    <?php foreach ($userSedes as $s): ?>
                        <option value="<?= $s['sede_id'] ?>">
                            <?= esc($s['sucursal']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

</div>

<!-- TABLA -->
<div class="card mt-5">
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="d-flex flex-column">
            <h3>Inventario por Sede</h3>
            <p class="text-muted">Control de stock con límites mínimos y máximos</p>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-inventory-table-toolbar="base">

                <!--begin::Export-->
                <button type="button" class="btn btn-light-primary me-3">
                    <i class="ki-duotone ki-exit-up fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Exportar</button>
                <!--end::Export-->

            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>

    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_inventory">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px text-center">#Código</th>
                    <th class="max-w-50px">Producto</th>
                    <th class="min-w-125px text-center">Área</th>
                    <th class="min-w-125px text-center">Sede</th>
                    <th class="min-w-125px text-center">Stock</th>
                    <th class="min-w-125px text-center">Estado</th>
                    <th class="text-end min-w-100px">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-ray-600 fw-semibold">
                <?php foreach ($stocks as $stock) : ?>
                    <?php
                    // Valores actuales
                    $stockActual  = intval($stock['stock']     ?? 0);
                    $stockMin     = intval($stock['stock_min'] ?? 0);
                    $stockMax     = intval($stock['stock_max'] ?? 1);

                    // 1) Porcentaje para el width
                    $percent = $stockMax > 0
                        ? max(0, min(($stockActual / $stockMax) * 100, 100))
                        : 0;

                    // 2) Clase según nivel
                    if ($stockActual === 0) {
                        $barClass = 'bg-danger';       // Crítico
                    } elseif ($stockActual < $stockMin) {
                        $barClass = 'bg-warning';      // Bajo
                    } else {
                        $barClass = 'bg-success';      // Normal
                    }
                    ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-light-primary badge-lg" data-code="<?= $stock['codigo'] ?>"><?= $stock['codigo'] ?></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <h4><?= $stock['nombre'] ?></h4>
                                    <p class="text-gray-600 fs-7"><?= $stock['descripcion'] ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-light-info badge-lg"><?= $stock['area'] ?></span>
                        </td>
                        <td class="text-center"><?= $stock['sede'] ?></td>
                        <?php
                        // Valores actuales
                        $stockActual  = intval($stock['stock']     ?? 0);
                        $stockMin     = intval($stock['stock_min'] ?? 0);
                        $stockMax     = max(1, intval($stock['stock_max'] ?? 1));

                        // 1) Porcentaje para el width
                        $percent = ($stockActual / $stockMax) * 100;
                        $percent = max(0, min($percent, 100));

                        // 2) Clase según nivel
                        if ($stockActual <= $stockMin) {
                            // por debajo o igual al mínimo → Danger
                            $barClass = 'bg-danger';
                        } elseif ($percent < 50) {
                            // menos del 50% del máximo → Warning
                            $barClass = 'bg-warning';
                        } else {
                            // 50% o más → Success
                            $barClass = 'bg-success';
                        }

                        // Ahora, determinar estado y clase de badge
                        if ($stockActual === 0) {
                            $stateLabel = 'Crítico';
                            $stateClass = 'badge-danger';
                        } elseif ($stockActual <= $stockMin) {
                            $stateLabel = 'Crítico';
                            $stateClass = 'badge-danger';
                        } elseif ($percent < 50) {
                            $stateLabel = 'Bajo';
                            $stateClass = 'badge-warning';
                        } else {
                            $stateLabel = 'Normal';
                            $stateClass = 'badge-success';
                        }
                        ?>
                        <td class="text-center">
                            <div class="d-flex flex-column align-items-center mt-2">
                                <span class="fw-bold">
                                    <?= $stockActual ?>
                                    <span class="text-gray-600 fs-7">/ <?= $stockMax ?></span>
                                </span>

                                <div class="progress w-100" style="height: 10px;">
                                    <div
                                        class="progress-bar <?= $barClass ?>"
                                        role="progressbar"
                                        style="width: <?= round($percent, 1) ?>%;"
                                        aria-valuenow="<?= $stockActual ?>"
                                        aria-valuemin="0"
                                        aria-valuemax="<?= $stockMax ?>">
                                    </div>
                                </div>

                                <span class="text-muted">Min: <?= $stockMin ?></span>
                            </div>
                        </td>


                        <td class="text-center">
                            <span class="badge <?= $stateClass ?> badge-lg">
                                <?= $stateLabel ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <button
                                type="button"
                                class="btn btn-sm btn-light view-stock-button"
                                data-product-id="<?= $stock['id'] ?>">
                                Ver
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--end::Table-->
    </div>
</div>



<!-- BEGIN: View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <div class="d-flex flex-column">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5">
                                <path d="m7.5 4.27 9 5.15"></path>
                                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                                <path d="m3.3 7 8.7 5 8.7-5"></path>
                                <path d="M12 22V12"></path>
                            </svg>
                            Detalles del Producto: <span id="viewProductName"></span>
                        </span>
                        <span class="text-muted fs-7">Información completa, números de serie y movimientos del producto <span id="viewProductCode"></span></span>
                    </div>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <div class="row gy-5">
                    <!-- Información General -->
                    <div class="col-md-6">
                        <h6 class="mb-3">Información General</h6>
                        <dl class="row">
                            <dt class="col-sm-4 text-muted">Código:</dt>
                            <dd class="col-sm-8 fw-semibold" id="gpCodigo"></dd>
                            <dt class="col-sm-4 text-muted">Área:</dt>
                            <dd class="col-sm-8 fw-semibold" id="gpArea"></dd>
                            <dt class="col-sm-4 text-muted">Sede:</dt>
                            <dd class="col-sm-8 fw-semibold" id="gpSede"></dd>
                        </dl>
                    </div>

                    <!-- Control de Stock -->
                    <div class="col-md-6">
                        <h6 class="mb-3">Control de Stock</h6>
                        <dl class="row">
                            <dt class="col-sm-5 text-muted">Stock Actual:</dt>
                            <dd class="col-sm-7 fw-semibold text-success" id="gpStock"></dd>
                            <dt class="col-sm-5 text-muted">Stock Mínimo:</dt>
                            <dd class="col-sm-7 fw-semibold text-warning" id="gpMin"></dd>
                            <dt class="col-sm-5 text-muted">Stock Máximo:</dt>
                            <dd class="col-sm-7 fw-semibold text-info" id="gpMax"></dd>
                            <dt class="col-sm-5 text-muted">Disponibles:</dt>
                            <dd class="col-sm-7 fw-semibold" id="gpDisp"></dd>
                        </dl>
                    </div>
                </div>

                <hr />

                <!-- Nav pills -->
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tabSerials">Números de Serie ( <span id="countSerials"></span> )</a></li>
                </ul>
                <div class="tab-content">
                    <!-- SERIES -->
                    <div id="tabSerials" class="tab-pane fade show active p-4">
                        <h3>Números de Serie Disponibles</h3>
                        <p class="text-muted fs-7">Productos disponibles para asignación o traslado</p>
                        <div class="row g-3 mt-4" id="serialsContainer"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END: View Product Modal -->



<?= $this->endSection(); ?>

<?= $this->section('scripts_inventory'); ?>
<script>
    const INVENTORY_AREAS = <?= json_encode(array_map(fn($a) => ['id' => $a['id'], 'text' => $a['nombres']], $areas), JSON_HEX_TAG) ?>;
    const INVENTORY_SEDES = <?= json_encode(array_map(fn($s) => ['id' => $s['sede_id'], 'text' => $s['sucursal']], $userSedes), JSON_HEX_TAG) ?>;

    const USER_SEDE_ID = '<?= session("inventory_user")["sede_id"] ?>';

    const KTDataTablesInventory = function() {
        let dt;

        const initDatatable = () => {
            dt = $("#kt_table_inventory").DataTable({
                searchDelay: 500,
                processing: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    url: "<?= base_url('assets/i18n/Spanish.json') ?>"
                }
            });
        };

        // Inicializa Select2 con datos locales
        const initFilterArea = () => {
            $('[data-kt-inventory-table-filter="area"]')
                .select2({
                    data: [{
                        id: '',
                        text: ''
                    }, ...INVENTORY_AREAS],
                    placeholder: 'Seleccionar Área',
                    allowClear: true,
                    width: '100%'
                })
                .on('change', function() {
                    const sel = $(this).select2('data');
                    const text = sel.length ? sel[0].text : '';
                    dt.column(2) // columna “Área”
                        .search(text)
                        .draw();
                });
        };

        const initFilterSede = () => {
            $('[data-kt-inventory-table-filter="sede"]')
                .select2({
                    data: [{
                        id: '',
                        text: ''
                    }, ...INVENTORY_SEDES],
                    placeholder: 'Seleccionar Sede',
                    allowClear: true,
                    width: '100%'
                })
                .on('change', function() {
                    const sel = $(this).select2('data');
                    const texto = sel.length ? sel[0].text.trim() : '';
                    // Si texto está vacío, quitamos filtro (search('','',false))
                    if (!texto) {
                        dt.column(3).search('').draw();
                    } else {
                        // regex ^texto$ para coincidencia exacta, tercera columna = Sede
                        dt
                            .column(3)
                            .search('^' + texto.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + '$', true, false)
                            .draw();
                    }
                });

            if (USER_SEDE_ID) {
                $('[data-kt-inventory-table-filter="sede"]').val(USER_SEDE_ID).trigger('change');
            }
        };


        const handleSearchInventory = () => {
            document
                .querySelector('[data-kt-inventory-table-filter="search"]')
                .addEventListener('keyup', e => {
                    dt.search(e.target.value).draw();
                });
        };

        return {
            init: function() {
                initDatatable();
                handleSearchInventory();
                initFilterArea();
                initFilterSede();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDataTablesInventory.init();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('viewProductModal');
        const modal = new bootstrap.Modal(modalEl);
        document.querySelectorAll('.view-stock-button').forEach(btn => {
            btn.addEventListener('click', async e => {
                e.preventDefault();
                const id = btn.dataset.productId;

                const res = await fetch(`<?= base_url('api/inventory/stock/show/') ?>${id}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!res.ok) return alert('Error al cargar detalles.');

                const {
                    product,
                    serials,
                    movements
                } = await res.json();

                // --- Datos generales ---
                modalEl.querySelector('#viewProductCode').textContent = product.codigo;
                modalEl.querySelector('#viewProductName').textContent = product.nombre;
                modalEl.querySelector('#gpCodigo').textContent = product.codigo;
                modalEl.querySelector('#gpArea').textContent = product.area_nombre;
                modalEl.querySelector('#gpSede').textContent = product.sede;

                // --- Stock ---
                modalEl.querySelector('#gpStock').textContent = product.stock;
                modalEl.querySelector('#gpMin').textContent = product.stock_min;
                modalEl.querySelector('#gpMax').textContent = product.stock_max;
                modalEl.querySelector('#gpDisp').textContent = product.stock;

                modalEl.querySelector('#countSerials').textContent = serials.length;

                // --- Series disponibles ---
                const sc = modalEl.querySelector('#serialsContainer');
                sc.innerHTML = serials.length ?
                    serials.map(s => `
                    <div class="col-md-3">
                    <div class="card bg-light-success mb-2">
                        <div class="card-body py-2">
                        <span class="fw-semibold">${s}</span>
                        </div>
                    </div>
                    </div>
                `).join('') :
                    `<p class="text-muted">Sin números de serie disponibles.</p>`;

                modal.show();
            });
        });
    });
</script>


<?= $this->endSection(); ?>