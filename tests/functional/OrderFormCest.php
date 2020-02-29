<?php

class OrderFormCest
{
    // public function _before(\FunctionalTester $I)
    // {
    //     $I->amOnRoute('order/create');
    // }

    public function openIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('order/index');
        $I->see('Add an Order', 'h6');
        // $I->see('Existing Order', 'h16');
        // $I->see('Map', 'h16');
    }

    // // demonstrates `amLoggedInAs` method
    // public function internalLoginById(\FunctionalTester $I)
    // {
    //     $I->amLoggedInAs(100);
    //     $I->amOnPage('/');
    //     $I->see('Logout (admin)');
    // }

    // // demonstrates `amLoggedInAs` method
    // public function internalLoginByInstance(\FunctionalTester $I)
    // {
    //     $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    //     $I->amOnPage('/');
    //     $I->see('Logout (admin)');
    // }

    // public function submitOrderWithEmptyCredentials(\FunctionalTester $I)
    // {
    //     $I->amOnRoute('order/create');
    //     $I->submitForm('#myForm', []);
    //     $I->expectTo('see validations errors');
    // }

    public function submitOrderWithCorrectCredentials(\FunctionalTester $I)
    {
        // $I->amOnRoute('order/create');
        // $I->submitForm('#myForm', [
        //     '_csrf' => Yii::$app->request->getCsrfToken(),
        //     'OrderForm[first_name]' => 'Test',
        //     'last_name' => 'Doe',
        //     'email' => "u@sample.com",
        //     'order_type_id' => 1,
        //     'country_id' => 1,
        //     'phone_number' => '08132186779',
        //     'order_value' => '30000',
        //     'scheduled_date' => '21/08/2020',
        //     'address' => '3 Akinsola street',
        //     'city' => 'Illasamaja',
        //     'state' => 'Lagos',
        //     'zip_code' => '23401',
        //     'lat' => '52.08',
        //     'lng' => '-0.07'
        // ]);
        // $I->expectTo('see validations errors');
    }

    public function testActionView(\FunctionalTester $I)
    {
        // $I->amOnRoute('order/view/1');

        // var_dump($R); die;
    }

    // public function loginWithWrongCredentials(\FunctionalTester $I)
    // {
    //     $I->submitForm('#login-form', [
    //         'LoginForm[username]' => 'admin',
    //         'LoginForm[password]' => 'wrong',
    //     ]);
    //     $I->expectTo('see validations errors');
    //     $I->see('Incorrect username or password.');
    // }

    // public function loginSuccessfully(\FunctionalTester $I)
    // {
    //     $I->submitForm('#login-form', [
    //         'LoginForm[username]' => 'admin',
    //         'LoginForm[password]' => 'admin',
    //     ]);
    //     $I->see('Logout (admin)');
    //     $I->dontSeeElement('form#login-form');              
    // }
}