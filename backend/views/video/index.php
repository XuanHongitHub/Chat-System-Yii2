<?php

use common\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'video_id',
            'title',
            'description:ntext',
            'tags',
            [
                'attribute' => 'has_thumbnail',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!empty($model->has_thumbnail)) {
                        $thumbnailUrl = '/uploads/thumbnails/' . $model->has_thumbnail;
                        return Html::img($thumbnailUrl, ['alt' => 'Thumbnail', 'style' => 'width:100px; height:auto;']);
                    }
                    return 'No Thumbnail';
                },
            ],


            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Video $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>



</div>