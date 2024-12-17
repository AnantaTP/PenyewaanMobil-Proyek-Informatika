<?php
include 'header.php';

// Ambil status dari session
if (!isset($_SESSION['status_simulasi'])) {
    $_SESSION['status_simulasi'] = [];
}

if (isset($_REQUEST['cat'])) {
    $category = $_REQUEST['cat'];
} else {
    $category = 0;
}

$fetch_product = "SELECT * FROM products WHERE type = '$category'";
$result = $conn->query($fetch_product);
?>

<script>
    function addtocart(pid) {
        $.post("addtocart.php", {
            pid: pid,
            addtocart: 1
        }, function (data, status) {
            if (data == 0) {
                window.location = "login.php";
            } else {
                alert(data);
            }
        });
    }
</script>

<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Menu</a>
                    <span>Belanja</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title">Kategori</h4>
                    <ul class="filter-catagories">
                        <li><a href="shop.php?cat=0">LCGC</a></li>
                        <li><a href="shop.php?cat=1">MPV</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-list">
                    <div class="row">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $plat_nomor = $row['plat_nomor'];
                            $current_status = isset($_SESSION['status_simulasi'][$plat_nomor]) ? $_SESSION['status_simulasi'][$plat_nomor] : 'Available';

                            // Kondisi warna dan tombol keranjang berdasarkan status
                            $is_available = ($current_status === 'Available');
                            $gray_class = $is_available ? '' : 'gray-out';
                            $button_html = $is_available ?
                                "<button onclick=\"addtocart('$plat_nomor');\"><i class=\"icon_bag_alt\"></i></button>" :
                                "<button disabled><i class=\"icon_bag_alt\"></i></button>"; // Disable button if not available
                            ?>
                            <div class="col-lg-4 col-sm-6 <?php echo $gray_class; ?>">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img src="<?php echo htmlspecialchars( $row['image']) ?>" alt="">
                                        <div class="icon"></div>
                                        <ul>
                                            <li class="w-icon active">
                                                <?php echo $button_html; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <a href="#" class="plat-nomor">
                                            <?php echo $row['plat_nomor']; ?>
                                        </a>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?php echo ($category == 0 ? 'LCGC' : 'MPV'); ?></div>
                                        <a href="#">
                                            <h5><?php echo $row['product_name']; ?></h5>
                                        </a>
                                        <div class="product-price">Rp <?php echo $row['product_price']; ?>/hari</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Deskripsi -->
                            <div class="modal fade bd-example-modal-lg-<?php echo $row['plat_nomor']; ?>" tabindex="-1"
                                role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Deskripsi Mobil - <?php echo $row['plat_nomor']; ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $row['product_details']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Tambahkan style untuk kendaraan yang tidak tersedia */
    .gray-out {
        filter: grayscale(100%);
        pointer-events: none;
        /* Nonaktifkan interaksi dengan elemen */
    }

    .gray-out .product-item {
        opacity: 0.5;
    }

    .gray-out button {
        pointer-events: none;
        /* Disable button klik pada mobil yang tidak tersedia */
    }
</style>

<?php
include 'footer.php';
?>