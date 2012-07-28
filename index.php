<?php
// index.php

// グローバルライブラリの読み込みと初期化
require 'bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// リクエストを内部的にルーティング
$request = Request::createFromGlobals();

$uri = $request->getPathInfo();
if ($uri === '/') {
    $response = list_action($container);
} elseif ($uri === '/show' && $request->query->has('id')) {
    $response = show_action($request->query->get('id'), $container);
} else {
    $html = '<html><body><h1>Page Not Found</h1></body></html>';
    $response = new Response($html, 404);
}

// ヘッダーを返し、レスポンスを送る
$response->send();