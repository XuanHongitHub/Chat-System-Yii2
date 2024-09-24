<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;

NavBar::begin([
    'brandLabel' => '<div class="d-flex align-items-center justify-content-center" style="width: 100%;">
        <img src="' . Yii::getAlias('@web') . '/images/logo-1.png" alt="Logo" style="height:30px; margin-right: 10px;">
        <span class="fw-semibold">' . Yii::$app->name . '</span>
    </div>',

    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-light yiiheader header fixed-top shadpw-sm',
    ],
]);
$menuItems = [
    // ['label' => 'Home', 'url' => ['/site/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
    'items' => $menuItems,
]);
if (Yii::$app->user->isGuest) {
    echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
} else {
    echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout text-decoration-none']
        )
        . Html::endForm();
}
NavBar::end();
