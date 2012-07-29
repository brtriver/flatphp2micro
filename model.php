<?php
trait Database
{
  public $pdo = null;

  public function open_database_connection($config)
  {
    if ($this->pdo === null ) {
      $this->pdo = new PDO(
        sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['database']),
        $config['user'],
        $config['password'],
        array(PDO::ATTR_EMULATE_PREPARES => false)
      );
    }
  }
}


class Post
{
  use Database;
  public $db_config;

  public function __construct($db_config)
  {
    $this->db_config = $db_config;
  }

  public function get_all_posts()
  {
    $this->open_database_connection($this->db_config);
    $stmt = $this->pdo->query('SELECT id, title FROM post');
    $posts = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $row;
    }
    return $posts;
  }
  function get_post_by_id($id)
  {
    $this->open_database_connection($this->db_config);
    $sth = $this->pdo->prepare('SELECT id, date, title, body FROM post where id = :id');
    $sth->execute(array(':id' => $id));
    $post = $sth->fetch(PDO::FETCH_ASSOC);

    return $post;
  }
}

// containerにmodel.postというkeyで登録
$app->container['model.post'] = function() use($app) {
    return new Post($app->config('db.config'));
};





