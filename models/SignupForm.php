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
        [['email', 'fio', 'phone', 'password'], 'required', 'message' => 'Заполните поле'],
        ['password_repeat', 'required'],
        [['email'], 'email'],
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