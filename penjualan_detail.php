
<?php
    $id  = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE id_penjualan = $id");
    $data = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Detail Pembelian</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-danger">Kembali</a>
    <hr>

    <div class="struk">
        <div class="header">
            <h2 class="text-center">toko</h2>
            <p class="text-center">Jl. Raya No.999, Malang</p>
            <p class="text-center">Telp: 0856279376512</p>
            <hr>
        </div>

        <div class="customer-info">
            <p><strong>Pelanggan:</strong> <?php echo $data['nama_pelanggan']; ?></p>
            <p><strong>No. Pembelian:</strong> <?php echo $data['id_penjualan']; ?></p>
            <p><strong>Tanggal:</strong> <?php echo date('d-m-Y H:i:s'); ?></p>
            <hr>
        </div>

        <div class="items">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pro = mysqli_query($koneksi, "SELECT * FROM detail_penjualan LEFT JOIN produk on produk.id_produk = detail_penjualan.id_produk where id_penjualan = $id");
                    while ($produk = mysqli_fetch_array($pro)) {
                    ?>
                    <tr>
                        <td><?php echo $produk['nama_produk']; ?></td>
                        <td>Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $produk['jumlah_produk']; ?></td>
                        <td>Rp. <?php echo number_format($produk['sub_total'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="total">
            <p><strong>Total:</strong> Rp. <?php echo number_format($data['total_harga'], 0, ',', '.'); ?></p>
        </div>

        <hr>
        <div class="footer">
            <p class="text-center">Terima kasih telah berbelanja di Toko</p>
            <p class="text-center"><a href="cetak_laporan.php?id=<?php echo $id; ?>" target="_blank" class="btn btn-primary">Cetak Struk (PDF)</a></p>
        </div>
    </div>
</div>

<!-- CSS Styling -->
<style>
    .struk {
        width: 300px;
        margin: 0 auto;
        font-family: 'Courier New', Courier, monospace;
        background-color: #fff;
        padding: 10px;
        border: 1px solid #000;
    }

    .header {
        text-align: center;
        font-size: 14px;
    }

    .customer-info p {
        margin: 5px 0;
        font-size: 12px;
    }

    .items {
        margin-top: 10px;
    }

    .items table {
        width: 100%;
        font-size: 12px;
        border-collapse: collapse;
    }

    .items th, .items td {
        padding: 5px;
        text-align: left;
    }

    .items th {
        border-bottom: 1px solid #000;
    }

    .total {
        margin-top: 10px;
        font-size: 14px;
        text-align: right;
    }

    .footer {
        margin-top: 20px;
        font-size: 12px;
        text-align: center;
    }

    .btn-primary {
        font-size: 12px;
    }
</style>