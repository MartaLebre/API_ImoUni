<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Dbz41tR2IAxfN8_Oaybv4hSurhdItiOt',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET {id}/detalhes' => 'detalhes', //mostra informação da tabela user e da tabela perfil
                        'GET {id}/email' => 'email', //mostra o email de um user
                        'GET total' => 'total', //mostra o total de users
                        'GET visita/{id}' => 'visita',
                        'GET reserva/{id}' => 'reserva',
                        'POST registo' => 'registo',
                        'POST login' => 'login',
                        'PUT editar/{username}' => 'editar',
                        'PATCH apagaruser/{username}' => 'apagaruser'
                    ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>',
                            '{id_user}' => '<id:\\d+>',
                            '{username}' => '<username:.*?>',
                        ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'anuncios',
                    'pluralize' => false,
                    'extraPatterns' =>
                        [
                            'PUT alterar/{id}' => 'alterar', //Altera os dados de um anúncio
                            'DELETE apagar/{id}' => 'apagar', //Apaga um anúncio
                            'POST adicionar' => 'adicionar', //Adiciona um anúncio novo
                        ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>'
                        ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'casas',
                    'pluralize' => false,
                    'extraPatterns' =>
                        [
                            'GET {id}/detalhes' => 'detalhes', //mostra detalhes de uma casa
                            'DELETE apagar/{id}' => 'apagar', //apaga uma casa
                            'GET {n_registos}/registos' => 'registos', //define um limite de registos e mostra esses registos
                            'GET cozinha/{id}' => 'cozinha',
                            'GET quarto/{id}' => 'quarto',
                            'GET sala/{id}' => 'sala',
                        ],
                    'tokens' =>
                        [
                            '{id}' => '<id:\\d+>',
                            '{n_registos}' => '<n_registos:\\d+>'
                        ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
