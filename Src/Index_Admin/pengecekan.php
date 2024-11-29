<?php
include 'header.php';  // Termasuk header dan koneksi database

// Mengambil data produk (mobil) dari tabel products
$fetch_products = "SELECT id, product_name FROM products";
$products = $conn->query($fetch_products);

// Mengambil data perawatan dari tabel pengecekan dengan JOIN
$fetch_maintenance = "
    SELECT 
        pengecekan.id_perawatan, 
        pengecekan.id_mobil, 
        products.product_name, 
        pengecekan.tanggal_perawatan, 
        pengecekan.perawatan_mesin, 
        pengecekan.perawatan_ban, 
        pengecekan.perawatan_oli
    FROM pengecekan
    JOIN products ON pengecekan.id_mobil = products.id
";
$maintenance = $conn->query($fetch_maintenance);

// Menangani permintaan untuk memperbarui data perawatan
if (isset($_POST['update_maintenance'])) {
    $id_perawatan = $_POST['id_perawatan'];
    $id_mobil = $_POST['id_mobil'];
    $tanggal_perawatan = $_POST['tanggal_perawatan'];
    $perawatan_mesin = $_POST['perawatan_mesin'];
    $perawatan_ban = $_POST['perawatan_ban'];
    $perawatan_oli = $_POST['perawatan_oli'];

    // Query untuk memperbarui data perawatan
    $update_query = "
        UPDATE pengecekan 
        SET 
            tanggal_perawatan = '$tanggal_perawatan',
            perawatan_mesin = '$perawatan_mesin',
            perawatan_ban = '$perawatan_ban',
            perawatan_oli = '$perawatan_oli'
        WHERE id_perawatan = '$id_perawatan'
    ";

    if ($conn->query($update_query) === TRUE) {
        echo "<script>alert('Data perawatan berhasil diperbarui.'); window.location.href='pengecekan.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}

// Menangani permintaan untuk menambah data perawatan baru
if (isset($_POST['add_maintenance'])) {
    $id_mobil = $_POST['id_mobil'];
    $tanggal_perawatan = $_POST['tanggal_perawatan'];
    $perawatan_mesin = $_POST['perawatan_mesin'];
    $perawatan_ban = $_POST['perawatan_ban'];
    $perawatan_oli = $_POST['perawatan_oli'];

    // Query untuk menambahkan data perawatan baru
    $insert_query = "
        INSERT INTO pengecekan (id_mobil, tanggal_perawatan, perawatan_mesin, perawatan_ban, perawatan_oli)
        VALUES ('$id_mobil', '$tanggal_perawatan', '$perawatan_mesin', '$perawatan_ban', '$perawatan_oli')
    ";

    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Data perawatan berhasil ditambahkan.'); window.location.href='pengecekan.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}
?>

<!-- Begin Page Content -->
<script>
    // Fungsi untuk mengonfirmasi pembaruan sebelum submit
    function confirmUpdate(form) {
        if (confirm("Apakah Anda yakin ingin memperbarui data perawatan ini?")) {
            form.submit();
        } else {
            return false;
        }
    }
</script>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Daftar Perawatan Mobil</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perawatan Mobil</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Perawatan</th>
                            <th>ID Mobil</th>
                            <th>Nama Mobil</th>
                            <th>Tanggal Perawatan</th>
                            <th>Perawatan Mesin</th>
                            <th>Perawatan Ban</th>
                            <th>Perawatan Oli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($maintenance->num_rows > 0) {
                            while ($row = $maintenance->fetch_assoc()) {
                                ?>
                                <form method="POST" action="pengecekan.php">
                                    <tr>
                                        <td><?php echo $row['id_perawatan']; ?></td>
                                        <td><?php echo $row['id_mobil']; ?></td>
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td>
                                            <input type="date" name="tanggal_perawatan"
                                                value="<?php echo $row['tanggal_perawatan']; ?>">
                                        </td>
                                        <td>
                                            <textarea name="perawatan_mesin"><?php echo $row['perawatan_mesin']; ?></textarea>
                                        </td>
                                        <td>
                                            <textarea name="perawatan_ban"><?php echo $row['perawatan_ban']; ?></textarea>
                                        </td>
                                        <td>
                                            <textarea name="perawatan_oli"><?php echo $row['perawatan_oli']; ?></textarea>
                                        </td>
                                        <td>
                                            <input type="hidden" name="id_perawatan"
                                                value="<?php echo $row['id_perawatan']; ?>">
                                            <button type="submit" name="update_maintenance" class="btn btn-primary"
                                                onclick="confirmUpdate(this.form)">Update</button>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data perawatan ditemukan.</td></tr>";
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
                    <label for="id_mobil">Pilih Mobil</label>
                    <select class="form-control" name="id_mobil" required>
                        <option value="">Pilih Mobil</option>
                        <?php
                        // Menampilkan daftar mobil dari tabel products
                        if ($products->num_rows > 0) {
                            while ($product_row = $products->fetch_assoc()) {
                                echo "<option value='" . $product_row['id'] . "'>" . $product_row['product_name'] . "</option>";
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
                <button type="submit" name="add_maintenance" class="btn btn-success">Tambah Mobil</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->



</div>
<!-- End of Main Content -->