<main id="main" class="main">
    <div class="pagetitle">
        <h1>Daftar Menu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Daftar Menu</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="row">
                    <?php foreach ($menu as $value) : ?>
                        <div class="col-3">
                            <div class="card">
                                <?= form_open('user/tambah_keranjang/' . $value['id_menu']); ?>
                                <img src="<?= base_url('assets/img/upload_menu/' . $value['foto']); ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= ucwords($value['nama_menu']); ?></h5>
                                    <p class="card-text">Rp <?= number_format($value['harga']); ?>,-</p>
                                    <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#detail<?= $value['id_menu']; ?>" title="Detail">Detail</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>

                        <!-- MODAL DETAIL ISI -->
                        <div class="modal fade" id="detail<?= $value['id_menu']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Menu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <img src="<?= base_url('assets/img/upload_menu/' . $value['foto']); ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="col-7">
                                                <div class="row">
                                                    <div class="col-4 text-capitalize">
                                                        <p>nama menu</p>
                                                        <p>ketegori menu</p>
                                                        <p>harga</p>
                                                        <p>stok</p>
                                                        <p>keterangan</p>
                                                        <p>isi</p>
                                                    </div>
                                                    <div class="col-7">
                                                        <p>: <?= ucwords($value['nama_menu']); ?></p>
                                                        <p>: <?= ucwords($value['nama_kategori']); ?></p>
                                                        <p>: Rp <?= number_format($value['harga']); ?>,-</p>
                                                        <p>: <?= $value['stok']; ?></p>
                                                        <p>: <?= ucwords($value['keterangan']); ?></p>
                                                        <p>:
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</main>