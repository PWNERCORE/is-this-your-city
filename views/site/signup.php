<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model app\models\SignupForm */

?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email')->label('Email') ?>
<?= $form->field($model, 'fio')->label('ФИО') ?>
<?= $form->field($model, 'phone')->label('Телефон') ?>
<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'password_repeat')->passwordInput()->label('Повторите пароль') ?>
    <div class="form-group">
        <div>
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>