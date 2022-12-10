<?php

namespace common\models\form;

class CreateAdsForm extends \yii\base\Model
{
    public $image;
    public $dateStart;
    public $dateEnd;
    public $redirectUrl;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'redirectUrl' => 'Перенаправить в',
            'image' => 'Фотография',
            'dateStart' => 'Дата начала объявления',
            'dateEnd' => 'Дата окончания объявления',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['redirectUrl', 'string'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['dateStart', 'safe'],
            ['dateEnd', 'safe'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->image as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}