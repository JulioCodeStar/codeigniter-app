<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ComponentListSeeder extends Seeder
{
    public function run()
    {
        $component_list = [

          /* TRANSFEMORAL */
          [ 'component_id' => 1, 'items' => 'Fibra de Vidrio' ],
          [ 'component_id' => 1, 'items' => 'Fibra de Carbono' ],
          [ 'component_id' => 1, 'items' => 'Endosocket Proteor' ],

          [ 'component_id' => 2, 'items' => 'Isquión contenido' ],
          [ 'component_id' => 2, 'items' => 'Cuadrilateral' ],
          [ 'component_id' => 2, 'items' => 'Contención Ramal' ],
          [ 'component_id' => 2, 'items' => 'Infraisquiático' ],
          
          [ 'component_id' => 3, 'items' => 'Lineal __ ___ Adaptador' ],
          [ 'component_id' => 3, 'items' => 'Cónica __ ___ Adaptador' ],

          [ 'component_id' => 4, 'items' => 'K1 (baja movilidad)' ], 
          [ 'component_id' => 4, 'items' => 'K2 (media movilidad)' ], 
          [ 'component_id' => 4, 'items' => 'K3 (alta movilidad)' ], 
          
          [ 'component_id' => 6, 'items' => 'Sujeción Lanyard' ], 
          [ 'component_id' => 6, 'items' => 'Locker Pin' ], 
          [ 'component_id' => 6, 'items' => 'Sujeción Revofit' ], 
          [ 'component_id' => 6, 'items' => 'ORing de Silicona' ], 

          [ 'component_id' => 8, 'items' => 'Mecánica Win Walker' ], 
          [ 'component_id' => 8, 'items' => 'Mecánica Össur' ], 
          [ 'component_id' => 8, 'items' => 'Mecánica LIMP' ], 
          [ 'component_id' => 8, 'items' => 'Geriátrica LIMP' ], 
          [ 'component_id' => 8, 'items' => 'Hidráulica Ottobock' ], 
          [ 'component_id' => 8, 'items' => 'Hidráulica Össur' ], 
          [ 'component_id' => 8, 'items' => 'Neumática Win Walker' ], 
          [ 'component_id' => 8, 'items' => 'Neumática Össur' ], 

          [ 'component_id' => 9, 'items' => 'Fibra de Carbono' ], 
          [ 'component_id' => 9, 'items' => 'Pie Sach' ], 
          [ 'component_id' => 9, 'items' => 'Pie Multiaxial' ], 

          [ 'component_id' => 10, 'items' => 'Tobillo Alto' ], 
          [ 'component_id' => 10, 'items' => 'Tobillo Bajo' ],

          [ 'component_id' => 12, 'items' => 'Media con Funda Estética' ], 
          [ 'component_id' => 12, 'items' => 'Cover 3D' ],

          [ 'component_id' => 14, 'items' => 'Titanio' ], 
          [ 'component_id' => 14, 'items' => 'Acero Inoxidable' ], 



        ];

        $this->db->table('componentes_list')->insertBatch($component_list);
    }
}
