<?php
use App\Utils\Page;

?>

<header>
  <nav class="navbar navbar-light navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Testing Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?php
          if (!isset($_SESSION['user'])) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/registration">Registration</a>
            </li>
            <?php
          } else {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="/profile">Profile</a>
            </li>
            <li class="nav-item">
              <form method="post" action="/auth/logout">
                <button type="submit" class="nav-link">Log out</button>
              </form>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <?= Page::renderAlert(); ?>
</header>