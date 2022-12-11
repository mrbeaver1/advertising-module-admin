<?php

namespace frontend\models\DTO;

use yii\base\Model;

class RedirectRequestData extends Model
{
    public $adsId;
    public $redirectTo;

    public function __construct($adsId, $redirectTo,$config = [])
    {
        parent::__construct($config);

        $this->adsId = $adsId;
        $this->redirectTo = $redirectTo;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['adsId', 'integer'],
            ['redirectTo', 'string'],
        ];
    }
}