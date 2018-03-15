<?php

class UsersCest
{
    /**
     * Call for the list of users and then test each user
     *
     * @param FunctionalTester $I
     * @throws Exception
     */
    public function testList(\FunctionalTester $I)
    {
        $I->amGoingTo('check the list of users');
        $I->sendGET('/users');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'name' => 'string',
        ]);

        // now let's check each item
        $ids = $I->grabDataFromResponseByJsonPath('$..id');
        foreach ($ids as $id) {
            $this->testItem($I, $id);
        }
    }

    /**
     * Test item from users list:
     *
     * - check common fields with codeception format
     * - check last login date with custom unit tests
     *
     * @param FunctionalTester $I
     * @param int $id
     * @throws Exception
     */
    private function testItem(\FunctionalTester $I, int $id)
    {
        $I->amGoingTo("test user #{$id}");
        $I->sendGET("/users/{$id}");

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'name' => 'string',
            'email' => 'string:email',
        ]);

        $lastLogin = $I->grabDataFromResponseByJsonPath('$.last_login')[0];
        $this->testLoginDate($lastLogin);
    }

    /**
     * Create DateTime object from API response and check it with PHPUnit:
     *
     * - date is properly formatted
     * - date is earlier than now
     *
     * @param string $source
     */
    private function testLoginDate(string $source)
    {
        $now = new DateTime();
        $date = DateTime::createFromFormat('Y-m-d', $source);

        PHPUnit\Framework\Assert::assertNotFalse($date);
        PHPUnit\Framework\Assert::assertLessThan($now, $date);
    }
}
