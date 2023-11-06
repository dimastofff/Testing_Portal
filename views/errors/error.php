<?php
use App\Utils\Page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>404 Not Found</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-25">
        <h2 class="text-center">
            <? echo $errorMessage; ?>
        </h2>
    </main>
</body>

</html>