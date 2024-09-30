<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ChatRooms $model */

$this->title = 'Update Chat Rooms: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chat Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chat-rooms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
