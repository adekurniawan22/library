<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users Data</h1>
        <div>
            <a href="<?= base_url('user/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add User</a>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th class="text-center" data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $user['role'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['full_name'] ?></td>
                                        <td><?= $user['address'] ?></td>
                                        <td><?= $user['mobile'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" href="<?= base_url("user/edit/{$user['user_id']}") ?>">Edit</a>
                                            <!-- Add data attributes to store user ID and toggle the modal -->
                                            <button class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $user['user_id'] ?>" data-user-id="<?= $user['user_id'] ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($users as $user) : ?>
    <div class="modal fade" id="deleteModal<?= $user['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Change the href attribute to the appropriate delete URL -->
                    <a href="<?= base_url("user/delete/{$user['user_id']}") ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection()  ?>