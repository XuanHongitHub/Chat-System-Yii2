<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ChatRooms $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chat Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-room-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Join Chat', ['join-chat', 'chatRoomId' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <h2>Messages</h2>
    <!-- Hiển thị các tin nhắn trong phòng chat -->
</div>