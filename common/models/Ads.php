<?php

namespace common\models;

class Ads extends base\Ads
{
    /**
     * @param $image
     * @param $startDate
     * @param $endDate
     * @param $redirectTo
     *
     * @return Ads
     */
    public static function make($image, $startDate, $endDate, $redirectTo)
    {
        $ads = new static();
        $ads->image = $image;
        $ads->start_date = $startDate;
        $ads->end_date = $endDate;
        $ads->redirect_to = $redirectTo;
        $ads->clicks = 0;
        $ads->save();

        return $ads;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID рекламного объявления',
            'image' => 'Фотография',
            'start_date' => 'Дата старта объявления',
            'end_date' => 'Дата окончания объявления',
            'redirect_to' => 'Перенаправить в',
            'clicks' => 'Количество кликов'
        ];
    }
}