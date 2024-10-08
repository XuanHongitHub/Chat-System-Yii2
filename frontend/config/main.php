<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'enableCsrfValidation' => true,
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'Asia/Ho_Chi_Minh',
        ],
        'pusher' => [
            'class' => \Pusher\Pusher::class,
            'app_id' => '1874606',
            'key' => '9417daa5964067a88896',
            'secret' => '761a296ebcc2a0fed0ae',
            'cluster' => 'ap1',
        ],
        'nodeSocket' => [
            'class' => '\YiiNodeSocket\NodeSocket',
            'host' => 'localhost',   // Địa chỉ máy chủ Node.js
            'port' => 3001,          // Port của Node.js server
            'allowedServerAddresses' => [
                "localhost",          // Các địa chỉ IP được phép kết nối
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'chat' => 'chat/index',
                'chat/get-contacts' => 'chat/get-contacts',
                'chat/add-contact' => 'chat/add-contact',
                'chat-room/add-room' => 'chat-room/add-room',
                'search-user' => 'chat/search-user',
                'chat/contact/messages/<id:\d+>' => 'chat/contact/messages',
                'chat/messages/<id:\d+>' => 'chat/messages',
                'chat/sendMessage' => 'chat/send-message',
                'chat/message/send-message' => 'chat/message/send-message',
                'chat/getSenderId' => 'chat/get-sender-id?chatId=${chatId}',
                'POST pusher/auth' => 'site/pusher-auth',
            ],
        ],

    ],
    'params' => $params,
];