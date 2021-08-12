<?php

/* @var $this yii\web\View */
/* @var $model app\models\Review */


use app\models\City;
use app\models\Review;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = 'My Yii Application';

$session = Yii::$app->session;
$session->open();

if (!$session['city'] and !Yii::$app->request->post('choose'))
{
        Modal::begin([
        'clientOptions' => ['show' => 'true'],
        'header' => '<h2>Это ваш город?</h2>',
        'toggleButton' => [
            'label' => 'Выбрать город',
            'id' => 'modal',
            'class' => 'btn btn-success',
            ],
        ]);
        echo City::getCity();
        ?>
    <?= Html::beginForm(['site/catcher'], 'post'); ?>
    <?= Html::submitInput('Да' , ['class' => 'btn btn-success', 'name' => 'submit']); ?>
    <?= Html::submitInput('Нет' , ['class' => 'btn btn-danger', 'name' => 'reject']); ?>
    <?= Html::endForm(); ?>
<?php
        Modal::end();
}
else  {
    $city = City::findOne(['name' => $session['city']]);
    $reviews = Review::find()->all();

    foreach ($reviews as $review)
    {
        //kazan 15, yaroslavl 16
       $city_id = explode(',', $review->city_id);
        if (in_array($city['id'], $city_id))
        {
            echo $review->title;
            echo '<hr>';
        }
        else
            {

        }
    }
}
?>
