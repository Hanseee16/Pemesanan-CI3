<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Registrasi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">

</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Registrasi</h5>
                                    </div>
                                    <?= form_open_multipart('registrasi', ['class' => 'row g-3']); ?>
                                    <div class="col-12">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                        <?= form_error('nama_lengkap', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                        <?= form_error('password', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="no_hp" class="form-label">No Handphone</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan no handphone" value="<?= set_value('no_hp'); ?>">
                                        <?= form_error('no_hp', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="col-12">
                                        <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                                        <input type="file" class="form-control" id="bukti_transaksi" name="bukti_transaksi" required>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Registrasi</button>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p class="small text-center mb-0">Sudah punya akun? <a href="<?= base_url('login'); ?>">Login</a></p>
                                        <a href="<?= base_url('auth'); ?>" class="small text-capitalize text-dark">halaman utama</a>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->


    <!-- Vendor JS Files -->
    <!-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script> -->

    <!-- Template Main JS File -->
    <!-- <script src="assets/js/main.js"></script> -->

</body>

</html>