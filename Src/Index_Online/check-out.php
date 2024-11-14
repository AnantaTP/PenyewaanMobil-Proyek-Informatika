<?php
include 'header.php';
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
    echo "<script>window.location = 'login.php';</script>";
    exit;
}

// Koneksi ke database
require_once 'koneksi.php';

// Ambil data mobil dari tabel products untuk menampilkan pilihan
$query_products = "SELECT * FROM products";
$products = $conn->query($query_products);

// Proses update jika tombol 'update' diklik
if (isset($_POST['update'])) {
    // Ambil data yang dikirimkan dari form
    $id_mobil = $_POST['id_mobil']; // ID mobil yang dipilih
    $tanggal_ganti_oli = $_POST['tanggal_ganti_oli'];
    $tanggal_ganti_ban = $_POST['tanggal_ganti_ban'];
    $tanggal_service_rutin = $_POST['tanggal_service_rutin'];

    // Debug: Pastikan data yang dikirimkan sudah benar
    var_dump($_POST); // Debugging form data
    exit; // Hentikan eksekusi di sini agar bisa melihat data

    // Pastikan ada setidaknya satu tanggal yang diinputkan
    $update_fields = [];
    if (!empty($tanggal_ganti_oli)) {
        $update_fields[] = "tanggal_ganti_oli = '$tanggal_ganti_oli'";
    }
    if (!empty($tanggal_ganti_ban)) {
        $update_fields[] = "tanggal_ganti_ban = '$tanggal_ganti_ban'";
    }
    if (!empty($tanggal_service_rutin)) {
        $update_fields[] = "tanggal_service_rutin = '$tanggal_service_rutin'";
    }

    // Jika ada data yang perlu diupdate
    if (count($update_fields) > 0) {
        // Gabungkan field yang diupdate
        $update_query = "UPDATE pengecekan SET " . implode(", ", $update_fields) . " WHERE id_mobil = '$id_mobil'";

        // Debug: Pastikan query sudah benar
        echo "Query Update: " . $update_query;
        exit; // Hentikan eksekusi di sini agar bisa melihat query

        // Eksekusi query update
        if ($conn->query($update_query) === TRUE) {
            echo "<script>alert('Data berhasil diperbarui!'); window.location = 'pengecekan.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Tidak ada data yang diperbarui');</script>";
    }
}

// Ambil data pengecekan yang sudah ada
$query_check = "SELECT * FROM pengecekan";
$check_results = $conn->query($query_check);
?>

<!-- Tampilan halaman pengecekan -->
<div class="container">
    <h2>Update Data Perawatan Mobil</h2>
    <form method="post" action="pengecekan.php">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Mobil</th>
                    <th>Tanggal Ganti Oli</th>
                    <th>Tanggal Ganti Ban</th>
                    <th>Tanggal Service Rutin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $check_results->fetch_assoc()) { ?>
                <tr>
                    <form method="post" action="pengecekan.php">
                        <td>
                            <!-- Dropdown untuk memilih mobil -->
                            <select name="id_mobil" required>
                                <?php
                                // Menampilkan daftar mobil dari tabel products
                                $products->data_seek(0); // Reset pointer result set
                                while ($product = $products->fetch_assoc()) {
                                    // Menandai mobil yang sudah ada di pengecekan
                                    $selected = ($product['id'] == $row['id_mobil']) ? 'selected' : '';
                                    echo "<option value='" . $product['id'] . "' $selected>" . $product['nama_mobil'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="date" name="tanggal_ganti_oli" value="<?= $row['tanggal_ganti_oli']; ?>"></td>
                        <td><input type="date" name="tanggal_ganti_ban" value="<?= $row['tanggal_ganti_ban']; ?>"></td>
                        <td><input type="date" name="tanggal_service_rutin" value="<?= $row['tanggal_service_rutin']; ?>"></td>
                        <td>
                            <!-- Tombol update -->
                            <button type="submit" name="update" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memperbarui data ini?');">Update</button>
                        </td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>

<?php
include 'footer.php';
?>
