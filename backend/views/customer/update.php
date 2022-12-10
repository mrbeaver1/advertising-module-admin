<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Customer $model */
/** @var common\models\form\UpdateCustomerForm $form */

$this->title = 'Редактировать клиента: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Клиент ' . $model->url . '(ID: ' . $model->id . ')', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="customer-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'form' => $form,
    ]) ?>

</div>
