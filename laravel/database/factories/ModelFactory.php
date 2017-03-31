<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'lastLogin' => $faker->dateTimeThisMonth,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'gender' => $faker->randomElement($array = array ('male','female', 'not applicable')) ,
        'birthdate' => $faker->dateTimeThisCentury,
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Admin::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
    ];
});
$factory->define(App\Models\Votemanager::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
    ];
});
$factory->define(App\Models\Voter::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
$factory->define(App\Models\Party::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
$factory->define(App\Models\Candidate::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },

        'party_id' => random_int(
            \DB::table('parties')
                ->min('id'),
            \DB::table('parties')
                ->max('id')),
    ];

});
$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
$factory->define(App\Models\Election::class, function (Faker\Generator $faker) {
    static $password;
    $startDate = $faker->dateTimeThisYear;
    $endDate = $faker->dateTimeBetween($startDate, "+1 month");
    $currentState = false;
    if($endDate > date('Y-m-d H:i:s') && $startDate < date('Y-m-d H:i:s')){
        $currentState = true;
    }

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'isClosed' => $currentState,
        //todo proper foreign keys
        'group_id' => random_int(
            \DB::table('groups')
                ->min('id'),
            \DB::table('groups')
                ->max('id')),

        'votemanager_id' => random_int(
            \DB::table('votemanagers')
                ->min('id'),
            \DB::table('votemanagers')
                ->max('id')),
    ];
});
$factory->define(App\Models\Candidate_election::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'score' =>  mt_rand(0.00, 5000.00),

        //todo proper foreign keys
        'candidate_id' => "1",
        'election_id' => "1",
    ];
});
$factory->define(App\Models\Referendum::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'published' => $faker->dateTimeThisYear,

        //todo proper foreign keys
        'candidate_id' => random_int(
            \DB::table('candidates')
                ->min('id'),
            \DB::table('candidates')
                ->max('id')),

        'group_id' => random_int(
            \DB::table('groups')
                ->min('id'),
            \DB::table('groups')
                ->max('id')),

        'votemanager_id' => random_int(
            \DB::table('votemanagers')
                ->min('id'),
            \DB::table('votemanagers')
                ->max('id')),

    ];
});
$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
$factory->define(App\Models\Vote::class, function (Faker\Generator $faker) {
    return [
        'voteType' => $faker->boolean(50),
        'hashCode' => bcrypt($faker->word),

        //todo proper foreign keys
        'CandidateElection_id' => "1",
        'voter_id' => random_int(
            \DB::table('voters')
                ->min('id'),
            \DB::table('voters')
                ->max('id')),
    ];
});
$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,

        //todo proper foreign keys
        'user_id' => random_int(
            \DB::table('users')
                ->min('id'),
            \DB::table('users')
                ->max('id')),

        'group_id' => random_int(
            \DB::table('groups')
                ->min('id'),
            \DB::table('groups')
                ->max('id')),

        'category_id' => random_int(
            \DB::table('categories')
                ->min('id'),
            \DB::table('categories')
                ->max('id')),
    ];
});