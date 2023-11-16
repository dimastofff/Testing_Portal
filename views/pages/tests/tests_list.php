<?php
use App\Models\Role;
use App\Utils\Page;
use App\Repositories\TestRepository;
use App\Utils\PermissionsManager;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Tests</title>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container my-4 w-25">
        <h2 class="text-center">Tests</h2>
        <? if (PermissionsManager::isUserHasAccess(Role::Moderator)): ?>
            <a href="/tests/create_test">
                <button type="button" class="btn btn-success my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                        <path
                            d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                        <path
                            d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z" />
                        <path
                            d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5V6.5Z" />
                    </svg>
                </button>
            </a>
        <? endif; ?>
        <ul class="list-group list-group">
            <? foreach (TestRepository::getTestsForUsers() as $index => $test): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">
                            <? echo $test->getName(); ?>
                        </div>
                        <span class="badge bg-success rounded-pill">Questions:
                            <? echo $test->getQuestionsCount(); ?>
                        </span>
                        <? if ($test->getAuthor()): ?>
                            <span class="badge bg-info rounded-pill">Author:
                                <? echo $test->getAuthor(); ?>
                            </span>
                        <? endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>

</html>