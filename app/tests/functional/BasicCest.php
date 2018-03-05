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
        $I->sendGET('/status');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string:=ok',
        ]);
    }
}

