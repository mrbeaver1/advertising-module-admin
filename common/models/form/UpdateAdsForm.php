<?php

namespace common\models\form;

use yii\web\UploadedFile;

class UpdateAdsForm extends CreateAdsForm
{
    public function __construct($ads, $config = [])
    {
        parent::__construct($config);

        $this->dateStart = $ads->start_date;
        $this->dateEnd = $ads->end_date;
        $this->redirectUrl = $ads->redirect_to;
    }
}