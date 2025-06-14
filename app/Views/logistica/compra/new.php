<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Crear Orden de Compras | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Logística
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Orden de Compra</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Nuevo</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= form_open('api/logistica/orden-compra/create', ['id' => 'kt_form_compra', 'class' => 'fv-row mt-5']) ?>

<div class="d-flex flex-column flex-lg-row">
    <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
        <div class="card card-dashed">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Información del Proveedor</strong>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggleProveedor">
                </div>
            </div>
            <div class="card-body" id="proveedorForm" style="display: none;">
                <div class="row g-3">
                    <div class="col-md-4">
                        <select data-control="select2" data-placeholder="Seleccionar Proveedor" name="proveedor" id="proveedor" class="form-select">
                            <option value="">Seleccionar</option>
                            <?php foreach ($proveedores as $proveedor) : ?>
                                <option
                                    value="<?= $proveedor['id'] ?>"
                                    data-empresa="<?= esc($proveedor['empresa']) ?>"
                                    data-contacto="<?= esc($proveedor['telefono']) ?>"
                                    data-producto="<?= esc($proveedor['producto']) ?>">
                                    <?= esc($proveedor['nombre']) ?> - <?= mb_strtoupper(esc($proveedor['empresa'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Empresa" readonly id="empresa">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Persona de contacto" readonly id="contacto">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Agregar Producto</h5>
            </div>
            <div class="card-body row g-3 align-items-end">
                <div class="col-md-3">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="cambiarCantidad(-1)">−</button>
                        <input type="number" id="cantidad" class="form-control text-center" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="cambiarCantidad(1)">+</button>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-floating">
                        <input type="text" id="producto" class="form-control" placeholder="Nombre del producto">
                        <label for="producto">Nombre del producto</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select id="unidad" class="form-select">
                            <option value="" selected disabled>-----</option>
                            <option value="uni.">uni.</option>
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                            <option value="l">l</option>
                            <option value="ml">ml</option>
                        </select>
                        <label for="unidad">Unidad</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="number" id="precio" class="form-control" placeholder="Precio U." min="0">
                        <label for="precio">Precio U.</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating">
                        <select id="Necesidad" class="form-select">
                            <option value="" selected disabled>-----</option>
                            <option value="Urgente">Urgente</option>
                            <option value="Importante">Importante</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                        <label for="Necesidad">Necesidad</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" id="concepto" class="form-control" placeholder="Concepto">
                        <label for="concepto">Concepto</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="date" id="fecha_sol" class="form-control" placeholder="Fecha Solicitud">
                        <label for="fecha_sol">Fecha Solicitud</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="date" id="fecha_ent" class="form-control" placeholder="Fecha Entrega">
                        <label for="fecha_ent">Fecha Entrega</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-success w-100" onclick="agregarProducto()">Agregar</button>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Productos Agregados</h5>
                <div class="card-toolbar">
                    <span id="cantidadProductos">(0 productos)</span>
                </div>
            </div>
            <div class="card-body pt-2">
                <table class="table align-middle table-row-dashed fs-6 gy-3" id="listaProductos">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="">#</th>
                            <th class="text-start pe-3 min-w-100px">Descripción</th>
                            <th class="text-end pe-3">Cant.</th>
                            <th class="text-end pe-3">Uni.</th>
                            <th class="text-end pe-3 min-w-100px">Precio U.</th>
                            <th class="text-end pe-3 min-w-100px">Subtotal</th>
                            <th class="text-end pe-3 min-w-100px">Acciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600" id="listaProductosBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex-lg-auto min-w-lg-300px">
        <div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
            <div class="card-header">
                <h5 class="card-title">Resumen</h5>
            </div>
            <div class="card-body p-10">
                <p>Productos: <span id="resProductos">0</span></p>
                <div class="fv-row mb-10">
                    <label class="form-label fw-bold fs-6 text-gray-700 required">Moneda</label>
                    <select name="moneda" id="moneda" aria-label="Select a Timezone" data-control="select2" data-placeholder="Seleccionar Moneda" class="form-select form-select-solid">
                        <option value=""></option>
                        <option data-kt-flag="flags/united-states.svg" value="USD">
                            <b>USD</b>&nbsp;-&nbsp;USA dollar
                        </option>
                        <option selected data-kt-flag="flags/united-states.svg" value="PEN">
                            <b>PEN</b>&nbsp;-&nbsp;PE soles
                        </option>
                    </select>
                </div>

                <h5>Total: <span class="text-primary fw-bold"><span id="resTotal">0.00</span></span></h5>

                <div class="separator separator-dashed mb-8"></div>

                <div class="fv-row mb-2">
                    <label>Forma de Pago</label>
                    <select name="forma_pago" id="forma_pago" class="form-select">
                        <option value="" selected disabled>Seleccionar</option>
                        <option value="Contado">Contado</option>
                        <option value="Crédito">Crédito</option>
                        <option value="Contraentrega">Contraentrega</option>
                    </select>
                </div>

                <div class="fv-row mb-10">
                    <label>Área</label>
                    <select name="area" id="area" data-control="select2" data-placeholder="Seleccionar Area" class="form-select">
                        <option value="" selected disabled>Seleccionar</option>
                        <option value="Front Desk">Front Desk</option>
                        <option value="Biomecánica">Biomecánica</option>
                        <option value="Administración Lima">Administración Lima</option>
                        <option value="Administración Arequipa">Administración Arequipa</option>
                        <option value="Administración Chiclayo">Administración Chiclayo</option>
                        <option value="Logística">Logística</option>
                        <option value="Producción">Producción</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Sistemas">Sistemas</option>
                        <option value="Desarrollo Tecnológico">Desarrollo Tecnológico</option>
                        <option value="Ventas">Ventas</option>
                        <option value="Limpieza">Limpieza</option>
                        <option value="Estética">Estética</option>
                        <option value="Fisioterapia">Fisioterapia</option>
                        <option value="Área Textil">Área Textil</option>
                        <option value="RRHH">RRHH</option>
                    </select>
                </div>

                <div class="separator separator-dashed mb-8"></div>

                <div class="mb-0">
                    <button type="button" class="btn btn-primary w-100" id="kt_form_compra_submit">
                        <i class="ki-duotone ki-triangle fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <span class="indicator-label">
                            Generar Orden
                        </span>
                        <span class="indicator-progress">
                            Generando Orden... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= form_close() ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= csrf_scripts_basic() ?>
<script>
    const lista = [];

    document.getElementById('toggleProveedor').addEventListener('change', function() {
        document.getElementById('proveedorForm').style.display = this.checked ? 'block' : 'none';
        $('#proveedor').val('');
        $('#empresa').val('');
        $('#contacto').val('');
        $('#producto').val('');

    });

    function cambiarCantidad(delta) {
        let input = document.getElementById("cantidad");
        let nuevaCantidad = Math.max(1, parseInt(input.value) + delta);
        input.value = nuevaCantidad;
    }

    function agregarProducto() {
        const nombre = document.getElementById("producto").value;
        const cantidad = parseInt(document.getElementById("cantidad").value);
        const unidad = document.getElementById("unidad").value;
        const precio = parseFloat(document.getElementById("precio").value);
        const necesidad = document.getElementById("Necesidad").value;
        const concepto = document.getElementById("concepto").value;
        const fecha_sol = document.getElementById("fecha_sol").value;
        const fecha_ent = document.getElementById("fecha_ent").value;

        if (!nombre || isNaN(precio) || isNaN(cantidad)) return;

        const total = precio * cantidad;

        lista.push({
            nombre,
            cantidad,
            unidad,
            precio,
            total,
            necesidad,
            concepto,
            fecha_sol,
            fecha_ent
        });

        renderLista();

        // 🔄 Limpiar campos
        document.getElementById("producto").value = '';
        document.getElementById("cantidad").value = 1;
        document.getElementById("unidad").value = '';
        document.getElementById("precio").value = '';
        document.getElementById("Necesidad").value = '';
        document.getElementById("concepto").value = '';
        document.getElementById("fecha_sol").value = '';
        document.getElementById("fecha_ent").value = '';
    }

    function eliminarProducto(index) {
        lista.splice(index, 1);
        renderLista();
    }

    function renderLista() {
        const tbody = document.getElementById("listaProductosBody");
        tbody.innerHTML = "";
        let subtotal = 0;

        lista.forEach((p, i) => {
            subtotal += p.total;

            tbody.innerHTML += `
            <tr id="row-main-${i}">
                <td>${i + 1}</td>
                <td class="text-start">${p.nombre}</td>
                <td class="text-end">${p.cantidad}</td>
                <td class="text-end">${p.unidad}</td>
                <td class="text-end">${p.precio.toFixed(2)}</td>
                <td class="text-end text-success">${p.total.toFixed(2)}</td>
                <td class="text-end">
                    <button type="button" class="btn btn-link btn-color-danger btn-active-color-primary me-5 mb-2" onclick="eliminarProducto(${i})">
                        <i class="ki-outline ki-trash"></i>
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" onclick="toggleSub(${i})">
                        <i class="ki-duotone ki-plus fs-3 m-0 toggle-off"></i>
                        <i class="ki-duotone ki-minus fs-3 m-0 toggle-on"></i>
                    </button>
                </td>
            </tr>
            <tr id="row-sub-${i}" class="d-none">
                <td colspan="8" class="bg-light p-3">
                    <strong>Necesidad:</strong> ${p.necesidad || '---'} <br>
                    <strong>Concepto:</strong> ${p.concepto || '---'} <br>
                    <strong>Fecha Solicitud:</strong> ${p.fecha_sol || '---'} <br>
                    <strong>Fecha Entrega:</strong> ${p.fecha_ent || '---'}
                </td>
            </tr>
        `;
        });

        const total = subtotal;

        document.getElementById("cantidadProductos").textContent = `(${lista.length} producto${lista.length !== 1 ? "s" : ""})`;
        document.getElementById("resProductos").textContent = lista.length;
        document.getElementById("resTotal").textContent = total.toFixed(2);

        console.log(JSON.stringify(lista));

    }

    function toggleSub(index) {
        const row = document.getElementById(`row-sub-${index}`);
        if (row.classList.contains('d-none')) {
            row.classList.remove('d-none');
        } else {
            row.classList.add('d-none');
        }
    }

    $(document).ready(function() {
        // Inicializa Select2 si aún no está
        $('#proveedor').select2();

        // Evento cuando se selecciona una opción
        $('#proveedor').on('select2:select', function(e) {
            const option = e.params.data.element;

            // Accede a los atributos data-empresa y data-contacto del option seleccionado
            const empresa = $(option).data('empresa') || '';
            const contacto = $(option).data('contacto') || '';
            const producto = $(option).data('producto') || '';

            // Rellena los inputs
            $('#empresa').val(empresa);
            $('#contacto').val(contacto);
            $('#producto').val(producto)
        });

        // Limpia los campos si se selecciona "Seleccionar"
        $('#proveedor').on('select2:clear', function() {
            $('#empresa').val('');
            $('#contacto').val('');
            $('#producto').val('');
        });
    });

    const form = document.querySelector("#kt_form_compra");

    const validator = FormValidation.formValidation(form, {
        fields: {
            'moneda': {
                validators: {
                    notEmpty: {
                        message: 'La moneda es obligatoria'
                    }
                }
            },

            'forma_pago': {
                validators: {
                    notEmpty: {
                        message: 'La forma de pago es obligatoria'
                    }
                }
            },

            'area': {
                validators: {
                    notEmpty: {
                        message: 'El area es obligatoria'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    });

    const submit = document.querySelector('#kt_form_compra_submit');
    submit.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validator) return;

        if (lista.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe agregar al menos un producto',
            });
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            submit.setAttribute('data-kt-indicator', 'on');
            submit.disabled = true;

            const formData = new FormData(form);
            formData.append('lista', JSON.stringify(lista));

            const executeFetch = async () => {
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        }
                    });

                    if (response.status === 403) {
                        await updateCsrfToken();
                        return executeFetch();
                    }

                    const data = await response.json();

                    console.log(data);

                    if (!response.ok || data.status >= 400) {
                        // Error
                        Swal.fire({
                            text: data.message || 'Error en el servidor',
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Entendido',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    } else {
                        // Éxito
                        Swal.fire({
                            text: data.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok!',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        }).then(() => {
                            window.location.href = '<?= base_url('logistica/orden-compra') ?>';
                        });
                    }

                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    submit.removeAttribute('data-kt-indicator');
                    submit.disabled = false;
                }
            };

            setTimeout(executeFetch, 2000);

        })
    });
</script>

<?= $this->endSection(); ?>