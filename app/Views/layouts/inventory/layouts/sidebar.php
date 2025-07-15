<div
  id="kt_app_sidebar"
  class="app-sidebar flex-column"
  data-kt-drawer="true"
  data-kt-drawer-name="app-sidebar"
  data-kt-drawer-activate="{default: true, lg: false}"
  data-kt-drawer-overlay="true"
  data-kt-drawer-width="225px"
  data-kt-drawer-direction="start"
  data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
  <!--begin::Logo-->
  <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="<?= base_url('inventory') ?>">
      <img
        alt="Logo"
        src="<?= base_url('assets/media/img/encabezado.png') ?>"
        class="app-sidebar-logo-default theme-light-show" style="height: 40px;" />
      <img
        alt="Logo"
        src="<?= base_url('assets/media/img/encabezado.png') ?>"
        class="app-sidebar-logo-default theme-dark-show" style="height: 40px;" />
      <img
        alt="Logo"
        src="<?= base_url('assets/media/logos/logo-mobile.svg') ?>"
        class="app-sidebar-logo-minimize" style="height: 35px;" />
    </a>
    <!--end::Logo image-->
    <!--begin::Sidebar toggle-->
    <div
      id="kt_app_sidebar_toggle"
      class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
      data-kt-toggle="true"
      data-kt-toggle-state="active"
      data-kt-toggle-target="body"
      data-kt-toggle-name="app-sidebar-minimize">
      <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
        <span class="path1"></span>
        <span class="path2"></span>
      </i>
    </div>
    <!--end::Sidebar toggle-->
  </div>
  <!--end::Logo-->

  <hr class="border-dotted border-gray-500">

  <?php
  $user         = session('inventory_user');
  $sedes        = $user['sedes']   ?? [];
  $activeSedeId = $user['sede_id'] ?? null;
  ?>

  <!--begin::Sede Activa-->
  <div class="px-6 pb-2">
    <label for="sedeActiva" class="form-label fs-6 fw-bold mb-1">Sede Activa</label>
    <select
      data-control="select2"
      data-placeholder="Seleccionar Sede"
      id="sedeActiva"
      name="sedeActiva"
      class="form-select form-select-solid mb-2"
      onchange="location.href='<?= base_url('inventory/change-sede/') ?>'+this.value">
      <option></option>
      <?php foreach ($sedes as $sede): ?>
        <option
          value="<?= $sede['sede_id']; ?>"
          <?= $sede['sede_id'] == $activeSedeId ? 'selected' : '' ?>>
          <?= esc($sede['sucursal']); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <!--end::Sede Activa-->


  <hr class="border-dotted border-gray-500">

  <!--begin::sidebar menu-->
  <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
      <!--begin::Scroll wrapper-->
      <div
        id="kt_app_sidebar_menu_scroll"
        class="scroll-y my-5 mx-3"
        data-kt-scroll="true"
        data-kt-scroll-activate="true"
        data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu"
        data-kt-scroll-offset="5px"
        data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div
          class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
          id="#kt_app_sidebar_menu"
          data-kt-menu="true"
          data-kt-menu-expand="false">

          <!-- begin:DASHBOARD -->
          <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link <?= set_active_menu('inventory') ?>" href="<?= base_url('inventory') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-element-11 fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                </i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
            <!--end:Menu link-->
          </div>
          <!-- end:DASHBOARD -->

          <!-- begin:PRODUCTOS -->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('inventory/products', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-parcel fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                </i>
              </span>
              <span class="menu-title">Productos <span class="badge badge-dark ms-2">global</span></span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/products') ?>" href="<?= base_url('inventory/products') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Lista de Productos</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/products/new') ?>" href="<?= base_url('inventory/products/new') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Registrar Producto</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!-- end:PRODUCTOS -->

          <!-- begin:ENTRADAS -->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('inventory/entries', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-delivery-3 fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                </i>
              </span>
              <span class="menu-title">Entradas</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/entries') ?>" href="<?= base_url('inventory/entries') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Lista de Entradas</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/entries/new') ?>" href="<?= base_url('inventory/entries/new') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Registrar Entrada</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!-- end:ENTRADAS -->

          <!-- begin:SALIDAS -->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('inventory/exits', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-delivery-2 fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                  <span class="path6"></span>
                  <span class="path7"></span>
                  <span class="path8"></span>
                  <span class="path9"></span>
                </i>
              </span>
              <span class="menu-title">Salidas</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/exits') ?>" href="<?= base_url('inventory/exits') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Lista de Salidas</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/exits/new') ?>" href="<?= base_url('inventory/exits/new') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Registrar Salida</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!-- end:SALIDAS -->

          <?php if (session('inventory_user')['sede_id'] != 1) : ?>
          <!-- begin:REQUERIMIENTOS -->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('inventory/requirements', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-delivery-24 fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                </i>
              </span>
              <span class="menu-title">Requerimientos</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/requirements') ?>" href="<?= base_url('inventory/requirements') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Lista de Requerimientos</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/requirements/new') ?>" href="<?= base_url('inventory/requirements/new') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Registrar Requerimiento</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!-- end:REQUERIMIENTOS -->
          <?php endif; ?>

          <?php if (session('inventory_user')['sede_id'] == 1) : ?>
          <!-- begin:TRASLADOS -->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('inventory/traslados', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-truck fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                </i>
              </span>
              <span class="menu-title">Traslados</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/traslados') ?>" href="<?= base_url('inventory/traslados') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Lista de Traslados</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('inventory/traslados/new') ?>" href="<?= base_url('inventory/traslados/new') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Registrar Traslado</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!-- end:TRASLADOS -->
          <?php endif; ?>

          <!-- begin:STOCK -->
          <div class="menu-item">
            <a class="menu-link <?= set_active_menu('inventory/stock') ?>" href="<?= base_url('inventory/stock') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-parcel-tracking fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                </i>
              </span>
              <span class="menu-title">Stock por Sede</span>
            </a>
            <!--end:Menu link-->
          </div>
          <!-- end:STOCK -->

        </div>
        <!--end::Menu-->
      </div>
      <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
  </div>
  <!--end::sidebar menu-->
</div>