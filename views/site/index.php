<?php

/* @var $this yii\web\View */
/* @var $model app\models\Review */


use app\models\City;
use app\models\Review;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
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
            'id' => 'city',
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
else
    {
        $city = City::findOne(['name' => $session['city']]);
        $reviews = Review::find()->all();
        if (Yii::$app->user->isGuest)
        {
            echo 'Вы не авторизированны';
        }
        else
            {
                foreach ($reviews as $review)
                {
                    $user = User::findOne(['id' => $review->author_id]);
                    $city_id = explode(',', $review->city_id);
                    if (in_array($city['id'], $city_id))
                    {
                        echo '<p><h2>' . $review->title . '</h2></p>';
                        echo '<p><h4>' . $review->text . '</h4></p>';
                        echo '<p>' . Html::img($review->getImage(), ['width' => 200]) . '</p>';

                        Modal::begin([
                            'header' => '<h2>Подробнее</h2>',
                            'toggleButton' => [
                                'label' => $user->fio,
                                'id' => 'review',
                                'class' => 'btn btn-link',
                            ],
                        ]);
                        echo $user->email . '<br>' . $user->phone . '<br>';
                        echo Html::a('Все отзывы', ['review/index?ReviewSearch%5Bauthor_id%5D=' . $review->author_id]);
                        Modal::end();
                        echo '<hr>';
                    }
                }
    }
}
?>
