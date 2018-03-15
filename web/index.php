<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$faker = Faker\Factory::create();


/**
 * Get status of application (just return ok)
 */
$app->get('/status', function () use ($app) {
    return $app->json(['status' => 'ok']);
});


/**
 * Create the list of fake transactions
 */
$app->get('/transactions', function () use ($app, $faker) {
    $data = [];

    for ($i = 0; $i < 5; ++$i) {
        $data[] = [
            'id' => $faker->randomNumber,
            'amount' => $faker->randomFloat(2, 100, 999),
            'currency' => $faker->currencyCode,
            'credit_card' => $faker->creditCardNumber,
        ];
    }

    return $app->json($data);
});


/**
 * Generate list of fake users
 */
$app->get('/users', function () use ($app, $faker) {
    $data = [];

    for ($i = 0; $i < 5; ++$i) {
        $data[] = [
            'id' => $faker->randomNumber,
            'name' => $faker->name,
        ];
    }

    return $app->json($data);
});


/**
 * Generate fake user profile
 */
$app->get('/users/{id}', function ($id) use ($app, $faker) {
    $data = [
        'id' => (int)$id,
        'name' => $faker->name,
        'email' => $faker->email,
        'last_login' => $faker->date,
        'user_agent' => $faker->userAgent
    ];

    return $app->json($data);
});


$app->run();
