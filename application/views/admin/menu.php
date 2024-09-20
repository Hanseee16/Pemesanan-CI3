<main id="main" class="main">
    <div class="pagetitle">
        <h1>Menu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Menu</li>
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
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Nama Menu</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Isi</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($menu)) : ?>
                                    <?php foreach ($menu as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $key + 1; ?>.</td>
                                            <td><?= ucwords($value['jenis_kategori'] . ' - ' . $value['nama_kategori']); ?></td>
                                            <td><?= ucwords($value['nama_menu']); ?></td>
                                            <td>Rp <?= number_format($value['harga']); ?>,-</td>
                                            <td><?= number_format($value['stok']); ?></td>
                                            <td><?= ucwords($value['keterangan']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#isi<?= $value['id_menu']; ?>">
                                                    <i class="bi bi-info"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_menu']; ?>">
                                                    <i class="bi bi-card-image"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_menu']; ?>">
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

<!-- TAMBAH DATA -->
<div class="modal fade" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('admin/tambah_menu') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select id="id_kategori" class="form-select" name="id_kategori" required oninvalid="this.setCustomValidity('Silakan pilih kategori')" oninput="this.setCustomValidity('')">
                            <option selected disabled value="">Pilih</option>
                            <?php foreach ($kategori as $value) : ?>
                                <option value="<?= $value['id_kategori']; ?>">
                                    <?= ucwords($value['jenis_kategori'] . ' - ' . $value['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="nama_menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Masukkan nama menu" required oninvalid="this.setCustomValidity('Silakan masukkan nama menu')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" min="0" id="harga" name="harga" placeholder="Masukkan harga" required oninvalid="this.setCustomValidity('Silakan masukkan harga')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" min="0" id="stok" name="stok" placeholder="Masukkan stok" required oninvalid="this.setCustomValidity('Silakan masukkan stok')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="isi" name="isi" rows="2" placeholder="Masukkan isi" required oninvalid="this.setCustomValidity('Silakan masukkan isi')" oninput="this.setCustomValidity('')"></textarea>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Masukkan keterangan" required oninvalid="this.setCustomValidity('Silakan masukkan keterangan')" oninput="this.setCustomValidity('')"></textarea>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input class="form-control" type="file" id="foto" name="foto" required oninvalid="this.setCustomValidity('Silakan pilih foto')" oninput="this.setCustomValidity('')">
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

<?php foreach ($menu as $key => $value) : ?>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $value['id_menu']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart('admin/edit_menu/' . $value['id_menu']) ?>
                <?= form_hidden('id_menu', $value['id_menu']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select id="id_kategori" class="form-select" name="id_kategori" required oninvalid="this.setCustomValidity('Silakan pilih kategori')" oninput="this.setCustomValidity('')">
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($kategori as $data) : ?>
                                    <option value="<?= $data['id_kategori']; ?>" <?= ($data['id_kategori'] == $value['id_kategori']) ? 'selected' : '' ?>>
                                        <?= ucwords($data['jenis_kategori'] . ' - ' . $data['nama_kategori']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="nama_menu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Masukkan nama menu" required oninvalid="this.setCustomValidity('Silakan masukkan nama menu')" oninput="this.setCustomValidity('')" value="<?= ucwords($value['nama_menu']); ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" min="0" id="harga" name="harga" placeholder="Masukkan harga" required oninvalid="this.setCustomValidity('Silakan masukkan harga')" oninput="this.setCustomValidity('')" value="<?= ucwords($value['harga']); ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" min="0" id="stok" name="stok" placeholder="Masukkan stok" required oninvalid="this.setCustomValidity('Silakan masukkan stok')" oninput="this.setCustomValidity('')" value="<?= ucwords($value['stok']); ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="isi" class="form-label">Isi</label>
                            <textarea class="form-control" id="isi" name="isi" rows="2" placeholder="Masukkan isi" required oninvalid="this.setCustomValidity('Silakan masukkan isi')" oninput="this.setCustomValidity('')"><?= ucwords($value['isi']); ?></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Masukkan keterangan" required oninvalid="this.setCustomValidity('Silakan masukkan keterangan')" oninput="this.setCustomValidity('')"><?= ucwords($value['keterangan']); ?></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                            <small class="form-text text-muted">*Biarkan kosong jika tidak ingin mengubah foto.</small>
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

    <!-- MODAL ISI -->
    <div class="modal fade" id="isi<?= $value['id_menu']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Isi Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        <?php
                        $isi = ucwords($value['isi']);
                        $isi_dengan_br = nl2br($isi);
                        $counter = 0;
                        $isi_bernomor = preg_replace_callback(
                            '/(.+?)(<br\s*\/?>\s*|$)/i',
                            function ($matches) use (&$counter) {
                                $counter++;
                                return $counter . '. ' . $matches[1] . $matches[2];
                            },
                            $isi_dengan_br
                        );
                        echo $isi_bernomor;
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_menu']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/img/upload_menu/' . $value['foto']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>