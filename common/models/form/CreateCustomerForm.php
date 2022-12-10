<?php

namespace common\models\form;

use yii\base\Model;

class CreateCustomerForm extends Model
{
    public $url;
    public $active;
    public $adsIds;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'string'],
            [['active'], 'integer'],
            [['adsIds'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'url' => 'URL Клиента',
            'active' => 'Активен',
            'adsIds' => 'Список рекламных объявлений',
        ];
    }
}