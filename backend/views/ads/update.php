<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ads $model */
/** @var common\models\form\UpdateAdsForm $form */

$this->title = 'Редактировать рекламное объявление (ID:   ' . $model->id . ')';
$this->params['breadcrumbs'][] = ['label' => 'Рекламные объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Рекламное объявление (ID:   ' . $model->id . ')', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="ads-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'form' => $form,
    ]) ?>

</div>
