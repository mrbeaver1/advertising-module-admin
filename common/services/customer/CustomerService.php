<?php

namespace common\services\customer;

use common\models\base\CustomerAds;
use common\models\Customer;
use yii\web\NotFoundHttpException;

class CustomerService
{
    /**
     * @param $url
     * @param $active
     * @param $adsIds
     *
     * @return Customer
     */
    public function create($url, $active, $adsIds)
    {
        $customer = Customer::make(
            $url,
            $active
        );

        if (!empty($adsIds)) {
            $this->addAds($adsIds, $customer);
        }

        return $customer;
    }

    /**
     * @param $customer
     * @param $url
     * @param $active
     * @param $adsIds
     *
     * @return Customer
     */
    public function update($customer, $url, $active, $adsIds)
    {
        $customer = $customer->updateCustomer(
            $url,
            $active,
            $adsIds
        );

        $this->addAds($adsIds, $customer);

        return $customer;
    }

    /**
     * @param $adsIds
     * @param $customer
     *
     * @return void
     */
    private function addAds($adsIds, $customer)
    {
        CustomerAds::deleteAll(['customer_id' => $customer->id]);

        if (is_array($adsIds)) {
            foreach($adsIds as $adsId) {
                $customerAds = new CustomerAds();
                $customerAds->customer_id = $customer->id;
                $customerAds->ads_id = $adsId;
                $customerAds->save();
            }
        }
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function getRelatedAdsIds($model)
    {
        $adsIds = [];

        $relations = $model->getAds();

        foreach ($relations as $relation) {
            $adsIds[] = $relation['ads']['id'];
        }

        return $adsIds;
    }

    public function delete($customer)
    {
        CustomerAds::deleteAll(['customer_id' => $customer->id]);
        $customer->delete();
    }

    public function getById($id)
    {
        $customer = Customer::find()->where(['id' => $id])->one();

        if (is_null($customer)) {
            throw new NotFoundHttpException('Клиента с ID ' . $id . ' не существует в системе');
        }

        return $customer;
    }
}
