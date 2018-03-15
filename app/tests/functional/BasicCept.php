<?php

/** @var Codeception\Scenario $scenario */
$I = new FunctionalTester($scenario);

$I->amGoingTo('check status');
$I->sendGET('/status');

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([
    'status' => 'ok',
]);
