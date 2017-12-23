<?php
namespace frontend\tests\unit\models;

use Yii;
use frontend\models\Math;

class MathTest extends \Codeception\Test\Unit
{
    public function testAdd()
    {
        Math::add(2,3,5);
    }

    public function testSub()
    {
        Math::sub(6,3,3);
    }
}
