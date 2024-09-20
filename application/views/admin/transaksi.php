<main id="main" class="main">
    <div class="pagetitle">
        <h1>Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Transaksi</li>
            </ol>
        </nav>
    </div>
    <?php if (!empty($transaksi)) : ?>
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
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Status Pengiriman</th>
                                        <th scope="col">Status Pembayaran</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $key => $value) : ?>
                                        <tr align="center">
                                            <th><?= $key + 1; ?>.</th>
                                            <td><?= $value['kode_pemesanan']; ?></td>
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
                                            <td>
                                                <a href="<?= base_url('admin/detail_transaksi/' . $value['id_pemesanan']); ?>" class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_pemesanan']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </td>
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

<!-- MODAL EDIT -->
<?php foreach ($transaksi as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_pemesanan']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('admin/edit_transaksi/' . $value['id_pemesanan']) ?>
                <?= form_hidden('id_pemesanan', $value['id_pemesanan']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="status_pengiriman" class="form-label">Status Pengiriman</label>
                            <select id="status_pengiriman" class="form-select" name="status_pengiriman" required oninvalid="this.setCustomValidity('Silakan pilih status pengiriman')" oninput="this.setCustomValidity('')">
                                <option selected disabled value="">Pilih</option>
                                <option value="Menunggu" <?= $value['status_pengiriman'] == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                <option value="Proses" <?= $value['status_pengiriman'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="Dikirim" <?= $value['status_pengiriman'] == 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select id="status_pembayaran" class="form-select" name="status_pembayaran" required oninvalid="this.setCustomValidity('Silakan pilih status pembayaran')" oninput="this.setCustomValidity('')">
                                <option selected disabled value="">Pilih</option>
                                <option value="Belum Diterima" <?= $value['status_pembayaran'] == 'Belum Diterima' ? 'selected' : '' ?>>Belum Diterima</option>
                                <option value="Diterima" <?= $value['status_pembayaran'] == 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                                <option value="Ditolak" <?= $value['status_pembayaran'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3" id="keterangan_ditolak_div" style="display:none;">
                            <label for="keterangan_ditolak" class="form-label">Keterangan Ditolak</label>
                            <textarea class="form-control" id="keterangan_ditolak" name="keterangan_ditolak" rows="3" placeholder="Masukkan keterangan ditolak" oninvalid="this.setCustomValidity('Silakan masukkan keterangan ditolak')" oninput="this.setCustomValidity('')"><?= ucwords($value['keterangan_ditolak']); ?></textarea>
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
<?php endforeach; ?>

<script>
    document.getElementById('status_pembayaran').addEventListener('change', function() {
        var keteranganDiv = document.getElementById('keterangan_ditolak_div');
        if (this.value === 'Ditolak') {
            keteranganDiv.style.display = 'block';
            document.getElementById('keterangan_ditolak').setAttribute('required', 'required');
        } else {
            keteranganDiv.style.display = 'none';
            document.getElementById('keterangan_ditolak').removeAttribute('required');
        }
    });
</script>