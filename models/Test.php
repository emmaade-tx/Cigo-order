<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string $phone_number
 * @property int $order_type_id
 * @property string|null $order_value
 * @property string $scheduled_date
 * @property string $address
 * @property string $city
 * @property string $state
 * @property int $status_id
 * @property string|null $zip_code
 * @property int $country_id
 * @property string $lat
 * @property string $lng
 *
 * @property Country $country
 * @property OrderType $orderType
 * @property Status $status
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'phone_number', 'order_type_id', 'scheduled_date', 'address', 'city', 'state', 'status_id', 'country_id', 'lat', 'lng'], 'required'],
            [['order_type_id', 'status_id', 'country_id'], 'integer'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 80],
            [['phone_number', 'order_value', 'scheduled_date', 'address', 'city', 'state', 'zip_code', 'lat', 'lng'], 'string', 'max' => 45],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['order_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderType::className(), 'targetAttribute' => ['order_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'order_type_id' => Yii::t('app', 'Order Type ID'),
            'order_value' => Yii::t('app', 'Order Value'),
            'scheduled_date' => Yii::t('app', 'Scheduled Date'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'status_id' => Yii::t('app', 'Status ID'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'country_id' => Yii::t('app', 'Country ID'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * Gets query for [[OrderType]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getOrderType()
    {
        return $this->hasOne(OrderType::className(), ['id' => 'order_type_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * {@inheritdoc}
     * @return TestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestsQuery(get_called_class());
    }
}
