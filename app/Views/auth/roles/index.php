<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Gestion de Usuarios | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

  <h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Mantenimiento de Usuarios
  </h1>

  <ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Autenticación</li>

    <li class="breadcrumb-item">
      <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Roles</li>

  </ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!--begin::Card-->
<div class="card mt-5">
  <!--begin::Card header-->
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title">
      <!--begin::Search-->
      <div class="d-flex align-items-center position-relative my-1">
        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
          <span class="path1"></span>
          <span class="path2"></span>
        </i>
        <input type="text" data-kt-patient-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Rol" />
      </div>
      <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        <a type="button" class="btn btn-primary" href="<?= base_url('patient/new') ?>">
          <i class="ki-duotone ki-plus fs-2"></i>Agregar Rol</a>
      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Card toolbar-->
  </div>
  <!--end::Card header-->
  <!--begin::Card body-->
  <div class="card-body py-4">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
      <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
          <th class="min-w-125px">Nombres</th>
          <th class="min-w-125px text-center">Descripción</th>
          <th class="min-w-125px text-center">Permisos</th>
          <th class="min-w-125px">Usuarios</th>
          <th class="min-w-100px">Fecha</th>
          <th class="text-end min-w-100px">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-ray-600 fw-semibold">
        
      </tbody>
    </table>
    <!--end::Table-->
  </div>
  <!--end::Card body-->
</div>
<!--end::Card-->

<?= $this->endSection(); ?>
