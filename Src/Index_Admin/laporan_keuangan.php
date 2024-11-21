<?php
include 'header.php'; // Header yang berisi koneksi database

// Query laporan keuangan dengan penyesuaian nama kolom
$query_laporan = "SELECT 
        lk.id AS laporan_id,
        CONCAT(ud.first_name, ' ', ud.last_name) AS nama_customer,
        p.product_name AS nama_produk,
        p.product_price AS harga_produk,
        lk.total_bayar,
        lk.tanggal AS tanggal_pengembalian
    FROM 
        laporan_keuangan lk
    LEFT JOIN 
        user_details ud ON lk.id_user = ud.id
    LEFT JOIN 
        products p ON lk.id_mobil = p.id
    ORDER BY 
        lk.tanggal DESC
";

// Menjalankan query
$result_laporan = $conn->query($query_laporan);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Laporan Keuangan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Keuangan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Laporan</th>
                            <th>Nama Customer</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Total Bayar</th>
                            <th>Tanggal Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_laporan->num_rows > 0) {
                            while ($row = $result_laporan->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['laporan_id']; ?></td>
                                    <td><?php echo $row['nama_customer']; ?></td>
                                    <td><?php echo $row['nama_produk']; ?></td>
                                    <td><?php echo "Rp " . number_format($row['harga_produk'], 0, ',', '.'); ?></td>
                                    <td><?php echo "Rp " . number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                                    <td><?php echo $row['tanggal_pengembalian']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data laporan keuangan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
