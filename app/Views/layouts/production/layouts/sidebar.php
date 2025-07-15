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
            <a class="menu-link <?= set_active_menu('production', 'link') ?>" href="<?= base_url('production') ?>">
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
          <div class="menu-item">
            <a class="menu-link <?= set_active_menu('production/products', 'link') ?>" href="<?= base_url('production/products') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-chart fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Productos</span>
            </a>
          </div>
          <!-- end:PRODUCTOS -->

          <!-- begin:ORDEN PRODUCCIÓN -->
          <div class="menu-item">
            <a class="menu-link <?= set_active_menu('production/orders', 'link') ?>" href="<?= base_url('production/orders') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-abstract-42 fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Ordenes de Producción</span>
            </a>
          </div>
          <!-- end:ORDEN PRODUCCIÓN -->

          <!-- begin:SEGUIMIENTO DE ITEMS -->
          <div class="menu-item">
            <a class="menu-link <?= set_active_menu('production/follow-up', 'link') ?>" href="<?= base_url('production/follow-up') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-scan-barcode fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                  <span class="path6"></span>
                  <span class="path7"></span>
                  <span class="path8"></span>
                </i>
              </span>
              <span class="menu-title">Seguimiento de Items</span>
            </a>
          </div>
          <!-- end:SEGUIMIENTO DE ITEMS -->

        </div>
        <!--end::Menu-->
      </div>
      <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
  </div>
  <!--end::sidebar menu-->
</div>