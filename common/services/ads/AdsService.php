<?php

namespace common\services\ads;

use common\models\Ads;
use common\models\base\CustomerAds;

class AdsService
{
    public function create($image, $startDate, $endDate, $redirectTo)
    {
        return Ads::make($image, $startDate, $endDate, $redirectTo);
    }

    public function update(Ads $model, $imageFile, $dateStart, $dateEnd, $redirectUrl)
    {
        $model->image = $imageFile;
        $model->start_date = $dateStart;
        $model->end_date = $dateEnd;
        $model->redirect_to = $redirectUrl;

        $model->update();

        return $model;
    }

    public function delete($ads)
    {
        CustomerAds::deleteAll(['ads_id' => $ads->id]);

        $ads->delete();
    }
}