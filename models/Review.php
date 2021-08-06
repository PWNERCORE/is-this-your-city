<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string|null $city_id
 * @property string|null $title
 * @property string|null $text
 * @property int|null $rating
 * @property string|null $img
 * @property int|null $author_id
 * @property int|null $creation_date
 *
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rating', 'author_id', 'creation_date'], 'integer'],
            [['text'], 'string'],
            [['title', 'img'], 'string', 'max' => 255],
            [['city_id'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'title' => 'Title',
            'text' => 'Text',
            'rating' => 'Rating',
            'img' => 'Img',
            'author_id' => 'Author ID',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
}
