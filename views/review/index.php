<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'city_id',
            'title',
            'text:ntext',
            'rating',
            [
                'format' => 'html',
                'label' => 'image',
                'value' => function ($data) {
                return Html::img($data->getImage(), ['width' => 200]);
                }
            ],
            //'img',
            //'author_id',
            //'creation_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
