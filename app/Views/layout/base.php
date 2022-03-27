<?php $page_session = \CodeIgniter\Config\Services::session(); ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="<?= base_url(); ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/public/assets/css/style.css" rel="stylesheet">
  <title>CI 4 APP</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url(); ?>">CI 4 App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('contact'); ?>">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('register'); ?>">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('login'); ?>">Login</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-sm-2" type="text" placeholder="Search">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Alert System -->
  <?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <?= $page_session->getFlashdata('success'); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-dismissible alert-danger">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <?= $page_session->getFlashdata('error'); ?>
    </div>
  <?php endif; ?>
  <!-- Alert System -->

  <?= $this->renderSection('content') ?>

  <footer class="footer py-3 bg-dark fixed-bottom">
    <div class="container">
      <span class="text-muted">Designed by Pawan @ <?= date('Y'); ?></span>
    </div>
  </footer>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="<?= base_url(); ?>/public/assets/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/js/custom.js"></script>
</body>

</html>