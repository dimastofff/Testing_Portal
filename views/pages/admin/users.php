<?php
use App\Utils\Page;
use App\Utils\Router;
use App\Models\User;
use App\Repositories\EntityRepository;

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    Router::redirect('/login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Users</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container mt-4 w-50">
        <h2 class="text-center">Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ROLE</th>
                    <th scope="col">IS EMAIL CONFIRMED</th>
                    <th scope="col">EMAIL CONFIRMED AT</th>
                    <th scope="col">LAST LOGIN AT</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">UPDATED AT</th>
                </tr>
            </thead>
            <tbody>
                <? foreach (EntityRepository::getBy(User::class) as $index => $user): ?>
                    <tr>
                        <th scope="row">
                            <? echo $index + 1; ?>
                        </th>
                        <td>
                            <? echo $user->getId(); ?>
                        </td>
                        <td>
                            <? echo $user->getEmail(); ?>
                        </td>
                        <td>
                            <? echo $user->getRole(); ?>
                        </td>
                        <td>
                            <? echo json_encode($user->getIsEmailConfirmed()); ?>
                        </td>
                        <td>
                            <? echo $user->getEmailConfirmedAt(); ?>
                        </td>
                        <td>
                            <? echo $user->getLastLoginAt(); ?>
                        </td>
                        <td>
                            <? echo $user->getCreatedAt(); ?>
                        </td>
                        <td>
                            <? echo $user->getUpdatedAt(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>