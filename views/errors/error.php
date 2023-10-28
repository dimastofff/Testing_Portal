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
    <?php
    Page::part('header');
    echo '<h2>'.$errorMessage.'</h2>';
    ?>
</body>

</html>
