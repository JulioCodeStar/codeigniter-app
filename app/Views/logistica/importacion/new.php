<?= $this->extend('layouts/template'); ?>

<?= $this->section('title'); ?>

Crear Orden de Importacion | KYP BIOINGENIERIA

<?= $this->endSection(); ?>

<?= $this->section('toolbar'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Logística
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Orden de Importacion</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Nuevo</li>

</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card mt-5">
    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
        <h3 class="card-title">Agregar Producto y Proveedor</h3>
        <div class="card-toolbar rotate-180">
            <i class="ki-duotone ki-down fs-1"></i>
        </div>
    </div>
    <form id="kt_docs_card_collapsible" class="collapse show fv-row">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-5">
                <div class="mb-8 w-100">

                    <div class="row">
                        <!-- Columna izquierda -->
                        <div class="col-md-6">
                            <label class="form-label fs-5 fw-bold text-gray-700 mb-3">Información del Producto</label>
                            <div class="separator separator-dashed my-2 mb-4"></div>

                            <div class="mb-4 fv-row">
                                <label for="producto" class="required form-label">Producto</label>
                                <input type="text" name="producto" id="producto" class="form-control" placeholder="Producto" />
                            </div>

                            <!-- Fila interna para cantidad y precio -->
                            <div class="row mb-4">
                                <div class="col-md-6 fv-row">
                                    <label for="cantidad" class="required form-label">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label for="precio" class="required form-label">Precio Unitario</label>
                                    <input type="number" name="precio" id="precio" class="form-control" placeholder="Precio Unitario" />
                                </div>
                            </div>

                            <div class="mb-4 fv-row">
                                <label for="descripcion" class="required form-label">Descripción</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" />
                            </div>

                            <div class="mb-4 fv-row">
                                <label for="link" class="required form-label">Link del Producto</label>
                                <input type="text" name="link" id="link" class="form-control" placeholder="Link del Producto" />
                            </div>

                            <div class="mb-4">
                                <label for="observacion" class="form-label">Observaciones</label>
                                <textarea name="observacion" id="observacion" class="form-control" placeholder="Observaciones adicionales"></textarea>
                            </div>
                        </div>


                        <!-- Columna derecha -->
                        <div class="col-md-6">

                            <label class="form-label fs-5 fw-bold text-gray-700 mb-3">Información del Proveedor</label>
                            <div class="separator separator-dashed my-2 mb-4"></div>

                            <div class="mb-4 fv-row">
                                <label for="proveedor" class="required form-label">Proveedor</label>
                                <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Proveedor" />
                            </div>

                            <div class="mb-4 fv-row">
                                <label for="pais" class="required form-label">País de Origen</label>
                                <input type="text" name="pais" id="pais" class="form-control" placeholder="País de Origen" />
                            </div>

                            <div class="mb-4">
                                <label for="vendedor" class="form-label">Vendedor</label>
                                <input type="text" name="vendedor" id="vendedor" class="form-control" placeholder="Vendedor" />
                            </div>

                            <div class="mb-4">
                                <label for="telefono" class="form-label">Telefono Vendedor</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono Vendedor" />
                            </div>

                            <div class="mb-4">
                                <label for="pagina_web" class="form-label">Pagina Web</label>
                                <input type="text" name="pagina_web" id="pagina_web" class="form-control" placeholder="Pagina Web" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button id="kt_add_table_importacion" type="button" class="btn btn-primary">
                Agregar a la lista
            </button>
        </div>
    </form>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title">Lista de Productos</h5>
        <div class="card-toolbar">
            <span class="badge badge-secondary badge-lg" id="cantidadProductos">0 productos</span>
        </div>
    </div>
    <div class="card-body pt-2">
        <table class="table align-middle table-row-dashed fs-6 gy-3" id="listaProductosTable">
            <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="">#</th>
                    <th class="pe-3 max-w-100px">Producto</th>
                    <th class="pe-3 max-w-100px">Proveedor</th>
                    <th class="text-center pe-3">Pais</th>
                    <th class="text-center pe-3">Cantidad</th>
                    <th class="text-center pe-3">Precio</th>
                    <th class="text-center pe-3">Total</th>
                    <th class="text-center pe-3">Acciones</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="fw-bold text-gray-600" id="listaProductosTableBody">

            </tbody>
        </table>
    </div>
</div>

<?= form_open('api/logistica/orden-importacion/create', ['id' => 'kt_form_importacion', 'class' => 'fv-row card mt-4']) ?>

<div class="card-header">
    <h5 class="card-title">Finalizar Importación</h5>
</div>
<div class="card-body">
    <div class="row">
        <!-- Formulario lado izquierdo -->
        <div class="col-md-8">
            <div class="mb-4">
                <label for="area" class="required form-label fw-semibold">Área Solicitante</label>
                <select data-control="select2" data-placeholder="Seleccionar Area" class="form-select" id="area" name="area">
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

            <div class="fv-row mb-4">
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

            <div class="mb-4">
                <label for="notas" class="form-label fw-semibold">Notas Adicionales</label>
                <textarea class="form-control" id="notas" name="notas" rows="3"
                    placeholder="Ingrese cualquier información adicional sobre esta importación"></textarea>
            </div>
        </div>

        <!-- Resumen lado derecho -->
        <div class="col-md-4">
            <div class="bg-light p-4 rounded">
                <h6 class="fw-bold mb-3">Resumen de Importación</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total de productos:</span>
                    <span id="resProductos">0</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span id="resSubtotal">---</span>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <strong>Total Importación:</strong>
                    <strong id="resTotal">---</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botón inferior -->
<div class="card-footer text-end bg-white border-top-0 pt-0">
    <button type="button" class="btn btn-success" id="kt_form_importacion_submit">
        <i class="ki-duotone ki-triangle fs-3">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <span class="indicator-label">
            Generar Importación
        </span>
        <span class="indicator-progress">
            Generando Orden... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
    </button>
</div>
<?= form_close() ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= csrf_scripts_basic() ?>
<script>
    const lista = [];

    // Function to update the table display
    function updateTable() {
        const tableBody = document.querySelector('#listaProductosTable tbody');
        tableBody.innerHTML = '';

        lista.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">${index + 1}</td>
                <td class="m">${item.producto.nombre}</td>
                <td>${item.proveedor.proveedor}</td>
                <td class="text-center">
                    <span class="badge badge-primary">${item.proveedor.pais}</span>
                </td>
                <td class="text-center">${item.producto.cantidad}</td>
                <td class="text-center">${item.producto.precio}</td>
                <td class="text-center">${item.producto.total}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-link btn-color-danger btn-active-color-primary me-5 mb-2" onclick="removeItem(${index})">
                        <i class="ki-outline ki-trash"></i>
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        document.querySelector('#cantidadProductos').textContent = `${lista.length} producto${lista.length !== 1 ? "s" : ""}`;
        document.querySelector('#resProductos').textContent = `${lista.length}`;
        document.querySelector('#resSubtotal').textContent = `${lista.reduce((total, item) => total + item.producto.total, 0).toFixed(2)}`;
        document.querySelector('#resTotal').textContent = `${lista.reduce((total, item) => total + item.producto.total, 0).toFixed(2)}`;

    }

    // Function to remove item from list
    function removeItem(index) {
        lista.splice(index, 1);
        updateTable();
    }

    const form_add_table = document.querySelector("#kt_docs_card_collapsible");
    const validator_add_table = FormValidation.formValidation(form_add_table, {
        fields: {
            'producto': {
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio'
                    }
                }
            },

            'cantidad': {
                validators: {
                    notEmpty: {
                        message: 'La cantidad es obligatoria'
                    },
                    numeric: {
                        message: 'La cantidad debe ser un número'
                    }
                }
            },

            'precio': {
                validators: {
                    notEmpty: {
                        message: 'El precio es obligatorio'
                    },
                    numeric: {
                        message: 'El precio debe ser un número'
                    },
                    currency: {
                        message: 'El precio debe ser un número'
                    }
                }
            },

            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'La descripción es obligatoria'
                    }
                }
            },
            'link': {
                validators: {
                    notEmpty: {
                        message: 'La URL es obligatoria'
                    }
                }
            },
            'proveedor': {
                validators: {
                    notEmpty: {
                        message: 'El proveedor es obligatorio'
                    }
                }
            },
            'pais': {
                validators: {
                    notEmpty: {
                        message: 'El pais es obligatorio'
                    }
                }
            },
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

    const submit_add_table = document.querySelector('#kt_add_table_importacion');
    submit_add_table.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validator_add_table) return;

        validator_add_table.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            const cantidad = parseFloat(document.querySelector('#cantidad').value);
            const precio = parseFloat(document.querySelector('#precio').value);
            const total = cantidad * precio;

            lista.push({
                producto: {
                    nombre: document.querySelector('#producto').value,
                    cantidad: cantidad,
                    precio: precio,
                    unidad: document.querySelector('#unidad').value,
                    total: total,
                    descripcion: document.querySelector('#descripcion').value,
                    link: document.querySelector('#link').value,
                    observacion: document.querySelector('#observacion').value,
                },
                proveedor: {
                    proveedor: document.querySelector('#proveedor').value,
                    pais: document.querySelector('#pais').value,
                    vendedor: document.querySelector('#vendedor').value,
                    telefono: document.querySelector('#telefono').value,
                    pagina_web: document.querySelector('#pagina_web').value,
                }
            });
            console.log(lista);
            updateTable();
        })
    });


    const form = document.querySelector('#kt_form_importacion');
    const validator = FormValidation.formValidation(form, {
        fields: {
            'area': {
                validators: {
                    notEmpty: {
                        message: 'El area es obligatoria'
                    }
                }
            },
            'moneda': {
                validators: {
                    notEmpty: {
                        message: 'La moneda es obligatoria'
                    }
                }
            },
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

    const submit = document.querySelector('#kt_form_importacion_submit');
    submit.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validator) return;

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
                            window.location.href = '<?= base_url('logistica/orden-importacion') ?>';
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