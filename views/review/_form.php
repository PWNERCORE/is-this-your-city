<?php

use app\models\City;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php
    $data = ArrayHelper::map(City::find()->all(), 'id', 'name');
    $form = ActiveForm::begin();
    ?>
    <?= $form->field($model, 'city_id')->widget(Select2::className(),
        ['data' => $data,
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите город ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true],
        ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'creation_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
