<?php

namespace tests\unit\models;

use app\models\UserTemplate;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = UserTemplate::findIdentity(100));
        expect($user->username)->equals('admin');

        expect_not(UserTemplate::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = UserTemplate::findIdentityByAccessToken('100-token'));
        expect($user->username)->equals('admin');

        expect_not(UserTemplate::findIdentityByAccessToken('non-existing'));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = UserTemplate::findByUsername('admin'));
        expect_not(UserTemplate::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = UserTemplate::findByUsername('admin');
        expect_that($user->validateAuthKey('test100key'));
        expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('123456'));        
    }

}
