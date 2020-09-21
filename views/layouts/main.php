<?php /** @var string $content */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="?c=user&a=all">Все пользователи</a></li>
        <li><a href="?c=user&a=one">Один пользователь</a></li>
    </ul>
    <?= $content ?>
</body>
</html>