<?php
// controllers.php
$app->get('/', function () use($app) {
    $post_model = $app->container['model.post'](); // <= Postモデルオブジェクトを生成
    $posts = $post_model->get_all_posts();
    $app->render('list.php', array('posts' => $posts));
});

$app->get('/show/:id', function ($id) use ($app) {
    $post_model = $app->container['model.post']();  // <= Postモデルオブジェクトを生成
    $post = $post_model->get_post_by_id($id);
    if (!$post) {
        // 該当する記事がないので、このルーティングにマッチしなかったとして
        // 次のマッチするルーティングに処理を委譲するpassメソッドをコールする
        // => つまり、どのルーティングにもマッチしないのでnotFoundが実行される
        $app->pass();
    }
    $app->render('show.php', array('post' => $post));
});

$app->notFound(function () use ($app) {
    echo '<html><body><h1>ページが見つかりません</h1></body></html>';
});
