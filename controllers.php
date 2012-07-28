<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// template
$app['template.render'] = $app->protect(function($path, $params) {
    extract($params, EXTR_SKIP);
    ob_start();
    require $path;
    $html = ob_get_clean();

    return $html;
});


// controllers.php
$app->get('/', function(Application $app, Request $request) {
    $get_all_posts = $app['model.all_posts'];
    $posts = $get_all_posts;
    $render = $app['template.render'];
    $html = $render('templates/list.php', array('posts' => $posts));
    return $html;
});

$app->get('/show', function(Application $app, Request $request) {
    $get_post_by_id = $app['model.post_by_id'];
    $post = $get_post_by_id($request->query->get('id'));
    if (!$post) {
        $app->abort(404);
    }
    $render = $app['template.render'];
    $html = $render('templates/show.php', array('post' => $post));
    return $html;
});

$app->error(function (\Exception $e, $code) use ($app) {
    $render = $app['template.render'];
    $html = '<html><body><h1>ページが見つかりません</h1></body></html>';
    return new Response($html, $code);
});