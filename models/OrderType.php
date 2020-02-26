<?php

class OrderType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order_types';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name', 'required')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::BELONGS_TO, 'Order', 'id'),
        );
    }
}