<main id="main" class="main">
    <div class="pagetitle">
        <h1>Registrasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Registrasi</li>
            </ol>
        </nav>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">No Hp</th>
                                    <th class="text-center">Tanggal Transaksi</th>
                                    <th class="text-center">Bukti Transaksi</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($registrasi)) : ?>
                                    <?php foreach ($registrasi as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $key + 1; ?>.</td>
                                            <td><?= ucwords($value['nama_lengkap']); ?></td>
                                            <td><?= $value['email']; ?></td>
                                            <td><?= $value['no_hp']; ?></td>
                                            <td><?= tanggalIndonesia($value['tanggal_transaksi']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_transaksi_pendaftaran']; ?>">
                                                    <i class="bi bi-card-image"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <?php
                                                $status_user = [
                                                    'Tidak Aktif'   => 'bg-danger',
                                                    'Aktif'         => 'bg-success',
                                                ];

                                                $statusClass = isset($status_user[$value['status']]) ? $status_user[$value['status']] : '';
                                                ?>

                                                <span class="badge rounded-pill fw-normal <?= $statusClass; ?>">
                                                    <?= ucwords($value['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_user']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr align="center">
                                        <td colspan="8">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php foreach ($registrasi as $key => $value) : ?>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $value['id_user']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('admin/edit_registrasi/' . $value['id_user']) ?>
                <?= form_hidden('id_user', $value['id_user']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select" name="status" required oninvalid="this.setCustomValidity('Silakan pilih status')" oninput="this.setCustomValidity('')">
                                <option selected disabled value="">Pilih</option>
                                <option value="Aktif" <?= $value['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="Tidak Aktif" <?= $value['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                        </div>
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

    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_transaksi_pendaftaran']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/img/transaksi_pendaftaran/' . $value['bukti_transaksi']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>