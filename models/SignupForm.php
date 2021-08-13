<?php
namespace app\models;
use yii\base\Model;

class SignupForm extends Model
{

public $email;
public $fio;
public $phone;
public $password;
public $password_repeat;

public function rules()
{
    return [
        [['email', 'fio', 'phone', 'password', 'password_repeat'], 'required', 'message' => 'Заполните поле'],
        [['email'], 'email'],
        ['email', 'unique', 'targetClass' => User::className(),  'message' => 'Этот email уже занят'],
        ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
    ];
}

public function attributeLabels()
{
    return [
        'email' => 'Email',
        'fio' => 'ФИО',
        'phone' => 'Телефон',
        'password' => 'Пароль',
        'password_repeat' => 'Повторите пароль'
    ];
}

}