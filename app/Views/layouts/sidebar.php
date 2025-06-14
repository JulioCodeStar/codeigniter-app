<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
  <!--begin::Logo-->
  <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="<?= base_url('/') ?>">
      <img
        alt="Logo"
        src="<?= base_url('assets/media/logos/logo-default.svg') ?>"
        class="app-sidebar-logo-default" style="height: 40px;" />
      <img
        alt="Logo"
        src="<?= base_url('assets/media/logos/logo-mobile.svg') ?>"
        class="app-sidebar-logo-minimize" style="height: 35px;" />
    </a>
    <!--end::Logo image-->
    <!--begin::Sidebar toggle-->

    <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
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
      <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

          <!--begin:Dashboard Item-->
          <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="<?= site_url() ?>">
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
          <!--end:Dashboard Item-->


          <!--begin:Managment User Items-->
          <div class="menu-item pt-5">
            <!--begin:Menu content-->
            <div class="menu-content">
              <span class="menu-heading fw-bold text-uppercase fs-7">Mantenimiento Usuarios</span>
            </div>
            <!--end:Menu content-->
          </div>
          <!--end:Managment User Items-->

          <!--begin:Menu item-->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-user fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Autenticación</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion <?= set_active_menu('users|users/roles', 'parent') ?>">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('users', 'link') ?>" href="<?= base_url('users') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Usuarios</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link <?= set_active_menu('users/roles', 'link') ?>" href="<?= base_url('users/roles') ?>">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Roles</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!--end:Menu item-->


          <?php if (show_if_permission(permisos_pacientes())): ?>
            <!--begin:Managment Patients Title-->
            <div class="menu-item pt-5">
              <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Mantenimiento Pacientes</span>
              </div>
            </div>
            <!--end:Managment Patients Title-->

            <!--begin:Pacientes Section-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('patient|invoice|contract|accesorios|citas|managment|consentimiento', 'parent') ?>">
              <span class="menu-link">
                <span class="menu-icon">
                  <i class="ki-duotone ki-user fs-2"><span class="path1"></span><span class="path2"></span></i>
                </span>
                <span class="menu-title">Pacientes</span>
                <span class="menu-arrow"></span>
              </span>

              <div class="menu-sub menu-sub-accordion <?= set_active_menu(['patient|invoice|contract|accesorios|citas|managment|consentimiento'], 'sub') ?>">

                <!-- Gestión de Pacientes -->
                <?php if (show_if_permission(['gestion_pacientes.pacientes.listado', 'gestion_pacientes.pacientes.create'])): ?>
                  <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('patient', 'parent') ?>">
                    <span class="menu-link">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Gestión de Pacientes</span>
                      <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg <?= set_active_menu('patient', 'sub') ?>">
                      <?php if (show_if_permission('gestion_pacientes.pacientes.listado')): ?>
                        <div class="menu-item">
                          <a class="menu-link <?= set_active_menu('patient', 'link') ?>" href="<?= base_url('patient') ?>">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Listado</span>
                          </a>
                        </div>
                      <?php endif; ?>

                      <?php if (show_if_permission('gestion_pacientes.pacientes.create')): ?>
                        <div class="menu-item">
                          <a class="menu-link <?= set_active_menu('patient/new', 'link') ?>" href="<?= base_url('patient/new') ?>">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Nuevo Registro</span>
                          </a>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>

                <!-- Cotizaciones -->
                <?php if (show_if_permission(['gestion_pacientes.cotizaciones.listado', 'gestion_pacientes.cotizaciones.create'])): ?>
                  <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('invoice', 'parent') ?>">
                    <span class="menu-link">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Cotizaciones</span>
                      <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg <?= set_active_menu('invoice', 'sub') ?>">
                      <?php if (show_if_permission('gestion_pacientes.cotizaciones.listado')): ?>
                        <div class="menu-item">
                          <a class="menu-link <?= set_active_menu('invoice', 'link') ?>" href="<?= base_url('invoice') ?>">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Listado</span>
                          </a>
                        </div>
                      <?php endif; ?>

                      <?php if (show_if_permission('gestion_pacientes.cotizaciones.create')): ?>
                        <div class="menu-item">
                          <a class="menu-link <?= set_active_menu('invoice/new', 'link') ?>" href="<?= base_url('invoice/new') ?>">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Nueva Cotización</span>
                          </a>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>

                <!-- Contratos -->
                <?php if (show_if_permission('gestion_pacientes.contratos')): ?>
                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('contract|contract/pagos', 'link') ?>" href="<?= base_url('contract') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Contratos</span>
                    </a>
                  </div>
                <?php endif; ?>

                <!-- Ventas Accesorios -->
                <?php if (show_if_permission('gestion_pacientes.ventas_accesorios')): ?>
                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('accesorios', 'link') ?>" href="<?= base_url('accesorios') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Ventas Accesorios</span>
                    </a>
                  </div>
                <?php endif; ?>

                <!-- Citas -->
                <?php if (show_if_permission('gestion_pacientes.citas')): ?>
                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('citas', 'link') ?>" href="<?= base_url('citas') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Citas</span>
                    </a>
                  </div>
                <?php endif; ?>

                <!-- Mantenimiento -->
                <?php if (show_if_permission('gestion_pacientes.mantenimiento')): ?>
                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('managment', 'link') ?>" href="<?= base_url('managment') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Mantenimiento</span>
                    </a>
                  </div>
                <?php endif; ?>

                <!-- Carta de Consentimiento -->
                <div class="menu-item">
                  <a class="menu-link <?= set_active_menu('consentimiento', 'link') ?>" href="<?= base_url('consentimiento') ?>">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">Carta de Consentimiento</span>
                  </a>
                </div>
              </div>
            </div>
            <!--end:Pacientes Section-->
          <?php endif; ?>


          <!--begin:Caja Ventas item-->
          <div class="menu-item">

            <a class="menu-link" target="_blank" href="<?= base_url('sales/auth/login') ?>">
              <span class="menu-icon">
                <i class="ki-duotone ki-cheque fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                  <span class="path6"></span>
                  <span class="path7"></span>
                </i>
              </span>
              <span class="menu-title">Caja Ventas</span>
            </a>

          </div>
          <!--end:Caja Ventas item-->




          <!--begin:Managment Logística Title-->
          <div class="menu-item pt-5">
            <div class="menu-content">
              <span class="menu-heading fw-bold text-uppercase fs-7">Mantenimiento Logística</span>
            </div>
          </div>

          <!--begin:Logística item-->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('logistica', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-chart fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Logística</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Logística link-->
            <!--begin:Logística sub-->
            <div class="menu-sub menu-sub-accordion <?= set_active_menu('logistica', 'sub') ?>">
              <!--begin:Orden Compra item-->
              <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('logistica/orden-compra|logistica/proveedor', 'sub') ?>">
                <span class="menu-link">
                  <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                  <span class="menu-title">Orden Compra</span>
                  <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/proveedor', 'link') ?>" href="<?= base_url('logistica/proveedor') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Proveedores</span>
                    </a>
                  </div>

                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/orden-compra', 'link') ?>" href="<?= base_url('logistica/orden-compra') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Listado</span>
                    </a>
                  </div>

                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/orden-compra/new', 'link') ?>" href="<?= base_url('logistica/orden-compra/new') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Nuevo Registro</span>
                    </a>
                  </div>
                </div>
              </div>
              <!--end:Orden Compra item-->

              <!--begin:Orden Trabajo item-->
              <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('logistica/orden-trabajo', 'sub') ?>">
                <span class="menu-link">
                  <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                  <span class="menu-title">Orden Trabajo</span>
                  <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/orden-trabajo', 'link') ?>" href="<?= base_url('logistica/orden-trabajo') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Listado</span>
                    </a>
                  </div>

                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/orden-trabajo/new', 'link') ?>" href="<?= base_url('logistica/orden-trabajo/new') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Nuevo Registro</span>
                    </a>
                  </div>
                </div>
              </div>
              <!--end:Orden Trabajo item-->

              <!--begin:Orden Importación item-->
              <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('logistica/orden-importacion', 'sub') ?>">
                <span class="menu-link">
                  <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                  <span class="menu-title">Orden Importación</span>
                  <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/orden-importacion', 'link') ?>" href="<?= base_url('logistica/orden-importacion') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Listado</span>
                    </a>
                  </div>

                  <div class="menu-item">
                    <a class="menu-link <?= set_active_menu('logistica/orden-importacion/new', 'link') ?>" href="<?= base_url('logistica/orden-importacion/new') ?>">
                      <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                      <span class="menu-title">Nuevo Registro</span>
                    </a>
                  </div>
                </div>
              </div>
              <!--end:Orden Importación item-->
              

              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="pages/social/settings.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Settings</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Logística sub-->
          </div>
          <!--end:Logística item-->
          <!--end:Managment Logística Title-->


        </div>
        <!--end::Menu-->
      </div>
      <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
  </div>
  <!--end::sidebar menu-->
  <!--begin::Footer-->
  <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
    <a href="https://preview.keenthemes.com/html/metronic/docs" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
      <span class="btn-label">Docs & Components</span>
      <i class="ki-duotone ki-document btn-icon fs-2 m-0">
        <span class="path1"></span>
        <span class="path2"></span>
      </i>
    </a>
  </div>
  <!--end::Footer-->
</div>
<!--end::Sidebar-->