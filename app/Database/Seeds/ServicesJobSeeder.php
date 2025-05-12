<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServicesJobSeeder extends Seeder
{
  public function run()
  {
    $servicios = [
      ['id' => 1, 'descripcion' => 'Miembro Superior'],
      ['id' => 2, 'descripcion' => 'Miembro Inferior'],
      ['id' => 3, 'descripcion' => 'Estética'],
      ['id' => 4, 'descripcion' => 'Accesorios'],
      ['id' => 5, 'descripcion' => 'Servicio Técnico'],
      ['id' => 6, 'descripcion' => 'Miembros Inferiores de Encaje'],
      ['id' => 7, 'descripcion' => 'Órtesis'],
      ['id' => 8, 'descripcion' => 'Proyectos'],
    ];

    $this->db->table('servicios')->insertBatch($servicios);

    $jobs = [
      ['servicios_id' => 1, 'descripcion' => 'Mano Parcial Biónica'],
      ['servicios_id' => 1, 'descripcion' => 'Mano Parcial Mecánica'],
      ['servicios_id' => 1, 'descripcion' => 'Mano Completa Biónica'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis Transradial Mioeléctrica de Fibra de Carbono FX-062'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis Transradial Mioeléctrica de aleación de aluminio FX-062'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis Transhumeral Mioelectrica'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis transradial tipo gancho con guante cosmético (Aosuo)'],
      ['servicios_id' => 1, 'descripcion' => 'Prótesis Transradial ILIMB de la marca Ossur'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis Transhumeral tipo gancho con guante cosmético (Aosuo)'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis transradial tipo gancho con guante cosmético (Fillauer)'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis mano completa mecánica de TPU'],
      ['servicios_id' => 1, 'descripcion' => 'Protesis Transhumeral tipo gancho con guante cosmético (Fillauer)'],
      ['servicios_id' => 1, 'descripcion' => 'Falange Mecánica'],
      ['servicios_id' => 1, 'descripcion' => 'Mano Parcial de articulación manual'],
      ['servicios_id' => 1, 'descripcion' => 'Prótesis Transhumeral Oymotion'],
      ['servicios_id' => 1, 'descripcion' => 'Transhumeral Estético con Articulación'],
      ['servicios_id' => 1, 'descripcion' => 'Transradial Biónica Ossur'],
      ['servicios_id' => 1, 'descripcion' => 'Transradial Biónica Oymotion'],
      ['servicios_id' => 1, 'descripcion' => 'Interescápulo Torácico pasivo con guante cosmético'],
      ['servicios_id' => 1, 'descripcion' => 'Desarticulado de hombro pasivo con guante cosmético'],

      ['servicios_id' => 2, 'descripcion' => 'Prótesis Transfemoral'],
      ['servicios_id' => 2, 'descripcion' => 'Prótesis Transtibial'],
      ['servicios_id' => 2, 'descripcion' => 'Prótesis de Desarticulado de Cadera'],
      ['servicios_id' => 2, 'descripcion' => 'Prótesis Chopart'],
      ['servicios_id' => 2, 'descripcion' => 'Prótesis Linsfrack'],
      ['servicios_id' => 2, 'descripcion' => 'Metatarsal'],
      ['servicios_id' => 2, 'descripcion' => 'Prótesis de Desarticulado de Rodilla'],
      ['servicios_id' => 2, 'descripcion' => 'Prótesis Syme'],
      ['servicios_id' => 2, 'descripcion' => 'Bilateral Transtibial'],
      ['servicios_id' => 2, 'descripcion' => 'Bilateral Transfemoral'],

      ['servicios_id' => 3, 'descripcion' => 'Parte Corporal'],
      ['servicios_id' => 3, 'descripcion' => 'Microtia Tipo 1 y 2'],
      ['servicios_id' => 3, 'descripcion' => 'Microtia Tipo 3 y 4'],
      ['servicios_id' => 3, 'descripcion' => 'Mano Parcial Estética'],
      ['servicios_id' => 3, 'descripcion' => 'Falange Estética de Pie'],
      ['servicios_id' => 3, 'descripcion' => 'Falange Total'],
      ['servicios_id' => 3, 'descripcion' => 'Falange Parcial'],
      ['servicios_id' => 3, 'descripcion' => 'Mitón de Pie Estético'],
      ['servicios_id' => 3, 'descripcion' => 'Prótesis de Mamas'],
      ['servicios_id' => 3, 'descripcion' => 'Mano Completa Estética'],

      ['servicios_id' => 4, 'descripcion' => 'Liners'],
      ['servicios_id' => 4, 'descripcion' => 'Rodilleras'],
      ['servicios_id' => 4, 'descripcion' => 'Pie Multiaxial'],
      ['servicios_id' => 4, 'descripcion' => 'Correa Lanyard'],
      ['servicios_id' => 4, 'descripcion' => 'Accesorios Lanyard'],
      ['servicios_id' => 4, 'descripcion' => 'Accesorios Transfemoral'],
      ['servicios_id' => 4, 'descripcion' => 'Accesorios Transtibial'],
      ['servicios_id' => 4, 'descripcion' => 'Sujetadores de Correa'],
      ['servicios_id' => 4, 'descripcion' => 'Medias de Compresión'],
      ['servicios_id' => 4, 'descripcion' => 'Covers 3D'],
      ['servicios_id' => 4, 'descripcion' => 'Lockers'],
      ['servicios_id' => 4, 'descripcion' => 'Pegamento PROS-AID'],
      ['servicios_id' => 4, 'descripcion' => 'Pegamento KRYOLAN'],

      ['servicios_id' => 6, 'descripcion' => 'Socket Transfemoral'],
      ['servicios_id' => 6, 'descripcion' => 'Socket Transtibial'],

      ['servicios_id' => 7, 'descripcion' => 'AFO'],

      ['servicios_id' => 8, 'descripcion' => 'Proyectos'],
    ];

    $this->db->table('jobs')->insertBatch($jobs);
  }
}
