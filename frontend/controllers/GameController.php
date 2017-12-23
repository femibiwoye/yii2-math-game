<?php
namespace frontend\controllers;

use frontend\models\Math;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class GameController extends Controller
{

    /**
     * Take examination
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session; // Start session to variable

        $answer = Yii::$app->request->post('answer'); // Save posted answer to variable
        $result = false; // Hides the result by default
        
        // Check if exam counter is active
        if(!isset($session['counter'])){
            $session['counter'] = 0;
            $session['unique_id'] = time().mt_rand(10,99); // Unique ID is generated per exam
        }

        // Check if provided answer is not null
        if (!is_null($answer)) {
            $model = new Math();
            $a = $session->get('a');
            $b = $session->get('b');

            // check if operator is + or - and choose appropriate function
            if ($correctAnswer = $session->get('operator') == '+' ? $model->add($a, $b, $answer) : $model->sub($a, $b, $answer)) {
                // Result to be displayed after submission of answer
                $response = $a . ' ' . $session->get('operator') . ' ' . $b.' = '.$correctAnswer;

                // Answer response message. Correct or incorrect
                if ($correctAnswer == $answer)
                    $correctAnswer = $response . ' <i class="fa fa-check"></i> Correct';
                else
                    $correctAnswer = $response . ' <i class="fa fa-times"></i> Incorrect';

                $result = true;
            }

            // Cut and paste line 52 to 56 here if you want counter to increment on when user submit answer
        }
        // Increment question counter
        $session['counter'] = $session['counter'] + 1;
        if($session['counter'] > 5){ // Redirect to result page if counter is upto 5
            return $this->redirect(['result','id'=>$session->get('unique_id')]);
        }

        $session['a'] = $a = mt_rand(1, 99); //$a: This is the first number and it is randomly generated
        $session['b'] = $b = mt_rand(1, 99); //$b: This is the second number and it is randomly generated
        $session['operator'] = $operator = ['+', '-'][rand(0, 1)]; //Randomise between + and -

        return $this->render('index', [
            'a' => $session['a'],
            'b' => $session['b'],
            'operator' => $session['operator'],
            'result' => $result,
            'correctAnswer' => !empty($correctAnswer) ? $correctAnswer : ''
        ]);
    }

    /**
     * View exam result using exam unique id
     * @param integer $id
     * @return mixed
     */
    public function actionResult($id)
    {
        $session = Yii::$app->session; // Start session

        $dataProvider = new ActiveDataProvider([
            'query' => Math::find()->where(['unique_id'=>$id]),
            'pagination' => ['pageSize' => 20]
        ]);

        // Remove counter and exam unique ID session
        $session->remove('counter');
        $session->remove('unique_id');

        return $this->render('lists',['dataProvider'=>$dataProvider]);
    }

}
