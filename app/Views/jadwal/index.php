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
<?php if (session()->getFlashdata('pesangagal')) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulation!</strong> <?= session()->getFlashdata('pesangagal'); ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 text-left">
        <a href="<?= base_url(); ?>/jadwal/create" class="btn btn-primary btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Jadwal</span>
        </a>
        <!-- <a href="<?= base_url(); ?>/jadwal/create" class="btn btn-success btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Excel</span>
        </a> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Nama Pesawat</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Slot</th>
                        <th>Tanggal Berangkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($jadwal as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['namaPaket']; ?></td>
                            <td><?= $row['namaPesawat']; ?></td>
                            <td><?= number_format($row['harga'],2,',','.') ; ?></td>
                            <?php 

                            $a= $row['status'];
                            if($a == 'siap'){
                                $warna = 'primary';
                            }
                            elseif ($a == 'batal') {
                                $warna = 'danger';
                            }
                            elseif ($a == 'selesai') {
                                $warna = 'success';
                            }
                            ?>



                            <td><h5><span class="badge badge-<?= $warna; ?>"><?= $row['status']; ?></span></h5></td>
                            <td><?= $row['slot']; ?></td>
                            <td><?= date('d-m-Y G:i:s',strtotime($row['jamBerangkat'])) ; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>/jadwal/edit/<?= $row['idJadwal']; ?>" class="btn btn-warning">
                                    Edit
                                </a>
                                <a data-toggle="modal" data-target="#delet<?= $row['idJadwal']; ?>" class="btn btn-danger">
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
                    <?php foreach ($jadwal as $row) : ?>
<!-- Logout Modal-->
<div class="modal fade" id="delet<?= $row['idJadwal']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="<?= base_url(); ?>/jadwal/<?= $row['idJadwal']; ?>" method="post">
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