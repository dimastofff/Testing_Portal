<?php
use App\Utils\Page;
use App\Utils\Router;

if (!isset($_SESSION['user'])) {
    Router::redirect('/login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Create test</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-25">
        <h2 class="text-center">Create test</h2>
        <form class="mt-4" method="post" action="/tests/create">
        <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" minlength="4" maxlength="255" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </main>
</body>

</html>
