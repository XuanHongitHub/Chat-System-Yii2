<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ChatRooms $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="chat-rooms-form container mt-4">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class='row mb-3'>{label}\n<div class='col-sm-10'>{input}{error}</div></div>",
            'labelOptions' => ['class' => 'col-sm-2 col-form-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => true,
        'placeholder' => 'Nhập tên phòng chat...',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-10 offset-sm-2">
                <?= Html::submitButton($model->isNewRecord ? 'Tạo phòng chat' : 'Cập nhật phòng chat', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>