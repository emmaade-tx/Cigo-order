<?php

namespace tests\unit\models;

use app\models\Order;

class OrderTest extends \Codeception\Test\Unit
{
    public function testFindOrderById()
    {
        expect_that($order = Order::findIdentity(1));
        expect($order->first_name)->equals('Ademola');

        expect_not(Order::findIdentity(1000));
    }

    // public function testFindUserByAccessToken()
    // {
    //     expect_that($user = User::findIdentityByAccessToken('100-token'));
    //     expect($user->username)->equals('admin');

    //     expect_not(User::findIdentityByAccessToken('non-existing'));        
    // }

    // public function testFindUserByUsername()
    // {
    //     expect_that($user = User::findByUsername('admin'));
    //     expect_not(User::findByUsername('not-admin'));
    // }

    // /**
    //  * @depends testFindUserByUsername
    //  */
    // public function testValidateUser($user)
    // {
    //     $user = User::findByUsername('admin');
    //     expect_that($user->validateAuthKey('test100key'));
    //     expect_not($user->validateAuthKey('test102key'));

    //     expect_that($user->validatePassword('admin'));
    //     expect_not($user->validatePassword('123456'));        
    // }

}
