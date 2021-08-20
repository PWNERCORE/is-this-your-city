<?php

use app\models\City;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $model app\models\City */
/* @var $this \yii\web\View */

class Catcher extends City
{
    public static function handler()
    {
        $request = Yii::$app->request;
        if ($request->post('submit'))
        {
            $session = Yii::$app->session;
            $session->open();
            $session->set('city', Yii::$app->geolocation->getCity());
            Yii::$app->response->redirect('index');


        }
        elseif ($request->post('reject'))
        {

            ?>
    <?= Html::beginForm(['site/catcher'], 'post'); ?>
    <?= Html::label('Выберите город'); ?>
    <?= Html::dropDownList('city', 'name' , ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Выберите город']); ?>
    <?= Html::submitInput('Выбрать' , ['class' => 'btn btn-danger', 'name' => 'choose']); ?>
    <?= Html::endForm(); ?><?php

        }
        elseif($request->post('choose'))
        {
            $id = $request->post('city');
            $city = City::findOne($id);
            $session = Yii::$app->session;
            $session->open();
            $session->set('city', $city['name']);
            Yii::$app->response->redirect('index');
        }
        else {
            Yii::$app->response->redirect('index');
        }

    }
}
Catcher::handler();
