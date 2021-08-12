<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

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
            [['author_id', 'creation_date'], 'integer'],
            [['text'], 'string'],
            [['rating'], 'in', 'range' => [1, 2, 3, 4, 5]],
            [['title', 'img'], 'string', 'max' => 255],
            [['city_id'],'safe']
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
            'city_id' => 'City ID',
            'title' => 'Title',
            'text' => 'Text',
            'rating' => 'Rating',
            'img' => 'Img',
            'author_id' => 'Author ID',
            'creation_date' => 'Creation Date',
        ];
    }

    public function uploadFile(UploadedFile $file)
    {
        $filename = uniqid() . $file->name;
        $file->saveAs(Yii::getAlias('@web') . 'uploads/' . $filename);
        return $filename;
    }

    public function saveImage ($image) {
        $this->img = $image;
        return $this->save(false);
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
