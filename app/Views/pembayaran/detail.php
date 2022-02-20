<?= $this->extend('layout/index'); ?>

<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulation!</strong> <?= session()->getFlashdata('pesan'); ?>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php endif; ?>

<a class="btn mb-2 text-primary" href="<?= base_url(); ?>/pembayaran/<?= $pembayaran['kategori']; ?>"><i class="fas fa-angle-double-left"></i> Kembali</a>
<div class="card shadow mb-4 text-dark">

    <div class="card-header py-3 text-left">    
        <a href="<?= base_url(); ?>" class="btn btn-primary btn-icon-split mr-3" data-toggle="modal" data-target="#konfirmasiPembayaran">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">Konfirmasi Pembayaran</span>
        </a>
        <a href="<?= base_url(); ?>/jemaah/detail_<?= $pembayaran['kategori']; ?>/<?= $pembayaran['idJemaah']; ?>" class="btn btn-info btn-icon-split mr-3">
            <span class="icon text-white-50">
            <i class="fas fa-info"></i>
            </span>
            <span class="text">Detail Jemaah</span>
        </a>
        <!-- <a href="" class="btn btn-danger btn-icon-split mr-3" data-toggle="modal" data-target="#deletModal">
            <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
            </span>
            <span class="text">Hapus</span>
        </a> -->
    </div>
    <div id="print-area-2" class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">

                    <table class="table table-sm text-dark">
                        <tr>
                            <td valign=top width="200px">No. Rekening</td>
                            <td valign=top width="30px">:</td>
                            <td valign=top><?= $pembayaran['noRek']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Pemilik Rekening</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $pembayaran['pemilikRek']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Nama Bank</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $pembayaran['namaBank']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Jumlah Bayar</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $pembayaran['kategori'] == 'haji'? '$' : 'Rp'; ?> <?= number_format($pembayaran['jumlahBayar'],2,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Bank Tujuan</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $pembayaran['bankTujuan']; ?></td>
                        </tr>
                        <tr>
                            <td valign=top>Tanggal Transfer</td>
                            <td valign=top>:</td>
                            <td valign=top><?= $pembayaran['tglTransfer']; ?></td>
                        </tr>

                        <?php
                        $a = $pembayaran['statusPembayaran'];

                        if ($a == 'konfirmasi')
                                $warna = "success";
                            else
                                $warna = "danger";
                            ?>

                        <tr>
                            <td valign=top>Status Pembayaran</td>
                            <td valign=top>:</td>
                            <td valign=top ><h5><span class="badge badge-<?= $warna; ?>"><?= $pembayaran['statusPembayaran']; ?></span></h5></td>
                        </tr>

                    </table>
                </div>
                <div class="col-sm-4">

                            <a href="" data-toggle="modal" data-target="#modalImg">
                                <img src="<?= base_url(); ?>/img/<?= $pembayaran['gambarStruk']; ?>" class="img-fluid" alt="..." width="150">
                            </a>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="konfirmasiPembayaran" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Status Pemabayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>/pembayaran/savebayar" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>


                <input type="hidden" value="<?= $pembayaran['kategori']; ?>" name="kategori">
                <input type="hidden" value="<?= $pembayaran['idBukti']; ?>" name="idBukti">
                <input type="hidden" value="konfirmasi" name="statusPembayaran">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Konfirmasi</button>
                    <button type="button" class="btn btn-secondary btn-lg btn-block" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- delete Modal-->
<div class="modal fade" id="deletModal" tabindex="-1" role="dialog" aria-labelledby="deletModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletModal">Are you sure you want to delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <form action="/pembayaran/<?= $pembayaran['idBukti']; ?>" method="post">
                <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="kategori" value="<?= $pembayaran['kategori']; ?>">
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalImg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <img src="<?= base_url(); ?>/img/<?= $pembayaran['gambarStruk']; ?>" class="img-fluid" alt="...">
  </div>
</div>


<?= $this->endSection(); ?>