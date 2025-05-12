<?php

namespace App\Database\Seeds;

use App\Models\PatientModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PatientSeeder extends Seeder
{
    public function run()
    {
      $faker = \Faker\Factory::create('es_ES');
      $faker->addProvider(new \Faker\Provider\es_ES\Person($faker));
      
      $model = new PatientModel();

      for ($i = 0; $i < 20; $i++) {
          $gender = $faker->randomElement(['Masculino', 'Femenino']);
          
          $data = [
              'nombres'           => $faker->firstName($gender),
              'apellidos'         => $faker->lastName . ' ' . $faker->lastName,
              'dni'               => $faker->unique()->numerify('########'),
              'genero'            => $gender,
              'edad'              => $faker->numberBetween(18, 95),
              'contacto'          => '9' . $faker->numerify('#######'),
              'fecha_nacimiento'  => $faker->dateTimeBetween('-95 years', '-18 years')->format('Y-m-d'),
              'direccion'         => $faker->streetAddress,
              'sede'              => $faker->randomElement(['Lima', 'Arequipa', 'Chiclayo']),
              'distrito'          => $faker->city,
              'email'             => $faker->unique()->safeEmail,
              'vendedor'          => $faker->name,
              'otro_contacto'    => $faker->optional(0.3)->numerify('9#######'),
              'canal'             => $faker->randomElement(['Web', 'Referencia', 'Publicidad', 'Campaña']),
              'time_ampu'         => $faker->optional(0.4)->randomElement(['<1 año', '1-5 años', '>5 años']),
              'motivo_amputacion' => $faker->optional(0.4)->sentence(6),
              'afecciones'        => $faker->optional(0.6)->text(200),
              'alergias'          => $faker->optional(0.5)->randomElement(['Penicilina', 'Aspirina', 'Ninguna', 'Mariscos']),
              'observaciones'     => $faker->optional(0.7)->paragraph(2),
              'created_at'        => Time::now(),
              'updated_at'        => Time::now()
          ];

          // Insertar usando el modelo para activar los callbacks
          $model->insert($data);
      }
    }
}
