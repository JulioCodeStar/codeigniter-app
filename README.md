# Guía de Consultas en CodeIgniter 4

Este archivo README recopila ejemplos de cómo interactuar con la base de datos utilizando CodeIgniter 4, ya sea mediante los **Modelos** o utilizando el **Query Builder**. Además, se incluyen ejemplos de cómo ejecutar consultas SQL crudas y otras operaciones útiles.

## Índice

- [Introducción](#introducción)
- [Consultas con Modelos](#consultas-con-modelos)
  - [a. Seleccionar Datos (Read)](#a-seleccionar-datos-read)
  - [b. Insertar Datos (Create)](#b-insertar-datos-create)
  - [c. Actualizar Datos (Update)](#c-consultas-con-el-query-builder)
  - [d. Eliminar Datos (Delete)](#e-consultas-delete)
- [Consultas con el Query Builder](#consultas-con-el-query-builder)
  - [a. Preparar el Builder](#a-preparar-el-builder)
  - [b. Consultas SELECT](#b-consultas-select)
  - [c. Consultas INSERT](#c-consultas-insert)
  - [d. Consultas UPDATE](#d-consultas-update)
  - [e. Consultas DELETE](#e-consultas-delete)
- [Consultas SQL Crudas (Raw Queries)](#consultas-sql-crudas-raw-queries)
- [Otras Operaciones y Funciones de Agregado](#otras-operaciones-y-funciones-de-agregado)
- [Consideraciones Finales](#consideraciones-finales)

## Introducción

CodeIgniter 4 ofrece dos metodologías principales para interactuar con la base de datos:

- **Consultas con Modelos:** Utilizando el patrón Active Record para operaciones CRUD de forma sencilla y estructurada.
- **Consultas con el Query Builder:** Permite escribir consultas de forma fluida y flexible sin necesidad de escribir SQL manualmente (aunque siempre puedes hacerlo en caso necesario).

## Consultas con Modelos

Asegúrate de tener creado un modelo, por ejemplo `PatientModel.php`, en `app/Models`:

```php
<?php
namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patient';         // Nombre de la tabla
    protected $primaryKey = 'id';         // Llave primaria
    protected $allowedFields = ['nombre', 'apellido', 'edad', 'direccion']; 
    protected $useTimestamps = true;
}
```

### a. Seleccionar Datos (Read)

- **Obtener todos los registros:**

  ```php
  // Dentro de PatientController.php
  use App\Models\PatientModel;

  public function index()
  {
      $patientModel = new PatientModel();
      $data['patients'] = $patientModel->findAll();
      return view('patients/index', $data);
  }
  ```

- **Obtener un registro específico (por ID):**

  ```php
  $patient = $patientModel->find($id);
  ```

- **Obtener registros con condiciones:**

  ```php
  // Ejemplo: Pacientes cuyo nombre sea 'Juan'
  $patients = $patientModel->where('nombre', 'Juan')->findAll();
  ```

### b. Insertar Datos (Create)

- **Insertar un único registro:**

  ```php
  $data = [
      'nombre'    => 'Pedro',
      'apellido'  => 'García',
      'edad'      => 30,
      'direccion' => 'Calle Falsa 123'
  ];
  $patientModel->insert($data);
  ```

- **Insertar múltiples registros:**

  ```php
  $dataBatch = [
      [
          'nombre'    => 'Ana',
          'apellido'  => 'Martínez',
          'edad'      => 28,
          'direccion' => 'Av. Siempre Viva 456'
      ],
      [
          'nombre'    => 'Luis',
          'apellido'  => 'Ramírez',
          'edad'      => 34,
          'direccion' => 'Boulevard Central 789'
      ]
  ];
  $patientModel->insertBatch($dataBatch);
  ```

### c. Actualizar Datos (Update)

- **Actualizar un registro específico:**

  ```php
  $data = [
      'edad'      => 35,
      'direccion' => 'Nueva Calle 101'
  ];
  $patientModel->update($id, $data);
  ```

- **Actualizar múltiples registros (Batch Update):**

  ```php
  $dataBatch = [
      ['id' => 1, 'edad' => 36],
      ['id' => 2, 'edad' => 29]
  ];
  $patientModel->updateBatch($dataBatch, 'id');
  ```

### d. Eliminar Datos (Delete)

- **Eliminar un registro específico:**

  ```php
  $patientModel->delete($id);
  ```

- **Eliminar registros según condiciones:**

  ```php
  // Ejemplo: eliminar todos los registros donde el nombre sea 'Juan'
  $patientModel->where('nombre', 'Juan')->delete();
  ```

## Consultas con el Query Builder

```bash
# Preparar el builder
$db = \Config\Database::connect()
$builder = $db->table('patient')
```

### b. Consultas SELECT

```php
// Seleccionar todos los registros
$query  = $builder->get()
$result = $query->getResult()
```

```php
// Seleccionar campos específicos
$builder->select('id, nombre, apellido')
$query = $builder->get()
```

```php
// WHERE
$builder->where('edad >', 25)
$query = $builder->get()
```

```php
// OR WHERE
$builder->where('nombre','Ana')->orWhere('nombre','Luis')
$query = $builder->get()
```

```php
# LIKE
$builder->like('nombre','an')
$query = $builder->get()
```

```php
# ORDER BY y LIMIT
$builder->orderBy('nombre','ASC')->limit(10,0)
$query = $builder->get()
```

```php
# JOIN
$builder->select('patient.*, appointments.fecha')
        ->join('appointments','appointments.patient_id = patient.id')
        ->where('appointments.fecha >=',date('Y-m-d'))
$query = $builder->get()
```

### c. Consultas INSERT

```php
$data = [
    'nombre'=>'Carlos','apellido'=>'López',
    'edad'=>40,'direccion'=>'Ruta 66'
]
$builder->insert($data)
```

```php
$dataBatch = [
    ['nombre'=>'Sara','apellido'=>'Pérez','edad'=>25,'direccion'=>'Calle A'],
    ['nombre'=>'Miguel','apellido'=>'Ruiz','edad'=>32,'direccion'=>'Calle B']
]
$builder->insertBatch($dataBatch)
```

### d. Consultas UPDATE

```php
$data = ['direccion'=>'Nueva Dirección 202']
$builder->where('id',3)->update($data)
```

```php
$dataBatch = [['id'=>4,'edad'=>45],['id'=>5,'edad'=>38]]
$builder->updateBatch($dataBatch,'id')
```

### e. Consultas DELETE

```php
$builder->where('id',6)->delete()
```

```bash
# Vaciar tabla
$builder->emptyTable()
```

## Consultas SQL Crudas (Raw Queries)

```php
$sql   = "SELECT * FROM patient WHERE edad > ?"
$query = $db->query($sql,[30])
$result= $query->getResult()
```

## Agregados

```php
// SUM
$builder->selectSum('edad')
$query = $builder->get()
$sumEdad = $query->getRow()->edad
```

```php
// GROUP BY y HAVING
$builder->select('edad, COUNT(*) as total')
        ->groupBy('edad')
        ->having('total >',1)
$query = $builder->get()
```

```php
// DISTINCT
$builder->distinct()->select('nombre')
$query = $builder->get()
```

## Consideraciones Finales

- Usa **Modelos** para código limpio y organizado.
- Verifica tu conexión en `app/Config/Database.php` o las variables de entorno.
- Siempre valida o escapa datos externos para evitar inyecciones SQL.
