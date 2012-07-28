<?php
//index.php
require_once __DIR__.'/vendor/autoload.php';

ini_set('display_errors', 1); // <= PHPのエラーを表示
error_reporting(-1); // <= PHPの全てのエラーレベルをレポートする

$app = new Silex\Application();
$app['debug'] = true; // <= エラー時にエラーの詳細を表示する

require __DIR__.'/config.php';
require __DIR__.'/model.php';
require __DIR__.'/controllers.php';

$app->run();
