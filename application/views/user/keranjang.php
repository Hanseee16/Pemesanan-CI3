<main id="main" class="main">
    <div class="pagetitle">
        <h1>Keranjang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Keranjang</li>
            </ol>
        </nav>
    </div>
    <?php if (!empty($keranjang)) : ?>
        <?= $this->session->flashdata('pesan'); ?>
        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Menu</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    foreach ($keranjang as $key => $value) :
                                        $total_harga = $value['harga'] * $value['jumlah'];
                                        $subtotal += $total_harga;
                                    ?>
                                        <tr align="center">
                                            <th><?= $key + 1; ?>.</th>
                                            <td><?= ucwords($value['nama_menu']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_menu']; ?>">
                                                    <i class="bi bi-card-image"></i>
                                                </button>
                                            </td>
                                            <td><?= $value['jumlah']; ?></td>
                                            <td>Rp <?= number_format($value['harga']); ?>,-</td>
                                            <td>Rp <?= number_format($total_harga); ?>,-</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_keranjang']; ?>" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <a href="<?= base_url('user/hapus_keranjang/' . $value['id_keranjang']); ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr align="center">
                                        <td colspan="5" class="fw-bold">Sub Total</td>
                                        <td class="fw-bold">Rp <?= number_format($subtotal); ?>,-</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="<?= base_url('user/checkout'); ?>" class="btn btn-sm btn-primary">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Keranjang belanja Anda kosong.
        </div>
        <a href="<?= base_url('user/daftar_menu'); ?>" class="btn btn-sm btn-primary">Lanjutkan Belanja</a>
    <?php endif; ?>
</main>

<?php foreach ($keranjang as $value) : ?>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $value['id_keranjang']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart('user/edit_keranjang/' . $value['id_keranjang']) ?>
                <?= form_hidden('id_keranjang', $value['id_keranjang']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" min="1" max="<?= $value['stok']; ?>" id="jumlah" name="jumlah" placeholder="Masukkan jumlah"
                                required
                                oninput="
                        this.setCustomValidity('');
                        if (parseInt(this.value) > <?= $value['stok']; ?>) {
                            this.setCustomValidity('Jumlah melebihi dari stok');
                        } else if (this.value < 1) {
                            this.setCustomValidity('Silakan masukkan jumlah');
                        }
                    "
                                oninvalid="
                        if (this.value > <?= $value['stok']; ?>) {
                            this.setCustomValidity('Jumlah melebihi dari stok');
                        } else {
                            this.setCustomValidity('Silakan masukkan jumlah');
                        }
                    "
                                value="<?= ucwords($value['jumlah']); ?>">
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