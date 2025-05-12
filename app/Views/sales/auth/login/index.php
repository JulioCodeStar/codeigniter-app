<!DOCTYPE html>
<html lang="es">
<!--begin::Head-->

<head>
  <base href="<?= base_url('') ?>" />
  <title>Caja Ventas - Login | KYP Bioingeniería</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
  <!--begin::Fonts(mandatory for all pages)-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
  <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
  <!--end::Global Stylesheets Bundle-->
  <script>
    // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
  </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
  <!--begin::Theme mode setup on page load-->
  <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
      if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
        themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
      } else {
        if (localStorage.getItem("data-bs-theme") !== null) {
          themeMode = localStorage.getItem("data-bs-theme");
        } else {
          themeMode = defaultThemeMode;
        }
      }
      if (themeMode === "system") {
        themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
      }
      document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
  </script>
  <!--end::Theme mode setup on page load-->
  <!--begin::Root-->
  <div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
      <!--begin::Body-->
      <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
          <!--begin::Wrapper-->
          <div class="w-lg-500px p-10">
            <!--begin::Form-->
            <?= form_open('api/sales/login', ['id' => 'kt_form_login_sales', 'class' => 'form w-100', 'novalidate' => 'novalidate']) ?>
            <!--begin::Heading-->
            <div class="text-center mb-11">
              <!--begin::Title-->
              <h1 class="text-gray-900 fw-bolder mb-3">Caja Ventas</h1>
              <!--end::Title-->
              <!--begin::Subtitle-->
              <div class="text-gray-500 fw-semibold fs-6">Iniciar Sesión</div>
              <!--end::Subtitle=-->
            </div>
            <!--begin::Heading-->
            <!--begin::Separator-->
            <div class="separator separator-content my-14">
              <span class="w-125px text-gray-500 fw-semibold fs-7">Escoja la sede</span>
            </div>
            <!--end::Separator-->
            <!--begin::Login options-->
            <div class="row g-3 mb-9">

              <select class="form-select form-select-solid" data-control="select2" data-placeholder="Seleccionar la Sede" id="sede" name="sede">
                <option></option>
                <?php foreach ($sede as $row) { ?>
                  <option value="<?= $row['id'] ?>"><?= $row['sucursal'] ?></option>
                <?php } ?>
              </select>

            </div>
            <!--end::Login options-->
            <!--begin::Input group=-->
            <div class="fv-row mb-8">
              <!--begin::Email-->
              <input type="text" placeholder="Correo Electrónico" id="email" name="email" autocomplete="off" class="form-control bg-transparent" />
              <!--end::Email-->
            </div>
            <!--end::Input group=-->
            <div class="fv-row mb-3" data-kt-password-meter="true">
              <div class="position-relative mb-3">
                <input class="form-control bg-transparent"
                  type="password" placeholder="•••••••••••••••••" id="password" name="password" autocomplete="off" />

                <!--begin::Visibility toggle-->
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                  data-kt-password-meter-control="visibility">
                  <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                  <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </span>
                <!--end::Visibility toggle-->
              </div>
              <!--end::Input wrapper-->
            </div>
            <!--end::Input group=-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">

            </div>
            <!--end::Wrapper-->
            <!--begin::Submit button-->
            <div class="d-grid mb-10">
              <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Acceder</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
              </button>
            </div>
            <!--end::Submit button-->
            <!--begin::Sign up-->
            <div class="text-gray-500 text-center fw-semibold fs-6">Regresar
              <a href="<?= base_url('') ?>" class="link-primary">click aquí!</a>
            </div>
            <!--end::Sign up-->
            <?= form_close(); ?>
            <!--end::Form-->
          </div>
          <!--end::Wrapper-->

          <?php if (session()->getFlashdata('error') !== null) : ?>
            <!--begin::Alert-->
            <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
              <!--begin::Icon-->
              <i class="ki-duotone ki-message-text-2 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
              <!--end::Icon-->

              <!--begin::Wrapper-->
              <div class="d-flex flex-column pe-0 pe-sm-10">
                <!--begin::Title-->
                <h5 class="mb-1">This is an alert</h5>
                <!--end::Title-->

                <!--begin::Content-->
                <span><?= session()->getFlashdata('error') ?></span>
                <!--end::Content-->
              </div>
              <!--end::Wrapper-->

              <!--begin::Close-->
              <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
              </button>
              <!--end::Close-->
            </div>
            <!--end::Alert-->
          <?php endif; ?>
        </div>
        <!--end::Form-->

      </div>
      <!--end::Body-->
      <!--begin::Aside-->
      <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(<?= base_url('assets/media/misc/auth-bg.png') ?>)">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
          <!--begin::Logo-->
          <a href="index.html" class="mb-0 mb-lg-12">
            <img alt="Logo" src="<?= base_url('assets/media/logos/custom-1.png') ?>" class="h-60px h-lg-75px" />
          </a>
          <!--end::Logo-->
          <!--begin::Image-->
          <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="<?= base_url('assets/media/misc/auth-screens.png') ?>" alt="" />
          <!--end::Image-->
          <!--begin::Title-->
          <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
          <!--end::Title-->
          <!--begin::Text-->
          <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
            <br />and provides some background information about
            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
            <br />work following this is a transcript of the interview.
          </div>
          <!--end::Text-->
        </div>
        <!--end::Content-->
      </div>
      <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
  </div>
  <!--end::Root-->
  <!--begin::Javascript-->
  <script>
    var hostUrl = "<?= base_url('assets/') ?>";
  </script>
  <!--begin::Global Javascript Bundle(mandatory for all pages)-->
  <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
  <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
  <!--end::Global Javascript Bundle-->
  <!--end::Javascript-->
</body>
<!--end::Body-->

</html>