 <?= $this->extend('layouts/template'); ?>

 <?= $this->section('title'); ?>

 Panel de Control Principal | KYP BIOINGENIERIA

 <?= $this->endSection(); ?>

 <?= $this->section('toolbar'); ?>

 <h1
     class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
     Panel de Control Principal
 </h1>

 <ul
     class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

     <li class="breadcrumb-item text-muted"><?= fecha_spanish(date('Y-m-d')) ?></li>

 </ul>

 <?= $this->endSection(); ?>

 <?= $this->section('content'); ?>

 <div class="my-8">
     <h1>Resumen del Día</h1>

     <div class="row g-3 mt-3">
         <div class="col-12 col-sm-6 col-md-3 col-lg-3">
             <div class="card">
                 <div class="card h-100 shadow-sm">
                     <div class="card-body d-flex flex-column">
                         <div class="d-flex justify-content-between align-items-start">
                             <div>
                                 <small class="text-uppercase text-muted">Pacientes Activos</small>
                                 <h2 class="fw-bold mb-1">892</h2>
                                 <small class="text-muted">23 nuevos hoy</small>
                             </div>
                             <div class="bg-primary rounded p-3">
                                 <i class="bi bi-people fs-3 text-white"></i>
                             </div>
                         </div>
                         <div class="mt-auto pt-3 d-flex align-items-center text-success">
                             <i class="bi bi-arrow-up-short me-1"></i>
                             <small class="fw-semibold">+12% vs ayer</small>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3 col-lg-3">
             <div class="card h-100 shadow-sm">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex justify-content-between align-items-start">
                         <div>
                             <small class="text-uppercase text-muted">Cotizaciones Realizadas</small>
                             <h2 class="fw-bold mb-1">34</h2>
                             <small class="text-muted">89 aprobadas</small>
                         </div>
                         <div class="bg-success rounded p-3">
                             <i class="bi bi-file-earmark-text fs-3 text-white"></i>
                         </div>
                     </div>
                     <div class="mt-auto pt-3 d-flex align-items-center text-success">
                         <i class="bi bi-arrow-up-short me-1"></i>
                         <small class="fw-semibold">+8% esta semana</small>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3 col-lg-3">
             <div class="card h-100 shadow-sm">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex justify-content-between align-items-start">
                         <div>
                             <small class="text-uppercase text-muted">Ordenes de Compra</small>
                             <h2 class="fw-bold mb-1">178</h2>
                             <small class="text-muted">12 por vencer</small>
                         </div>
                         <div class="bg-info rounded p-3">
                             <i class="bi bi-bullseye fs-3 text-white"></i>
                         </div>
                     </div>
                     <div class="mt-auto pt-3 d-flex align-items-center text-success">
                         <i class="bi bi-arrow-up-short me-1"></i>
                         <small class="fw-semibold">+5% este mes</small>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3 col-lg-3">
             <div class="card h-100 shadow-sm">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex justify-content-between align-items-start">
                         <div>
                             <small class="text-uppercase text-muted">Ordenes de Trabajo</small>
                             <h2 class="fw-bold mb-1">178</h2>
                             <small class="text-muted">12 por vencer</small>
                         </div>
                         <div class="bg-warning rounded p-3">
                             <i class="bi bi-bullseye fs-3 text-white"></i>
                         </div>
                     </div>
                     <div class="mt-auto pt-3 d-flex align-items-center text-success">
                         <i class="bi bi-arrow-up-short me-1"></i>
                         <small class="fw-semibold">+5% este mes</small>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="my-10">
     <h1 class="mb-4 text-center pb-4">Módulos del Sistema</h1>
     <div class="row g-4">
         <!-- Gestión de Pacientes -->
         <div class="col-12 col-md-6 col-lg-4">
             <div class="card h-100 border-light shadow-sm" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex align-items-start mb-3">
                         <div class="p-3 bg-primary bg-opacity-10 rounded">
                             <i class="bi bi-people fs-2 text-primary"></i>
                         </div>
                         <div class="ms-3">
                             <h5 class="mb-1">Gestión de Pacientes</h5>
                             <p class="text-muted mb-2">Registro, historial médico y seguimiento de pacientes</p>
                             <span class="badge bg-light text-dark">1,247 activos</span>
                         </div>
                     </div>
                     <div class="mt-auto text-end">
                         <a href="#" class="text-decoration-none fw-semibold">
                             Acceder <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Cotizaciones (seleccionado) -->
         <div class="col-12 col-md-6 col-lg-4">
             <div class="card h-100 border-light shadow-sm" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex align-items-start mb-3">
                         <div class="p-3 bg-success bg-opacity-10 rounded">
                             <i class="bi bi-file-earmark-text fs-2 text-success"></i>
                         </div>
                         <div class="ms-3">
                             <h5 class="mb-1">Cotizaciones</h5>
                             <p class="text-muted mb-2">Crear y gestionar cotizaciones de servicios médicos</p>
                             <span class="badge bg-light text-dark">89 este mes</span>
                         </div>
                     </div>
                     <div class="mt-auto text-end">
                         <a href="#" class="text-decoration-none fw-semibold text-primary">
                             Acceder <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Contratos -->
         <div class="col-12 col-md-6 col-lg-4">
             <div class="card h-100 border-light shadow-sm" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex align-items-start mb-3">
                         <div class="p-3 bg-warning bg-opacity-10 rounded">
                             <i class="bi bi-file-earmark-check fs-2 text-warning"></i>
                         </div>
                         <div class="ms-3">
                             <h5 class="mb-1">Contratos</h5>
                             <p class="text-muted mb-2">Administración de contratos y acuerdos</p>
                             <span class="badge bg-light text-dark">156 activos</span>
                         </div>
                     </div>
                     <div class="mt-auto text-end">
                         <a href="#" class="text-decoration-none fw-semibold">
                             Acceder <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Citas Médicas -->
         <div class="col-12 col-md-6 col-lg-4">
             <div class="card h-100 border-light shadow-sm" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex align-items-start mb-3">
                         <div class="p-3 bg-warning bg-opacity-10 rounded">
                             <i class="bi bi-calendar-check fs-2 text-warning"></i>
                         </div>
                         <div class="ms-3">
                             <h5 class="mb-1">Citas Médicas</h5>
                             <p class="text-muted mb-2">Programación y gestión de citas</p>
                             <span class="badge bg-light text-dark">24 hoy</span>
                         </div>
                     </div>
                     <div class="mt-auto text-end">
                         <a href="#" class="text-decoration-none fw-semibold">
                             Acceder <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Facturación -->
         <div class="col-12 col-md-6 col-lg-4">
             <div class="card h-100 border-light shadow-sm" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex align-items-start mb-3">
                         <div class="p-3 bg-success bg-opacity-10 rounded">
                             <i class="bi bi-currency-dollar fs-2 text-success"></i>
                         </div>
                         <div class="ms-3">
                             <h5 class="mb-1">Facturación</h5>
                             <p class="text-muted mb-2">Control de ingresos y facturación</p>
                             <span class="badge bg-light text-dark">$45,230</span>
                         </div>
                     </div>
                     <div class="mt-auto text-end">
                         <a href="#" class="text-decoration-none fw-semibold">
                             Acceder <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Reportes -->
         <div class="col-12 col-md-6 col-lg-4">
             <div class="card h-100 border-light shadow-sm" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">
                 <div class="card-body d-flex flex-column">
                     <div class="d-flex align-items-start mb-3">
                         <div class="p-3 bg-info bg-opacity-10 rounded">
                             <i class="bi bi-bar-chart-line fs-2 text-info"></i>
                         </div>
                         <div class="ms-3">
                             <h5 class="mb-1">Reportes</h5>
                             <p class="text-muted mb-2">Análisis y reportes del sistema</p>
                             <span class="badge bg-light text-dark">12 disponibles</span>
                         </div>
                     </div>
                     <div class="mt-auto text-end">
                         <a href="#" class="text-decoration-none fw-semibold">
                             Acceder <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <?= $this->endSection(); ?>