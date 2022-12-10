<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\form\CreateCustomerForm $form */

$this->title = 'Добавить клиента';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <?= $this->render('_form', [
        'form' => $form,
    ]) ?>

</div>
