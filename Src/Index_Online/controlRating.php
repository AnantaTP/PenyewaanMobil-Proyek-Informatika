<?php
// Include database connection
include 'admin/config.php'; // Pastikan ini adalah path yang benar untuk file konfigurasi database

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari form
    $rating_value = $_POST['rating_value'];  // Nilai rating dari form (seharusnya integer 1-5)
    $tanggal_rating = date('Y-m-d H:i:s');    // Mendapatkan tanggal dan waktu saat ini untuk tanggal_rating
    $review = $_POST['review'];              // Teks ulasan dari form

    // Insert new review (id_rating otomatis dibuat oleh database)
    $query = "INSERT INTO rating (rating_value, tanggal_rating, review) VALUES ('$rating_value', '$tanggal_rating', '$review')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        // Redirect kembali ke halaman orders setelah berhasil
        header("Location: orders.php");
        exit;
    } else {
        // Tampilkan error jika query gagal
        echo "Error: " . $conn->error;
    }
} else {
    // Jika diakses langsung tanpa pengiriman form, redirect ke halaman orders
    header("Location: orders.php");
    exit;
}
?>
