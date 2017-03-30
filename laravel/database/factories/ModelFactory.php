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
//        'user_id' => function () {
//            return factory(App\User::class)->create()->id;
//        }
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
//        'user_id' => function () {
//            return factory(App\User::class)->create()->id;
//        },
//        'party_id' => function () {
//            return factory(App\Models\Party::class)->create()->id;
//        }
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
    if($endDate > date() && $startDate < date()){
        $currentState = true;
    }

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'isClosed' => $currentState,

//        'group_id' => function () {
//            return factory(App\Models\Group::class)->create()->id;
//        },
//        'votemanager_id' => function () {
//            return factory(App\Models\Votemanager::class)->create()->id;
//        },

    ];
});
$factory->define(App\Models\Candidate_election::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'score' =>  mt_rand(0.00, 5000.00),

//        'candidate_id' => function () {
//            return factory(App\Models\Candidate::class)->create()->id;
//        },
//         'election_id' => function () {
//            return factory(App\Models\Election::class)->create()->id;
//        },
    ];
});
$factory->define(App\Models\Referendum::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'title' => $faker->title,
        'description' => $faker->sentence,
        'published' => $faker->dateTimeThisYear,

//        'candidate_id' => function () {
//            return factory(App\Models\Candidate::class)->create()->id;
//        },
//         'group_id' => function () {
//            return factory(App\Models\Group::class)->create()->id;
//        },
    ];
});
$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->word,
    ];
});
$factory->define(App\Models\Vote::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'voteType' => $faker->randomElements(false, true),
        'hashCode' => $faker->word,

//        'CandidateElection_id' => function () {
//            return factory(App\Models\Candidate_election::class)->create()->id;
//        },
//         'voter_id' => function () {
//            return factory(App\Models\Voter::class)->create()->id;
//        },
    ];
});
$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->word,
    ];
});
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'title' => $faker->title,
        'description' => $faker->sentence,

//        'user_id' => function () {
//            return factory(App\Models\User::class)->create()->id;
//        },
//         'group_id' => function () {
//            return factory(App\Models\Group::class)->create()->id;
//        },
//         'category_id' => function () {
//            return factory(App\Models\Category::class)->create()->id;
//        },
    ];
});
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    static $password;

    return [
//        'user_id' => function () {
//            return factory(App\Models\User::class)->create()->id;
//        },
//         'group_id' => function () {
//             return factory(App\Models\Group::class)->create()->id;
//         }
    ];
});
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    static $password;

    return [
//        'post_id' => function () {
//            return factory(App\Models\Post::class)->create()->id;
//        },
//         'tag_id' => function () {
//             return factory(App\Models\Tag::class)->create()->id;
//         }
    ];
});