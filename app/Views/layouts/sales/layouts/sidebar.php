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
    <a href="<?= base_url('sales') ?>">
      <img
        alt="Logo"
        src="<?= base_url('assets/media/logos/default.svg') ?>"
        class="h-25px app-sidebar-logo-default theme-light-show" />
      <img
        alt="Logo"
        src="<?= base_url('assets/media/logos/default-dark.svg') ?>"
        class="h-25px app-sidebar-logo-default theme-dark-show" />
      <img
        alt="Logo"
        src="<?= base_url('assets/media/logos/default-small.svg') ?>"
        class="h-20px app-sidebar-logo-minimize" />
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
            <a class="menu-link <?= set_active_menu('sales', 'link') ?>" href="<?= base_url('sales') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-element-11 fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                </i>
              </span>
              <span class="menu-title">Inicio</span>
            </a>
            <!--end:Menu link-->
          </div>
          <!-- end:DASHBOARD -->

          <?php if (apertura()): ?>
            <!-- begin:ACCESORIOS -->
            <div class="menu-item">
              <!--begin:Menu link-->
              <a class="menu-link <?= set_active_menu('sales/accesorios|sales/accesorios/new|sales/accesorios/pagos', 'link') ?>" href="<?= base_url('sales/accesorios') ?>">
                <span class="menu-icon">
                  <i class="ki-duotone ki-tag fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                  </i>
                </span>
                <span class="menu-title">Ventas Accesorios</span>
              </a>
              <!--end:Menu link-->
            </div>
            <!-- end:ACCESORIOS -->

            <!-- begin:CONTRATOS -->
            <div class="menu-item">
              <!--begin:Menu link-->
              <a class="menu-link <?= set_active_menu('sales/contract|sales/contract/new|sales/contract/pagos', 'link') ?>" href="<?= base_url('sales/contract') ?>">
                <span class="menu-icon">
                  <i class="ki-duotone ki-package fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                  </i>
                </span>
                <span class="menu-title">Contratos</span>
              </a>
              <!--end:Menu link-->
            </div>
            <!-- end:CONTRATOS -->

            <!-- begin:CITAS -->
            <div class="menu-item">
              <!--begin:Menu link-->
              <a class="menu-link <?= set_active_menu('sales/citas', 'link') ?>" href="<?= base_url('sales/citas') ?>">
                <span class="menu-icon">
                  <i class="ki-duotone ki-note-2 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                  </i>
                </span>
                <span class="menu-title">Citas</span>
              </a>
              <!--end:Menu link-->
            </div>
            <!-- end:CITAS -->

            <!-- begin:MANTENIMIENTO -->
            <div class="menu-item">
              <!--begin:Menu link-->
              <a class="menu-link <?= set_active_menu('sales/managment', 'link') ?>" href="<?= base_url('sales/managment') ?>">
                <span class="menu-icon">
                  <i class="ki-duotone ki-chart fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                  </i>
                </span>
                <span class="menu-title">Mantenimiento</span>
              </a>
              <!--end:Menu link-->
            </div>
            <!-- end:MANTENIMIENTO -->

          <?php endif; ?>

          <?php if(user_has_permission_sales('caja_ventas.seguimiento.acceso')): ?>
          <!-- begin:SEGUIMIENTO -->
          <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link <?= set_active_menu('sales/seguimiento', 'link') ?>" href="<?= base_url('sales/seguimiento') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-chart-line-down-2 fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                </i>
              </span>
              <span class="menu-title">Seguimiento</span>
            </a>
            <!--end:Menu link-->
          </div>
          <!-- end:SEGUIMIENTO -->
          <?php endif; ?>

          <?php if(user_has_permission_sales('caja_ventas.reportes.acceso')): ?>
          <!-- begin:REPORTES -->
          <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link <?= set_active_menu('sales/reports', 'link') ?>" href="<?= base_url('sales/reports') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-chart-pie-simple fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Reportes</span>
            </a>
            <!--end:Menu link-->
          </div>
          <!-- end:REPORTES -->
          <?php endif; ?>


        </div>
        <!--end::Menu-->
      </div>
      <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
  </div>
  <!--end::sidebar menu-->
</div>