<?= $this->extend('layouts/sales/layouts/template'); ?>

<?= $this->section('title'); ?>

Pagos - KYP BIOINGENIERIA

<?= $this->endSection(); ?>


<?= $this->section('content_sales'); ?>

<div
  id="kt_app_toolbar_container"
  class="d-flex flex-stack">
  <!--begin::Page title-->
  <div
    class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1
      class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
      Registrar Nuevo Pago
    </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul
      class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
        <a
          href="<?= base_url('sales/contract') ?>"
          class="text-muted text-hover-primary">Contratos | Pagos</a>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
        Pagos
      </li>
      <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
  </div>
  <!--end::Page title-->
  <!--begin::Actions-->
  <div class="">

  </div>
  <!--end::Actions-->
</div>

<div class="d-flex flex-column flex-lg-row mt-5">
  <!--begin::Content-->
  <div
    class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
    <!--begin::Form-->
    <form
      class="form"
      action="#"
      id="kt_subscriptions_create_new">
      <!--begin::Customer-->
      <div class="card card-flush pt-3 mb-5 mb-lg-10">
        <!--begin::Card header-->
        <div class="card-header">
          <!--begin::Card title-->
          <div class="card-title">
            <h2 class="fw-bold">Paciente</h2>
          </div>
          <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Description-->
          <div class="text-gray-500 fw-semibold fs-5 mb-5">
            Seleccionar un paciente para proceder con su pago
          </div>
          <!--end::Description-->

          <!--begin::Customer change button-->
          <div class="mb-10">
            <select name="paciente_id" id="paciente_id" aria-label="Select a Patient" data-control="select2" data-placeholder="Seleccionar Paciente" class="form-select form-select-solid">
              <option value=""></option>
              <?php foreach ($contract as $row) { ?>
                <option value="<?= $row['paciente_id'] ?>"><?= $row['cod_paciente'] . ' - ' . mb_strtoupper($row['nombres'] . ' ' . $row['apellidos'] . ' - ' . $row['trabajo']) ?></option>
              <?php } ?>
            </select>
          </div>
          <!--end::Customer change button-->

        </div>
        <!--end::Card body-->
      </div>
      <!--end::Customer-->



      <!--begin::Payment method-->
      <div
        class="card card-flush pt-3 mb-5 mb-lg-10"
        data-kt-subscriptions-form="pricing">
        <!--begin::Card header-->
        <div class="card-header">
          <!--begin::Card title-->
          <div class="card-title">
            <h2 class="fw-bold">Payment Method</h2>
          </div>
          <!--begin::Card title-->
          <!--begin::Card toolbar-->
          <div class="card-toolbar">
            <a
              href="#"
              class="btn btn-light-primary"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_new_card">New Method</a>
          </div>
          <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Options-->
          <div id="kt_create_new_payment_method">
            <!--begin::Option-->
            <div class="py-1">
              <!--begin::Header-->
              <div class="py-3 d-flex flex-stack flex-wrap">
                <!--begin::Toggle-->
                <div
                  class="d-flex align-items-center collapsible toggle"
                  data-bs-toggle="collapse"
                  data-bs-target="#kt_create_new_payment_method_1">
                  <!--begin::Arrow-->
                  <div
                    class="btn btn-sm btn-icon btn-active-color-primary ms-n3 me-2">
                    <i
                      class="ki-duotone ki-minus-square toggle-on text-primary fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                    <i
                      class="ki-duotone ki-plus-square toggle-off fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                      <span class="path3"></span>
                    </i>
                  </div>
                  <!--end::Arrow-->
                  <!--begin::Logo-->
                  <img
                    src="assets/media/svg/card-logos/mastercard.svg"
                    class="w-40px me-3"
                    alt="" />
                  <!--end::Logo-->
                  <!--begin::Summary-->
                  <div class="me-3">
                    <div
                      class="d-flex align-items-center fw-bold">
                      Mastercard
                      <div
                        class="badge badge-light-primary ms-5">
                        Primary
                      </div>
                    </div>
                    <div class="text-muted">
                      Expires Dec 2024
                    </div>
                  </div>
                  <!--end::Summary-->
                </div>
                <!--end::Toggle-->
                <!--begin::Input-->
                <div class="d-flex my-3 ms-9">
                  <!--begin::Radio-->
                  <label
                    class="form-check form-check-custom form-check-solid me-5">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="payment_method"
                      checked="checked" />
                  </label>
                  <!--end::Radio-->
                </div>
                <!--end::Input-->
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div
                id="kt_create_new_payment_method_1"
                class="collapse show fs-6 ps-10">
                <!--begin::Details-->
                <div class="d-flex flex-wrap py-5">
                  <!--begin::Col-->
                  <div class="flex-equal me-5">
                    <table
                      class="table table-flush fw-semibold gy-1">
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Name
                        </td>
                        <td class="text-gray-800">
                          Emma Smith
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Number
                        </td>
                        <td class="text-gray-800">
                          **** 9673
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Expires
                        </td>
                        <td class="text-gray-800">12/2024</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Type
                        </td>
                        <td class="text-gray-800">
                          Mastercard credit card
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Issuer
                        </td>
                        <td class="text-gray-800">VICBANK</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          ID
                        </td>
                        <td class="text-gray-800">
                          id_4325df90sdf8
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="flex-equal">
                    <table
                      class="table table-flush fw-semibold gy-1">
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Billing address
                        </td>
                        <td class="text-gray-800">AU</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Phone
                        </td>
                        <td class="text-gray-800">
                          No phone provided
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Email
                        </td>
                        <td class="text-gray-800">
                          <a
                            href="#"
                            class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Origin
                        </td>
                        <td class="text-gray-800">
                          Australia
                          <div
                            class="symbol symbol-20px symbol-circle ms-2">
                            <img
                              src="assets/media/flags/australia.svg" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          CVC check
                        </td>
                        <td class="text-gray-800">
                          Passed
                          <i
                            class="ki-duotone ki-check-circle fs-2 text-success">
                            <span class="path1"></span>
                            <span class="path2"></span>
                          </i>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--end::Col-->
                </div>
                <!--end::Details-->
              </div>
              <!--end::Body-->
            </div>
            <!--end::Option-->
            <div class="separator separator-dashed"></div>
            <!--begin::Option-->
            <div class="py-1">
              <!--begin::Header-->
              <div class="py-3 d-flex flex-stack flex-wrap">
                <!--begin::Toggle-->
                <div
                  class="d-flex align-items-center collapsible toggle collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#kt_create_new_payment_method_2">
                  <!--begin::Arrow-->
                  <div
                    class="btn btn-sm btn-icon btn-active-color-primary ms-n3 me-2">
                    <i
                      class="ki-duotone ki-minus-square toggle-on text-primary fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                    <i
                      class="ki-duotone ki-plus-square toggle-off fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                      <span class="path3"></span>
                    </i>
                  </div>
                  <!--end::Arrow-->
                  <!--begin::Logo-->
                  <img
                    src="assets/media/svg/card-logos/visa.svg"
                    class="w-40px me-3"
                    alt="" />
                  <!--end::Logo-->
                  <!--begin::Summary-->
                  <div class="me-3">
                    <div
                      class="d-flex align-items-center fw-bold">
                      Visa
                    </div>
                    <div class="text-muted">
                      Expires Feb 2022
                    </div>
                  </div>
                  <!--end::Summary-->
                </div>
                <!--end::Toggle-->
                <!--begin::Input-->
                <div class="d-flex my-3 ms-9">
                  <!--begin::Radio-->
                  <label
                    class="form-check form-check-custom form-check-solid me-5">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="payment_method" />
                  </label>
                  <!--end::Radio-->
                </div>
                <!--end::Input-->
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div
                id="kt_create_new_payment_method_2"
                class="collapse fs-6 ps-10">
                <!--begin::Details-->
                <div class="d-flex flex-wrap py-5">
                  <!--begin::Col-->
                  <div class="flex-equal me-5">
                    <table
                      class="table table-flush fw-semibold gy-1">
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Name
                        </td>
                        <td class="text-gray-800">
                          Melody Macy
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Number
                        </td>
                        <td class="text-gray-800">
                          **** 4499
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Expires
                        </td>
                        <td class="text-gray-800">02/2022</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Type
                        </td>
                        <td class="text-gray-800">
                          Visa credit card
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Issuer
                        </td>
                        <td class="text-gray-800">ENBANK</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          ID
                        </td>
                        <td class="text-gray-800">
                          id_w2r84jdy723
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="flex-equal">
                    <table
                      class="table table-flush fw-semibold gy-1">
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Billing address
                        </td>
                        <td class="text-gray-800">UK</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Phone
                        </td>
                        <td class="text-gray-800">
                          No phone provided
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Email
                        </td>
                        <td class="text-gray-800">
                          <a
                            href="#"
                            class="text-gray-900 text-hover-primary">melody@altbox.com</a>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Origin
                        </td>
                        <td class="text-gray-800">
                          United Kingdom
                          <div
                            class="symbol symbol-20px symbol-circle ms-2">
                            <img
                              src="assets/media/flags/united-kingdom.svg" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          CVC check
                        </td>
                        <td class="text-gray-800">
                          Passed
                          <i
                            class="ki-duotone ki-check fs-2 text-success"></i>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--end::Col-->
                </div>
                <!--end::Details-->
              </div>
              <!--end::Body-->
            </div>
            <!--end::Option-->
            <div class="separator separator-dashed"></div>
            <!--begin::Option-->
            <div class="py-1">
              <!--begin::Header-->
              <div class="py-3 d-flex flex-stack flex-wrap">
                <!--begin::Toggle-->
                <div
                  class="d-flex align-items-center collapsible toggle collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#kt_create_new_payment_method_3">
                  <!--begin::Arrow-->
                  <div
                    class="btn btn-sm btn-icon btn-active-color-primary ms-n3 me-2">
                    <i
                      class="ki-duotone ki-minus-square toggle-on text-primary fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                    <i
                      class="ki-duotone ki-plus-square toggle-off fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                      <span class="path3"></span>
                    </i>
                  </div>
                  <!--end::Arrow-->
                  <!--begin::Logo-->
                  <img
                    src="assets/media/svg/card-logos/american-express.svg"
                    class="w-40px me-3"
                    alt="" />
                  <!--end::Logo-->
                  <!--begin::Summary-->
                  <div class="me-3">
                    <div
                      class="d-flex align-items-center fw-bold">
                      American Express
                      <div
                        class="badge badge-light-danger ms-5">
                        Expired
                      </div>
                    </div>
                    <div class="text-muted">
                      Expires Aug 2021
                    </div>
                  </div>
                  <!--end::Summary-->
                </div>
                <!--end::Toggle-->
                <!--begin::Input-->
                <div class="d-flex my-3 ms-9">
                  <!--begin::Radio-->
                  <label
                    class="form-check form-check-custom form-check-solid me-5">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="payment_method" />
                  </label>
                  <!--end::Radio-->
                </div>
                <!--end::Input-->
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div
                id="kt_create_new_payment_method_3"
                class="collapse fs-6 ps-10">
                <!--begin::Details-->
                <div class="d-flex flex-wrap py-5">
                  <!--begin::Col-->
                  <div class="flex-equal me-5">
                    <table
                      class="table table-flush fw-semibold gy-1">
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Name
                        </td>
                        <td class="text-gray-800">
                          Max Smith
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Number
                        </td>
                        <td class="text-gray-800">
                          **** 5337
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Expires
                        </td>
                        <td class="text-gray-800">08/2021</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Type
                        </td>
                        <td class="text-gray-800">
                          American express credit card
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Issuer
                        </td>
                        <td class="text-gray-800">USABANK</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          ID
                        </td>
                        <td class="text-gray-800">
                          id_89457jcje63
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--end::Col-->
                  <!--begin::Col-->
                  <div class="flex-equal">
                    <table
                      class="table table-flush fw-semibold gy-1">
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Billing address
                        </td>
                        <td class="text-gray-800">US</td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Phone
                        </td>
                        <td class="text-gray-800">
                          No phone provided
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Email
                        </td>
                        <td class="text-gray-800">
                          <a
                            href="#"
                            class="text-gray-900 text-hover-primary">max@kt.com</a>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          Origin
                        </td>
                        <td class="text-gray-800">
                          United States of America
                          <div
                            class="symbol symbol-20px symbol-circle ms-2">
                            <img
                              src="assets/media/flags/united-states.svg" />
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="text-muted min-w-125px w-125px">
                          CVC check
                        </td>
                        <td class="text-gray-800">
                          Failed
                          <i
                            class="ki-duotone ki-cross fs-2 text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                          </i>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--end::Col-->
                </div>
                <!--end::Details-->
              </div>
              <!--end::Body-->
            </div>
            <!--end::Option-->
          </div>
          <!--end::Options-->
        </div>
        <!--end::Card body-->
      </div>
      <!--end::Payment method-->


    </form>
    <!--end::Form-->
  </div>
  <!--end::Content-->

  <div
    class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
    <!--begin::Card-->
    <div
      class="card card-flush pt-3 mb-0"
      data-kt-sticky="true"
      data-kt-sticky-name="subscription-summary"
      data-kt-sticky-offset="{default: false, lg: '200px'}"
      data-kt-sticky-width="{lg: '250px', xl: '300px'}"
      data-kt-sticky-left="auto"
      data-kt-sticky-top="150px"
      data-kt-sticky-animation="false"
      data-kt-sticky-zindex="95">
      <!--begin::Card header-->
      <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
          <h2>Summary</h2>
        </div>
        <!--end::Card title-->
      </div>
      <!--end::Card header-->
      <!--begin::Card body-->
      <div class="card-body pt-0 fs-6">
        <!--begin::Section-->
        <div class="mb-7">
          <!--begin::Title-->
          <h5 class="mb-3">Customer details</h5>
          <!--end::Title-->
          <!--begin::Details-->
          <div class="d-flex align-items-center mb-1">
            <!--begin::Name-->
            <a
              href="apps/customers/view.html"
              class="fw-bold text-gray-800 text-hover-primary me-2">Sean Bean</a>
            <!--end::Name-->
            <!--begin::Status-->
            <span class="badge badge-light-success">Active</span>
            <!--end::Status-->
          </div>
          <!--end::Details-->
          <!--begin::Email-->
          <a
            href="#"
            class="fw-semibold text-gray-600 text-hover-primary">sean@dellito.com</a>
          <!--end::Email-->
        </div>
        <!--end::Section-->
        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->
        <!--begin::Section-->
        <div class="mb-7">
          <!--begin::Title-->
          <h5 class="mb-3">Product details</h5>
          <!--end::Title-->
          <!--begin::Details-->
          <div class="mb-0">
            <!--begin::Plan-->
            <span class="badge badge-light-info me-2">Basic Bundle</span>
            <!--end::Plan-->
            <!--begin::Price-->
            <span class="fw-semibold text-gray-600">$149.99 / Year</span>
            <!--end::Price-->
          </div>
          <!--end::Details-->
        </div>
        <!--end::Section-->
        <!--begin::Seperator-->
        <div class="separator separator-dashed mb-7"></div>
        <!--end::Seperator-->
        <!--begin::Section-->
        <div class="mb-10">
          <!--begin::Title-->
          <h5 class="mb-3">Payment Details</h5>
          <!--end::Title-->
          <!--begin::Details-->
          <div class="mb-0">
            <!--begin::Card info-->
            <div
              class="fw-semibold text-gray-600 d-flex align-items-center">
              Mastercard
              <img
                src="assets/media/svg/card-logos/mastercard.svg"
                class="w-35px ms-2"
                alt="" />
            </div>
            <!--end::Card info-->
            <!--begin::Card expiry-->
            <div class="fw-semibold text-gray-600">
              Expires Dec 2024
            </div>
            <!--end::Card expiry-->
          </div>
          <!--end::Details-->
        </div>
        <!--end::Section-->

      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
</div>

<?= $this->endSection(); ?>



<?= $this->section('scripts_sales'); ?>

<script>

</script>

<?= $this->endSection(); ?>