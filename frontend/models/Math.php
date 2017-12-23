<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "math".
 * @property integer $a
 * @property integer $b
 * @property string $task
 * @property integer $result
 */
class Math extends \yii\db\ActiveRecord
{

    /**
     * @var int
     */
    public $a;
    /**
     * @var int
     */
    public $b;
    /**
     * @var string
     */
    public $operation;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'math';
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                'operation' => ['a', 'b'],
                'result' => ['task', 'result', 'answer', 'ip', 'unique_id'],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task', 'result', 'ip', 'unique_id'], 'required'],
            [['task', 'operation', 'ip', 'unique_id'], 'string'],
            [['result', 'answer'], 'number'],
            [['a', 'b'], 'integer'],
        ];
    }

    /**
     * Making adding operation
     * @param int $a
     * @param int $b
     * @param float $answer
     * @return int|null
     * @throws \yii\base\ErrorException
     */
    public function add($a = null, $b = null, $answer = null) //I do not expect null or empty value to be passed in
    {
        if (!is_null($a)) {
            $this->a = $a;
        }
        if (!is_null($b)) {
            $this->b = $b;
        }
        $this->setScenario('operation');
        if (!$this->validate()) {
            throw new \yii\base\ErrorException(var_export($this->getErrors(), true));
        }
        $this->operation = '+';
        $this->result = $this->a + $this->b;
        $this->answer = $answer;
        if ($this->save()) {
            return $this->result;
        }
        return null;
    }

    /**
     * Making subtraction operation
     * @param int $a
     * @param int $b
     * @param float $answer
     * @return int|null
     * @throws \yii\base\ErrorException
     */
    public function sub($a = null, $b = null, $answer = null)
    {
        if (!is_null($a)) {
            $this->a = $a;
        }
        if (!is_null($b)) {
            $this->b = $b;
        }
        $this->setScenario('operation');
        if (!$this->validate()) {
            throw new \yii\base\ErrorException(var_export($this->getErrors(), true));
        }
        $this->operation = '-';
        $this->result = $this->a - $this->b;
        $this->answer = $answer;
        if ($this->save()) {
            return $this->result;
        }
        return null;
    }

    /**
     * Making preparements before save to db
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->setScenario('result');
            $this->task = $this->a . $this->operation . $this->b;
            $this->ip = \Yii::$app->request->getUserIP();
            $this->unique_id = \Yii::$app->session->has('unique_id')? \Yii::$app->session->get('unique_id'):'';
            return true;//I had to add return so that the function will be passed
        }
        return false;
    }
    
}
