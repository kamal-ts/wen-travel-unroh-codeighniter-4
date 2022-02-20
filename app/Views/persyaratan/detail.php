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
        <!-- <a href="<?= base_url(); ?>/persyaratan/create/<?= $idJemaah; ?>" class="btn btn-primary btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a> -->
    </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-4">
            <?php if ($persyaratan) : ?>
                <?php foreach ($persyaratan as $row) : ?>
                    <div class="col mb-4">
                        <div class="card">
                            <a href="" data-toggle="modal" data-target="#modal<?= $row['idPersyaratan']; ?>">
                                <img src="<?= base_url(); ?>/img/<?= $row['namaFile']; ?>" class="card-img-top" height="200">
                            </a>
                            <div class="card-body text-dark">
                                <h5 class="card-title"><?= $row['namaDok']; ?></h5>
                                <!-- <a href="#" class="card-link btn btn-primary btn-sm">Ubah</a>
                            <a href="#" class="card-link btn btn-danger btn-sm">Hapus</a> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h4 class="ml-4">Tidak Ada Dokumen</h4>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php foreach ($persyaratan as $row) : ?>
    <div class="modal fade" id="modal<?= $row['idPersyaratan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <img src="<?= base_url(); ?>/img/<?= $row['namaFile']; ?>" class="img-fluid" alt="...">
            </div>
        </div>
    </div>

<?php endforeach; ?>
<!-- Modal -->

<?= $this->endSection(); ?>