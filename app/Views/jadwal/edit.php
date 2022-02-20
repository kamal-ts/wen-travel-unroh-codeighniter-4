<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>

<div class="card shadow mb-4 col-sm-6">
    <div class="card-body">
        <form action="<?= base_url(); ?>/jadwal/update" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <input type="hidden" name="idJadwal" value="<?= $jadwal['idJadwal']; ?>">

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
                        <option value="<?= $row['idPaket']; ?>" 
                        <?php if(old('idPaket')){
                                if(old('idPaket') == $row['idPaket']){
                                    echo "selected";
                                }
                            }else{
                                if($jadwal['idPaket'] == $row['idPaket']){
                                    echo "selected";
                                }
                            } 
                        ?>><?= $row['namaPaket']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('idPaket'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="namaPesawat">Nama Pesawat</label>
                <input type="text" class="form-control <?= ($validation->hasError('namaPesawat')) ? 'is-invalid' : ''; ?>" id="namaPesawat" placeholder="Nama Pesawat" name="namaPesawat" value="<?= old('namaPesawat') ? old('namaPesawat') : $jadwal['namaPesawat']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('namaPesawat'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="harga">Harga Daftar</label>
                <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" placeholder="0" name="harga" value="<?= old('harga') ? old('harga') : $jadwal['harga'];?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('harga'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="slot">Slot</label>
                <input type="text" class="form-control <?= ($validation->hasError('slot')) ? 'is-invalid' : ''; ?>" id="slot" placeholder="0" name="slot" value="<?= old('slot') ? old('slot') : $jadwal['slot']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('slot'); ?>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="tglBerangkat">Tanggal Berangkat</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tglBerangkat')) ? 'is-invalid' : ''; ?>" id="tglBerangkat" placeholder="yyyy-mm-dd " name="tglBerangkat" value="<?= old('tglBerangkat') ? old('tglBerangkat') : $tgl; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tglBerangkat'); ?>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="jamBerangkat">Jam Berangkat</label>
                        <input type="time" class="form-control <?= ($validation->hasError('jamBerangkat')) ? 'is-invalid' : ''; ?>" id="jamBerangkat" placeholder="yyyy-mm-dd " name="jamBerangkat" value="<?= old('jamBerangkat') ? old('jamBerangkat') : $jam; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jamBerangkat'); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="status">status</label>
                <select id="status" name="status" class="custom-select <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>">
                    <option value="1" selected disabled>Choose...</option>

                    <?php 
                        $batal = "";
                        $siap ="";
                        $selesai="";
                        if($jadwal['status'] == 'batal' || old('status') == 'batal' ){
                                $batal = "selected";
                        }elseif($jadwal['status'] == 'siap' || old('status') == 'siap'){
                                $siap = 'selected';
                        }elseif($jadwal['status'] == 'selesai' || old('status') == 'selesai'){
                                $selesai = 'selected';
                        }
                    
                    ?>

                    <option value="batal" <?= $batal; ?> >Batal</option>
                    <option value="siap" <?= $siap; ?>>Siap</option>
                    <option value="selesai" <?= $selesai; ?>>Selesai</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('status'); ?>
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