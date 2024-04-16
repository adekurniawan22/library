<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Borrowings Data</h1>
        <div>
            <a href="<?= base_url('borrowing/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Borrowing</a>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Borrowings Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Borrowing Date</th>
                                    <th>Book Title</th>
                                    <th>Name Member</th>
                                    <th class="text-center">Return Date</th>
                                    <th class="text-center">Penalty</th>
                                    <th class="text-center">Is Return</th>
                                    <th class="text-center" data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($borrowings as $borrowing) : ?>
                                    <tr>
                                        <td>
                                            <?= date('d M Y', strtotime($borrowing['borrowing_date'])) ?>
                                        </td>
                                        <td>
                                            <?php
                                            $db = \Config\Database::connect();
                                            $builder = $db->table('book');
                                            $builder->where('book_id', $borrowing['book_id']);
                                            $query = $builder->get()->getRowArray();
                                            ?>
                                            <?= $query['book_title'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $db = \Config\Database::connect();
                                            $builder = $db->table('user');
                                            $builder->where('user_id', $borrowing['user_id']);
                                            $query = $builder->get()->getRowArray();
                                            ?>
                                            <?= $query['full_name'] ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($borrowing['return_date'] == null) {
                                                echo '-- / -- / ----';
                                            } else {
                                                echo date('d M Y', strtotime($borrowing['return_date']));
                                            };
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?= number_to_currency($borrowing['penalty'], 'IDR') ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if ($borrowing['is_return'] == 1) : ?>
                                                <span class="badge badge-success">Returned</span>
                                            <?php else : ?>
                                                <span class="badge badge-warning">Not Yet Returned</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-primary" href="<?= base_url("borrowing/edit/{$borrowing['borrowing_id']}") ?>">Update Return</a>
                                            <!-- Add data attributes to store borrowing ID and toggle the modal -->
                                            <button class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $borrowing['borrowing_id'] ?>" data-borrowing-id="<?= $borrowing['borrowing_id'] ?>">Delete</button>
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
<?php foreach ($borrowings as $borrowing) : ?>
    <div class="modal fade" id="deleteModal<?= $borrowing['borrowing_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this borrowing?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Change the href attribute to the appropriate delete URL -->
                    <a href="<?= base_url("borrowing/delete/{$borrowing['borrowing_id']}") ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection()  ?>