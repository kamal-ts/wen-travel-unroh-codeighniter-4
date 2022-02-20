<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>

<div class="card shadow mb-4 text-dark">
    <div class="card-body ">
        <div class="container">


            <form action="<?= base_url(); ?>/jemaah/save" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="noKtp" class="col-sm-3 col-form-label">No. KTP</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="noKtp" name="noKtp" placeholder="Nomor  KTP">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="noPaspor" class="col-sm-3 col-form-label">No. Paspor</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="noPaspor" name="noPaspor" placeholder="Nomor Paspor">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaLengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" placeholder="Input Nama Lengkap">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jekel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-7">
                        <!--<input type="text" class="form-control" id="jekel" name="jekel">-->
                        <select id="jekel" name="jekel" class="custom-select">
                            <option value="a" selected disabled>pilih jenis kelamin</option>

                            <option value="1">Laki - Laki</option>
                            <option value="2">Perempuan</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="namaAyah" class="col-sm-3 col-form-label">Nama Ayah Kandung</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="namaAyah" name="namaAyah" placeholder="Nama Ayah Kandung">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaIbu" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="namaIbu" name="namaIbu" placeholder="Nama Ibu Kandung">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tmpLahir" class="col-sm-3 col-form-label">Tempat & Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="tmpLahir" name="tmpLahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" value="2020-02-02" class="form-control" id="tglLahir" name="tglLahir">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamatRumah" class="col-sm-3 col-form-label">Alamat Rumah</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" id="alamatRumah" rows="3" name="alamatRumah" placeholder="Input Alamat Rumah Lengkap"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kota" class="col-sm-3 col-form-label">Kota</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telpRumah" class="col-sm-3 col-form-label">Telpon Rumah</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="telpRumah" name="telpRumah" placeholder="Nomor Telpon Rumah">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telpMobile" class="col-sm-3 col-form-label">Telpon Mobile</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="telpMobile" name="telpMobile" placeholder="Nomor Telpon Mobile">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ukuranPakaian" class="col-sm-3 col-form-label">Ukuran Pakaian</label>
                    <div class="col-sm-7">
                        <!--<input type="text" class="form-control" id="ukuranPakaian" name="ukuranPakaian">-->
                        <select id="ukuranPakaian" name="ukuranPakaian" class="custom-select">
                            <option value="a" selected disabled>pilih ukuran pakaian</option>

                            <option value="1">S</option>
                            <option value="2">L</option>
                            <option value="2">XL</option>
                            <option value="2">XXL</option>

                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="namaPaket" class="col-sm-3 col-form-label">Nama Paket</label>
                    <div class="col-sm-7">
                        <!--<input type="text" class="form-control" id="namaPaket" name="namaPaket">-->
                        <select id="namaPaket" name="idPaket" class="custom-select">
                            <option value="a" selected disabled>Pilih Paket</option>

                            <?php foreach ($paket as $row) : ?>
                                <?php if ($row['kategori'] == $kategori) : ?>
                                    <option value="<?= $row['idPaket']; ?>"><?= $row['namaPaket']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>

                <?php if ($kategori == 'umroh') : ?>

                    <div class="form-group row">
                        <label for="jadwal" class="col-sm-3 col-form-label">Jadwal Rencana Berangkat</label>
                        <div class="col-sm-7">
                            <!--<input type="text" class="form-control" id="jadwal" name="jadwal">-->
                            <select id="jadwal" name="idJadwal" class="custom-select">
                                <option value="a" selected disabled>Pilih Jadwal Berangkat</option>

                                <?php foreach ($jadwal as $row) : ?>
                                    <option value="<?= $row['idJadwal']; ?>"><?= $row['namaPesawat']; ?>, <?= $row['tglBerangkat']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group row">
                    <div class="col-sm-10 text-right mt-4">
                        <a href="<?= base_url(); ?>/jemaah/<?= $kategori; ?>" class="btn btn-danger mr-4">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>