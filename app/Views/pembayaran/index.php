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

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 text-left">
        <a href="<?= base_url(); ?>/pembayaran/excel/<?= $kategori; ?>" class="btn btn-success btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Excel</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Rekening</th>
                        <th>Pemilik Rekening</th>
                        <th>Jumlah Bayar</th>
                        <th>Tanggal Transfer</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($pembayaran as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['noRek']; ?></td>
                            <td><?= $row['pemilikRek']; ?></td>
                            <td><?= $kategori == 'haji'? '$' : 'Rp'; ?> <?= number_format($row['jumlahBayar'],2,',','.'); ?></td>
                            <td><?= $row['tglTransfer']; ?></td>

                            <?php
                            $a = $row['statusPembayaran'];

                            if ($a == 'konfirmasi')
                                $warna = "success";
                            else
                                $warna = "danger";
                            ?>
                            
                            <td><h5><span class="badge badge-<?= $warna; ?>"><?= $row['statusPembayaran']; ?></span></h5></td>
                            
                            <td>
                                <a href="<?= base_url(); ?>/pembayaran/detail/<?= $row['idBukti']; ?>" class="btn btn-info">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>