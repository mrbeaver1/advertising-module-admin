<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string|null $url
 * @property int|null $active
 *
 * @property CustomerAds[] $customerAds
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'string'],
            [['active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[CustomerAds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerAds()
    {
        return $this->hasMany(CustomerAds::class, ['customer_id' => 'id']);
    }
}
