<?php

class BasicCest
{
    /**
     * Check application status
     *
     * @param FunctionalTester $I
     */
    public function testStatus(\FunctionalTester $I)
    {
        $I->amGoingTo('check status');
        $I->sendGET('/status');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'status' => 'ok',
        ]);
    }
}
