<?php

use common\models\ChatRooms;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ChatRooms $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Chat Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Chat Rooms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'created_by',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ChatRooms $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {update} {delete} {join}', // Thêm nút join
                'buttons' => [
                    'join' => function ($url, $model, $key) {
                        return Html::a('Join', ['chat-room/join', 'chatRoomId' => $model->id], [
                            'title' => 'Join this chat room',
                            'class' => 'btn btn-primary btn-xs',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>