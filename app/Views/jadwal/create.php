<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>

<div class="card shadow mb-4 col-sm-6">
    <div class="card-body">
        <form action="<?= base_url(); ?>/jadwal/save" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <input type="hidden" name="status" value="siap">

            <div class="form-group">
                <input type="hidden" class="form-control <?= ($validation->hasError('idPaket')) ? 'is-invalid' : ''; ?>" id="idPaket" placeholder="Nama Paket" value="<?= old('idPaket'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('idPaket'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="idPaket">Paket</label>
                <select id="idPaket" name="idPaket" class="custom-select <?= ($validation->hasError('idPaket')) ? 'is-invalid' : ''; ?>">
                    <option value="a" selected disabled>Choose...</option>
                    <?php foreach ($paket as $row) : ?>
                        <option value="<?= $row['idPaket']; ?>" <?= old('idPaket') ==  $row['idPaket']  ? "selected" : ''; ?>><?= $row['namaPaket']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('idPaket'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="namaPesawat">Nama Pesawat</label>
                <input type="text" class="form-control <?= ($validation->hasError('namaPesawat')) ? 'is-invalid' : ''; ?>" id="namaPesawat" placeholder="Nama Pesawat" name="namaPesawat" value="<?= old('namaPesawat'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('namaPesawat'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="harga">Harga Daftar</label>
                <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" placeholder="0" name="harga" value="<?= old('harga'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('harga'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="slot">Slot</label>
                <input type="text" class="form-control <?= ($validation->hasError('slot')) ? 'is-invalid' : ''; ?>" id="slot" placeholder="0" name="slot" value="<?= old('slot'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('slot'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="tglBerangkat">Tanggal Berangkat</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tglBerangkat')) ? 'is-invalid' : ''; ?>" id="tglBerangkat" placeholder="yyyy-mm-dd " name="tglBerangkat" value="<?= old('tglBerangkat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tglBerangkat'); ?>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="jamBerangkat">Jam Berangkat</label>
                        <input type="time" class="form-control <?= ($validation->hasError('jamBerangkat')) ? 'is-invalid' : ''; ?>" id="jamBerangkat" placeholder="yyyy-mm-dd " name="jamBerangkat" value="<?= old('jamBerangkat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jamBerangkat'); ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-right">
                <a href="/jadwal" class="btn btn-secondary mt-4 mr-2">Cancel</a>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>