<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>


<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container">

        
        <form action="<?= base_url(); ?>/jemaah/saveporsi" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <input type="hidden" value="<?= $idJemaah; ?>" name="idJemaah">

            <div class="form-group row">
                <!-- <label for="nomorPorsi" class="col-sm-3 col-form-label">Nomor Porsi</label> -->
                <div class="col-sm-7">
                    <input type="hidden" class="form-control <?= ($validation->hasError('nomorPorsi')) ? 'is-invalid' : ''; ?>" id="name" placeholder="nomor porsi" name="nomorPorsi" autofocus value="<?= old('nomorPorsi'); ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('nomorPorsi'); ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nomorPorsi" class="col-sm-2 col-form-label">Nomor Porsi</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control <?= ($validation->hasError('nomorPorsi')) ? 'is-invalid' : ''; ?>" id="name" placeholder="nomor porsi" name="nomorPorsi" autofocus value="<?= old('nomorPorsi'); ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('nomorPorsi'); ?>
                </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="hargaPelunasan" class="col-sm-2 col-form-label">Harga Pelunasan</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control <?= ($validation->hasError('hargaPelunasan')) ? 'is-invalid' : ''; ?>" id="name" placeholder="0" name="hargaPelunasan" autofocus value="<?= old('hargaPelunasan'); ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('hargaPelunasan'); ?>
                </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="tglBerangkat" class="col-sm-2 col-form-label">Tanggal Berangkat</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control <?= ($validation->hasError('tglBerangkat')) ? 'is-invalid' : ''; ?>" id="name" placeholder="Tanggal Berengkat" name="tglBerangkat" autofocus value="<?= old('tglBerangkat'); ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tglBerangkat'); ?>
                </div>
                </div>
            </div>


            <div class="text-right">
                <a href="<?= base_url(); ?>/jemaah/detail_haji/<?= $idJemaah; ?>" class="btn btn-secondary mt-4 mr-2">Cancel</a>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </div>
        </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>