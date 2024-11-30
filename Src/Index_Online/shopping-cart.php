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
$fetch_orders = "SELECT *, o.id as orderid FROM products p inner join orders o on o.plat_nomor = p.plat_nomor WHERE user_id = '$uid' and status IS NULL";
$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT sum(p.product_price) as total FROM products p inner join orders o on o.plat_nomor = p.plat_nomor WHERE user_id = '$uid' and status IS NULL";
$total_amount = $conn->query($total_amount_query);
$total = 50;
while ($row = $total_amount->fetch_assoc()) {
    $total = $row['total'];
}
if ($total == NULL) {
    $total = 0;
}
?>
<script>
    function removefromcart(oid) {
        $.post("addtocart.php", {
            deleteorder: 1,
            oid: oid
        }, function (data, status) {
            if (data == 1) {
                window.location = "shopping-cart.php";
            } else {
                alert("Error removing item from cart");
            }
        });
    }

    // Prevent checkout if no items in the cart
    function checkOut() {
        var totalAmount = <?php echo $total; ?>;
        if (totalAmount <= 0) {
            alert("Keranjang Anda kosong. Silakan tambahkan produk untuk melanjutkan ke pembayaran.");
            return false; // Prevent checkout
        }
    }
</script>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i>Menu</a>
                    <a href="./shop.html">belanja</a>
                    <span>Keranjang Pemesanan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($orders->num_rows > 0) {
                                while ($row = $orders->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="cart-pic first-row"><img src="<?php echo 'admin/' . $row['image'] ?>" alt="">
                                        </td>
                                        <td class="first-row">
                                            <h5><?php echo $row['product_name'] ?></h5>
                                        </td>
                                        <td class="p-price first-row"><?php echo $row['product_price'] ?></td>
                                        <td class="p-price first-row">
                                            <?php
                                            $status = $row['status'];
                                            if ($status == NULL) {
                                                echo "In the cart";
                                            } elseif ($status == 0) {
                                                echo "Placed";
                                            } elseif ($status == 1) {
                                                echo "Accepted";
                                            } elseif ($status == 2) {
                                                echo "Dispatched";
                                            } elseif ($status == 3) {
                                                echo "Cancelled";
                                            } elseif ($status == 4) {
                                                echo "Received";
                                            }
                                            ?>
                                        </td>
                                        <td class="close-td first-row"><i class="ti-close"
                                                onclick="removefromcart('<?php echo $row['orderid']; ?>');"></i></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center">Keranjang Anda kosong.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="shop.php" class="primary-btn continue-shop">Lanjut belanja</a>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="cart-total">Total <span><?php echo $total; ?></span></li>
                            </ul>
                            <!-- Disable the checkout button if no items in the cart -->
                            <?php if ($total <= 0): ?>
                                <a href="#" class="proceed-btn" onclick="return checkOut();">Lanjut Ke Pembayaran</a>
                            <?php else: ?>
                                <a href="check-out.php" class="proceed-btn">Lanjut Ke Pembayaran</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php include 'footer.php' ?>