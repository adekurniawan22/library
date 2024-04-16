<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Books Data</h1>
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
                                    <th class="text-center">Publication Year</th>
                                    <th class="text-center">Pages</th>
                                    <th class="text-center">Stock</th>
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