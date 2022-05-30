<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void {
        $this->call(InitialSeeder::class);
        $this->call(EventosSeeder::class);
        $this->call(AtividadesSeeder::class);
        $this->call(ApresentadoresSeeder::class);
        $this->call(ParticipanteAtividadesSeeder::class);
        $this->call(ImagensSeeder::class);

    }
}
