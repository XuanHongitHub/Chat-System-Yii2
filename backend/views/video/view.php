<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="thumbnail">
        <?php if (!empty($model->has_thumbnail)): ?>
            <h3>Thumbnail:</h3>
            <?= Html::img('/uploads/thumbnails/' . $model->has_thumbnail, [
                'alt' => 'Thumbnail',
                'style' => 'width:200px; height:auto;'
            ]) ?>
        <?php else: ?>
            <p>No Thumbnail Available</p>
        <?php endif; ?>
    </div>

    <div class="video-player">
        <h3>Video:</h3>
        <?php if (!empty($model->video_path)): ?>
            <video height="400" controls>
                <source src="<?= '/uploads/videos/' . basename($model->video_path) ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php else: ?>
            <p>No Video Available</p>
        <?php endif; ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'video_id',
            'title',
            'description:ntext',
            'tags',
            'status',
            'view_count',
            'like_count',
            'comment_count',
            'created_at',
            'updated_at',
            'created_by',
        ],
    ]) ?>

</div>

<?php if ($model->hasErrors()): ?>
    <div class="alert alert-danger">
        <?= implode('<br>', $model->getFirstErrors()) ?>
    </div>
<?php endif; ?>