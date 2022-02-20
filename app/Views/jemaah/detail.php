<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>

<?php
if ($jemaah['statusJemaah'] == 'pulang')
    $warna = "secondary";
elseif ($jemaah['statusJemaah'] == 'berangkat')
    $warna = "primary";
elseif ($jemaah['statusJemaah'] == 'lunas pending')
    $warna = "success";
elseif ($jemaah['statusJemaah'] == 'pending')
    $warna = "warning";
elseif ($jemaah['statusJemaah'] == 'belum lunas')
    $warna = "danger";
?>

<?php if (session()->getFlashdata('pesan')) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulation!</strong> <?= session()->getFlashdata('pesan'); ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('pesangagal')) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>!!!</strong> <?= session()->getFlashdata('pesangagal'); ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>

<a class="btn mb-2 text-primary" href="<?= base_url(); ?>/jemaah/<?= $jemaah['kategori']; ?>"><i class="fas fa-angle-double-left"></i> Kembali</a>

<div class="card shadow mb-4 text-dark">
    <div class="card-header py-3 text-left">


        <?php if ($jemaah['kategori'] == 'haji' && $jemaah['statusJemaah'] != 'belum lunas') : ?>
            <a href="<?= base_url(); ?>/jemaah/createporsi/<?= $jemaah['idJemaah']; ?>" class="btn btn-primary btn-icon-split mr-3">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data Porsi</span>
            </a>
        <?php endif; ?>

        <a href="" class="btn btn-warning btn-icon-split mr-3" data-toggle="modal" data-target="#statusJemaah">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Ubah Status Jemaah</span>
        </a>
        <a href="<?= base_url(); ?>/persyaratan/<?= $jemaah['idJemaah']; ?>" class="btn btn-dark btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-file-upload"></i>
            </span>
            <span class="text">Dokumen Persyaratan</span>
        </a>

        <a href="javascript:printDiv('print-area-2');" class="btn btn-danger btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-print"></i>
            </span>
            <span class="text">Print</span>
        </a>
        <!-- <a  class="btn btn-danger btn-icon-split mr-3" data-toggle="modal" data-target="#deletJemaah">
            <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
            </span>
            <span class="text">Hapus</span>
        </a> -->
    </div>
    <div id="print-area-2" class="card-body">
        <div class="container">
            <h4 class="card-title"><?= $jemaah['namaPaket']; ?></h4>
            <h5 class="card-subtitle mb-2"><span class="badge badge-<?= $warna; ?>"><?= $jemaah['statusJemaah']; ?></span></h5>
            <?php if ($jemaah['kategori'] == 'umroh') : ?>
                <p class="card-text"><?= $jemaah['namaPesawat']; ?> | <?= $jemaah['jamBerangkat']; ?></p>
            <?php endif; ?>
            <hr>
            <div class="row">
                <div class="col-sm-7">

                    <table class="font-weight-bold text-dark">
                        <?php if ($porsi) : ?>
                            <tr class="bg-success text-light">
                                <td valign=top width="200px">Nomor Porsi </td>
                                <td valign=top width="30px">:</td>
                                <td valign=top><?= $porsi['nomorPorsi']; ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td valign=top width="200px">Nomor KTP </td>
                            <td valign=top width="30px">:</td>
                            <td valign=top><?= $jemaah['noKtp']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nomor Paspor </td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['noPaspor']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nama Jemaah</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['namaJemaah']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nama Ayah Kandung</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['namaAyahKandung']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nama Ibu Kandung</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['namaIbuKandung']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Tempat Tanggal Lahir</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['tempatLahir']; ?>, <?= $jemaah['tglLahir']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Alamat Rumah</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['alamatRumah']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Kelurahan</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['kelurahan']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Kota</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['kota']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Kode POS</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['kodePos']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Alamat Rumah</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['kota']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nomor Telpon Rumah</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['telponRumah']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nomor Telpon Mobile</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['telponMobile']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Pekerjaan</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['pekerjaan']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Ukuran Pakaian</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['pekerjaan']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Email</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['email']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Status Perkawinan</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $jemaah['statusPerkawinan']; ?></td>
                        </tr>

                        <?php if ($jemaah['kategori'] == 'umroh') : ?>
                            <tr>
                                <td valign=top>Tanggal Berangkat</td>
                                <td valign=top>:</td>
                                <td valign=top><?= $jemaah['jamBerangkat']; ?></td>
                            </tr>
                            <tr>
                                <td valign=top>Tanggal Kembali</td>
                                <td valign=top>:</td>
                                <td valign=top><?= $jemaah['tglKembali'] == '0000-00-00' ? '-' : $jemaah['tglKembali']; ?></td>
                            </tr>
                        <?php endif; ?>

                    </table>
                </div>
                
                <div class="col-sm-5">
                    <?php if($pembayaran) : ?>
                    <table class="table table-sm text-dark">
                        <thead>
                            <tr>
                                <th>Jumlah Yang Dibayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($pembayaran as $row) : ?>
                                <?php $jumlah[] = $row['jumlahBayar']; ?>
                                <tr>
                                    <td><?= $jemaah['kategori'] == 'umroh' ? 'Rp':'$'; ?> <?= number_format($row['jumlahBayar'],2,',','.'); ?></td>
                                    <td><?= $row['statusPembayaran']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                    <table class="table table-sm text-dark">
                    <?php if($pembayaran) : ?>
                        <tr>
                            <th>Total Jumlah Yang Dibayar</th>
                            <th>=</th>
                            <th><?= $jemaah['kategori'] == 'umroh' ? 'Rp':'$'; ?> <?= number_format(array_sum($jumlah),2,',','.'); ?></th>
                        </tr>
                        <?php if($jemaah['kategori'] == 'haji') :?>
                        <tr>
                            <th>Total Harga Pelunasan</th>
                            <th>=</th>
                            <th>$ <?=  number_format($porsi['hargaPelunasan'],2,',','.'); ?></th>
                        </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                        <tr>
                            <th>Total Yang Harus Dibayar</th>
                            <th>=</th>
                            <?php if($jemaah['kategori'] == 'umroh'): ?>
                                <th>Rp <?= number_format($jemaah['harga']+$jemaah['hargaDaftar'],2,',','.'); ?></th>
                            <?php elseif($porsi) : ?>
                                <th>$ <?= number_format($porsi['hargaPelunasan']+$jemaah['hargaDaftar'],2,',','.'); ?></th>
                            <?php else : ?>
                                <th>$ <?= number_format($jemaah['hargaDaftar'],2,',','.'); ?></th>
                            <?php endif; ?>
                        </tr>

                    </table>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="statusJemaah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Status Jemaah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url(); ?>/jemaah/update/<?= $jemaah['idJemaah']; ?>" method="post" enctype="multipart/form-data">

                    <input type="hidden" value="<?= $jemaah['kategori']; ?>" name="kategori">
                    <div class="form-group row">
                        <label for="jekel" class="col-sm-4 col-form-label">Status Jemaah</label>
                        <div class="col-sm-7">
                            <!--<input type="text" class="form-control" id="jekel" name="jekel">-->
                            <select id="jekel" name="statusJemaah" class="custom-select">
                                <option value="a" selected disabled>pilih</option>
                                <option value="belum lunas" <?= $jemaah['statusJemaah'] == 'belum lunas' ? 'selected' : ''; ?>>Belum Lunas</option>
                                <?php if ($jemaah['kategori'] == 'haji') : ?>
                                    <option value="pending" <?= $jemaah['statusJemaah'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <?php endif; ?>
                                <option value="lunas pending" <?= $jemaah['statusJemaah'] == 'lunas pending' ? 'selected' : ''; ?>>Lunas Pending</option>
                                <option value="berangkat" <?= $jemaah['statusJemaah'] == 'berangkat' ? 'selected' : ''; ?>>Berangkat</option>
                                <option value="pulang" <?= $jemaah['statusJemaah'] == 'pulang' ? 'selected' : ''; ?>>Pulang</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <a href="<?= base_url(); ?>/jemaah/detail_<?= $jemaah['kategori']; ?>/<?= $jemaah['idJemaah']; ?>" class="btn btn-secondary">Close</a>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- delete Modal-->
<div class="modal fade" id="deletJemaah" tabindex="-1" role="dialog" aria-labelledby="deletJemaah" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletJemaah">Are you sure you want to delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <form action="/jemaah/<?= $jemaah['idJemaah']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="kategori" value="<?= $jemaah['kategori']; ?>">
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>


<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>

<script type="text/javascript">
    function printDiv(elementId) {
        var a = document.getElementById('print-area-2').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
</script>

<?= $this->endSection(); ?>