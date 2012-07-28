<?php
// グローバルライブラリの読み込みと初期化
require 'bootstrap.php';

// ドキュメントルート以外に設置した場合のベースとなるアプリケーションのパス
$base = '/flatphp2micro'; 

// リクエストを内部的にルーティング
$uri = $_SERVER['REQUEST_URI'];
if ($uri === ($base .'/index.php')) {
    list_action();
} elseif ( preg_match("#^{$base}/index.php/show#", $uri) && isset($_GET['id'])) {
    show_action($_GET['id']);
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>ページが見つかりません</h1></body></html>';
}

