<?php
// Include database connection
include 'admin/config.php'; // Pastikan ini adalah path yang benar untuk file konfigurasi database

// Pastikan user sudah login
session_start();
if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['uid'];

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari form
    $rating_value = $_POST['rating_value'];  // Nilai rating dari form (seharusnya integer 1-5)
    $tanggal_rating = date('Y-m-d H:i:s');    // Mendapatkan tanggal dan waktu saat ini untuk tanggal_rating
    $review = $_POST['review'];              // Teks ulasan dari form

    // Validasi input rating dan review
    if ($rating_value && $review) {
        // Simpan rating dan review
        $query = "INSERT INTO rating (rating_value, tanggal_rating, review, id_user) 
                  VALUES ('$rating_value', '$tanggal_rating', '$review', '$uid')";

        if ($conn->query($query) === TRUE) {
            // Redirect kembali ke halaman orders setelah berhasil
            header("Location: orders.php?status=success");
            exit;
        } else {
            // Tampilkan error jika query gagal
            echo "Error: " . $conn->error;
        }
    } else {
        // Tampilkan error jika input tidak lengkap
        echo "Semua data harus diisi!";
    }
} else {
    // Jika diakses langsung tanpa pengiriman form, redirect ke halaman orders
    header("Location: orders.php");
    exit;
}
?>