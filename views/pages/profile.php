<?php
use App\Utils\Page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Profile</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container my-4 w-25">
        <h2 class="text-center">Profile</h2>
        <p><b>Email: </b>
            <? echo $_SESSION['user']['email']; ?>
            <? if ($_SESSION['user']['isEmailConfirmed']): ?>
                <span class="badge text-bg-success">CONFIRMED</span>
            <? else: ?>
                <span class="badge text-bg-warning">UNCONFIRMED</span>
            <? endif; ?>
        </p>
        <p>
            <b>Nickname: </b>
            <? echo $_SESSION['user']['nickname']; ?>
        </p>
        <p><b>Role: </b>
            <? switch ($_SESSION['user']['role']):
                case 'Admin': ?>
                    <span class="badge text-bg-danger">ADMIN</span>
                    <? break;
                case 'Moderator': ?>
                    <span class="badge text-bg-info">MODERATOR</span>
                    <? break;
                case 'User': ?>
                    <span class="badge text-bg-secondary">USER</span>
                    <? break;
            endswitch; ?>
        </p>
    </main>
</body>

</html>