<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Book</h1>

    <!-- Form untuk menambahkan data buku -->
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('book/edit/' . $book['book_id']) ?>" method="POST">
                <div class="form-group">
                    <label for="book_title">Book Title</label>
                    <input type="text" class="form-control <?= ($validation->hasError('book_title')) ? 'is-invalid' : '' ?>" id="book_title" title="book_title" name="book_title" value="<?= set_value('book_title', $book['book_title']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('book_title') ?></div>
                </div>
                <div class="form-group">
                    <label for="book_author">Author</label>
                    <input type="text" class="form-control <?= ($validation->hasError('book_author')) ? 'is-invalid' : '' ?>" id="book_author" name="book_author" value="<?= set_value('book_author', $book['book_author']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('book_author') ?></div>
                </div>
                <div class="form-group">
                    <label for="book_publisher">Publisher</label>
                    <input type="text" class="form-control <?= ($validation->hasError('book_publisher')) ? 'is-invalid' : '' ?>" id="book_publisher" name="book_publisher" value="<?= set_value('book_publisher', $book['book_publisher']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('book_publisher') ?></div>
                </div>
                <div class="form-group">
                    <label for="book_publication_year">Publication Year</label>
                    <input type="text" class="form-control <?= ($validation->hasError('book_publication_year')) ? 'is-invalid' : '' ?>" id="book_publication_year" name="book_publication_year" value="<?= set_value('book_publication_year', $book['book_publication_year']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('book_publication_year') ?></div>
                </div>
                <div class="form-group">
                    <label for="book_pages">Pages</label>
                    <input type="number" class="form-control <?= ($validation->hasError('book_pages')) ? 'is-invalid' : '' ?>" id="book_pages" name="book_pages" value="<?= set_value('book_pages', $book['book_pages']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('book_pages') ?></div>
                </div>
                <div class="form-group">
                    <label for="book_stock">Stock</label>
                    <input type="number" class="form-control <?= ($validation->hasError('book_stock')) ? 'is-invalid' : '' ?>" id="book_stock" name="book_stock" value="<?= set_value('book_stock', $book['book_stock']) ?>">
                    <div class="invalid-feedback"><?= $validation->getError('book_stock') ?></div>
                </div>

                <a href="<?= base_url('book') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>