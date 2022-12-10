<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Customer $model */

$this->title = 'Клиент ' . $model->url . '(ID: ' . $model->id .')';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p class="text-end">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данного клиента?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url:ntext',
            'active',
        ],
    ]) ?>

    <h4><?= Html::encode('Рекламные объявления') ?></h4>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $model->getAds(),
            'pagination' => false,
        ]),
        'layout' => "{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'ads.id',
                'label' => 'ID рекламного объявления',
            ],
            [
                'attribute' => 'ads.redirect_to',
                'label' => 'Перенаправлять на',
            ],
            [
                'attribute' => 'ads.clicks',
                'label' => 'Количество кликов',
            ],
        ],
    ]); ?>

</div>
