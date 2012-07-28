<?php
$container = new Pimple();
// database
$container['db.host'] = 'localhost';
$container['db.database'] = 'blog_db';
$container['db.user'] = 'myuser';
$container['db.password'] = 'mypassword';