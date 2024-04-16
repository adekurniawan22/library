<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Update Borrowing</h1>

    <!-- Form untuk menambahkan data buku -->
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('borrowing/edit/' . $borrowing['borrowing_id']) ?>" method="POST">
                <div class="form-group mb-3" id="return_date_field">
                    <label for="return_date">Return Date</label>
                    <input type="date" class="form-control <?= ($validation->hasError('return_date')) ? 'is-invalid' : '' ?>" id="return_date" title="return_date" name="return_date" value="<?= set_value('return_date') ?>">
                    <div class="invalid-feedback"><?= $validation->getError('return_date') ?></div>
                </div>

                <div class="form-group mb-3">
                    <input type="checkbox" class="mr-2" id="cheklist" name="cheklist[]">Cheklist if you want to reset return borrowing
                </div>

                <a href="<?= base_url('borrowing') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
    document.getElementById('cheklist').addEventListener('change', function() {
        var returnDateField = document.getElementById('return_date_field');
        if (this.checked) {
            returnDateField.style.display = 'none';
        } else {
            returnDateField.style.display = 'block';
        }
    });
</script>

<?= $this->endSection() ?>