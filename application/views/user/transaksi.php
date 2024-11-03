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
    <?php if (!empty($pemesanan)) : ?>
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
                                        <th scope="col">Kode Pemesanan</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Status Pengiriman</th>
                                        <th scope="col">Status Pembayaran</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pemesanan as $key => $value) : ?>
                                        <tr align="center">
                                            <th><?= $key + 1; ?>.</th>
                                            <td><?= $value['kode_pemesanan']; ?></td>
                                            <td>Rp <?= number_format($value['sub_total']); ?>,-</td>
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
                                            <td>
                                                <a href="<?= base_url('user/detail_transaksi/' . $value['id_pemesanan']); ?>" class="btn btn-sm btn-secondary" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if ($value['status_pengiriman'] == 'Menunggu' && $value['status_pembayaran'] == 'Belum Diterima' || $value['status_pembayaran'] == 'Ditolak') : ?>
                                                    <a href="<?= base_url('user/pembayaran/' . $value['id_pemesanan']); ?>" class="btn btn-sm btn-primary" title="Pembayaran">
                                                        <i class="bi bi-credit-card-fill"></i> </a>
                                                    <a href="<?= base_url('user/hapus_transaksi/' . $value['id_pemesanan']); ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                <?php elseif ($value['status_pengiriman'] == 'Proses' || $value['status_pengiriman'] == 'Dikirim' && $value['status_pembayaran'] == 'Diterima') : ?>
                                                    <a href="<?= base_url('user/nota/' . $value['id_pemesanan']); ?>" class="btn btn-sm btn-success" target="_blank" title="Nota Pemesanan">
                                                        <i class="bi bi-receipt"></i>
                                                    </a>
                                                <?php endif; ?>
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

<?php foreach ($pemesanan as $value) : ?>

    <!-- MODAL EDIT -->
    <!-- <div class="modal fade" id="edit<?= $value['id_menu']; ?>" tabindex="-1">
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
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                            <small class="form-text text-muted">*Biarkan kosong jika tidak ingin mengubah foto.</small>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan" required oninvalid="this.setCustomValidity('Silakan masukkan keterangan')" oninput="this.setCustomValidity('')"><?= ucwords($value['keterangan']); ?></textarea>
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
    </div> -->

    <!-- MODAL FOTO -->
    <!-- <div class="modal fade" id="foto<?= $value['id_keranjang']; ?>" tabindex="-1">
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
    </div> -->
<?php endforeach; ?>