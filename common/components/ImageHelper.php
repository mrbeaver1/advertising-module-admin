<?php

namespace common\components;

use Gumlet\ImageResize;
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

    public static function resize($path, $height, $width)
    {
        $imageResizer = new ImageResize($path);
            $imageResizer->resize($width, $height);

        return $imageResizer->getImageAsString();
    }
}