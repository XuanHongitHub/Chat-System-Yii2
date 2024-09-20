<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'YiiTwoBe Studio';
?>
<div class="site-index">
    <div class="header">
        <h1><?= Html::encode('Trang tổng quan của kênh') ?></h1>
        <div class="actions">
            <?= Html::a('Thêm Video', ['video/create'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="content">
        <div class="title">Số liệu phân tích về kênh</div>
        <div class="stats">
            <div class="stat">
                <strong>0</strong>
                <span>Số người đăng ký hiện tại</span>
            </div>
            <div class="stat">
                <strong>0</strong>
                <span>Số lượt xem</span>
            </div>
            <div class="stat">
                <strong>0,0</strong>
                <span>Thời gian xem (giờ)</span>
            </div>
        </div>

        <div class="summary">
            <h3>Tóm tắt</h3>
            <p>28 ngày qua</p>
            <div class="stat">
                <span>Số lượt xem</span>
                <span>0</span>
            </div>
            <div class="stat">
                <span>Thời gian xem (giờ)</span>
                <span>0,0</span>
            </div>
        </div>

        <div class="video-stats">
            <h3>Video hàng đầu</h3>
            <p>48 giờ qua - Số lượt xem</p>
        </div>

        <?= Html::a('Chuyển đến số liệu phân tích', ['video/index'], ['class' => 'btn btn-secondary']) ?>

        <div class="video-details">
            <h3>Bạn có muốn xem các chỉ số cho video gần đây của mình không?</h3>
            <p>Hãy đăng tải và xuất bản một video để bắt đầu.</p>
            <?= Html::a('Tải video lên', ['video/create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>