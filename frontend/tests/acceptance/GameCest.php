<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class GameCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/game/index'));
        $I->see('Math Game');

        $I->seeLink('Game');
        $I->click('Game');
        $I->wait(2); // wait for page to be opened
        
    }
}
