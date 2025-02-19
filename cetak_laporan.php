<?php
require 'koneksi.php'; // Pastikan koneksi database sudah benar
require 'vendor/autoload.php'; // Jika menggunakan Composer

use Dompdf\Dompdf;
use Dompdf\Options;

$id = $_GET['id'];

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM penjualan 
    LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
    WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);

$produk_html = "";
$pro = mysqli_query($koneksi, "SELECT * FROM detail_penjualan 
    LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk 
    WHERE id_penjualan = $id");

while ($produk = mysqli_fetch_array($pro)) {
    $produk_html .= "
    <tr>
        <td>{$produk['nama_produk']}</td>
        <td style='text-align: center;'>{$produk['jumlah_produk']}</td>
        <td style='text-align: right;'>".number_format($produk['sub_total'], 0, ',', '.')."</td>
    </tr>";
}

// Format HTML untuk PDF
$html = "
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <title>Struk Pembelian</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; font-size: 12px; max-width: 58mm; }
        h3 { text-align: center; border-bottom: 1px dashed #000; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 3px; }
        th { text-align: left; border-bottom: 1px dashed #000; }
        .total { text-align: right; font-size: 14px; font-weight: bold; margin-top: 5px; }
        .thankyou { text-align: center; margin-top: 10px; }
    </style>
</head>
<body>

<h3>Struk Pembelian</h3>
<p><strong>Nama Pelanggan:</strong> {$data['nama_pelanggan']}</p>
<p><strong>Tanggal:</strong> ".date('d-m-Y H:i')."</p>
<hr style='border-top: 1px dashed #000;'>

<table>
    <tr>
        <th>Produk</th>
        <th style='text-align: center;'>Qty</th>
        <th style='text-align: right;'>Subtotal</th>
    </tr>
    $produk_html
</table>
<hr style='border-top: 1px dashed #000;'>
<p class='total'>Total: ".number_format($data['total_harga'], 0, ',', '.')."</p>
<p class='thankyou'>* Terima Kasih *</p>

</body>
</html>";

// Konfigurasi Dompdf
$options = new Options();
$options->set('defaultFont', 'Courier');
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper([0, 0, 210, 297], 'portrait'); // Ukuran kertas kecil (80mm atau A4)
$dompdf->render();

// Output file PDF ke browser
$dompdf->stream("struk_pembelian_$id.pdf", ["Attachment" => false]);
?>