<?php
include 'header.php';

if(isset($_REQUEST['cat'])){
    $category = $_REQUEST['cat'];    
} else {
    $category = 0;
}

$fetch_product = "SELECT * FROM products WHERE type = '$category'";
$result = $conn->query($fetch_product);
?>

<script>
    function addtocart(pid){
        $.post("addtocart.php", {
            pid: pid,
            addtocart: 1
        }, function(data, status){
            if(data == 0){
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
                        <li><a href="shop.php?cat=0">Produk</a></li>
                        <li><a href="shop.php?cat=1">Aksesoris</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-list">
                    <div class="row">
                        <?php
                        while($row = $result->fetch_assoc()){
                            ?>
                            <div class="col-lg-4 col-sm-6">]
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <!-- Tambahkan path ke gambar menggunakan fungsi htmlspecialchars() untuk mencegah XSS -->
                                        <img src="<?php echo htmlspecialchars('admin/'.$row['image']) ?>" alt="">
                                        <div class="icon"></div>
                                        <ul>
                                            <li class="w-icon active"><button onclick="addtocart('<?php echo $row['id'];?>');"><i class="icon_bag_alt"></i></button></li>
                                            <li class="quick-view"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-<?php echo $row['id']; ?>">+ Deskripsi</a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?php echo ($category==0?'Produk':'Aksesoris') ?></div>
                                        <a href="#"><h5><?php echo $row['product_name'] ?></h5></a>
                                        <div class="product-price"><?php echo $row['product_price'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade bd-example-modal-lg-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <p style="margin:20px;">
                                            <?php echo $row['product_details'] ?>
                                        </p>
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

<?php
include 'footer.php';
?>
