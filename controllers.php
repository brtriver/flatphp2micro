<?php
use Symfony\Component\HttpFoundation\Response;

function list_action($container)
{
    $get_all_posts = $container['model.all_posts'];
    $posts = $get_all_posts;
    $html = render_template('templates/list.php', array('posts' => $posts));

    return new Response($html);
}

function show_action($id, $container)
{
    $get_post_by_id = $container['model.post_by_id'];
    $post = $get_post_by_id($id);
    $html = render_template('templates/show.php', array('post' => $post));

    return new Response($html);
}

// テンプレートをレンダリングするためのヘルパー関数
function render_template($path, $params)
{
    extract($params, EXTR_SKIP);
    ob_start();
    require $path;
    $html = ob_get_clean();

    return $html;
}
