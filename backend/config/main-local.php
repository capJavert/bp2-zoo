<?php

$config = [
    'components' => [
	    'assetManager' => [
            'converter' => [
                'class' => 'cakebake\lessphp\AssetConverter',
                'compress' => true, // Optional: You can tell less.php to remove comments and whitespace to generate minimized css files.
                'useCache' => true, // Optional: less.php will save serialized parser data for each .less file. Faster, but more memory-intense.
                //'cacheDir' => null, // Optional: is passed to the SetCacheDir() method. By default "cakebake\lessphp\runtime" is used.
                //'cacheSuffix' => true, // Optional: Filename suffix to avoid the browser cache and force recompiling by configuration changes
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1XlvWM0lciC5SDX9Fonx53hFq9pJUqyl',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
