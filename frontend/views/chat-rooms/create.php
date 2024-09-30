<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ChatRooms $model */

$this->title = 'Create Chat Rooms';
$this->params['breadcrumbs'][] = ['label' => 'Chat Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-rooms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
