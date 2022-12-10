<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Ads $model */

$this->title = 'Рекламное объявление (ID: ' . $model->id . ')';
$this->params['breadcrumbs'][] = ['label' => 'Рекламные объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ads-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p class="text-end">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данное рекламное объявление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'image:ntext',
            'start_date:date',
            'end_date:date',
            'redirect_to:ntext',
            'clicks',
        ],
    ]) ?>

</div>
