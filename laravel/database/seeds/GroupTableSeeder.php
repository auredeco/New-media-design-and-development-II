<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Group::class, 10)->create();

        foreach(range(1, 10) as $index) {
            DB::table('group_users')->insert([
                'user_id' => random_int(
                    \DB::table('users')
                        ->min('id'),
                    \DB::table('users')
                        ->max('id')),
                'group_id' => random_int(
                    \DB::table('groups')
                        ->min('id'),
                    \DB::table('groups')
                        ->max('id'))
            ]);
        }
    }
}
