<?php

namespace common\components;

use Yii;

class ImageHelper
{
    public static function upload($image)
    {
        $uploadFilePath = Yii::$app->params['uploadPath'] . '/' . $image->baseName . '.' . $image->extension;

//        $uploadFilePath = $image->baseName . '.' . $image->extension;

        if (!is_file($uploadFilePath)) {
            $image->saveAs($uploadFilePath);
        }

        return $uploadFilePath;
    }
}