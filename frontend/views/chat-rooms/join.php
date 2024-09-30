<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ChatRooms $chatRoom */

$this->title = 'Tham Gia Phòng Chat: ' . Html::encode($chatRoom->name);
$this->params['breadcrumbs'][] = ['label' => 'Phòng Chat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="chat-room-join">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Bạn đã tham gia vào phòng chat: <strong><?= Html::encode($chatRoom->name) ?></strong></p>

    <p>Thời gian tham gia: <?= date('d-m-Y H:i:s', $chatRoomUser->joined_at) ?></p>

    <p>
        <?= Html::a('Quay lại danh sách phòng chat', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>