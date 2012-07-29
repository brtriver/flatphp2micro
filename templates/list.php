<?php $title = '投稿のリスト' ?>

<?php ob_start() ?>
    <h1>投稿のリスト</h1>
    <ul>
        <?php foreach ($posts as $post): ?>
        <li>
            <a href="show/<?php echo htmlspecialchars($post['id'], ENT_QUOTES, 'utf-8') ?>">
                <?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'utf-8') ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>

