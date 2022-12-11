<?php

namespace common\services\ads;

use common\components\ImageHelper;
use common\models\Ads;
use common\models\base\CustomerAds;
use yii\web\NotFoundHttpException;

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

    public function getDataForResponse($availableIds, $adsRanges)
    {
        $now = date('Y-m-d');
        $ads = Ads::find()
            ->where(['id' => $availableIds])
            ->andWhere(['<=', 'start_date', $now])
            ->andWhere(['>=', 'end_date', $now])
            ->all();

        $resizeAdsData = [];

        $i = 0;
        foreach ($ads as $ad) {
            $image = $ad->image;
            $range = $adsRanges[$i];
            [$width, $height] = explode('X', strtoupper($range));
            $mimeType = mime_content_type($image);
            $resizeAdsData[] = [
                'base64' => 'data:'. $mimeType . ';base64, ' . base64_encode(ImageHelper::resize($image, $height, $width)),
                'redirectUrl' => '/api/redirect?adsId=' . $ad->id . '&redirectTo=' . $ad->redirect_to
            ];
            ++$i;
        }

        return $resizeAdsData;
    }

    public function redirectClick(?int $adsId)
    {
        $ads = Ads::find()
            ->where(['id' => $adsId])
            ->one();

        if (is_null($ads)) {
            throw new NotFoundHttpException('Рекламного объявления с ID ' . $adsId . ' не существует в системе');
        }

        $ads->clicks = ++ $ads->clicks;
        $ads->update();
    }
}