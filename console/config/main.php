<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'common\fixtures',
        ],
        //    'nodeSocket' => array(
        // 'class' => 'application.extensions.yii-node-socket.lib.php.NodeSocket',
        // 'host' => 'localhost',  // default is 127.0.0.1, can be ip or domain name, without http
        // 'port' => 3001      // default is 3001, should be integer
        //    ),
        'node-socket' => '\YiiNodeSocket\NodeSocketCommand',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
    // 'commandMap' => array(
    //     'node-socket' => 'common.extensions.yii-node-socket.lib.php.NodeSocketCommand'
    // )
];