<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$faker = Faker\Factory::create();

// get status of application
$app->get('/status', function () use ($app) {
    return $app->json(['status' => 'ok']);
});

// get list of transactions
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

// get list of users
$app->get('/users', function () use ($app, $faker) {
    $data = [];

    for ($i = 0; $i < 5; ++$i) {
        $data[] = [
            'user' => $faker->email,
            'name' => $faker->name,
            'last_login' => $faker->date,
            'user_agent' => $faker->userAgent
        ];
    }

    return $app->json($data);
});

$app->run();
