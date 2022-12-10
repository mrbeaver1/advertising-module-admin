<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\form\CreateAdsForm $form */

$this->title = 'Добавить рекламное объявление';
$this->params['breadcrumbs'][] = ['label' => 'Рекламные объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'form' => $form,
    ]) ?>

</div>
