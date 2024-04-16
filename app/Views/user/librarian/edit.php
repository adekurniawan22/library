<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    <!-- Form untuk menambahkan data buku -->
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('user/edit/' . $user['user_id']) ?>" method="POST">
                <input type="hidden" name="role_id" value="<?= $user['role_id'] ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email', $user['email']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" value="<?= set_value('password') ?>">
                    <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                </div>

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control <?= ($validation->hasError('full_name')) ? 'is-invalid' : '' ?>" id="full_name" name="full_name" value="<?= set_value('full_name', $user['full_name']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('full_name') ?></div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control <?= ($validation->hasError('address')) ? 'is-invalid' : '' ?>" id="address" name="address"><?= set_value('address', $user['address']) ?></textarea>
                    <div class="invalid-feedback"><?= $validation->getError('address') ?></div>
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile Phone</label>
                    <input type="text" class="form-control <?= ($validation->hasError('mobile')) ? 'is-invalid' : '' ?>" id="mobile" name="mobile" value="<?= set_value('mobile', $user['mobile']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('mobile') ?></div>
                </div>

                <a href="<?= base_url('user') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>