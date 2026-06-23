<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            ['name' => 'Carlos Monsalve', 'email' => 'carlos@ecopiscis.com', 'rol' => 'administrador', 'telefono' => '3001234567'],
            ['name' => 'María López', 'email' => 'maria@ecopiscis.com', 'rol' => 'administrador', 'telefono' => '3002345678'],
            ['name' => 'Juan Pérez', 'email' => 'juan@ecopiscis.com', 'rol' => 'administrador', 'telefono' => '3003456789'],
            ['name' => 'Pedro Ramírez', 'email' => 'pedro@ecopiscis.com', 'rol' => 'trabajador', 'telefono' => '3004567890'],
            ['name' => 'Ana Gómez', 'email' => 'ana@ecopiscis.com', 'rol' => 'trabajador', 'telefono' => '3005678901'],
            ['name' => 'Luis Torres', 'email' => 'luis@ecopiscis.com', 'rol' => 'trabajador', 'telefono' => '3006789012'],
            ['name' => 'Sofía Rincón', 'email' => 'sofia@ecopiscis.com', 'rol' => 'trabajador', 'telefono' => '3007890123'],
            ['name' => 'Diego Castro', 'email' => 'diego@ecopiscis.com', 'rol' => 'trabajador', 'telefono' => '3008901234'],
        ];

        foreach ($users as $user) {
            User::create(array_merge($user, [
                'password' => $password,
                'status' => 'activo',
            ]));
        }

        $this->command->info('8 usuarios creados correctamente.');
    }
}
