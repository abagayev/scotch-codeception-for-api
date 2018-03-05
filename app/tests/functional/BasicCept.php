<?php

/** @var Codeception\Scenario $scenario */
$I = new FunctionalTester($scenario);

$I->sendGET('/status');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();



