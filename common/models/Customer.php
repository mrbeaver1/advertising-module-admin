<?php

namespace common\models;

class Customer extends base\Customer
{
    public static function make($url, $active)
    {
        $customer = new static();
        $customer->url = $url;
        $customer->active = $active;
        $customer->save();

        return $customer;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID клиента',
            'url' => 'URL Клиента',
            'active' => 'Активен',
        ];
    }

    public function updateCustomer($url, $active)
    {
        $this->url = $url;
        $this->active = $active;
        $this->update();

        return $this;
    }

    public function getAds()
    {
        return $this->getCustomerAds()->with('ads')->with('customer')->asArray()->all();
    }

    public function getAdsIds()
    {
        return $this->getCustomerAds()->with('ads')->with('customer')->asArray()->all();
    }
}