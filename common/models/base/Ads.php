<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $redirect_to
 * @property int|null $clicks
 *
 * @property CustomerAds[] $customerAds
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'redirect_to'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['clicks'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'redirect_to' => 'Redirect To',
            'clicks' => 'Clicks',
        ];
    }

    /**
     * Gets query for [[CustomerAds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerAds()
    {
        return $this->hasMany(CustomerAds::class, ['ads_id' => 'id']);
    }
}
