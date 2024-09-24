<?php

use yii\bootstrap5\Nav;

?>

<div class="user-info text-center p-3">
    <img src="<?= Yii::getAlias('@web') ?>/images/default-avatar.jpg" alt="Avatar" class="rounded-circle"
        style="width: 7rem; height: 7rem;">
    <h6 class="entity-label fw-semibold mt-2">Kênh của bạn</h6>
    <p class="entity-name text-muted">
        <?= Yii::$app->user->isGuest ? 'Khách' : Yii::$app->user->identity->username ?>
    </p>
</div>

<?php
echo Nav::widget([
    'options' => ["class" => "nav nav-pills nav-sidebar flex-column"],
    'items' => [
        [
            'label' => '<i class="fas fa-tachometer-alt icon-custom"></i> <span>Tổng quan</span>',
            'url' => ['/site/index'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-video icon-custom"></i> <span>Videos</span>',
            'url' => ['/video/index'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-file-alt icon-custom"></i> <span>Nội dung</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-chart-line icon-custom"></i> <span>Số liệu phân tích</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-comments icon-custom"></i> <span>Bình luận</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-closed-captioning icon-custom"></i> <span>Phụ đề</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-copyright icon-custom"></i> <span>Bản quyền</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-dollar-sign icon-custom"></i> <span>Kiếm tiền</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-cog icon-custom"></i> <span>Tùy chỉnh</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-music icon-custom"></i> <span>Thư viện âm thanh</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-cogs icon-custom"></i> <span>Cài đặt</span>',
            'url' => '#',
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-comment-dots icon-custom"></i> <span>Gửi ý kiến phản hồi</span>',
            'url' => '#',
            'encode' => false,
        ],
    ],
]);
?>