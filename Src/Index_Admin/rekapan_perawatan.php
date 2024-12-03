<?php
include 'header.php'; // Termasuk koneksi database

// Memastikan plat nomor diterima
if (isset($_GET['plat_nomor'])) {
    $plat_nomor = $conn->real_escape_string($_GET['plat_nomor']);

    // Query untuk mengambil data perawatan mobil berdasarkan plat nomor
    $rekap_query = "
        SELECT 
            pengecekan.id_perawatan,
            pengecekan.tanggal_perawatan, 
            pengecekan.perawatan_mesin, 
            pengecekan.perawatan_ban, 
            pengecekan.perawatan_oli 
        FROM pengecekan
        WHERE pengecekan.plat_nomor = '$plat_nomor'
        ORDER BY pengecekan.tanggal_perawatan DESC
    ";
    $rekap_data = $conn->query($rekap_query);
} else {
    echo "<script>alert('Plat nomor tidak ditemukan!');</script>";
    echo "<script>window.location.href = 'pengecekan.php';</script>";
    exit;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Rekapan Perawatan Mobil</h1>
    <h6>Plat Nomor: <?php echo htmlspecialchars($plat_nomor); ?></h6>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Rekapan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Perawatan</th>
                            <th>Tanggal Perawatan</th>
                            <th>Perawatan Mesin</th>
                            <th>Perawatan Ban</th>
                            <th>Perawatan Oli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($rekap_data->num_rows > 0) {
                            while ($rekap_row = $rekap_data->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $rekap_row['id_perawatan']; ?></td>
                                    <td><?php echo $rekap_row['tanggal_perawatan']; ?></td>
                                    <td><?php echo $rekap_row['perawatan_mesin']; ?></td>
                                    <td><?php echo $rekap_row['perawatan_ban']; ?></td>
                                    <td><?php echo $rekap_row['perawatan_oli']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada rekapan perawatan ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->