<?php
use App\Utils\Page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Email confirmation</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-25">
        <p>Your email successful confirmed. Now you can participate in all tests and can make your own tests and send them to moderation.</p>
    </main>
</body>

</html>
