<?php

namespace common\models\form;

class UpdateCustomerForm extends CreateCustomerForm
{

    public function __construct($model, $config = [])
    {
        parent::__construct($config);

        $this->url = $model->url;
        $this->active = $model->active;
    }
}