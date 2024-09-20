<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center text-uppercase">nota pesanan</h3>
                <div class="row my-5">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6 text-capitalize">
                                <p style="font-size: 15px;">kode pesanan</p>
                                <p style="font-size: 15px;">nama pemesan</p>
                                <p style="font-size: 15px;">tanggal transaksi</p>
                                <p style="font-size: 15px;">no telepon</p>
                            </div>
                            <div class="col-6">
                                <p style="font-size: 15px;">: <?= $pemesanan['kode_pemesanan']; ?></p>
                                <p style="font-size: 15px;">: <?= ucwords($pemesanan['nama_lengkap']); ?></p>
                                <p style="font-size: 15px;">: <?= tanggalIndonesia($pemesanan['tanggal_transaksi']); ?></p>
                                <p style="font-size: 15px;">: <?= $pemesanan['no_telp']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">NO</th>
                            <th scope="col">PRODUK PESANAN</th>
                            <th scope="col">HARGA</th>
                            <th scope="col">JUMLAH</th>
                            <th scope="col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        foreach ($detail_pemesanan as $key => $value) :
                            $subtotal = $value['harga'] * $value['jumlah'];
                            $total += $subtotal;
                        ?>
                            <tr align="center">
                                <th scope="row"><?= $key + 1; ?>.</th>
                                <td><?= ucwords($value['nama_menu']); ?></td>
                                <td>Rp <?= number_format($value['harga']); ?>,-</td>
                                <td><?= $value['jumlah']; ?></td>
                                <td>Rp <?= number_format($subtotal); ?>,-</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr align="center">
                            <th colspan="4" scope="row">TOTAL</th>
                            <th scope="row">Rp <?= number_format($total); ?>,-</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

<script>
    window.print()
</script>