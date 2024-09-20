<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th width="20%">Nama Lengkap</th>
                                    <th>: <?= ucwords($user['nama_lengkap']); ?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Email</th>
                                    <th>: <?= ucwords($user['email']); ?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Nomor Telepon</th>
                                    <th>: <?= $user['no_hp']; ?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Jenis Akun</th>
                                    <th>: <?= ucwords($user['role']); ?></th>
                                </tr>
                                <tr>
                                    <?php
                                    $status_pembayaran = [
                                        'Aktif'         => 'text-bg-success',
                                        'Tidak Aktif'   => 'text-bg-danger',
                                    ];

                                    $statusClass = isset($status_pembayaran[$user['status']]) ? $status_pembayaran[$user['status']] : '';
                                    ?>

                                    <th width="20%">Status Akun</th>
                                    <td>:
                                        <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                            <?= ucwords($user['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $user['id_user']; ?>" title="Edit">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit<?= $user['id_user']; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/edit_profile/' . $user['id_user']) ?>
            <?= form_hidden('id_user', $user['id_user']) ?>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= $user['nama_lengkap']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="no_hp">Nomor Telepon</label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor telepon" value="<?= $user['no_hp']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                    <small class="form-text text-muted">*Kosongkan jika tidak ingin mengubah password.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>