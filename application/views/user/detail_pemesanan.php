<main id="main" class="main">
    <div class="pagetitle">
        <h1>Detail Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Detail Transaksi</li>
            </ol>
        </nav>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <section class="section dashboard">
        <div class="row">
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
                                <?php foreach ($detail_pemesanan as $key => $value) : ?>
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
                                        <td>Rp <?= number_format($value['harga'] * $value['jumlah']); ?>,-</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr align="center">
                                    <td colspan="5" class="fw-bold">Sub Total</td>
                                    <td class="fw-bold">Rp <?= number_format($value['sub_total']); ?>,-</td>
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
                        <div class="row mb-3">
                            <div class="col-2 text-capitalize">
                                <p>no telpon</p>
                                <p>alamat</p>
                            </div>
                            <div class="col-10">
                                <p>: <?= $value['no_telp']; ?></p>
                                <p>: <?= ucwords($value['alamat']); ?></p>
                            </div>
                        </div>
                        <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php foreach ($detail_pemesanan as $value) : ?>
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