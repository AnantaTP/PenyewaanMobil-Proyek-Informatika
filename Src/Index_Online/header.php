<?php
include 'admin/config.php';

if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
    // User not logged in
} else {
    $uid = $_SESSION['uid'];
    $fetch_orders = "SELECT *, o.id as orderid, p.plat_nomor FROM products p 
                     INNER JOIN orders o ON o.plat_nomor = p.plat_nomor
                     WHERE o.user_id = '$uid' AND o.status IS NULL";
    $orders = $conn->query($fetch_orders);

    $total_amount_query = "SELECT SUM(p.product_price) AS total, COUNT(o.id) AS totalorder 
                           FROM products p 
                           INNER JOIN orders o ON o.plat_nomor = p.plat_nomor
                           WHERE o.user_id = '$uid' AND o.status IS NULL";
    $total_amount = $conn->query($total_amount_query);
    $total = 50;
    $totalorder = 0; // Default value

    while ($row = $total_amount->fetch_assoc()) {
        $total = $row['total'];
        $totalorder = $row['totalorder'];
    }

    // If there are no orders in the cart, we set a flag to show empty cart message
    $is_cart_empty = $totalorder == 0 ? true : false;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Buddies</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        <?php
                        if (isset($_SESSION['user_email']) && $_SESSION['user_email'] != NULL) {
                            echo $_SESSION['user_email'];
                        } else {
                            echo 'xxx@xmail.com';
                        }
                        ?>
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        <?php
                        if (isset($_SESSION['contactno']) && $_SESSION['contactno'] != NULL) {
                            echo $_SESSION['contactno'];
                        } else {
                            echo '+91 xxxxxxxxxx';
                        }
                        ?>
                    </div>
                </div>
                <div class="ht-right">
                    <?php
                    if (isset($_SESSION['contactno']) && $_SESSION['contactno'] != NULL) {
                        ?>
                        <img src="<?php echo $_SESSION['profilephoto']; ?>" style="width:50px; height:50px;"
                            class="img-round">
                        <a href="logout.php" class="login-panel"><i class="fa fa-user"></i>Logout</a>
                        <?php
                    } else {
                        ?>
                        <a href="login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/logooo.png" alt="" style="width:1000px; height:50px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <!-- Optionally add something here -->
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <?php
                        if (isset($_SESSION['uid']) && $_SESSION['uid'] != NULL) {
                            ?>
                            <ul class="nav-right">
                                <li class="heart-icon"></li>
                                <li class="cart-icon">
                                    <a href="#">
                                        <i class="icon_bag_alt"></i>
                                        <span><?php echo $totalorder; ?></span>
                                    </a>
                                    <div class="cart-hover">
                                        <div class="select-items">
                                            <table>
                                                <tbody>
                                                    <?php
                                                    if ($is_cart_empty) {
                                                        echo '<tr><td colspan="2" class="text-center">Keranjang Anda kosong.</td></tr>';
                                                    } else {
                                                        while ($row = $orders->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td class="si-pic"><img style="width:75px;height:75px;"
                                                                        src="<?php echo 'admin/' . $row['image']; ?>" alt=""></td>
                                                                <td class="si-text">
                                                                    <div class="product-selected">
                                                                        <p><?php echo $row['product_name']; ?></p>
                                                                        <h6><?php echo $row['product_details']; ?></h6>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="select-total">
                                            <span>total:</span>
                                            <h5><?php echo $total; ?></h5>
                                        </div>
                                        <div class="select-button">
                                            <a href="shopping-cart.php" class="primary-btn view-card">Keranjang</a>
                                            <!-- Disable the checkout button if the cart is empty -->
                                            <?php if ($is_cart_empty): ?>
                                                <a href="#" class="primary-btn checkout-btn"
                                                    onclick="alert('Keranjang Anda kosong. Tambahkan produk untuk melanjutkan ke pembayaran.'); return false;">CHECK
                                                    OUT</a>
                                            <?php else: ?>
                                                <a href="check-out.php" class="primary-btn checkout-btn">CHECK OUT</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="cart-price"><?php echo $total; ?></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-item">
            <div class="container">
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li><a href="./index.php">Menu</a></li>
                        <li><a href="./shop.php">Belanja</a></li>
                        <li><a href="./contact.php">Kontak</a></li>
                        <li><a href="./aboutus.php">Tentang Kami</a></li>
                        <li><a href="./orders.php">Orderan</a></li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>

    <!-- Footer and Other Content -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Set initial active state based on the current page
            $('.nav-menu ul li a').each(function () {
                if (window.location.href === this.href) {
                    $(this).closest('li').addClass('active');
                }
            });

            // Add click event to set active class
            $('.nav-menu ul li').click(function () {
                $('.nav-menu ul li').removeClass('active'); // Hapus class 'active' dari semua item
                $(this).addClass('active'); // Tambahkan class 'active' pada item yang diklik
            });
        });
    </script>
</body>

</html>