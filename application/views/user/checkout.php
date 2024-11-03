<main id="main" class="main">
    <div class="pagetitle">
        <h1>Checkout</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <section class="section dashboard">
        <div class="row">
            <?= form_open('user/checkout_pemesanan') ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3">
                        <h5 class="fw-semibold">Detail Pemesanan</h5>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
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
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_keranjang']; ?>">
                                                <i class="bi bi-card-image"></i>
                                            </button>
                                        </td>
                                        <td><?= $value['jumlah']; ?></td>
                                        <td>Rp <?= number_format($value['harga']); ?>,-</td>
                                        <td>Rp <?= number_format($total_harga); ?>,-</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr align="center">
                                    <td colspan="5" class="fw-bold">Sub Total</td>
                                    <?= form_hidden('sub_total', $subtotal); ?>
                                    <td class="fw-bold">Rp <?= number_format($subtotal); ?>,-</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="fw-semibold">Informasi Pemesanan</h5>
                        <hr>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="no_telp" class="form-label">No Telpon</label>
                                <input type="number" class="form-control" min="0" id="no_telp" name="no_telp" placeholder="Masukkan nomor telpon" required oninvalid="this.setCustomValidity('Silakan masukkan nomor telpon')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat" required oninvalid="this.setCustomValidity('Silakan masukkan alamat')" oninput="this.setCustomValidity('')"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Konfirmasi</button>
                        <a href="<?= base_url('user/keranjang'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </section>
</main>

<?php foreach ($keranjang as $value) : ?>
    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_keranjang']; ?>" tabindex="-1">
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