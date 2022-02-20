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
        <a href="<?= base_url(); ?>/jemaah/excel/<?= $kategori; ?>" class="btn btn-success btn-icon-split mb-3 mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Excel</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>No. KTP</th>
                        <th>No. Paspor</th>
                        <th>Nama Jemaah</th>
                        <th>Status Jemaah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>No. KTP</th>
                        <th>No. Paspor</th>
                        <th>Nama Jemaah</th>
                        <th>Status Jemaah</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($jemaah as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['namaPaket']; ?></td>
                            <td><?= $row['noKtp']; ?></td>
                            <td><?= $row['noPaspor']; ?></td>
                            <td><?= $row['namaJemaah']; ?></td>

                            <?php
                            if ($row['statusJemaah'] == 'selesai')
                                $warna = "secondary";
                            elseif ($row['statusJemaah'] == 'berangkat')
                                $warna = "primary";
                            elseif ($row['statusJemaah'] == 'lunas pending')
                                $warna = "success";
                            elseif ($row['statusJemaah'] == 'pending')
                                $warna = "warning";
                            elseif ($row['statusJemaah'] == 'belum lunas')
                                $warna = "danger";
                            ?>

                            <td><h5><span class="badge badge-<?= $warna; ?>"><?= $row['statusJemaah']; ?></span></h5></td>
                            <td>
                                <a href="<?= base_url(); ?>/jemaah/detail_<?= $row['kategori']; ?>/<?= $row['idJemaah']; ?>" class="btn btn-info">
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