<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <title>
    <?= $this->renderSection('title_sales'); ?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
  <!--begin::Fonts(mandatory for all pages)-->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Vendor Stylesheets(used for this page only)-->
  <link
    href="<?= base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') ?>"
    rel="stylesheet"
    type="text/css" />
  <link
    href="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.css') ?>"
    rel="stylesheet"
    type="text/css" />
  <!--end::Vendor Stylesheets-->
  <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
  <link
    href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>"
    rel="stylesheet"
    type="text/css" />
  <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
  <!--end::Global Stylesheets Bundle-->
  <meta name="csrf-token" content="<?= csrf_hash() ?>" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body
  id="kt_app_body"
  data-kt-app-layout="light-sidebar"
  data-kt-app-header-fixed="true"
  data-kt-app-sidebar-enabled="true"
  data-kt-app-sidebar-fixed="true"
  data-kt-app-sidebar-hoverable="true"
  data-kt-app-sidebar-push-header="true"
  data-kt-app-sidebar-push-toolbar="true"
  data-kt-app-sidebar-push-footer="true"
  data-kt-app-toolbar-enabled="true"
  class="app-default">
  <!--begin::Theme mode setup on page load-->
  <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
      if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
        themeMode =
          document.documentElement.getAttribute("data-bs-theme-mode");
      } else {
        if (localStorage.getItem("data-bs-theme") !== null) {
          themeMode = localStorage.getItem("data-bs-theme");
        } else {
          themeMode = defaultThemeMode;
        }
      }
      if (themeMode === "system") {
        themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ?
          "dark" :
          "light";
      }
      document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
  </script>
  <!--end::Theme mode setup on page load-->
  <!--begin::App-->
  <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
      <!--begin::Header-->
      <div
        id="kt_app_header"
        class="app-header"
        data-kt-sticky="true"
        data-kt-sticky-activate="{default: true, lg: true}"
        data-kt-sticky-name="app-header-minimize"
        data-kt-sticky-offset="{default: '200px', lg: '0'}"
        data-kt-sticky-animation="false">
        <!--begin::Header container-->
        <div
          class="app-container container-fluid d-flex align-items-stretch justify-content-between"
          id="kt_app_header_container">
          <!--begin::Sidebar mobile toggle-->
          <div
            class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2"
            title="Show sidebar menu">
            <div
              class="btn btn-icon btn-active-color-primary w-35px h-35px"
              id="kt_app_sidebar_mobile_toggle">
              <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                <span class="path1"></span>
                <span class="path2"></span>
              </i>
            </div>
          </div>
          <!--end::Sidebar mobile toggle-->
          <!--begin::Mobile logo-->
          <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="index.html" class="d-lg-none">
              <img
                alt="Logo"
                src="<?= base_url('assets/media/logos/default-small.svg') ?>"
                class="h-30px" />
            </a>
          </div>
          <!--end::Mobile logo-->
          <!--begin::Header wrapper-->
          <div
            class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
            id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-navbar flex-shrink-0">

            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">

              <!--begin::Activities-->
              <div class="app-navbar-item ms-1 ms-md-4">
                <!--begin::Drawer toggle-->
                <div
                  class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                  id="kt_activities_toggle">
                  <i class="ki-duotone ki-messages fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                  </i>
                </div>
                <!--end::Drawer toggle-->
              </div>
              <!--end::Activities-->



              <!--begin::Theme mode-->
              <div class="app-navbar-item ms-1 ms-md-4">
                <!--begin::Menu toggle-->
                <a
                  href="#"
                  class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                  data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                  data-kt-menu-attach="parent"
                  data-kt-menu-placement="bottom-end">
                  <i class="ki-duotone ki-night-day theme-light-show fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                    <span class="path6"></span>
                    <span class="path7"></span>
                    <span class="path8"></span>
                    <span class="path9"></span>
                    <span class="path10"></span>
                  </i>
                  <i class="ki-duotone ki-moon theme-dark-show fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                  </i>
                </a>
                <!--begin::Menu toggle-->
                <!--begin::Menu-->
                <div
                  class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                  data-kt-menu="true"
                  data-kt-element="theme-mode-menu">
                  <!--begin::Menu item-->
                  <div class="menu-item px-3 my-0">
                    <a
                      href="#"
                      class="menu-link px-3 py-2"
                      data-kt-element="mode"
                      data-kt-value="light">
                      <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-duotone ki-night-day fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                          <span class="path3"></span>
                          <span class="path4"></span>
                          <span class="path5"></span>
                          <span class="path6"></span>
                          <span class="path7"></span>
                          <span class="path8"></span>
                          <span class="path9"></span>
                          <span class="path10"></span>
                        </i>
                      </span>
                      <span class="menu-title">Light</span>
                    </a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3 my-0">
                    <a
                      href="#"
                      class="menu-link px-3 py-2"
                      data-kt-element="mode"
                      data-kt-value="dark">
                      <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-duotone ki-moon fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </span>
                      <span class="menu-title">Dark</span>
                    </a>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3 my-0">
                    <a
                      href="#"
                      class="menu-link px-3 py-2"
                      data-kt-element="mode"
                      data-kt-value="system">
                      <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-duotone ki-screen fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                          <span class="path3"></span>
                          <span class="path4"></span>
                        </i>
                      </span>
                      <span class="menu-title">System</span>
                    </a>
                  </div>
                  <!--end::Menu item-->
                </div>
                <!--end::Menu-->
              </div>
              <!--end::Theme mode-->
              <!--begin::User menu-->
              <div
                class="app-navbar-item ms-1 ms-md-4"
                id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div
                  class="cursor-pointer symbol symbol-35px"
                  data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                  data-kt-menu-attach="parent"
                  data-kt-menu-placement="bottom-end">
                  <img
                    src="<?= base_url('assets/media/avatars/300-3.jpg') ?>"
                    class="rounded-3"
                    alt="user" />
                </div>
                <!--begin::User account menu-->
                <div
                  class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                  data-kt-menu="true">
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                      <!--begin::Avatar-->
                      <div class="symbol symbol-50px me-5">
                        <img
                          alt="Logo"
                          src="<?= base_url('assets/media/avatars/300-3.jpg') ?>" />
                      </div>
                      <!--end::Avatar-->
                      <!--begin::Username-->
                      <div class="d-flex flex-column min-w-0"><!-- 👈 min-w-0 permite que el flex-item se encoja -->
                        <div class="fw-bold fs-5 text-truncate">
                          <?= esc(session('caja_user')['nombre']) ?>
                        </div>
                        <a href="#"
                          class="fw-semibold text-muted text-hover-primary fs-7 text-truncate">
                          <?= esc(session('caja_user')['email']) ?>
                        </a>
                      </div>
                      <!--end::Username-->

                    </div>
                  </div>
                  <!--end::Menu item-->
                  <!--begin::Menu separator-->
                  <div class="separator my-2"></div>
                  <!--end::Menu separator-->

                  <!--begin::Menu item-->
                  <div class="menu-item px-5">
                    <a
                      href="<?= base_url('api/sales/logout') ?>"
                      class="menu-link px-5">Cerrar Sesión</a>
                  </div>
                  <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
                <!--end::Menu wrapper-->
              </div>
              <!--end::User menu-->
              <!--begin::Header menu toggle-->
              <div
                class="app-navbar-item d-lg-none ms-2 me-n2"
                title="Show header menu">
                <div
                  class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                  id="kt_app_header_menu_toggle">
                  <i class="ki-duotone ki-element-4 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                  </i>
                </div>
              </div>
              <!--end::Header menu toggle-->
              <!--begin::Aside toggle-->
              <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
          </div>
          <!--end::Header wrapper-->
        </div>
        <!--end::Header container-->
      </div>
      <!--end::Header-->
      <!--begin::Wrapper-->
      <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

        <?= view('layouts/sales/layouts/sidebar'); ?>

        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
          <!--begin::Content wrapper-->
          <div class="d-flex flex-column flex-column-fluid">

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
              <!--begin::Content container-->
              <div
                id="kt_app_content_container"
                class="app-container container-xxl">

                <?= $this->renderSection('content_sales'); ?>

              </div>
              <!--end::Content container-->
            </div>
            <!--end::Content-->
          </div>
          <!--end::Content wrapper-->
          <!--begin::Footer-->
          <div id="kt_app_footer" class="app-footer">
            <!--begin::Footer container-->
            <div
              class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
              <!--begin::Copyright-->
              <div class="text-gray-900 order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2025&copy;</span>
                <a
                  href="https://keenthemes.com"
                  target="_blank"
                  class="text-gray-800 text-hover-primary">Keenthemes</a>
              </div>
              <!--end::Copyright-->
              <!--begin::Menu-->
              <ul
                class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                <li class="menu-item">
                  <a
                    href="https://keenthemes.com"
                    target="_blank"
                    class="menu-link px-2">About</a>
                </li>
                <li class="menu-item">
                  <a
                    href="https://devs.keenthemes.com"
                    target="_blank"
                    class="menu-link px-2">Support</a>
                </li>
                <li class="menu-item">
                  <a
                    href="https://1.envato.market/EA4JP"
                    target="_blank"
                    class="menu-link px-2">Purchase</a>
                </li>
              </ul>
              <!--end::Menu-->
            </div>
            <!--end::Footer container-->
          </div>
          <!--end::Footer-->
        </div>
        <!--end:::Main-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::App-->

  <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up">
      <span class="path1"></span>
      <span class="path2"></span>
    </i>
  </div>
  <!--end::Scrolltop-->


  <!--begin::Javascript-->
  <script>
    const hostUrl = "<?= base_url('assets/') ?>";
  </script>
  <!--begin::Global Javascript Bundle(mandatory for all pages)-->
  <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
  <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
  <!--end::Global Javascript Bundle-->
  <!--begin::Vendors Javascript(used for this page only)-->
  <script src="<?= base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
  <!--end::Vendors Javascript-->
  <!--begin::Custom Javascript(used for this page only)-->
  <script src="<?= base_url('assets/js/widgets.bundle.js') ?>"></script>
  <script src="<?= base_url('assets/js/custom/widgets.js') ?>"></script>
  <script src="<?= base_url('assets/js/custom/apps/chat/chat.js') ?>"></script>
  <script src="<?= base_url('assets/js/custom/utilities/modals/upgrade-plan.js') ?>"></script>
  <script src="<?= base_url('assets/js/custom/utilities/modals/create-app.js') ?>"></script>
  <script src="<?= base_url('assets/js/custom/utilities/modals/users-search.js') ?>"></script>
  <!--end::Custom Javascript-->

  <?= $this->renderSection('scripts_sales'); ?>

  <!--end::Javascript-->
</body>
<!--end::Body-->

</html>