<?php

// model.php
function get_database_connection()
{
    $pdo = new PDO(
     'mysql:host=localhost;dbname=blog_db',
     'myuser',
     'mypassword'
    );
    return $pdo;
}

function close_database_connection(&$pdo)
{
    $pdo = null;
}

function get_all_posts()
{
    $pdo = get_database_connection();

    $stmt = $pdo->query('SELECT id, title FROM post');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $row;
    }

    close_database_connection($pdo);

    return $posts;
}

function get_post_by_id($id)
{
    $pdo = get_database_connection();

    $sth = $pdo->prepare('SELECT id, date, title, body FROM post where id = :id');
    $sth->execute(array(':id' => $id));
    $post = $sth->fetch(PDO::FETCH_ASSOC);

    close_database_connection($pdo);

    return $post;
}