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

<?php if ($validation->getErrors()) : ?>

    <div class="alert alert-danger  alert-dismissible fade show" role="alert">
        <strong>Gagal !! </strong><?= $validation->listErrors(); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 text-left">
        <a href="<?= base_url(); ?>/porsiHaji/excel" class="btn btn-success btn-icon-split mr-3">
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
                        <th>Nama</th>
                        <th>Nomor Porsi</th>
                        <th>Harga Pelunasan</th>
                        <th>Tahun Perkiraan Berangkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($porsi as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['namaJemaah']; ?></td>
                            <td><?= $row['nomorPorsi']; ?></td>
                            <td>$ <?= number_format($row['hargaPelunasan'],2,',','.'); ?></td>
                            <td><?= $row['tglBerangkat']; ?></td>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#update<?= $row['id']; ?>">
                                    Update
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
<?php foreach ($porsi as $row) : ?>

    <!-- Modal -->
    <div class="modal fade" id="update<?= $row['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Porsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url(); ?>/porsiHaji/update" method="post" enctype="multipart/form-data">

                        <input type="hidden" value="<?= $row['id']; ?>" name="id">

                        <div class="form-group row">
                            <label for="nomorPorsi" class="col-sm-4 col-form-label">Nomor Porsi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="nomorPorsi" placeholder="0" name="nomorPorsi" required autofocus value="<?= $row['nomorPorsi']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hargaPelunasan" class="col-sm-4 col-form-label">Harga Pelunasan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="hargaPelunasan" placeholder="0" name="hargaPelunasan" required autofocus value="<?= $row['hargaPelunasan']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="tglBerangkat" class="col-sm-4 col-form-label">Tahun Perkiraan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="name" placeholder="0000M/0000H" required name="tglBerangkat" autofocus value="<?= $row['tglBerangkat']; ?>">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary">Close</a>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>

                </form>
            </div>
        </div>
    </div>


<?php endforeach; ?>



<?= $this->endSection(); ?>