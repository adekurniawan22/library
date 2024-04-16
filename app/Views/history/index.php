<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Borrowings Data</h1>
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

<?= $this->endSection()  ?>