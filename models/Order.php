<?php

namespace app\models;

class Order extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('first_name, phone_number, order_type_id, scheduled_date, address, city, state, country_id', 'required'),
            array('email','email')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order_types' => array(self::HAS_MANY, 'OrderType', 'order_type_id'),
            'country' => array(self::HAS_MANY, 'Country', 'country_id'),
        );
    }
}