<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
        <div>
            <h1>Laporan Penjualan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Penjualan</li>
                </ol>
            </nav>
        </div>
        <div>
            <?= form_open() ?>
            <div style="display: flex; align-items: flex-end; gap: 8px;">
                <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required oninvalid="this.setCustomValidity('Silakan pilih Tanggal Awal')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required oninvalid="this.setCustomValidity('Silakan pilih Tanggal Akhir')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <button type="submit" formaction="<?= base_url('admin/print_laporan_excel') ?>" formtarget="_blank" class="btn btn-success text-white">Excel</button>
                    <button type="submit" formaction="<?= base_url('admin/print_laporan_pdf') ?>" formtarget="_blank" class="btn btn-danger text-white">PDF</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
    <?php if (!empty($laporan)) : ?>
        <?= $this->session->flashdata('pesan'); ?>
        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <th scope="col">No.</th>
                                        <th scope="col">Kode Pemesanan</th>
                                        <th scope="col">Tanggal Pemesanan</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Status Pengiriman</th>
                                        <th scope="col">Status Pembayaran</th>
                                        <th scope="col">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($laporan as $key => $value) : ?>
                                        <tr align="center">
                                            <th><?= $key + 1; ?>.</th>
                                            <td><?= $value['kode_pemesanan']; ?></td>
                                            <td><?= tanggalIndonesia($value['tanggal_pemesanan']); ?></td>
                                            <td><?= ucwords($value['nama_lengkap']); ?></td>
                                            <td>
                                                <?php
                                                $status_pengiriman = [
                                                    'Menunggu'  => 'text-bg-secondary',
                                                    'Proses'    => 'text-bg-warning',
                                                    'Dikirim'   => 'text-bg-success',
                                                ];

                                                $statusClass = isset($status_pengiriman[$value['status_pengiriman']]) ? $status_pengiriman[$value['status_pengiriman']] : '';
                                                ?>

                                                <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($value['status_pengiriman']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                $status_pembayaran = [
                                                    'Belum Diterima'    => 'text-bg-secondary',
                                                    'Ditolak'           => 'text-bg-danger',
                                                    'Diterima'          => 'text-bg-success',
                                                ];

                                                $statusClass = isset($status_pembayaran[$value['status_pembayaran']]) ? $status_pembayaran[$value['status_pembayaran']] : '';
                                                ?>
                                                <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($value['status_pembayaran']); ?>
                                                </span>
                                            </td>
                                            <td>Rp <?= number_format($value['sub_total']); ?>,-</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Tidak ada data transaksi.
        </div>
    <?php endif; ?>
</main>