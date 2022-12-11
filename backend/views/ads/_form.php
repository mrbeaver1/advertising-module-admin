<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\widgets\ActiveForm $activeForm */
/** @var common\models\form\CreateAdsForm $form */
?>

<div class="ads-form">

    <?php $activeForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'autocomplete' => 'off']]); ?>

    <?= $activeForm->field($form, 'image')->fileInput() ?>

    <?= $activeForm->field($form, 'dateStart')->widget(DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $activeForm->field($form, 'dateEnd')->widget(DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $activeForm->field($form, 'redirectUrl')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
