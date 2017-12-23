<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class GameCest
{
    protected $formId = '#play-game';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('game/index');
    }

}
