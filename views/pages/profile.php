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
        <h2 class="text-center">Profile</h2>
        <p><b>Email:</b>
            <?= $_SESSION['user']['email'] ?>
            <?php
            if ($_SESSION['user']['isEmailConfirmed']) {
                ?>
                <span class="badge text-bg-success">CONFIRMED</span>
                <?php
            } else {
                ?>
                <span class="badge text-bg-warning">UNCONFIRMED</span>
                <?php
            }
            ?>
        </p>
        <p><b>Role:</b>
            <?php
            switch ($_SESSION['user']['role']) {
                case 'Admin':
                    ?><span class="badge text-bg-danger">ADMIN</span><?php
                    break;
                case 'Moderator':
                    ?><span class="badge text-bg-info">MODERATOR</span><?php
                    break;
                case 'User':
                    ?><span class="badge text-bg-secondary">USER</span><?php
                    break;
            }
            ?>
        </p>
    </main>
</body>

</html>