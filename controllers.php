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
    return $app['twig']->render('list.html.twig', array('posts' => $posts));
});

$app->get('/show/{id}', function($id, Application $app, Request $request) {
    $get_post_by_id = $app['model.post_by_id'];
    $post = $get_post_by_id($id);
    if (!$post) {
        $app->abort(404);
    }
    return $app['twig']->render('show.html.twig', array('post' => $post));
})
->bind('blog_show')
;

$app->error(function (\Exception $e, $code) use ($app) {
    echo $e;
    $render = $app['template.render'];
    $html = '<html><body><h1>ページが見つかりません</h1></body></html>';
    return new Response($html, $code);
});