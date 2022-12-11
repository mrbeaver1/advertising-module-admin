<?php

use common\models\Ads;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\form\CreateCustomerForm $form */
/** @var yii\widgets\ActiveForm $activeform */
/** @var yii\widgets\ActiveForm $activeform */
?>

<div class="customer-form">

    <?php $activeform = ActiveForm::begin([
        'options' => [
            'autocomplete' => 'off'
        ]
    ]); ?>

    <?= $activeform->field($form, 'url')->textarea(['rows' => 6]) ?>

    <?= $activeform->field($form, 'adsIds')->widget(Select2::class, [
        'data' => ArrayHelper::map(Ads::find()->select(['id', 'redirect_to'])->all(), 'id', 'redirect_to'),
        'options' => [
            'placeholder' => 'Выберите рекламные объявления',
            'multiple' => true,
        ],
        'toggleAllSettings' => [
            'selectLabel' => 'Выбрать все',
            'unselectLabel' => 'Убрать все'
        ]
    ]) ?>

    <?= $activeform->field($form, 'active')->checkbox(['class' => 'mt-3']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
