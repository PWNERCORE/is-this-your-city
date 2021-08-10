<?php

namespace app\models;

use Dadata\DadataClient;
use Yii;

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

    public static function getCity() {
        $token = "4ffe29813ad9f908905e230f3f1b9ea7f96a476b";
        $secret = "ef2b8c507125f23231f71dfca6f42bfcef0e40a8";
        $dadata = new DadataClient($token, $secret);
        //$response = $api->iplocate(Yii::$app->getRequest()->getUserIP());
        $response = $dadata->iplocate('46.226.227.20');
        return $response['value'];
    }

    public static function inputCity($input) {
        $token = "4ffe29813ad9f908905e230f3f1b9ea7f96a476b";
        $secret = "ef2b8c507125f23231f71dfca6f42bfcef0e40a8";
        $dadata = new DadataClient($token, $secret);
        $result = $dadata->suggest("address", $input);
        if (is_integer($input)) {
            return $input;
        }
        else {
            $echo = $result['0'];
            $echo = $echo['data'];
            return $echo['city'];
        }
    }
}
