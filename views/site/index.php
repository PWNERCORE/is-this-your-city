<?php

/* @var $this yii\web\View */
/* @var $model app\models\City */


use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use app\models\City;

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
    print_r($session['city']);
}
?>
