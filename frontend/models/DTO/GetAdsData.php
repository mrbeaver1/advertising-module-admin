<?php

namespace frontend\models\DTO;

use yii\base\Model;

class GetAdsData extends Model
{
    public $clientId;
    public $adsCount;
    public $adsRange;

    /**
     * @param $clientId
     * @param $adsCount
     * @param $adsRange
     * @param $config
     */
    public function __construct($clientId, $adsCount, $adsRange, $config = [])
    {
        parent::__construct($config);

        $this->clientId = $clientId;
        $this->adsCount = $adsCount;
        $this->adsRange = $adsRange;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['clientId', 'integer'],
            ['adsCount', 'integer'],
            ['adsRange', 'each', 'rule' => ['string']],
        ];
    }
}