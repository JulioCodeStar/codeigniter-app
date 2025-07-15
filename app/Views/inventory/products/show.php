<?= $this->extend('layouts/inventory/layouts/template'); ?>

<?= $this->section('title_inventory'); ?>
Productos | Inventario - KYP Bioingeniería
<?= $this->endSection(); ?>

<?= $this->section('toolbar_inventory'); ?>

<h1
    class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
    Catálogo de Productos
</h1>

<ul
    class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    <li class="breadcrumb-item text-muted">Productos</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-muted">Editar</li>

</ul>

<?= $this->endSection(); ?>


<?= $this->section('content_inventory'); ?>

<div class="card card-flush h-lg-100 mt-5">
    <div class="card-header pt-7">
        <div class="card-title">
            <i class="ki-duotone ki-parcel fs-1 me-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
            <h2>Editar Producto</h2>
        </div>
    </div>

    <div class="card-body pt-5">

        <?= form_open('api/inventory/products/edit/' . $product['id'], ['id' => 'kt_product_edit', 'class' => 'fv-form fv-row', 'autocomplete' => 'off']) ?>
        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Información Básica</label>

            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="codigo" class="form-label required">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Ej: LN-PJ-K" value="<?= $product['codigo'] ?>"/>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="nombre" class="form-label required">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre descriptivo del producto" value="<?= $product['nombre'] ?>" />
                </div>

                <div class="col-md-12 mb-4 fv-row">
                    <label for="descripcion" class="form-label required">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción del producto"><?= $product['descripcion'] ?></textarea>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Clasificación</label>

            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-4 mb-4 fv-row">
                    <label for="area_id" class="form-label required">Area Perteneciente</label>
                    <select data-control="select2" data-placeholder="Seleccionar Area" name="area_id" id="area_id" class="form-select">
                        <option value="">Seleccionar Area</option>
                        <?php foreach ($areas as $area): ?>
                            <option value="<?= $area['id'] ?>" <?= $area['id'] == $product['area_id'] ? 'selected' : '' ?>><?= $area['nombres'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-4 fv-row">
                    <label for="categoria" class="form-label required">Categoría</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Ej: Linners, Rodillas, Sensores, etc." value="<?= $product['categoria'] ?>"/>
                </div>

                <div class="col-md-4 mb-4 fv-row">
                    <label for="unidad_id" class="form-label required">Unidades</label>
                    <select data-control="select2" data-placeholder="Seleccionar Unidades" name="unidad_id" id="unidad_id" class="form-select">
                        <option value="">Seleccionar Unidades</option>
                        <?php foreach ($unidades as $unidad): ?>
                            <option value="<?= $unidad['id'] ?>" <?= $unidad['id'] == $product['unidad_id'] ? 'selected' : '' ?>><?= $unidad['nombres'] ?> (<?= $unidad['abreviatura'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Control de Inventario</label>

            <div class="separator separator-dashed my-2 mb-4"></div>

            <div class="row g-4">
                <div class="col-md-6 mb-4 fv-row">
                    <label for="stock_min" class="form-label required">Stock Mínimo</label>
                    <input type="number" name="stock_min" id="stock_min" class="form-control" placeholder="Stock Mínimo" value="<?= $product['stock_min'] ?>"/>
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <label for="stock_max" class="form-label required">Stock Máximo</label>
                    <input type="number" name="stock_max" id="stock_max" class="form-control" placeholder="Stock Máximo" value="<?= $product['stock_max'] ?>" />
                </div>

                <div class="col-md-6 mb-4 fv-row">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" id="requiere_serie" name="requiere_serie" <?= ($product['requiere_serie'] == 1) ? 'checked' : '' ?> />
                        <label class="form-check-label" for="requiere_serie">
                            Requiere Número de Serie
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <button id="kt_submit_form_product" type="submit" class="btn btn-primary">
            <span class="indicator-label">
                Guardar
            </span>
            <span class="indicator-progress">
                Guardando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts_inventory'); ?>
<?= csrf_scripts_basic() ?>
<script>
    const form = document.querySelector('#kt_product_edit');
    const validator = FormValidation.formValidation(form, {
        fields: {
            'codigo': {
                validators: {
                    notEmpty: {
                        message: 'El campo Codigo es Obligatorio'
                    }
                }
            },

            'nombre': {
                validators: {
                    notEmpty: {
                        message: 'El campo Nombre es Obligatorio'
                    }
                }
            },

            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'El campo Descripcion es Obligatorio'
                    }
                }
            },

            'area_id': {
                validators: {
                    notEmpty: {
                        message: 'El campo Area es Obligatorio'
                    }
                }
            },

            'unidad_id': {
                validators: {
                    notEmpty: {
                        message: 'El campo Unidad es Obligatorio'
                    }
                }
            },

            'categoria': {
                validators: {
                    notEmpty: {
                        message: 'El campo Categoria es Obligatorio'
                    }
                }
            },

            'stock_min': {
                validators: {
                    notEmpty: {
                        message: 'El campo Stock Minimo es Obligatorio'
                    }
                }
            },

            'stock_max': {
                validators: {
                    notEmpty: {
                        message: 'El campo Stock Maximo es Obligatorio'
                    }
                }
            },
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                leValidClass: ''
            })
        }
    });

    const submitButton = document.querySelector('#kt_submit_form_product');
    submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        if (!validator) {
            return;
        }

        validator.validate().then(function(status) {
            if (status !== 'Valid') {
                return;
            }

            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;

            const executeFetch = async () => {
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
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
                            window.location.href = '<?= base_url('inventory/products') ?>';
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            };

            setTimeout(executeFetch, 2000);
        })
    });
</script>

<?= $this->endSection(); ?>