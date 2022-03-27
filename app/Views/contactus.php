<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<div class="card bg-light mb-3 contact-form" style="max-width: 30rem;">
  <h4 class="card-header text-center">Contact Form</h4>

  <div class="card-body">
    <form method="post" action="<?= base_url('contact/check'); ?>">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?= set_value('name'); ?>">
        <?php if (isset($validation)) : ?>
          <small class="text-danger"><?= $validation->getError('name'); ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group mt-4">
        <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?= set_value('email'); ?>">
        <?php if (isset($validation)) : ?>
          <small class="text-danger"><?= $validation->getError('email'); ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group mt-4">
        <input type="number" class="form-control" placeholder="Mobile" name="mobile" value="<?= set_value('mobile'); ?>">
        <?php if (isset($validation)) : ?>
          <small class="text-danger"><?= $validation->getError('mobile'); ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group mt-4">
        <textarea class="form-control" placeholder="Message" name="message"><?= set_value('message'); ?></textarea>
        <?php if (isset($validation)) : ?>
          <small class="text-danger"><?= $validation->getError('message'); ?></small>
        <?php endif; ?>
      </div><br>

      <button type="submit" class="btn btn-primary text-center" name="submit">Submit</button>

    </form>
  </div>
</div>
<?= $this->endSection() ?>