<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<div class="card bg-light mb-3 contact-form" style="max-width: 30rem;">
  <h4 class="card-header text-center">Login</h4>

  <div class="card-body">
    <form method="post" action="<?= base_url('login/check'); ?>">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Username" name="username" value="<?= set_value('username'); ?>">
        <?php if (isset($validation)) : ?>
          <small class="text-danger"><?= $validation->getError('username'); ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group mt-4">
        <input type="password" class="form-control" placeholder="Enter Password" name="password" value="<?= set_value('password'); ?>">
        <?php if (isset($validation)) : ?>
          <small class="text-danger"><?= $validation->getError('password'); ?></small>
        <?php endif; ?>
      </div><br>

      <button type="submit" class="btn btn-success text-center" name="login">Login</button>
    </form>

    <br>
    <a href="" class="btn btn-info">Login with Facebook</a>
    <a href="" class="btn btn-warning">Login with Google</a>
  </div>
</div>
<?= $this->endSection() ?>