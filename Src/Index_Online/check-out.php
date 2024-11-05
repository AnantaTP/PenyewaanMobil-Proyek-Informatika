<?php include 'header.php';
if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
    ?>
    <script>
        window.location = "shop.php";
    </script>
    <?php
    exit;
}

$uid = $_SESSION['uid'];
$fetch_orders = "SELECT *, o.id as orderid FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and status is NULL";
$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT sum(p.product_price) as total FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and status is NULL";
$total_amount = $conn->query($total_amount_query);
$total = 50;
while ($row = $total_amount->fetch_assoc()) {
    $total = $row['total'];
}
if (isset($_POST['placeorder'])) {
    // Validasi semua input diperlukan
    if (!empty($_POST['lama_sewa']) && !empty($_POST['address']) && !empty($_POST['tanggal_mulai_sewa']) && !empty($_FILES['foto_ktp']['name'])) {

        $lama_sewa = intval($_POST['lama_sewa']);
        $tanggal_mulai_sewa = $_POST['tanggal_mulai_sewa'];
        $tanggal_kembali = date('Y-m-d', strtotime("$tanggal_mulai_sewa + $lama_sewa days"));
        $full_address = $_POST['address']; // Menggunakan 'address' yang konsisten
        $datetime = date("Y-m-d");

        // Upload foto KTP
        $target_dir = 'admin/uploads/Foto KTP'; // Direktori untuk menyimpan foto
        $foto_ktp = $target_dir . basename($_FILES['foto_ktp']['name']);
        if (move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $foto_ktp)) {
            // Menghitung total bayar berdasarkan lama sewa
            $total_belanja = $total * $lama_sewa;

            // Update atau masukkan data ke tabel orders
            $place_order_query = "UPDATE orders SET 
                address = '$full_address', 
                status = 0, 
                date = '$datetime', 
                lama_sewa = '$lama_sewa', 
                tanggal_kembali = '$tanggal_kembali', 
                total_bayar = '$total_belanja', 
                foto_ktp = '$foto_ktp' 
                WHERE user_id = '$uid' AND status IS NULL";

            $result = $conn->query($place_order_query);
            if ($result === TRUE) {
                ?>
                <script>
                    alert("Thank You For Shopping !");
                    window.location = "orders.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Some error occurred !");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Failed to upload KTP photo. Please try again.");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Please fill all the details, including uploading your KTP photo !");
        </script>
        <?php
    }
}
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Menu</a>
                    <a href="./shop.html">belanja</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form method="post" enctype="multipart/form-data" class="checkout-form"> <!-- Menambahkan enctype -->
            <div class="row">
                <div class="col-lg-6">
                    <h4>Details</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="lama_sewa">Lama Sewa (hari)<span>*</span></label>
                            <input type="number" id="lama_sewa" name="lama_sewa" min="1" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="street">Alamat<span>*</span></label>
                            <input type="text" id="street" class="street-first" name="address" required>
                            <!-- Menggunakan 'address' yang konsisten -->
                        </div>
                        <div class="col-lg-12">
                            <label for="tanggal_mulai_sewa">Tanggal Mulai Sewa<span>*</span></label>
                            <input type="date" id="tanggal_mulai_sewa" name="tanggal_mulai_sewa" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="foto_ktp">Foto KTP<span>*</span></label>
                            <input type="file" id="foto_ktp" name="foto_ktp" accept="image/*" required>
                        </div>
                        <div class="col-lg-12">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="place-order">
                        <h4>Orderan Anda</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Produk<span>Harga</span></li>
                                <?php
                                $total_belanja = 0; // Inisialisasi variabel untuk total belanja
                                while ($row = $orders->fetch_assoc()) {
                                    $total_belanja += $row['product_price']; // Menambahkan harga produk ke total belanja
                                    ?>
                                    <li class="fw-normal">
                                        <?php echo $row['product_name'] ?><span><?php echo number_format($row['product_price'], 2) ?></span>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="fw-bold">Total
                                    Belanja<span><?php echo number_format($total_belanja, 2) ?></span></li>
                                <!-- Menampilkan total belanja -->
                            </ul>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn" name="placeorder">Buat Pesanan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php include 'footer.php'; ?>