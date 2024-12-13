<?php
include 'header.php';

// Pastikan user sudah login
if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
    echo "<script>window.location = 'login.php';</script>";
    exit;
}

$uid = $_SESSION['uid'];
$fetch_orders = "SELECT *, o.id as orderid FROM products p INNER JOIN orders o ON o.plat_nomor = p.plat_nomor WHERE user_id = '$uid' AND status IS NOT NULL";
$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT SUM(p.product_price) AS total FROM products p INNER JOIN orders o ON o.plat_nomor = p.plat_nomor WHERE user_id = '$uid' AND status IS NOT NULL";
$total_amount = $conn->query($total_amount_query);
$total = 50;
while ($row = $total_amount->fetch_assoc()) {
    $total = $row['total'];
}

?>

<head>
    <!-- Link to checked.css file -->
    <link rel="stylesheet" href="css/checked.css">
</head>

<script>
    function removefromcart(oid) {
        $.post("addtocart.php", {
            cancelorder: 1,
            oid: oid
        }, function (data, status) {
            if (data == 1) {
                window.location = "orders.php";
            } else {
                alert(data);
            }
        });
    }

    function openRatingModal(product_id) {
        $('#ratingOrderId').val(product_id); // set order ID in hidden input
        $('#ratingModal').modal('show'); // show modal
    }

    function setRating(star) {
        $('#ratingInput').val(star); // set hidden input with rating value
        $('.fa-star').each(function (i) {
            $(this).toggleClass('checked', i < star);
        });
    }
</script>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Menu</a>
                    <span>Pesan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

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
                                <th>Rating</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $orders->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="<?php echo 'admin/' . $row['image'] ?>" alt="">
                                    </td>
                                    <td class="first-row">
                                        <h5><?php echo $row['product_name'] ?></h5>
                                    </td>
                                    <td class="p-price first-row"><?php echo $row['total_bayar'] ?></td>
                                    <td class="p-price first-row">
                                        <?php
                                        $status = $row['status'];
                                        switch ($status) {
                                            case 0:
                                                echo "Belum Bayar";
                                                break;
                                            case 1:
                                                echo "Sudah Bayar";
                                                break;
                                            case 2:
                                                echo "Mobil Diambil";
                                                break;
                                            case 3:
                                                echo "Mobil Dikembalikan";
                                                break;
                                            case 4:
                                                echo "Dibatalkan";
                                                break;
                                            case 5:
                                                echo "Selesai";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($status == 5) {
                                            ?>
                                            <!-- Button to open the rating modal -->
                                            <button class="btn btn-warning text-white rating-btn"
                                                onclick="openRatingModal('<?php echo $row['orderid']; ?>')">Give Rating</button>
                                            <?php
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td class="close-td first-row"><i class="ti-close"
                                            onclick="removefromcart('<?php echo $row['orderid']; ?>');"></i></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="shop.php" class="primary-btn continue-shop">Lanjut Berbelanja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Give Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="controlRating.php" method="post">
                <div class="modal-body text-center">
                    <input type="hidden" name="rating_value" id="ratingInput"> <!-- Hidden input to store rating -->
                    <input type="hidden" name="order_id" id="ratingOrderId"> <!-- Hidden input for order ID -->
                    <label for="rating">Select Rating:</label>
                    <div>
                        <!-- Star icons for rating -->
                        <i class="fa fa-star fa-2x" onclick="setRating(1)"></i>
                        <i class="fa fa-star fa-2x" onclick="setRating(2)"></i>
                        <i class="fa fa-star fa-2x" onclick="setRating(3)"></i>
                        <i class="fa fa-star fa-2x" onclick="setRating(4)"></i>
                        <i class="fa fa-star fa-2x" onclick="setRating(5)"></i>
                    </div>
                    <div>
                        <!-- Add a textarea for the review input -->
                        <label for="review">Write Your Review:</label>
                        <textarea name="review" id="review" rows="4" class="form-control"
                            placeholder="Enter your review here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rating Modal -->

<!-- Shopping Cart Section End -->
<?php include 'footer.php' ?>