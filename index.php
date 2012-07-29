<?php
// グローバルライブラリの読み込みと初期化
require 'bootstrap.php';

$app = new Slim();
$app->container = array(); 

$app->config('db.config', array(
               'host' => 'localhost',
               'database' => 'blog_db',
               'user' => 'myuser',
               'password' => 'mypassword',
               ));

require_once 'controllers.php';
require_once 'model.php';

$app->run();