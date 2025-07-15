<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ComponentsSeeder extends Seeder
{
  public function run()
  {
    $components = [

      /* Protesis Transfemoral */
      [
        'job_id'      => 21,
        'order'       => 1,
        'description' => 'Tipo de Encaje',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Fibra de Vidrio + Endosocket Proteor',
          'Fibra de Carbono + Endosocket Proteor'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 2,
        'description' => 'Diseño de Encaje',
        'cantidad' => 1,
        'items' => json_encode([
          'Isquión contenido',
          'Cuadrilateral',
          'Contención Ramal',
          'Infraisquiático'
        ]),
      ],
      [
        'job_id' => 21,
        'order' => 3,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Sujeción Lanyard',
          'Locker Pin',
          'Sujeción Revofit',
          'ORing Marca: ___, Talla: __ + Valvula de Vacío Marca: ___',
        ])
      ],
      [
        'job_id' => 21,
        'order' => 4,
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 21,
        'order' => 5,
        'description' => 'Tipo de Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'K1 (baja movilidad)',
          'K2 (media movilidad)',
          'K3 (alta movilidad)'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 6,
        'description' => 'Longitud de la Liner',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 21,
        'order' => 7,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Sujeción Lanyard',
          'Locker Pin',
          'Sujeción Revofit',
          'ORing de Silicona'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 8,
        'description' => 'Modelo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Aspire M1',
          'Huknee M1',
          'Huknee P4',
          'Huknee P7',
          'Aspure P1',
          'Paso Knee',
          'Aspire M7',
        ])
      ],
      [
        'job_id' => 21,
        'order' => 9,
        'description' => 'Tipo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Geriátrica',
          'Mecánica',
          'Neumática',
          'Hidráulica',
        ])
      ],
      [
        'job_id' => 21,
        'order' => 10,
        'description' => 'Marca de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Össur',
          'LIMP',
          'Ottobock'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 11,
        'description' => 'Mecanismo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Mecánica monocéntrica',
          'Mecánica policéntrica 4 ejes',
          'Mecánica policéntrica 7 ejes',
          'Neumática policéntrica 4 ejes',
          'Hidráulica policéntrica 4 ejes',
          'Hidráulica policéntrica 7 ejes',
          'Hidráulica monocéntrica'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 12,
        'description' => 'Tipo del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'SACH Madera Tobilllo Bajo',
          'Multiaxial Fibra de Carbono Tobillo Alto',
          'Balance J Silicona Tobillo Bajo',
          'Kamel Fibra de Carbono Tobillo Bajo',
          'Lizzard Fibra de Carbono Tobillo Bajo',
          'Assure Fibra de Carbono Tobillo Alto',
          'Variflex Fibra de Carbono Tobillo Alto',
          'Ostrich Fibra de Carbono Tobillo Alto',
          'Proflex - lp Fibra de Carbono Tobillo Medio',
          'Proflex - Terra Fibra de Carbono Tobillo Alto',
          'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 13,
        'description' => 'Categoría del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'K1',
          'K2',
          'K3',
          'K2 - K3',
          'align - K2'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 14,
        'description' => 'Talla y Lado del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          '___, ___',
        ])
      ],
      [
        'job_id' => 21,
        'order' => 15,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 16,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 21,
        'order' => 17,
        'description' => 'Tipo de Accesorio',
        'cantidad' => 1,
        'items' => json_encode([
          'Titanio',
          'Acero Inoxidable'
        ])
      ],
      /* Protesis Transfemoral */


      /* Protesis Transtibial */
      [
        'job_id' => 22,
        'order' => 1,
        'description' => 'Tipo de Encaje',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Fibra de Vidrio + Endosocket Proteor',
          'Fibra de Carbono + Endosocket Proteor'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 2,
        'description' => 'Diseño de Encaje',
        'cantidad' => 1,
        'items' => json_encode([
          'KBM',
          'Contacto Total',
          'PTB'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 3,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Rodillera Talla: ____',
          'Lanyard',
          'ORing Marca: ___, Talla: __ + Valvula de Vacío Marca: ___',
          'Leocker Pon Geriátrico o Convencional',
          'Endosocket'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 4,
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 22,
        'order' => 5,
        'description' => 'Tipo de Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'K1 (baja movilidad)',
          'K2 (media movilidad)',
          'K3 (alta movilidad)'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 6,
        'description' => 'Longitud de Liner',
        'cantidad' => 1,
        'items' => json_encode([
          '___'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 7,
        'description' => 'Tipo del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'SACH Madera Tobilllo Bajo',
          'Multiaxial Fibra de Carbono Tobillo Alto',
          'Balance J Silicona Tobillo Bajo',
          'Kamel Fibra de Carbono Tobillo Bajo',
          'Lizzard Fibra de Carbono Tobillo Bajo',
          'Assure Fibra de Carbono Tobillo Alto',
          'Variflex Fibra de Carbono Tobillo Alto',
          'Ostrich Fibra de Carbono Tobillo Alto',
          'Proflex - lp Fibra de Carbono Tobillo Medio',
          'Proflex - Terra Fibra de Carbono Tobillo Alto',
          'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 8,
        'description' => 'Categoría del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'K1',
          'K2',
          'K3',
          'K2 - K3',
          'align - K2'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 9,
        'description' => 'Talla y Lado del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          '___, ___',
        ])
      ],
      [
        'job_id' => 22,
        'order' => 10,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 11,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 22,
        'order' => 12,
        'description' => 'Tipo de Accesorio',
        'cantidad' => 1,
        'items' => json_encode([
          'Titanio',
          'Acero Inoxidable'
        ])
      ],
      /* Protesis Transtibial */


      /* Protesis Desarticulado de Cadera */
      [
        'job_id' => 23,
        'order' => 1,
        'description' => 'Tipo de Encaje',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Fibra de Vidrio + Endosocket Proteor',
          'Fibra de Carbono + Endosocket Proteor'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 2,
        'description' => 'Accesorio',
        'cantidad' => 1,
        'items' => json_encode([
          'Correa de Sujeción'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 3,
        'description' => 'Componente',
        'cantidad' => 1,
        'items' => json_encode([
          'Articulación de Cadera'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 4,
        'description' => 'Tipo de Faja',
        'cantidad' => 1,
        'items' => json_encode([
          'Talla S',
          'Talla M',
          'Talla L',
          'Talla 35',
          'Talla 41',
          'Talla 44',
          'Talla 47',
        ])
      ],
      [
        'job_id' => 23,
        'order' => 5,
        'description' => 'Modelo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Aspire M1',
          'Huknee M1',
          'Huknee P4',
          'Huknee P7',
          'Aspure P1',
          'Paso Knee',
          'Aspire M7',
        ])
      ],
      [
        'job_id' => 23,
        'order' => 6,
        'description' => 'Tipo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Geriátrica',
          'Mecánica',
          'Neumática',
          'Hidráulica',
        ])
      ],
      [
        'job_id' => 23,
        'order' => 7,
        'description' => 'Marca de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Össur',
          'LIMP',
          'Ottobock'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 8,
        'description' => 'Mecanismo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Mecánica monocéntrica',
          'Mecánica policéntrica 4 ejes',
          'Mecánica policéntrica 7 ejes',
          'Neumática policéntrica 4 ejes',
          'Hidráulica policéntrica 4 ejes',
          'Hidráulica policéntrica 7 ejes',
          'Hidráulica monocéntrica'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 9,
        'description' => 'Tipo del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'SACH Madera Tobilllo Bajo',
          'Multiaxial Fibra de Carbono Tobillo Alto',
          'Balance J Silicona Tobillo Bajo',
          'Kamel Fibra de Carbono Tobillo Bajo',
          'Lizzard Fibra de Carbono Tobillo Bajo',
          'Assure Fibra de Carbono Tobillo Alto',
          'Variflex Fibra de Carbono Tobillo Alto',
          'Ostrich Fibra de Carbono Tobillo Alto',
          'Proflex - lp Fibra de Carbono Tobillo Medio',
          'Proflex - Terra Fibra de Carbono Tobillo Alto',
          'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 10,
        'description' => 'Categoría del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'K1',
          'K2',
          'K3',
          'K2 - K3',
          'align - K2'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 11,
        'description' => 'Talla y Lado del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          '___, ___',
        ])
      ],
      [
        'job_id' => 23,
        'order' => 12,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 13,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 23,
        'order' => 14,
        'description' => 'Tipo de Accesorio',
        'cantidad' => 1,
        'items' => json_encode([
          'Titanio',
          'Acero Inoxidable'
        ])
      ],
      /* Protesis Desarticulado de Cadera */


      /* Protesis Chopart */
      [
        'job_id' => 24,
        'order' => 1,
        'description' => 'Reconstrucción',
        'cantidad' => 1,
        'items' => json_encode([
          'Pie en silicona Médica'
        ])
      ],
      [
        'job_id' => 24,
        'order' => 2,
        'description' => 'Base',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono'
        ])
      ],
      [
        'job_id' => 24,
        'order' => 3,
        'description' => 'Correa de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      /* Protesis Chopart */


      /* Protesis Linsfrack */
      [
        'job_id' => 25,
        'order' => 1,
        'description' => 'Reconstrucción',
        'cantidad' => 1,
        'items' => json_encode([
          'Pie en silicona Médica'
        ])
      ],
      [
        'job_id' => 25,
        'order' => 2,
        'description' => 'Base',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono'
        ])
      ],
      [
        'job_id' => 25,
        'order' => 3,
        'description' => 'Correa de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      /* Protesis Linsfrack */


      /* Protesis Metatarsal */
      [
        'job_id' => 26,
        'order' => 1,
        'description' => 'Reconstrucción',
        'cantidad' => 1,
        'items' => json_encode([
          'Pie en Silicona Médica'
        ])
      ],
      [
        'job_id' => 26,
        'order' => 2,
        'description' => 'Base',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono'
        ])
      ],
      /* Protesis Metatarsal */


      /* Protesis Desarticulado de Rodilla */
      [
        'job_id'      => 27,
        'order'       => 1,
        'description' => 'Tipo de Encaje',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Fibra de Vidrio + Endosocket Proteor',
          'Fibra de Carbono + Endosocket Proteor'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 2,
        'description' => 'Diseño de Encaje',
        'cantidad' => 1,
        'items' => json_encode([
          'Isquión contenido',
          'Cuadrilateral',
          'Contención Ramal',
          'Infraisquiático'
        ]),
      ],
      [
        'job_id' => 27,
        'order' => 3,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Sujeción Lanyard',
          'Locker Pin',
          'Sujeción Revofit',
          'ORing Marca: ___, Talla: __ + Valvula de Vacío Marca: ___',
        ])
      ],
      [
        'job_id' => 27,
        'order' => 4,
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 27,
        'order' => 5,
        'description' => 'Tipo de Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'K1 (baja movilidad)',
          'K2 (media movilidad)',
          'K3 (alta movilidad)'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 6,
        'description' => 'Longitud de la Liner',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 27,
        'order' => 7,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Sujeción Lanyard',
          'Locker Pin',
          'Sujeción Revofit',
          'ORing de Silicona'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 8,
        'description' => 'Modelo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Aspire M1',
          'Huknee M1',
          'Huknee P4',
          'Huknee P7',
          'Aspure P1',
          'Paso Knee',
          'Aspire M7',
        ])
      ],
      [
        'job_id' => 27,
        'order' => 9,
        'description' => 'Tipo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Geriátrica',
          'Mecánica',
          'Neumática',
          'Hidráulica',
        ])
      ],
      [
        'job_id' => 27,
        'order' => 10,
        'description' => 'Marca de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Össur',
          'LIMP',
          'Ottobock'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 11,
        'description' => 'Mecanismo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Mecánica monocéntrica',
          'Mecánica policéntrica 4 ejes',
          'Mecánica policéntrica 7 ejes',
          'Neumática policéntrica 4 ejes',
          'Hidráulica policéntrica 4 ejes',
          'Hidráulica policéntrica 7 ejes',
          'Hidráulica monocéntrica'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 12,
        'description' => 'Tipo del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'SACH Madera Tobilllo Bajo',
          'Multiaxial Fibra de Carbono Tobillo Alto',
          'Balance J Silicona Tobillo Bajo',
          'Kamel Fibra de Carbono Tobillo Bajo',
          'Lizzard Fibra de Carbono Tobillo Bajo',
          'Assure Fibra de Carbono Tobillo Alto',
          'Variflex Fibra de Carbono Tobillo Alto',
          'Ostrich Fibra de Carbono Tobillo Alto',
          'Proflex - lp Fibra de Carbono Tobillo Medio',
          'Proflex - Terra Fibra de Carbono Tobillo Alto',
          'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 13,
        'description' => 'Categoría del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'K1',
          'K2',
          'K3',
          'K2 - K3',
          'align - K2'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 14,
        'description' => 'Talla y Lado del Pie',
        'cantidad' => 1,
        'items' => json_encode([
          '___, ___',
        ])
      ],
      [
        'job_id' => 27,
        'order' => 15,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 16,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 27,
        'order' => 17,
        'description' => 'Tipo de Accesorio',
        'cantidad' => 1,
        'items' => json_encode([
          'Titanio',
          'Acero Inoxidable'
        ])
      ],
      /* Protesis Desarticulado de Rodilla */


      /* Protesis Syme */
        [
          'job_id' => 28,
          'order' => 1,
          'description' => 'Tipo de Encaje',
          'cantidad' => 1,
          'items'       => json_encode([
            'Fibra de Vidrio',
            'Fibra de Carbono',
            'Fibra de Vidrio + Endosocket Proteor',
            'Fibra de Carbono + Endosocket Proteor'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 2,
          'description' => 'Diseño de Encaje',
          'cantidad' => 1,
          'items' => json_encode([
            'KBM',
            'Contacto Total',
            'PTB'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 3,
          'description' => 'Tipo de Sujeción',
          'cantidad' => 1,
          'items' => json_encode([
            'Rodillera Talla: ____',
            'Lanyard',
            'ORing Marca: ___, Talla: __ + Valvula de Vacío Marca: ___',
            'Leocker Pon Geriátrico o Convencional',
            'Endosocket'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 4,
          'description' => 'Liner',
          'cantidad' => 1,
          'items' => json_encode([
            'Lineal __ ___ Adaptador',
            'Cónica __ ___ Adaptador'
          ]),
        ],
        [
          'job_id' => 28,
          'order' => 5,
          'description' => 'Tipo de Liner',
          'cantidad' => 1,
          'items' => json_encode([
            'K1 (baja movilidad)',
            'K2 (media movilidad)',
            'K3 (alta movilidad)'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 6,
          'description' => 'Longitud de Liner',
          'cantidad' => 1,
          'items' => json_encode([
            '___'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 7,
          'description' => 'Tipo del Pie',
          'cantidad' => 1,
          'items' => json_encode([
            'SACH Madera Tobilllo Bajo',
            'Multiaxial Fibra de Carbono Tobillo Alto',
            'Balance J Silicona Tobillo Bajo',
            'Kamel Fibra de Carbono Tobillo Bajo',
            'Lizzard Fibra de Carbono Tobillo Bajo',
            'Assure Fibra de Carbono Tobillo Alto',
            'Variflex Fibra de Carbono Tobillo Alto',
            'Ostrich Fibra de Carbono Tobillo Alto',
            'Proflex - lp Fibra de Carbono Tobillo Medio',
            'Proflex - Terra Fibra de Carbono Tobillo Alto',
            'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 8,
          'description' => 'Categoría del Pie',
          'cantidad' => 1,
          'items' => json_encode([
            'K1',
            'K2',
            'K3',
            'K2 - K3',
            'align - K2'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 9,
          'description' => 'Talla y Lado del Pie',
          'cantidad' => 1,
          'items' => json_encode([
            '___, ___',
          ])
        ],
        [
          'job_id' => 28,
          'order' => 10,
          'description' => 'Acabado Estético',
          'cantidad' => 1,
          'items' => json_encode([
            'Media con Funda Estética',
            'Cover 3D'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 11,
          'description' => 'Conectores Especiales',
          'cantidad' => 1,
          'items' => json_encode([
            'Sí',
            'No'
          ])
        ],
        [
          'job_id' => 28,
          'order' => 12,
          'description' => 'Tipo de Accesorio',
          'cantidad' => 1,
          'items' => json_encode([
            'Titanio',
            'Acero Inoxidable'
          ])
        ],
      /* Protesis Syme */


      /* Protesis Bilateral Transtibial */
        [
          'job_id' => 29,
          'order' => 1,
          'description' => 'Tipo de Encaje',
          'cantidad' => 2,
          'items'       => json_encode([
            'Fibra de Vidrio',
            'Fibra de Carbono',
            'Fibra de Vidrio + Endosocket Proteor',
            'Fibra de Carbono + Endosocket Proteor'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 2,
          'description' => 'Diseño de Encaje',
          'cantidad' => 2,
          'items' => json_encode([
            'KBM',
            'Contacto Total',
            'PTB'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 3,
          'description' => 'Tipo de Sujeción',
          'cantidad' => 2,
          'items' => json_encode([
            'Rodillera Talla: ____',
            'Lanyard',
            'ORing Marca: ___, Talla: __ + Valvula de Vacío Marca: ___',
            'Leocker Pon Geriátrico o Convencional',
            'Endosocket'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 4,
          'description' => 'Liner Izquierdo',
          'cantidad' => 1,
          'items' => json_encode([
            'Lineal __ ___ Adaptador',
            'Cónica __ ___ Adaptador'
          ]),
        ],
        [
          'job_id' => 29,
          'order' => 5,
          'description' => 'Liner Derecho',
          'cantidad' => 1,
          'items' => json_encode([
            'Lineal __ ___ Adaptador',
            'Cónica __ ___ Adaptador'
          ]),
        ],
        [
          'job_id' => 29,
          'order' => 6,
          'description' => 'Tipo de Liner',
          'cantidad' => 2,
          'items' => json_encode([
            'K1 (baja movilidad)',
            'K2 (media movilidad)',
            'K3 (alta movilidad)'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 6,
          'description' => 'Longitud de Liner',
          'cantidad' => 2,
          'items' => json_encode([
            'Derecho: ___, Izquierdo: ___'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 7,
          'description' => 'Tipo del Pie',
          'cantidad' => 2,
          'items' => json_encode([
            'SACH Madera Tobilllo Bajo',
            'Multiaxial Fibra de Carbono Tobillo Alto',
            'Balance J Silicona Tobillo Bajo',
            'Kamel Fibra de Carbono Tobillo Bajo',
            'Lizzard Fibra de Carbono Tobillo Bajo',
            'Assure Fibra de Carbono Tobillo Alto',
            'Variflex Fibra de Carbono Tobillo Alto',
            'Ostrich Fibra de Carbono Tobillo Alto',
            'Proflex - lp Fibra de Carbono Tobillo Medio',
            'Proflex - Terra Fibra de Carbono Tobillo Alto',
            'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 8,
          'description' => 'Categoría del Pie',
          'cantidad' => 2,
          'items' => json_encode([
            'K1',
            'K2',
            'K3',
            'K2 - K3',
            'align - K2'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 9,
          'description' => 'Talla y Lado del Pie Izquierdo',
          'cantidad' => 1,
          'items' => json_encode([
            '___, ___',
          ])
        ],
        [
          'job_id' => 29,
          'order' => 10,
          'description' => 'Talla y Lado del Pie Derecho',
          'cantidad' => 1,
          'items' => json_encode([
            '___, ___',
          ])
        ],
        [
          'job_id' => 29,
          'order' => 11,
          'description' => 'Acabado Estético',
          'cantidad' => 2,
          'items' => json_encode([
            'Media con Funda Estética',
            'Cover 3D'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 12,
          'description' => 'Conectores Especiales',
          'cantidad' => 1,
          'items' => json_encode([
            'Sí',
            'No'
          ])
        ],
        [
          'job_id' => 29,
          'order' => 13,
          'description' => 'Tipo de Accesorio',
          'cantidad' => 2,
          'items' => json_encode([
            'Titanio',
            'Acero Inoxidable'
          ])
        ],
      /* Protesis Bilateral Transtibial */


      /* Protesis Bilateral Transfemoral */
        [
          'job_id'      => 30,
          'order'       => 1,
          'description' => 'Tipo de Encaje',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Fibra de Vidrio',
            'Fibra de Carbono',
            'Fibra de Vidrio + Endosocket Proteor',
            'Fibra de Carbono + Endosocket Proteor'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 2,
          'description' => 'Diseño de Encaje',
          'cantidad' => 2,
          'items' => json_encode([
            'Isquión contenido',
            'Cuadrilateral',
            'Contención Ramal',
            'Infraisquiático'
          ]),
        ],
        [
          'job_id' => 30,
          'order' => 3,
          'description' => 'Tipo de Sujeción',
          'cantidad' => 2,
          'items' => json_encode([
            'Sujeción Lanyard',
            'Locker Pin',
            'Sujeción Revofit',
            'ORing Marca: ___, Talla: __ + Valvula de Vacío Marca: ___',
          ])
        ],
        [
          'job_id' => 30,
          'order' => 4,
          'description' => 'Liner Izquierdo',
          'cantidad' => 1,
          'items' => json_encode([
            'Lineal __ ___ Adaptador',
            'Cónica __ ___ Adaptador'
          ]),
        ],
        [
          'job_id' => 30,
          'order' => 5,
          'description' => 'Liner Derecho',
          'cantidad' => 1,
          'items' => json_encode([
            'Lineal __ ___ Adaptador',
            'Cónica __ ___ Adaptador'
          ]),
        ],
        [
          'job_id' => 30,
          'order' => 6,
          'description' => 'Tipo de Liner',
          'cantidad' => 2,
          'items' => json_encode([
            'K1 (baja movilidad)',
            'K2 (media movilidad)',
            'K3 (alta movilidad)'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 6,
          'description' => 'Longitud de la Liner',
          'cantidad' => 1,
          'items'       => json_encode([
            'Derecho: ___, Izquierdo: ___'
          ]),
        ],
        [
          'job_id' => 30,
          'order' => 7,
          'description' => 'Tipo de Sujeción',
          'cantidad' => 2,
          'items' => json_encode([
            'Sujeción Lanyard',
            'Locker Pin',
            'Sujeción Revofit',
            'ORing de Silicona'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 8,
          'description' => 'Modelo de Rodilla',
          'cantidad' => 2,
          'items' => json_encode([
            'Aspire M1',
            'Huknee M1',
            'Huknee P4',
            'Huknee P7',
            'Aspure P1',
            'Paso Knee',
            'Aspire M7',
          ])
        ],
        [
          'job_id' => 30,
          'order' => 9,
          'description' => 'Tipo de Rodilla',
          'cantidad' => 2,
          'items' => json_encode([
            'Geriátrica',
            'Mecánica',
            'Neumática',
            'Hidráulica',
          ])
        ],
        [
          'job_id' => 30,
          'order' => 10,
          'description' => 'Marca de Rodilla',
          'cantidad' => 2,
          'items' => json_encode([
            'Össur',
            'LIMP',
            'Ottobock'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 11,
          'description' => 'Mecanismo de Rodilla',
          'cantidad' => 2,
          'items' => json_encode([
            'Mecánica monocéntrica',
            'Mecánica policéntrica 4 ejes',
            'Mecánica policéntrica 7 ejes',
            'Neumática policéntrica 4 ejes',
            'Hidráulica policéntrica 4 ejes',
            'Hidráulica policéntrica 7 ejes',
            'Hidráulica monocéntrica'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 12,
          'description' => 'Tipo del Pie',
          'cantidad' => 2,
          'items' => json_encode([
            'SACH Madera Tobilllo Bajo',
            'Multiaxial Fibra de Carbono Tobillo Alto',
            'Balance J Silicona Tobillo Bajo',
            'Kamel Fibra de Carbono Tobillo Bajo',
            'Lizzard Fibra de Carbono Tobillo Bajo',
            'Assure Fibra de Carbono Tobillo Alto',
            'Variflex Fibra de Carbono Tobillo Alto',
            'Ostrich Fibra de Carbono Tobillo Alto',
            'Proflex - lp Fibra de Carbono Tobillo Medio',
            'Proflex - Terra Fibra de Carbono Tobillo Alto',
            'Proflex XC Torsión Fibra de Carbono Tobillo Alto'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 13,
          'description' => 'Categoría del Pie',
          'cantidad' => 2,
          'items' => json_encode([
            'K1',
            'K2',
            'K3',
            'K2 - K3',
            'align - K2'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 14,
          'description' => 'Talla y Lado del Pie',
          'cantidad' => 2,
          'items' => json_encode([
            'Derecho: ___, Izquierdo: ___',
          ])
        ],
        [
          'job_id' => 30,
          'order' => 15,
          'description' => 'Acabado Estético',
          'cantidad' => 2,
          'items' => json_encode([
            'Media con Funda Estética',
            'Cover 3D'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 16,
          'description' => 'Conectores Especiales',
          'cantidad' => 2,
          'items' => json_encode([
            'Sí',
            'No'
          ])
        ],
        [
          'job_id' => 30,
          'order' => 17,
          'description' => 'Tipo de Accesorio',
          'cantidad' => 2,
          'items' => json_encode([
            'Titanio',
            'Acero Inoxidable'
          ])
        ],
      /* Protesis Bilateral Transfemoral */


      /* Mano Parcial Biónica */
        [
          'job_id' => 1,
          'order' => 1,
          'description' => 'Tipo de Socket',
          'cantidad' => 1,
          'items'       => json_encode([
            'Fibra de Carbono',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 2,
          'description' => 'Falange',
          'cantidad' => 1,
          'items'       => json_encode([
            'Biónicas',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 3,
          'description' => 'Sensor',
          'cantidad' => 1,
          'items'       => json_encode([
            'Mioeléctrico',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 4,
          'description' => 'Fundas',
          'cantidad' => 2,
          'items'       => json_encode([
            'Personalizadas para muñón',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 5,
          'description' => 'Brazalete',
          'cantidad' => 1,
          'items'       => json_encode([
            'Para Batería y placa de Control',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 6,
          'description' => 'Juego',
          'cantidad' => 1,
          'items'       => json_encode([
            'Fundas de silicona extra',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 7,
          'description' => 'Soporte',
          'cantidad' => 1,
          'items'       => json_encode([
            'Prótesis',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 8,
          'description' => 'Tipo de Cable',
          'cantidad' => 1,
          'items'       => json_encode([
            'Micro USB',
          ])
        ],
        [
          'job_id' => 1,
          'order' => 9,
          'description' => 'Baterías Incluidas',
          'cantidad' => 1,
          'items'       => json_encode([
            'Sí',
            'No'
          ])
        ],
        [
          'job_id' => 1,
          'order' => 10,
          'description' => 'Kit',
          'cantidad' => 1,
          'items'       => json_encode([
            'Accesorio de Ensamble',
          ])
        ],
      /* Mano Parcial Biónica */


      /* Mano Parcial Mecánica */
        [
          'job_id' => 2,
          'order' => 1,
          'description' => 'Tipo de Socket',
          'cantidad' => 1,
          'items'       => json_encode([
            'TPU',
          ])
        ],
        [
          'job_id' => 2,
          'order' => 2,
          'description' => 'Tipo de Muñequera',
          'cantidad' => 1,
          'items'       => json_encode([
            'TPU',
          ])
        ],
        [
          'job_id' => 2,
          'order' => 3,
          'description' => 'Fundas',
          'cantidad' => 2,
          'items'       => json_encode([
            'Personalizadas para muñón',
          ])
        ],
        [
          'job_id' => 2,
          'order' => 4,
          'description' => 'Fundas',
          'cantidad' => 2,
          'items'       => json_encode([
            'Personalizadas para muñón',
          ])
        ],
        [
          'job_id' => 2,
          'order' => 5,
          'description' => 'Tipo de Falange Proximal',
          'cantidad' => 1,
          'items'       => json_encode([
            'TPU',
          ])
        ],
        [
          'job_id' => 2,
          'order' => 6,
          'description' => 'Tipo de Falange Distal',
          'cantidad' => 1,
          'items'       => json_encode([
            'TPU',
          ])
        ],
        [
          'job_id' => 2,
          'order' => 7,
          'description' => 'Fundas de Siliconas para Falange Distales',
          'cantidad' => 1,
          'items'       => json_encode([
            'Sí',
            'No'
          ])
        ],
        [
          'job_id' => 2,
          'order' => 8,
          'description' => 'Kit',
          'cantidad' => 1,
          'items'       => json_encode([
            'Accesorio de Ensamble',
          ])
        ],
      /* Mano Parcial Mecánica */

      /* Mano Completa Biónica */
        [
          'job_id'      => 3,
          'order' => 1,
          'description' => 'Tipo de Socket',
          'cantidad'    => 1,
          'items'       => json_encode([
            'TPU',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 2,
          'description' => 'Tipo de Muñequera',
          'cantidad'    => 1,
          'items'       => json_encode([
            'TPU',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 3,
          'description' => 'Fundas',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Personalizadas para muñón',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 4,
          'description' => 'Fundas',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Personalizadas para muñón',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 5,
          'description' => 'Tipo de Falange Proximal',
          'cantidad'    => 1,
          'items'       => json_encode([
            'TPU',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 6,
          'description' => 'Tipo de Falange Distal',
          'cantidad'    => 1,
          'items'       => json_encode([
            'TPU',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 7,
          'description' => 'Fundas de Siliconas para Falange Distales',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Sí',
            'No',
          ]),
        ],
        [
          'job_id'      => 3,
          'order' => 8,
          'description' => 'Kit',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Accesorio de Ensamble',
          ]),
        ],
      /* Mano Completa Biónica */

      /* Protesis Transradial Mioeléctrica de Fibra de Carbono FX-062 */
        [
          'job_id'      => 4,
          'order' => 1,
          'description' => 'Mano eléctrica',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Fibra de carbono',
          ]),
        ],
        [
          'job_id'      => 4,
          'order' => 2,
          'description' => 'Tipo de Socket',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Fibra de carbono',
          ]),
        ],
        [
          'job_id'      => 4,
          'order' => 3,
          'description' => 'Guante cosmético',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Sí',
            'No',
          ]),
        ],
        [
          'job_id'      => 4,
          'order' => 4,
          'description' => 'Kit ',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Accesorio de ensamble',
          ]),
        ],
      /* Protesis Transradial Mioeléctrica de Fibra de Carbono FX-062 */


      /* Protesis Transradial Mioeléctrica de aleación de Aluminio FX-062 */
        [
          'job_id'      => 5,
          'order' => 1,
          'description' => 'Mano eléctrica',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Aleación de Aluminio',
          ]),
        ],
        [
          'job_id'      => 5,
          'order' => 2,
          'description' => 'Tipo de Socket',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Fibra de carbono',
          ]),
        ],
        [
          'job_id'      => 5,
          'order' => 3,
          'description' => 'Guante cosmético',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Sí',
            'No',
          ]),
        ],
        [
          'job_id'      => 5,
          'order' => 4,
          'description' => 'Kit ',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Accesorio de ensamble',
          ]),
        ],
      /* Protesis Transradial Mioeléctrica de aleación de Aluminio FX-062 */

      /*  */

      
      /* Parte Corporal */
        [
          'job_id'      => 31,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 31,
          'order' => 2,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Parte Corporal */

      /* Microtia Tipo 1 y 2 */
        [
          'job_id'      => 32,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 32,
          'order' => 2,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Pegamento',
          ]),
        ],
        [
          'job_id'      => 32,
          'order' => 3,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Disolvente',
          ]),
        ],
        [
          'job_id'      => 32,
          'order' => 4,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Microtia Tipo 1 y 2 */

      /* Microtia Tipo 3 y 4 */
        [
          'job_id'      => 33,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 33,
          'order' => 2,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Pegamento',
          ]),
        ],
        [
          'job_id'      => 33,
          'order' => 3,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Disolvente',
          ]),
        ],
        [
          'job_id'      => 33,
          'order' => 4,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Microtia Tipo 3 y 4 */

      /* Mano Parcial Estética */
        [
          'job_id'      => 34,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 34,
          'order' => 2,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Mano Parcial Estética */

      /* Falange Estética del Pie */
        [
          'job_id'      => 35,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 35,
          'order' => 2,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Pegamento',
          ]),
        ],
        [
          'job_id'      => 35,
          'order' => 3,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Disolvente',
          ]),
        ],
        [
          'job_id'      => 35,
          'order' => 4,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Falange Estética del Pie */

      /* Falange Total */
        [
          'job_id'      => 36,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 36,
          'order' => 2,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Falange Total */ 

      /* Falange Parcial */
        [
          'job_id'      => 37,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 37,
          'order' => 2,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Falange Parcial */

      /* Mitón de Pie Estético */
        [
          'job_id'      => 38,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 38,
          'order' => 2,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Pegamento',
          ]),
        ],
        [
          'job_id'      => 38,
          'order' => 3,
          'description' => 'Accesorio',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Disolvente',
          ]),
        ],
        [
          'job_id'      => 38,
          'order' => 4,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Mitón de Pie Estético */

      /* Prótesis de Mamas */
        [
          'job_id'      => 39,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 39,
          'order' => 2,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Prótesis de Mamas */

      /* Mano Completa Estética */
        [
          'job_id'      => 40,
          'order' => 1,
          'description' => 'Componente',
          'cantidad'    => 1,
          'items'       => json_encode([
            'Prótesis reconstruida en silicona médica',
          ]),
        ],
        [
          'job_id'      => 40,
          'order' => 2,
          'description' => 'Prótesis Médica',
          'cantidad'    => 2,
          'items'       => json_encode([
            'Capas Protectoras',
          ]),
        ],
      /* Mano Completa Estética */
    ];

    $this->db->table('components')->insertBatch($components);
  }
}
