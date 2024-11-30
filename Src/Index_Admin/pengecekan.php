<?php
include 'header.php'; // Termasuk header dan koneksi database

// Mengambil data mobil dari tabel products
$fetch_products = "SELECT plat_nomor, product_name FROM products";
$products = $conn->query($fetch_products);

// Mengambil data perawatan dari tabel pengecekan dengan JOIN
$fetch_maintenance = "
    SELECT 
        pengecekan.id_perawatan, 
        pengecekan.plat_nomor, 
        products.product_name, 
        pengecekan.tanggal_perawatan, 
        pengecekan.perawatan_mesin, 
        pengecekan.perawatan_ban, 
        pengecekan.perawatan_oli
    FROM pengecekan
    JOIN products ON pengecekan.plat_nomor = products.plat_nomor
    ORDER BY pengecekan.tanggal_perawatan DESC
";
$maintenance = $conn->query($fetch_maintenance);

// Menangani permintaan untuk menambah data perawatan baru
if (isset($_POST['add_maintenance'])) {
    $plat_nomor = $conn->real_escape_string($_POST['plat_nomor']);
    $tanggal_perawatan = $conn->real_escape_string($_POST['tanggal_perawatan']);
    $perawatan_mesin = $conn->real_escape_string($_POST['perawatan_mesin']);
    $perawatan_ban = $conn->real_escape_string($_POST['perawatan_ban']);
    $perawatan_oli = $conn->real_escape_string($_POST['perawatan_oli']);

    // Query untuk menambahkan data perawatan baru
    $insert_query = "
        INSERT INTO pengecekan (plat_nomor, tanggal_perawatan, perawatan_mesin, perawatan_ban, perawatan_oli)
        VALUES ('$plat_nomor', '$tanggal_perawatan', '$perawatan_mesin', '$perawatan_ban', '$perawatan_oli')
    ";

    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Data perawatan berhasil ditambahkan!');</script>";
        echo "<script>window.location.href = 'pengecekan.php';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Daftar Perawatan Mobil</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Perawatan Mobil</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Perawatan</th>
                            <th>Plat Nomor</th>
                            <th>Nama Mobil</th>
                            <th>Tanggal Perawatan</th>
                            <th>Perawatan Mesin</th>
                            <th>Perawatan Ban</th>
                            <th>Perawatan Oli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($maintenance->num_rows > 0) {
                            while ($row = $maintenance->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id_perawatan']; ?></td>
                                    <td><?php echo $row['plat_nomor']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['tanggal_perawatan']; ?></td>
                                    <td><?php echo $row['perawatan_mesin']; ?></td>
                                    <td><?php echo $row['perawatan_ban']; ?></td>
                                    <td><?php echo $row['perawatan_oli']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>Tidak ada data perawatan ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formulir untuk Menambah Perawatan Mobil Baru -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Perawatan Mobil Baru</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="pengecekan.php">
                <div class="form-group">
                    <label for="plat_nomor">Pilih Mobil (Plat Nomor)</label>
                    <select class="form-control" name="plat_nomor" required>
                        <option value="">Pilih Mobil</option>
                        <?php
                        if ($products->num_rows > 0) {
                            while ($product_row = $products->fetch_assoc()) {
                                echo "<option value='" . $product_row['plat_nomor'] . "'>" . $product_row['plat_nomor'] . " - " . $product_row['product_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_perawatan">Tanggal Perawatan</label>
                    <input type="date" class="form-control" name="tanggal_perawatan" required>
                </div>
                <div class="form-group">
                    <label for="perawatan_mesin">Perawatan Mesin</label>
                    <textarea class="form-control" name="perawatan_mesin" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="perawatan_ban">Perawatan Ban</label>
                    <textarea class="form-control" name="perawatan_ban" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="perawatan_oli">Perawatan Oli</label>
                    <textarea class="form-control" name="perawatan_oli" rows="3"></textarea>
                </div>
                <button type="submit" name="add_maintenance" class="btn btn-success">Tambah Perawatan</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
