<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Loan</h1>

    <!-- Form untuk menambahkan data buku -->
    <div class="row">
        <div class=" col">
            <form action="<?= base_url('borrowing/add') ?>" method="POST">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="borrowing_date">Loan Date</label>
                            <input type="date" class="form-control <?= ($validation->hasError('borrowing_date')) ? 'is-invalid' : '' ?>" id="borrowing_date" title="borrowing_date" name="borrowing_date" value="<?= set_value('borrowing_date') ?>">
                            <div class="invalid-feedback"><?= $validation->getError('borrowing_date') ?></div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4" <?= ($validation->hasError('user_id')) ? 'style="border-color:red"' : '' ?>>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Members Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th class="text-center" data-sortable="false">Select User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($user['full_name']) ?></td>
                                            <td><?= htmlspecialchars($user['address']) ?></td>
                                            <td><?= htmlspecialchars($user['mobile']) ?></td>
                                            <td class="text-center">
                                                <input type="radio" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>" <?= set_radio('user_id', htmlspecialchars($user['user_id'])) ?>>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-danger"><?= $validation->getError('user_id') ?></div>
                        <!-- Menampilkan pesan kesalahan validasi -->
                    </div>
                </div>


                <div class="card shadow mb-4" <?= ($validation->hasError('book_id')) ? 'style="border-color:red"' : '' ?>>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Books Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th class="text-center">Publication Year</th>
                                        <th class="text-center">Pages</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center" data-sortable="false">Select Book</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($books as $book) : ?>
                                        <tr>
                                            <td><?= $book['book_title'] ?></td>
                                            <td><?= $book['book_author'] ?></td>
                                            <td><?= $book['book_publisher'] ?></td>
                                            <td class="text-center"><?= $book['book_publication_year'] ?></td>
                                            <td class="text-center"><?= $book['book_pages'] ?></td>
                                            <td class="text-center"><?= $book['book_stock'] ?></td>
                                            <td class="text-center">
                                                <input type="checkbox" name="book_id[]" value="<?= $book['book_id'] ?>" <?= set_checkbox('book_id[]', $book['book_id']) ?>>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-danger"><?= $validation->getError('book_id') ?></div>
                    </div>
                </div>

                <a href="<?= base_url('borrowing') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>