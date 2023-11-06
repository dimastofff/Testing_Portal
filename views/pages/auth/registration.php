<?php
use App\Utils\Page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Registration</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-25">
        <h2 class="text-center">Registration</h2>
        <form class="mt-4" method="post" action="/auth/registration">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="40" required>
            </div>
            <div class="mb-3">
                <label for="nickname" class="form-label">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" minlength="4" maxlength="20"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" minlength="6" maxlength="15"
                    required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Password confirmation</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="6"
                    maxlength="15" required>
            </div>
            <button type="submit" class="btn btn-primary">Registration</button>
        </form>
    </main>
</body>

</html>