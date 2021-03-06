<?php

// model.php

$app['db.pdo'] = $app->share(function($c) {
    $pdo = new PDO(
      sprintf('mysql:host=%s;dbname=%s', $c['db.host'], $c['db.database']),
     $c['db.user'],
     $c['db.password']
    );
    return $pdo;
});

$app['model.all_posts'] = function($c) {
    $stmt = $c['db.pdo']->query('SELECT id, title FROM post');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $row;
    }

    return $posts;
};

$app['model.post_by_id'] = $app->protect(function($id) use ($app) {
    $sth = $app['db.pdo']->prepare('SELECT id, date, title, body FROM post where id = :id');
    $sth->execute(array(':id' => $id));
    $post = $sth->fetch(PDO::FETCH_ASSOC);

    return $post;
});
