<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = 'Thêm Video';

?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">

        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        <br>

        <p class="m-0">
            Kéo và thả tệp video để tải lên
        </p>
        <p class="text-muted">
            Các video của bạn sẽ ở chế độ riêng tư cho đến khi bạn xuất bản.
        </p>

        <?php \yii\bootstrap5\ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]) ?>

        <button class="btn btn-primary btn-file">
            Select File
            <input type="file" name="video" id="videoFile">
        </button>
        <button type="submit" class="btn btn-primary">Tải lên</button>
        <?php \yii\bootstrap5\ActiveForm::end() ?>

    </div>
</div>
</div>