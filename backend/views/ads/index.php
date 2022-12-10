<?php

use common\models\Ads;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\Ads $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Рекламные объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p class="text-end">
        <?= Html::a('Добавить рекламное объявление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'image:ntext',
//            [
//                'attribute' => 'image',
//                'format' => 'raw',
//                'value' => function($model) {
//                    return Html::img($model->image, ['class' => 'img-thumbnail', 'style' => 'width: 100px; height: 100px; object-fit: cover; object-position: 100% 0;']);
//                }
//            ],
            'start_date:date',
            'end_date:date',
            'redirect_to:ntext',
            'clicks',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ads $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
