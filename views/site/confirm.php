<?php

/* @var $this \yii\web\View */

use app\models\User;

/* @var $model app\models\User */

class Confirm
{
    public function confirmEmail()
    {
        $token = Yii::$app->request->get('token');
        User::findOne(['token' => $token]);
        Yii::$app->db->createCommand()->update('user', ['status' => 1], ['token' => $token])->execute();
        Yii::$app->db->createCommand()->update('user', ['token' => 0], ['token' => $token])->execute();
        Yii::$app->session->setFlash('confirm', 'Email успешно поддтвержден!');
        Yii::$app->response->redirect('site/login');
    }
}
(new Confirm)->confirmEmail();