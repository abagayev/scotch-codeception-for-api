<?php

class TransactionsCest
{
    /**
     * Check list of transactions and see if response matches given types:
     *
     * - id is integer
     * - amount is float more than 99 nad less than 1000
     * - currency is string
     * - credit card ends with 4 digits
     *
     * @param FunctionalTester $I
     */
    public function testList(\FunctionalTester $I)
    {
        $I->amGoingTo('check list of transactions');
        $I->sendGET('/transactions');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'amount' => 'integer|float:>99:<1000',
            'currency' => 'string',
            'credit_card' => 'string:regex(~[0-9]$~)',
        ]);
    }
}
