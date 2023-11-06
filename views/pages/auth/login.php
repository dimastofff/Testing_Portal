<?php
use App\Utils\Page;
use App\Utils\Router;

if (isset($_SESSION['user'])) {
    Router::redirect('/profile');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Login</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-25">
        <h2 class="text-center">Login</h2>
        <form class="mt-4" method="post" action="/auth/login">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="40" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" minlength="6" maxlength="15" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </main>
</body>

</html>
