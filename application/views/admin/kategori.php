<main id="main" class="main">
    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </nav>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="bi bi-plus"></i> Tambah Data
                            </button>
                        </h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Jenis Kategori</th>
                                    <th class="text-center">Nama Kategori</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($kategori)) : ?>
                                    <?php foreach ($kategori as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $key + 1; ?>.</td>
                                            <td><?= ucwords($value['jenis_kategori']); ?></td>
                                            <td><?= ucwords($value['nama_kategori']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_kategori']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr align="center">
                                        <td colspan="4">Tidak ada data</td>
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

<!-- TAMBAH DATA -->
<div class="modal fade" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/tambah_kategori'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="jenis_kategori" class="form-label">Jenis Kategori</label>
                        <select id="jenis_kategori" class="form-select" name="jenis_kategori" required oninvalid="this.setCustomValidity('Silakan pilih jenis kategori')" oninput="this.setCustomValidity('')">
                            <option selected disabled value="">Pilih</option>
                            <option value="instan">Instan</option>
                            <option value="non-instan">Non-Instan</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama menu" required oninvalid="this.setCustomValidity('Silakan masukkan nama kategori')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($kategori as $key => $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_kategori']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('admin/edit_kategori/' . $value['id_kategori']) ?>
                <?= form_hidden('id_kategori', $value['id_kategori']) ?>
                <div class="modal-body">
                    <div class="col-12 mb-3">
                        <label for="jenis_kategori" class="form-label">Jenis Kategori</label>
                        <select id="jenis_kategori" class="form-select" name="jenis_kategori" required oninvalid="this.setCustomValidity('Silakan pilih jenis kategori')" oninput="this.setCustomValidity('')">
                            <option selected disabled value="">Pilih</option>
                            <option value="instan" <?= $value['jenis_kategori'] == 'instan' ? 'selected' : '' ?>>Instan</option>
                            <option value="non-instan" <?= $value['jenis_kategori'] == 'non-instan' ? 'selected' : '' ?>>Non-Instan</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" required oninvalid="this.setCustomValidity('Silakan masukkan nama kategori')" oninput="this.setCustomValidity('')" value="<?= ucwords($value['nama_kategori']); ?>">
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
<?php endforeach; ?>