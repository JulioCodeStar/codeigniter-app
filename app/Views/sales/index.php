<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title_sales'); ?>
Inicio | Caja Ventas - KYP Bioingeniería
<?= $this->endSection(); ?>


<?= $this->section('content_sales'); ?>

<?php if (!$apertura) { ?>
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body p-0">
      <!--begin::Wrapper-->
      <div class="card-px text-center py-20 my-10">
        <!--begin::Title-->
        <h2 class="fs-2x fw-bold mb-10">
          Welcome to Customers App
        </h2>
        <!--end::Title-->
        <!--begin::Description-->
        <p class="text-gray-500 fs-4 fw-semibold mb-10">
          There are no customers added yet. <br />Kickstart your
          CRM by adding a your first customer
        </p>
        <!--end::Description-->
        <!--begin::Action-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalApertura" class="btn btn-primary">Iniciar Caja</a>
        <!--end::Action-->
      </div>
      <!--end::Wrapper-->
      <!--begin::Illustration-->
      <div class="text-center pb-4 px-4">
        <img
          class="mw-100 mh-300px"
          alt=""
          src="<?= base_url('assets/media/illustrations/sketchy-1/2.png') ?>" />
      </div>
      <!--end::Illustration-->
    </div>
    <!--end::Card body-->
  </div>


  <div class="modal fade" tabindex="-1" id="modalApertura">
    <div class="modal-dialog modal-dialog-centered">
      <?= form_open('api/sales/init-sales', ['id' => 'kt_form_apertura', 'class' => 'modal-content']) ?>
      <div class="modal-header">
        <h3 class="modal-title">Apertura</h3>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Close-->
      </div>

      <div class="modal-body">
        <p>La caja se iniciara con <strong>0.00</strong> con fecha <strong><?= fecha_spanish(date('d-m-Y')) ?></strong></p>
      </div>

      <div class="modal-footer">
        <button id="btnInitSales" type="submit" class="btn btn-primary">
          <span class="indicator-label">
            Iniciar
          </span>
          <span class="indicator-progress">
            Iniciando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
          </span>
        </button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
<?php } else { ?>
  <div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
      <!--begin::Card widget 2-->
      <div class="card h-lg-100">
        <!--begin::Body-->
        <div
          class="card-body d-flex justify-content-between align-items-start flex-column">
          <!--begin::Icon-->
          <div class="m-0">
            <i
              class="ki-duotone ki-tag fs-2hx text-gray-600">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
            </i>
          </div>
          <!--end::Icon-->
          <!--begin::Section-->
          <div class="d-flex flex-column my-7">
            <!--begin::Number-->
            <h2
              class="fw-semibold fs-2qx text-gray-800">Accesorios</h2>
            <!--end::Number-->
            <!--begin::Follower-->
            <div class="m-0">
              <span class="fw-semibold fs-6 text-gray-500">S/. 4536</span>
            </div>
            <!--end::Follower-->
          </div>
          <!--end::Section-->
          <!--begin::Badge-->
          <span class="badge badge-light-success fs-base">
            <i
              class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
              <span class="path1"></span>
              <span class="path2"></span> </i>2.1%</span>
          <!--end::Badge-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
      <!--begin::Card widget 2-->
      <div class="card h-lg-100">
        <!--begin::Body-->
        <div
          class="card-body d-flex justify-content-between align-items-start flex-column">
          <!--begin::Icon-->
          <div class="m-0">
            <i
              class="ki-duotone ki-package fs-2hx text-gray-600">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
            </i>
          </div>
          <!--end::Icon-->
          <!--begin::Section-->
          <div class="d-flex flex-column my-7">
            <!--begin::Number-->
            <h2
              class="fw-semibold fs-2qx text-gray-800">Contratos</h2>
            <!--end::Number-->
            <!--begin::Follower-->
            <div class="m-0">
              <span class="fw-semibold fs-6 text-gray-500">S/. 324324</span>
            </div>
            <!--end::Follower-->
          </div>
          <!--end::Section-->
          <!--begin::Badge-->
          <span class="badge badge-light-success fs-base">
            <i
              class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
              <span class="path1"></span>
              <span class="path2"></span> </i>2.1%</span>
          <!--end::Badge-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
      <!--begin::Card widget 2-->
      <div class="card h-lg-100">
        <!--begin::Body-->
        <div
          class="card-body d-flex justify-content-between align-items-start flex-column">
          <!--begin::Icon-->
          <div class="m-0">
            <i
              class="ki-duotone ki-note-2 fs-2hx text-gray-600">
              <span class="path1"></span>
              <span class="path2"></span>
              <span class="path3"></span>
              <span class="path4"></span>
            </i>
          </div>
          <!--end::Icon-->
          <!--begin::Section-->
          <div class="d-flex flex-column my-7">
            <!--begin::Number-->
            <h2
              class="fw-semibold fs-2qx text-gray-800">Citas</h2>
            <!--end::Number-->
            <!--begin::Follower-->
            <div class="m-0">
              <span class="fw-semibold fs-6 text-gray-500">S/. 3264</span>
            </div>
            <!--end::Follower-->
          </div>
          <!--end::Section-->
          <!--begin::Badge-->
          <span class="badge badge-light-danger fs-base">
            <i
              class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
              <span class="path1"></span>
              <span class="path2"></span> </i>0.47%</span>
          <!--end::Badge-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
      <!--begin::Card widget 2-->
      <div class="card h-lg-100">
        <!--begin::Body-->
        <div
          class="card-body d-flex justify-content-between align-items-start flex-column">
          <!--begin::Icon-->
          <div class="m-0">
            <i class="ki-duotone ki-chart fs-2hx text-gray-600">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
          </div>
          <!--end::Icon-->
          <!--begin::Section-->
          <div class="d-flex flex-column my-7">
            <!--begin::Number-->
            <h2
              class="fw-semibold fs-2qx text-gray-800">Mantenimiento</h2>
            <!--end::Number-->
            <!--begin::Follower-->
            <div class="m-0">
              <span class="fw-semibold fs-6 text-gray-500">S/. 3223434</span>
            </div>
            <!--end::Follower-->
          </div>
          <!--end::Section-->
          <!--begin::Badge-->
          <span class="badge badge-light-success fs-base">
            <i
              class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
              <span class="path1"></span>
              <span class="path2"></span> </i>2.1%</span>
          <!--end::Badge-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
  </div>
<?php } ?>






<?= $this->endSection(); ?>



<?= $this->section('scripts_sales'); ?>

<script>
  <?php if (!$apertura) { ?>

    const btn = document.querySelector("#btnInitSales");
    const frm = document.querySelector("#kt_form_apertura");

    btn.addEventListener('click', function(event) {

      event.preventDefault();

      btn.setAttribute('data-kt-indicator', 'on');
      btn.disabled = true;

      setTimeout(() => {
        fetch(frm.action, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
            },
            body: new FormData(frm)
          })
          .then(res => res.json())
          .then(data => {
            if (data.status === "success") {
              Swal.fire({
                icon: 'success',
                title: 'Caja aperturada',
                text: 'Redirigiendo al módulo de ventas...',
                timer: 1500,
                showConfirmButton: false
              }).then(() => {
                window.location.href = data.redirect;
              });
            } else {
              Swal.fire({
                icon: 'warning',
                title: 'Ya existe una caja abierta',
                text: data.message
              }).then(() => location.reload());
            }
          })
          .catch(() => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ocurrió un problema al aperturar la caja'
            });
          })
          .finally(() => {
            btn.removeAttribute('data-kt-indicator');
            btn.disabled = false;
          })
      }, 2000)



    });

  <?php } ?>
</script>

<?= $this->endSection(); ?>