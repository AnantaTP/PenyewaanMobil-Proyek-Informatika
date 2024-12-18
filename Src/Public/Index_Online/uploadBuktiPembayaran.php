<?php
include 'admin/config.php'; // Pastikan file koneksi ke database sudah di-include

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $order_id = $_POST['order_id'];

    // Direktori tempat file akan disimpan
    $dir1 = "admin/uploads/bukti_pembayaran/";
    $dir2 = "../../Admin/Index_Admin/admin/uploads/bukti_pembayaran/";

    // Periksa apakah file bukti pembayaran ada
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0) {
        $file_name = basename($_FILES['bukti_pembayaran']['name']);
        $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Validasi jenis file (hanya gambar yang diperbolehkan)
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($file_ext), $allowed_ext)) {
            echo "<script>alert('File harus berupa gambar (jpg, jpeg, png, gif).'); window.history.back();</script>";
            exit;
        }

        // Beri nama unik pada file untuk mencegah duplikasi
        $new_file_name = "bukti_" . time() . "_" . uniqid() . "." . $file_ext;

        // Path untuk menyimpan file
        $path1 = $dir1 . $new_file_name;
        $path2 = $dir2 . $new_file_name;

        // Pindahkan file ke direktori pertama
        if (move_uploaded_file($file_tmp, $path1)) {
            // Salin file ke direktori kedua
            if (!copy($path1, $path2)) {
                echo "<script>alert('Gagal menyimpan file di direktori kedua.'); window.history.back();</script>";
                exit;
            }

            // Simpan path file ke database
            $update_query = "UPDATE orders SET bukti_pembayaran = '$path1' WHERE id = '$order_id'";
            if ($conn->query($update_query) === TRUE) {
                echo "<script>alert('Bukti pembayaran berhasil diunggah!'); window.location = 'orders.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data ke database.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah file.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Harap pilih file untuk diunggah.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Metode tidak diizinkan.'); window.history.back();</script>";
}
?>