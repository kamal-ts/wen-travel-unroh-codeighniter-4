<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>


<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container">

        
        <form action="<?= base_url(); ?>/jemaah/saveporsi" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <input type="hidden" value="<?= $idJemaah; ?>" name="idJemaah">

            <div class="form-group row">
                <label for="namaDok" class="col-sm-2 col-form-label">Nama Dokumen</label>
                <div class="col-sm-7">
                        <!--<input type="text" class="form-control" id="jekel" name="jekel">-->
                        <select id="jekel" name="namaDok" class="custom-select">
                            <option value="a" selected disabled>pilih..</option>

                            <option value="1"></option>
                            <option value="2">Perempuan</option>

                        </select>
                    </div>
            </div>
            <div class="form-group row">
                <label for="namaFile" class="col-sm-2 col-form-label">Nomor Porsi</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control <?= ($validation->hasError('namaFile')) ? 'is-invalid' : ''; ?>" id="name" placeholder="nomor porsi" name="namaFile" autofocus value="<?= old('namaFile'); ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('namaFile'); ?>
                </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Harga Pelunasan</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="name" placeholder="0" name="keterangan" autofocus value="<?= old('keterangan'); ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('keterangan'); ?>
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