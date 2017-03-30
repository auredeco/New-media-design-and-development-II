<?php

use Illuminate\Database\Seeder;

class ReferendumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Referendum::class, 20)->create();

    }
}
