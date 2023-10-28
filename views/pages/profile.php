<?php
use App\Utils\Page;
use App\Utils\Router;

if (!isset($_SESSION['user'])) {
    Router::redirectWithAlert('danger', 'This page only for authorized users. Please login.', '/login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Profile</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-25">
        <h2>Profile</h2>
        <?= $_SESSION['user']['email'] ?>
    </main>
</body>

</html>
