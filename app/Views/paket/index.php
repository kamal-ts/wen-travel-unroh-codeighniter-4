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
        <a href="<?= base_url(); ?>/paket/create" class="btn btn-primary btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kategori</th>
                        <th>Nomor Paket</th>
                        <th>Deskripsi</th>
                        <th>Harga Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($paket as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= $row['namaPaket']; ?></td>
                            <td><?= $row['description']; ?></td>
                            <td><?= $row['kategori'] == 'haji' ? '$' : 'Rp'; ?> <?=  number_format($row['hargaDaftar'],2,',','.'); ?></td>
                            <td>
                                <a href="<?= base_url(); ?>/paket/edit/<?= $row['idPaket']; ?>" class="btn btn-warning">
                                    Edit
                                </a>
                                <a data-toggle="modal" data-target="#delet<?= $row['idPaket']; ?>" class="btn btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $i = 1 ?>
                    <?php foreach ($paket as $row) : ?>
<!-- Logout Modal-->
<div class="modal fade" id="delet<?= $row['idPaket']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="<?= base_url(); ?>/paket/<?= $row['idPaket']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>

<?= $this->endSection(); ?>