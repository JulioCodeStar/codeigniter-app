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
        'description' => 'Tipo de Encaje',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 21,
        'description' =>
        'Diseño de Encaje',
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
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 21,
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
        'description' => 'Longitud de la Liner',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 21,
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
        'description' => 'Talla Sujeción',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 21,
        'description' => 'Tipo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Mecánica Win Walker',
          'Mecánica Össur',
          'Mecánica LIMP',
          'Geriátrica LIMP',
          'Hidráulica Ottobock',
          'Hidráulica Össur',
          'Neumática Win Walker',
          'Neumática Össur'
        ])
      ],
      [
        'job_id' => 21,
        'description' => 'Tipo de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 21,
        'description' => 'Altura de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Tobillo Alto',
          'Tobillo Bajo'
        ])
      ],
      [
        'job_id' => 21,
        'description' => 'Marca del Pie',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 21,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 21,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 21,
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
        'description' => 'Tipo de Encaje',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 22,
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
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 22,
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
        'description' => 'Longitud de la Liner',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 22,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Rodillera S',
          'Rodillera M',
          'Rodillera L',
          'Lanyard',
          'Locker Pin',
          'Revofit',
        ])
      ],
      [
        'job_id' => 22,
        'description' => 'Tipo de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 22,
        'description' => 'Altura de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Tobillo Alto',
          'Tobillo Bajo'
        ])
      ],
      [
        'job_id' => 22,
        'description' => 'Marca del Pie',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 22,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 22,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 22,
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
        'description' => 'Tipo de Encaje',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 23,
        'description' => 'Accesorio',
        'cantidad' => 1,
        'items' => json_encode([
          'Correa de Sujeción'
        ])
      ],
      [
        'job_id' => 23,
        'description' => 'Componente',
        'cantidad' => 1,
        'items' => json_encode([
          'Articulación de Cadera'
        ])
      ],
      [
        'job_id' => 23,
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
        'description' => 'Tipo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Mecánica Win Walker',
          'Mecánica Össur',
          'Mecánica LIMP',
          'Geriátrica LIMP',
          'Hidráulica Ottobock',
          'Hidráulica Össur',
          'Neumática Win Walker',
          'Neumática Össur'
        ])
      ],
      [
        'job_id' => 23,
        'description' => 'Tipo de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 23,
        'description' => 'Altura de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Tobillo Alto',
          'Tobillo Bajo'
        ])
      ],
      [
        'job_id' => 23,
        'description' => 'Marca de Pie',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 23,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 23,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 23,
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
        'description' => 'Reconstrucción',
        'cantidad' => 1,
        'items' => json_encode([
          'Pie en silicona Médica'
        ])
      ],
      [
        'job_id' => 24,
        'description' => 'Base',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono'
        ])
      ],
      [
        'job_id' => 24,
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
        'description' => 'Reconstrucción',
        'cantidad' => 1,
        'items' => json_encode([
          'Pie en silicona Médica'
        ])
      ],
      [
        'job_id' => 25,
        'description' => 'Base',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono'
        ])
      ],
      [
        'job_id' => 25,
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
        'description' => 'Reconstrucción',
        'cantidad' => 1,
        'items' => json_encode([
          'Pie en Silicona Médica'
        ])
      ],
      [
        'job_id' => 26,
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
        'description' => 'Tipo de Encaje',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 27,
        'description' =>
        'Diseño de Encaje',
        'cantidad' => 1,
        'items' => json_encode([
          'Isquión contenido',
          'Infraisquiático'
        ]),
      ],
      [
        'job_id' => 27,
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 27,
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
        'description' => 'Longitud de la Liner',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 27,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Faja + Oring',
          'Revofit + Válvula',
        ])
      ],
      [
        'job_id' => 27,
        'description' => 'Tipo de Rodilla',
        'cantidad' => 1,
        'items' => json_encode([
          'Mecánica Win Walker',
          'Mecánica Össur',
          'Mecánica LIMP',
          'Geriátrica LIMP',
          'Hidráulica Ottobock',
          'Hidráulica Össur',
          'Neumática Win Walker',
          'Neumática Össur'
        ])
      ],
      [
        'job_id' => 27,
        'description' => 'Tipo de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 27,
        'description' => 'Altura de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Tobillo Alto',
          'Tobillo Bajo'
        ])
      ],
      [
        'job_id' => 27,
        'description' => 'Marca del Pie',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 27,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 27,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 27,
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
        'description' => 'Tipo de Encaje',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 28,
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
        'description' => 'Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 28,
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
        'description' => 'Longitud de la Liner',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 28,
        'description' => 'Tipo de Sujeción',
        'cantidad' => 1,
        'items' => json_encode([
          'Rodillera S',
          'Rodillera M',
          'Rodillera L',
          'Lanyard',
          'Locker Pin',
          'Revofit',
        ])
      ],
      [
        'job_id' => 28,
        'description' => 'Tipo de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 28,
        'description' => 'Altura de Pie',
        'cantidad' => 1,
        'items' => json_encode([
          'Tobillo Alto',
          'Tobillo Bajo'
        ])
      ],
      [
        'job_id' => 28,
        'description' => 'Marca del Pie',
        'cantidad' => 1,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 28,
        'description' => 'Acabado Estético',
        'cantidad' => 1,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 28,
        'description' => 'Conectores Especiales',
        'cantidad' => 1,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 28,
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
        'description' => 'Tipo de Encaje',
        'cantidad' => 2,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 29,
        'description' => 'Liner Izquierdo',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 29,
        'description' => 'Liner Derecho',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 29,
        'description' => 'Tipo de Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'K1 (baja movilidad)',
          'K2 (media movilidad)',
          'K3 (alta movilidad)'
        ])
      ],
      [
        'job_id' => 29,
        'description' => 'Rodilleras',
        'cantidad' => 2,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 29,
        'description' => 'Tipo de Pie',
        'cantidad' => 2,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 29,
        'description' => 'Altura de Pie',
        'cantidad' => 2,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 29,
        'description' => 'Marca del Pie',
        'cantidad' => 2,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 29,
        'description' => 'Acabado Estético',
        'cantidad' => 2,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 29,
        'description' => 'Conectores Especiales',
        'cantidad' => 2,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 29,
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
        'job_id' => 30,
        'description' => 'Tipo de Encaje',
        'cantidad' => 2,
        'items'       => json_encode([
          'Fibra de Vidrio',
          'Fibra de Carbono',
          'Endosocket Proteor',
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Liner Izquierdo',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 30,
        'description' => 'Liner Derecho',
        'cantidad' => 1,
        'items' => json_encode([
          'Lineal __ ___ Adaptador',
          'Cónica __ ___ Adaptador'
        ]),
      ],
      [
        'job_id' => 30,
        'description' => 'Tipo de Liner',
        'cantidad' => 1,
        'items' => json_encode([
          'K1 (baja movilidad)',
          'K2 (media movilidad)',
          'K3 (alta movilidad)'
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Tipo de Rodilla',
        'cantidad' => 2,
        'items' => json_encode([
          'Mecánica Win Walker',
          'Mecánica Össur',
          'Mecánica LIMP',
          'Geriátrica LIMP',
          'Hidráulica Ottobock',
          'Hidráulica Össur',
          'Neumática Win Walker',
          'Neumática Össur'
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Stubbies',
        'cantidad' => 2,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Tipo de Pie',
        'cantidad' => 2,
        'items' => json_encode([
          'Fibra de Carbono',
          'Pie Sach',
          'Pie Multiaxial'
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Altura de Pie',
        'cantidad' => 2,
        'items' => json_encode([
          'Tobillo Alto',
          'Tobillo Bajo'
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Marca del Pie',
        'cantidad' => 2,
        'items'       => json_encode([]),
      ],
      [
        'job_id' => 30,
        'description' => 'Acabado Estético',
        'cantidad' => 2,
        'items' => json_encode([
          'Media con Funda Estética',
          'Cover 3D'
        ])
      ],
      [
        'job_id' => 30,
        'description' => 'Conectores Especiales',
        'cantidad' => 2,
        'items' => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 30,
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
        'description' => 'Tipo de Socket',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fibra de Carbono',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Falange',
        'cantidad' => 1,
        'items'       => json_encode([
          'Biónicas',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Sensor',
        'cantidad' => 1,
        'items'       => json_encode([
          'Mioeléctrico',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Fundas',
        'cantidad' => 2,
        'items'       => json_encode([
          'Personalizadas para muñón',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Brazalete',
        'cantidad' => 1,
        'items'       => json_encode([
          'Para Batería y placa de Control',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Juego',
        'cantidad' => 1,
        'items'       => json_encode([
          'Fundas de silicona extra',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Soporte',
        'cantidad' => 1,
        'items'       => json_encode([
          'Prótesis',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Tipo de Cable',
        'cantidad' => 1,
        'items'       => json_encode([
          'Micro USB',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Baterías Incluidas',
        'cantidad' => 1,
        'items'       => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 1,
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
        'description' => 'Tipo de Socket',
        'cantidad' => 1,
        'items'       => json_encode([
          'TPU',
        ])
      ],
      [
        'job_id' => 2,
        'description' => 'Tipo de Muñequera',
        'cantidad' => 1,
        'items'       => json_encode([
          'TPU',
        ])
      ],
      [
        'job_id' => 2,
        'description' => 'Fundas',
        'cantidad' => 2,
        'items'       => json_encode([
          'Personalizadas para muñón',
        ])
      ],
      [
        'job_id' => 2,
        'description' => 'Fundas',
        'cantidad' => 2,
        'items'       => json_encode([
          'Personalizadas para muñón',
        ])
      ],
      [
        'job_id' => 2,
        'description' => 'Tipo de Falange Proximal',
        'cantidad' => 1,
        'items'       => json_encode([
          'TPU',
        ])
      ],
      [
        'job_id' => 2,
        'description' => 'Tipo de Falange Distal',
        'cantidad' => 1,
        'items'       => json_encode([
          'TPU',
        ])
      ],
      [
        'job_id' => 1,
        'description' => 'Fundas de Siliconas para Falange Distales',
        'cantidad' => 1,
        'items'       => json_encode([
          'Sí',
          'No'
        ])
      ],
      [
        'job_id' => 1,
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
        'description' => 'Tipo de Socket',
        'cantidad'    => 1,
        'items'       => json_encode([
          'TPU',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Tipo de Muñequera',
        'cantidad'    => 1,
        'items'       => json_encode([
          'TPU',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Fundas',
        'cantidad'    => 2,
        'items'       => json_encode([
          'Personalizadas para muñón',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Fundas',
        'cantidad'    => 2,
        'items'       => json_encode([
          'Personalizadas para muñón',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Tipo de Falange Proximal',
        'cantidad'    => 1,
        'items'       => json_encode([
          'TPU',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Tipo de Falange Distal',
        'cantidad'    => 1,
        'items'       => json_encode([
          'TPU',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Fundas de Siliconas para Falange Distales',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Sí',
          'No',
        ]),
      ],
      [
        'job_id'      => 3,
        'description' => 'Kit',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Accesorio de Ensamble',
        ]),
      ],
      /* /Mano Parcial Mecánica */

      /* Protesis Transradial Mioeléctrica de Fibra de Carbono FX-062 */
      [
        'job_id'      => 4,
        'description' => 'Mano eléctrica',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de carbono',
        ]),
      ],
      [
        'job_id'      => 4,
        'description' => 'Tipo de Socket',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de carbono',
        ]),
      ],
      [
        'job_id'      => 4,
        'description' => 'Guante cosmético',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Sí',
          'No',
        ]),
      ],
      [
        'job_id'      => 4,
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
        'description' => 'Mano eléctrica',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Aleación de Aluminio',
        ]),
      ],
      [
        'job_id'      => 5,
        'description' => 'Tipo de Socket',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Fibra de carbono',
        ]),
      ],
      [
        'job_id'      => 5,
        'description' => 'Guante cosmético',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Sí',
          'No',
        ]),
      ],
      [
        'job_id'      => 5,
        'description' => 'Kit ',
        'cantidad'    => 1,
        'items'       => json_encode([
          'Accesorio de ensamble',
        ]),
      ],
      /* Protesis Transradial Mioeléctrica de aleación de Aluminio FX-062 */
    ];

    $this->db->table('components')->insertBatch($components);
  }
}
