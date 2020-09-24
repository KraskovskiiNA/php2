<?php /** @var string $content 
 * @var srting $title
 */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?></title>
</head>
<body>
    <ul>
        <li><a href="?c=user&a=all">Все пользователи</a></li>
        <li><a href="?c=user&a=one">Один пользователь</a></li>
        <li><a href="?c=user&a=add">Добавить пользователя</a></li>
    </ul>
    <?= $content ?>
</body>
</html>