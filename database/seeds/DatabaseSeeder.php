<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // factory(App\Models\Entreprise::class, 17)->create()->each(function ($entreprise) {
        //     $i = rand(2, 8);
        //     while (--$i) {
        //         $entreprise->employes()->save(factory(App\Models\Employe::class)->make());
        //     }
        // });


        // factory(App\Models\Employe::class, 50)->create();

    }
}
