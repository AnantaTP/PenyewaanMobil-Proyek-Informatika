<?php
include 'admin/config.php';

// Menambahkan pesanan ke keranjang
if (isset($_POST['addtocart']) && $_POST['addtocart'] == 1) {
    if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
        echo 0;
        exit;
    }
    $pid = $_POST['pid'];  // plat_nomor
    $uid = $_SESSION['uid'];

    // Cek apakah mobil sudah ada di keranjang
    $order_check_query = "SELECT * FROM orders WHERE plat_nomor = '$pid' AND user_id = '$uid' AND (status IS NULL OR status != 4)";
    $order_check_result = $conn->query($order_check_query);

    if ($order_check_result->num_rows > 0) {
        // Jika sudah ada di keranjang atau sudah disewa
        echo "Mobil sudah ada di keranjang atau sudah disewa.";
        exit;
    }

    // Menambahkan pesanan baru ke keranjang
    $addtocart_query = "INSERT INTO orders (plat_nomor, user_id) VALUES ('$pid', '$uid')";
    $result = $conn->query($addtocart_query);

    if ($result === FALSE) {
        echo "Something went wrong!";
    } else {
        echo "Added successfully";
    }
    exit;
}

// Menghapus pesanan dari keranjang
if (isset($_POST['deleteorder']) && $_POST['deleteorder'] == 1) {
    $oid = $_POST['oid'];
    $delete_order_query = "DELETE FROM orders WHERE id = '$oid'";
    $result = $conn->query($delete_order_query);
    if ($result === TRUE) {
        echo 1;  // Menandakan bahwa pesanan berhasil dihapus
    } else {
        echo "Failed to delete order.";
    }
    exit;
}

// Membatalkan pesanan
if (isset($_POST['cancelorder']) && $_POST['cancelorder'] == 1) {
    $oid = $_POST['oid'];
    $cancel_order_query = "UPDATE orders SET status = 3 WHERE id = '$oid'";  // 3 berarti dibatalkan
    $result = $conn->query($cancel_order_query);
    if ($result === TRUE) {
        echo 1;  // Menandakan bahwa pesanan berhasil dibatalkan
    } else {
        echo "Failed to cancel order.";
    }
    exit;
}
?>
