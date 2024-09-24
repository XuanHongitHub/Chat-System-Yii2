<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Video;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Nội dung của kênh';
?>

<div class="site-index">
    <div class="header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="actions">
            <?= Html::a('Thêm Video', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="content">
        <!-- Tab links -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="video-tab" data-toggle="tab" href="#video" role="tab"
                    aria-controls="video" aria-selected="true">Video</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="shorts-tab" data-toggle="tab" href="#shorts" role="tab" aria-controls="shorts"
                    aria-selected="false">Shorts</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="live"
                    aria-selected="false">Sự kiện phát trực tiếp</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="playlist-tab" data-toggle="tab" href="#playlist" role="tab"
                    aria-controls="playlist" aria-selected="false">Danh sách phát</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="podcast-tab" data-toggle="tab" href="#podcast" role="tab"
                    aria-controls="podcast" aria-selected="false">Podcast</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="promotion-tab" data-toggle="tab" href="#promotion" role="tab"
                    aria-controls="promotion" aria-selected="false">Quảng bá</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content mt-2" id="myTabContent">
            <!-- Tab Video -->
            <div class="tab-pane fade show active" id="video" role="tabpanel" aria-labelledby="video-tab">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                        ],
                        [
                            'attribute' => 'title',
                            'label' => 'Video',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $thumbnailHtml = 'No Thumbnail';
                                if (!empty($model->has_thumbnail)) {
                                    $thumbnailUrl = '/uploads/thumbnails/' . $model->has_thumbnail;
                                    $thumbnailHtml = Html::img($thumbnailUrl, ['alt' => 'Thumbnail', 'style' => 'width:100px; height:auto; margin-right:10px;']);
                                }

                                $maxLength = 30;
                                $title = mb_strlen($model->title) > $maxLength ? mb_substr($model->title, 0, $maxLength) . '...' : $model->title;
                                $description = mb_strlen($model->description) > $maxLength ? mb_substr($model->description, 0, $maxLength) . '...' : $model->description;

                                $titleHtml = Html::tag('div', Html::encode($title), ['class' => 'title-cell-video']);
                                $descriptionHtml = Html::tag('div', Html::encode($description), ['class' => 'description-cell-video']);

                                return Html::tag('div', $thumbnailHtml . Html::tag('div', $titleHtml . $descriptionHtml, ['style' => 'display: flex; flex-direction: column;']), ['style' => 'display: flex; align-items: center;']);
                            },
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Trạng Thái',
                            'value' => function ($model) {
                                return $model->status == 1 ? 'Hiện' : 'Ẩn';
                            },
                        ],
                        'created_at:date',
                        'view_count',
                        'comment_count',
                        [
                            'attribute' => 'like_count',
                            'label' => 'Lượt thích',
                            'value' => function ($model) {
                                return $model->like_count . '';
                            }
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Thao tác',
                            'urlCreator' => function ($action, Video $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],

                    ],
                ]); ?>

                <?php if ($dataProvider->getCount() == 0): ?>
                    <div class="text-center">
                        <img src="https://www.gstatic.com/youtube/img/creator/no_content_illustration_v4.svg"
                            alt="Không có nội dung" width="100">
                        <h5 class="mt-3">Không có nội dung</h5>
                        <?= Html::a('Tải video lên', ['create'], ['class' => 'btn btn-primary mt-3']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="shorts" role="tabpanel" aria-labelledby="shorts-tab">
                <p class="card-text">Nội dung cho tab Shorts</p>
            </div>

            <div class="tab-pane fade" id="live" role="tabpanel" aria-labelledby="live-tab">
                <p class="card-text">Nội dung cho tab Sự kiện phát trực tiếp</p>
            </div>

            <div class="tab-pane fade" id="playlist" role="tabpanel" aria-labelledby="playlist-tab">
                <p class="card-text">Nội dung cho tab Playlist</p>
            </div>

            <div class="tab-pane fade" id="podcast" role="tabpanel" aria-labelledby="podcast-tab">
                <p class="card-text">Nội dung cho tab Podcast</p>
            </div>

            <div class="tab-pane fade" id="promotion" role="tabpanel" aria-labelledby="promotion-tab">
                <p class="card-text">Nội dung cho tab Quảng bá</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>