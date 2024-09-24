<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = 'Cập nhật Video: ' . (strlen($model->title) > 30 ? substr($model->title, 0, 27) . '...' : $model->title);
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (strlen($model->title) > 30 ? substr($model->title, 0, 27) . '...' : $model->title), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="video-update">

    <h1 class="video-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>