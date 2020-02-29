<?php 

class OrderTestCest
{
    public function _before(ApiTester $I)
    {

    }

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendPOST('/create', [
            '_csrf' => Yii::$app->request->getCsrfToken(),
            'first_name' => 'Test',
            'last_name' => 'Doe',
            'email' => "u@sample.com",
            'order_type_id' => 1,
            'country_id' => 1,
            'phone_number' => '08132186779',
            'order_value' => '30000',
            'scheduled_date' => '21/08/2020',
            'address' => '3 Akinsola street',
            'city' => 'Illasamaja',
            'state' => 'Lagos',
            'zip_code' => '23401',
            'lat' => '52.08',
            'lng' => '-0.07'
        ]);
    }
}
