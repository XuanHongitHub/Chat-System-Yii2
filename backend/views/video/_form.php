<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Đường liên kết của video</label>
                <div class="video-info">
                    <span class="video-url-fadeable">
                        <a target="_blank" class="video-url" href="<?php echo $model->getVideoLink(); ?>">
                            <?php echo $model->getVideoLink(); ?>
                        </a>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="video">Tải lên video</label>
                <?= $form->field($model, 'video')->fileInput(['class' => 'form-control-file'])->label(false) ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="thumbnail">Tải lên ảnh đại diện</label>
                <?= $form->field($model, 'thumbnail')->fileInput(['class' => 'form-control-file'])->label(false) ?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>