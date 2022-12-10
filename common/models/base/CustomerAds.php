<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "customer_ads".
 *
 * @property int $customer_id
 * @property int $ads_id
 *
 * @property Ads $ads
 * @property Customer $customer
 */
class CustomerAds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'ads_id'], 'required'],
            [['customer_id', 'ads_id'], 'integer'],
            [['ads_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ads::class, 'targetAttribute' => ['ads_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'customer ID',
            'ads_id' => 'Ads ID',
        ];
    }

    /**
     * Gets query for [[Ads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasOne(Ads::class, ['id' => 'ads_id']);
    }

    /**
     * Gets query for [[customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }
}
