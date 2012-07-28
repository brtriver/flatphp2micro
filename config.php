<?php
// database
$app['db.config'] = array(
  'host' => 'localhost',
  'database' => 'blog_db',
  'user' => 'myuser',
  'password' => 'mypassword'
);

// twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/templates',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


