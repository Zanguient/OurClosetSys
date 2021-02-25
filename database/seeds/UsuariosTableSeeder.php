<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Usuario::create([
            'nome' => 'Airton',
            'email' => 'airtonmrfilho@gmail.com',
            'status' => 'ATIVO',
            'password' => bcrypt('senha123')
        ]);

    }
}
