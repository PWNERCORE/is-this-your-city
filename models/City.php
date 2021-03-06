<?php

namespace app\models;

use Dadata\DadataClient;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $creation_date
 *
 * @property Review[] $reviews
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_date'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' =>
                    [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['creation_date'],
                    ],
                'value' => new Expression('UNIX_TIMESTAMP(NOW())'),
            ],
        ];
    }

        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['city_id' => 'id']);
    }
}
