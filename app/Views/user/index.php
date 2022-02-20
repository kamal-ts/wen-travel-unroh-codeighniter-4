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

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> <?= session()->getFlashdata('pesangagal'); ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 text-left">
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
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($users as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['email']; ?></td>
                            
                            <?php if($row['role_id'] == '1'){
                                    $warna = 'primary';
                            }elseif($row['role_id'] == '2'){
                                    $warna = 'warning';
                            }
                            elseif($row['role_id'] == '3'){
                                    $warna = 'danger';
                            }
                            
                            ?>
                            <td> <h5><span class="badge badge-<?= $warna; ?>"><?= $row['role']; ?></h5></span></td>

                            
                            <?php if($row['is_active'] == '1'): ?>
                            <td class="text-success font-weight-bold">Aktif</td>
                            <?php else : ?>
                            <td class="text-danger font-weight-bold">Tidak Aktif</td>
                            <?php endif; ?>
                            
                            <td>
                                <a data-toggle="modal" data-target="#status<?= $row['id']; ?>" class="btn btn-warning">
                                    Update
                                </a>
                                <a data-toggle="modal" data-target="#delet<?= $row['id']; ?>" class="btn btn-danger">
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
                    <?php foreach ($users as $row) : ?>
<!-- Logout Modal-->
<div class="modal fade" id="delet<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="<?= base_url(); ?>/users/<?= $row['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="status<?= $row['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url(); ?>/users/update/<?= $row['id']; ?>" method="post" enctype="multipart/form-data">

                    
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status User</label>
                        <div class="col-sm-7">
                            <!--<input type="text" class="form-control" id="status" name="status">-->
                            <select id="status" name="is_active" class="custom-select">
                                <option value="a" selected disabled>pilih</option>
                                <option value="1" <?= $row['is_active'] == '1' ? 'selected' : ''; ?>>Aktif</option>
                                
                                <option value="0" <?= $row['is_active'] == '0' ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Role User</label>
                        <div class="col-sm-7">
                            <!--<input type="text" class="form-control" id="status" name="status">-->
                            <select id="status" name="role_id" class="custom-select">
                                <option value="a" selected disabled>pilih</option>
                                <?php foreach($role as $r) : ?>
                                <option value="<?= $r['idRole']; ?>" <?= $row['role_id'] == $r['idRole'] ? 'selected' : ''; ?>><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <a href="<?= base_url(); ?>/users" class="btn btn-secondary">Close</a>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>

            </form>
        </div>
    </div>
</div>


<?php endforeach; ?>

<?= $this->endSection(); ?>