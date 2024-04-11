<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Books Data</h1>
        <div>
            <a href="<?= base_url('book/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Book</a>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Books Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Publication Year</th>
                                    <th>Pages</th>
                                    <th>Stock</th>
                                    <th class="text-center" data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($books as $book) : ?>
                                    <tr>
                                        <td><?= $book['book_title'] ?></td>
                                        <td><?= $book['book_author'] ?></td>
                                        <td><?= $book['book_publisher'] ?></td>
                                        <td><?= $book['book_publication_year'] ?></td>
                                        <td><?= $book['book_pages'] ?></td>
                                        <td><?= $book['book_stock'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" href="<?= base_url("book/edit/{$book['book_id']}") ?>">Edit</a>
                                            <!-- Add data attributes to store book ID and toggle the modal -->
                                            <button class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $book['book_id'] ?>" data-book-id="<?= $book['book_id'] ?>">Delete</button>
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
<?php foreach ($books as $book) : ?>
    <div class="modal fade" id="deleteModal<?= $book['book_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this book?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Change the href attribute to the appropriate delete URL -->
                    <a href="<?= base_url("book/delete/{$book['book_id']}") ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection()  ?>