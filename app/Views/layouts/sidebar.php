<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
  <!--begin::Logo-->
  <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="<?= base_url('/') ?>">
      <img alt="Logo" src="<?= base_url('assets/media/logos/default.svg') ?>" class="h-25px app-sidebar-logo-default theme-light-show" />
      <img alt="Logo" src="<?= base_url('assets/media/logos/default-dark.svg') ?>" class="h-25px app-sidebar-logo-default theme-dark-show" />
      <img alt="Logo" src="<?= base_url('assets/media/logos/default-small.svg') ?>" class="h-20px app-sidebar-logo-minimize" />
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
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="authentication/extended/multi-steps-sign-up.html">
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
                <a class="menu-link" href="authentication/general/welcome.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Roles & Permisos</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!--end:Menu item-->


          <!--begin:Managment Patients Items-->
          <div class="menu-item pt-5">
            <!--begin:Menu content-->
            <div class="menu-content">
              <span class="menu-heading fw-bold text-uppercase fs-7">Mantenimiento Pacientes</span>
            </div>
            <!--end:Menu content-->
          </div>
          <!--end:Managment Patients Items-->

          <!--begin:Menu Patients item-->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('patient|invoice', 'parent') ?>">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-user fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Pacientes</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion <?= set_active_menu(['patient', 'invoice'], 'sub') ?>">
              <!--begin:Menu item-->
              <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('patient', 'parent') ?>">
                <!--begin:Menu link-->
                <span class="menu-link">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Gestión de Pacientes</span>
                  <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion menu-active-bg <?= set_active_menu('patient', 'sub') ?>">
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link <?= set_active_menu(['patient'], 'link') ?>" href="<?= base_url('patient') ?>">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Listado</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link <?= set_active_menu(['patient', 'new'], 'link') ?>" href="<?= base_url('patient/new') ?>">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Nuevo Registro</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= set_active_menu('invoice', 'parent') ?>">
                <!--begin:Menu link-->
                <span class="menu-link">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Cotizaciones</span>
                  <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion menu-active-bg <?= set_active_menu('invoice', 'sub') ?>">
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link <?= set_active_menu(['invoice'], 'link') ?>" href="<?= base_url('invoice') ?>">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Listado</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link <?= set_active_menu(['invoice', 'new'], 'link') ?>" href="<?= base_url('invoice/new') ?>">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Nueva Cotización</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <span class="menu-link">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Historial</span>
                  <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="authentication/layouts/creative/sign-in.html">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Sign-in</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="authentication/layouts/creative/sign-up.html">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Sign-up</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="authentication/layouts/creative/two-factor.html">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Two-Factor</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="authentication/layouts/creative/reset-password.html">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Reset Password</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                  <!--begin:Menu item-->
                  <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="authentication/layouts/creative/new-password.html">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">New Password</span>
                    </a>
                    <!--end:Menu link-->
                  </div>
                  <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
              </div>
              <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
          </div>
          <!--end:Menu Patients item-->


          <div class="menu-item">
            <!--begin:Menu link-->
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
            <!--end:Menu link-->
          </div>


          <!--begin:Menu item-->
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <!--begin:Menu link-->
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-abstract-39 fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Social</span>
              <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="pages/social/feeds.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Feeds</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="pages/social/activity.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Activty</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
              <!--begin:Menu item-->
              <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="pages/social/followers.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Followers</span>
                </a>
                <!--end:Menu link-->
              </div>
              <!--end:Menu item-->
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
            <!--end:Menu sub-->
          </div>
          <!--end:Menu item-->





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