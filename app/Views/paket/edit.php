<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>

<div class="card shadow mb-4 col-sm-6">
    <div class="card-body">
        <form action="<?= base_url(); ?>/paket/update" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <input type="hidden" name="idPaket" value="<?= $paket['idPaket']; ?>">

            <div class="form-group">
                <input type="hidden" class="form-control <?= ($validation->hasError('namaPaket')) ? 'is-invalid' : ''; ?>" id="namaPaket" placeholder="Nama Paket"  value="<?= old('namaPaket') ? old('namaPaket') : $paket['namaPaket']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('namaPaket'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" class="custom-select <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>">
                    <option value="1" selected disabled>Choose...</option>
                    <option value="haji" <?= $paket['kategori'] == 'haji'  ? 'selected' : ''; ?> >Haji</option>
                    <option value="umroh" <?= $paket['kategori'] == 'umroh'  ? 'selected' : ''; ?>>Umroh</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('kategori'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="namaPaket">Nama Paket</label>
                <input type="text" class="form-control <?= ($validation->hasError('namaPaket')) ? 'is-invalid' : ''; ?>" id="namaPaket" placeholder="Nama Paket" name="namaPaket" value="<?= old('namaPaket') ? old('namaPaket') : $paket['namaPaket']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('namaPaket'); ?>
                </div>
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" id="exampleFormControlTextarea1" rows="3"><?= old('description') ? old('description') : $paket['description']; ?></textarea>
                <div class="invalid-feedback">
                    <?= $validation->getError('description'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="hargaDaftar">Harga Daftar</label>
                <input type="text" class="form-control <?= ($validation->hasError('hargaDaftar')) ? 'is-invalid' : ''; ?>" id="hargaDaftar" placeholder="500" name="hargaDaftar" value="<?= old('hargaDaftar') ? old('hargaDaftar') : $paket['hargaDaftar']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('hargaDaftar'); ?>
                </div>
            </div>


            <div class="text-right">
                <a href="<?= base_url(); ?>/paket" class="btn btn-secondary mt-4 mr-2">Cancel</a>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>