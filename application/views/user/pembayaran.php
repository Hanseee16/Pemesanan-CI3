<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Pembayaran</li>
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
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_pemesanan']; ?>">
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

                        <!-- JIKA STATUS PEMBAYARAN DITOLAK -->
                        <?php if ($value['status_pembayaran'] == 'Ditolak'): ?>
                            <div class="text-center">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <h5 class="alert-heading fw-semibold">Pembayaran Ditolak!!!</h5>
                                    <p><?= nl2br(htmlspecialchars(ucwords($value['keterangan_ditolak']), ENT_QUOTES, 'UTF-8')); ?></p>
                                    <hr>
                                    <p class="mb-0">Silakan periksa kembali bukti pembayaran Anda atau upload ulang bukti pembayaran.</p>
                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-6 text-center ">
                                <p class="fw-medium">Untuk melakukan proses pemesanan Anda, silahkan melakukan pembayaran dengan cara Transfer ke nomor rekening dibawah ini :</p>
                                <div class="py-4">
                                    <img src="<?= base_url('assets/img/logo/Bank-BCA.png'); ?>" alt="" width="250" class="img-fluid d-block mx-auto">
                                    <p class="pt-3">7111-612-777 a/n Warung Kisam</p>
                                </div>
                                <div class="pb-5">
                                    <p class="fw-medium">Jumlah yang harus Anda bayar sebesar :</p>
                                    <h3 class="fw-bold">Rp <?= number_format($value['sub_total']); ?>,-</h3>
                                </div>
                                <div class="pb-5">
                                    <?= form_open_multipart('user/upload_pembayaran') ?>
                                    <?= form_hidden('id_pemesanan', $value['id_pemesanan']) ?>
                                    <?= form_hidden('id_transaksi', $value['id_transaksi']) ?>
                                    <div class="mb-3">
                                        <label for="bukti_transaksi" class="form-label">Silahkan upload bukti pembayaran dibawah ini :</label>
                                        <input class="form-control" type="file" id="bukti_transaksi" name="bukti_transaksi" required oninvalid="this.setCustomValidity('Silakan Upload Bukti Pembayaran Anda')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="d-grid gap-2 mt-4">
                                        <?php if ($value['bukti_transaksi'] == null): ?>
                                            <!-- Jika belum upload bukti transaksi -->
                                            <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
                                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                        <?php else: ?>
                                            <!-- Jika sudah upload bukti transaksi -->
                                            <button type="submit" class="btn btn-primary">Upload Ulang Bukti Pembayaran</button>
                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bukti_transaksi<?= $value['id_transaksi']; ?>">Lihat Bukti Pembayaran</button>
                                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Kembali</a>
                                        <?php endif; ?>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php foreach ($detail_pemesanan as $value) : ?>
    <!-- MODAL FOTO MENU -->
    <div class="modal fade" id="foto<?= $value['id_pemesanan']; ?>" tabindex="-1">
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

    <!-- MODAL BUKTI TRANSAKSI -->
    <div class="modal fade" id="bukti_transaksi<?= $value['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/img/bukti_transaksi/' . $value['bukti_transaksi']); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>