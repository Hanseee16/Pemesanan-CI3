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
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">

                <!-- RINCIAN PEMESANAN -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title py-0">Informasi Pemesanan</h3>
                    </div>
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col-3 text-capitalize">
                                <p>nama lengkap</p>
                                <p>tanggal pemesanan</p>
                                <p>nomor telpon</p>
                                <p>alamat</p>
                                <p>total</p>
                                <p>status pengiriman</p>
                                <p>status pembayaran</p>
                                <?php if ($pemesanan['status_pembayaran'] == 'Ditolak') : ?>
                                    <p>keterangan ditolak</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-9">
                                <p>: <?= ucwords($pemesanan['nama_lengkap']); ?></p>
                                <p>: <?= tanggalIndonesia($pemesanan['tanggal_pemesanan']); ?></p>
                                <p>: <?= $pemesanan['no_telp']; ?></p>
                                <p>: <?= ucwords($pemesanan['alamat']); ?></p>
                                <p>: Rp <?= number_format($pemesanan['sub_total']); ?>,-</p>
                                <p>: <?= ucwords($pemesanan['status_pengiriman']); ?></p>
                                <p>: <?= ucwords($pemesanan['status_pembayaran']); ?></p>
                                <?php if ($pemesanan['status_pembayaran'] == 'Ditolak') : ?>
                                    <p>: <?= !empty($pemesanan['keterangan_ditolak']) ? ucwords($pemesanan['keterangan_ditolak']) : '-'; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TRANSAKSI -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title py-0">Informasi Transaksi</h3>
                    </div>
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col-3 text-capitalize">
                                <p>tanggal transaksi</p>
                                <p>bukti transaksi</p>
                            </div>
                            <div class="col-9">
                                <p>: <?= !empty($pemesanan['tanggal_transaksi']) ? tanggalIndonesia($pemesanan['tanggal_transaksi']) : '-'; ?></p>
                                <p>:
                                    <?php if (!empty($pemesanan['bukti_transaksi'])) : ?>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bukti_transaksi<?= $pemesanan['id_transaksi']; ?>">Lihat</button>
                                        <a href="<?= base_url('assets/img/bukti_transaksi/' . $pemesanan['bukti_transaksi']); ?>" download="Bukti Pembayaran" class="btn btn-sm btn-danger">Download</a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DETAIL PEMESANAN -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title py-0">Detail Pemesanan</h3>
                    </div>
                    <div class="card-body py-3">
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Menu</th>
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
                                        <td><?= $value['jumlah']; ?></td>
                                        <td>Rp <?= number_format($value['harga']); ?>,-</td>
                                        <td>Rp <?= number_format($value['harga'] * $value['jumlah']); ?>,-</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr align="center" class="fw-bold">
                                    <td colspan="4">Sub Total</td>
                                    <td>Rp <?= number_format($value['sub_total']); ?>,-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="<?= base_url('admin/transaksi'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </div>
    </section>
</main>

<!-- MODAL BUKTI TRANSAKSI -->
<div class="modal fade" id="bukti_transaksi<?= $pemesanan['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_transaksi/' . $pemesanan['bukti_transaksi']); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>