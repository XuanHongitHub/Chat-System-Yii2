<?php ?>

<?php
echo yii\bootstrap5\Nav::widget([
    'options' => ["class" => "list-group list-group-flus"],
    'items' => [
        [
            'label' => 'Dashboard',
            'url' => ['/site/index'],
        ],
        [
            'label' => 'Videos',
            'url' => ['/video/index'],
        ],
        [
            'label' => 'Nội dung',
            'url' => '#',
        ],
        [
            'label' => 'Số liệu phân tích',
            'url' => '#',
        ],
        [
            'label' => 'Bình luận',
            'url' => '#',
        ],
        [
            'label' => 'Phụ đề',
            'url' => '#',
        ],
        [
            'label' => 'Bản quyền',
            'url' => '#',
        ],
        [
            'label' => 'Kiếm tiền',
            'url' => '#',
        ],
        [
            'label' => 'Tùy chỉnh',
            'url' => '#',
        ],
        [
            'label' => 'Thư viện âm thanh',
            'url' => '#',
        ],
        [
            'label' => 'Cài đặt',
            'url' => '#',
        ],
        [
            'label' => 'Gửi ý kiến phản hồi',
            'url' => '#',
        ],
    ]
]);
?>