<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class PlayCest
{
    protected $formId = '#play-game';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('game/index');
    }

}
