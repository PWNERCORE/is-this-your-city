<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $fio
 * @property string|null $email
 * @property int|null $phone
 * @property int|null $creation_date
 * @property string|null $password
 * @property string|null $token
 * @property int|null $status
 *
 * @property-read void $authKey
 * @property Review[] $reviews
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @var mixed|string|null
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'creation_date'], 'integer'],
            [['fio', 'email', 'password'], 'string', 'max' => 255],
            [['token', 'status'], 'safe'],
            ['email', 'unique', 'targetClass' => User::className(),  'message' => 'Этот email уже занят'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'email' => 'Email',
            'phone' => 'Phone',
            'creation_date' => 'Creation Date',
            'password' => 'Password',
            'token' => 'Token'
        ];
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return yii\db\ActiveQuery
     */

    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['author_id' => 'id']);
    }

    public static function checkStatus() {
        $loginForm = Yii::$app->request->post('LoginForm');
        $user = User::findOne(['email' => $loginForm['email']]);
        if ($user->status == 1) {
            return true;
        }
            Yii::$app->session->setFlash('status', 'Вы не подтвердили email!');
            return false;
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findByEmail($email)
    {
        return User::findOne(['email' => $email]);

    }
}
