<?php include 'header.php'; 
if(!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL){
    ?>
    <script>
    window.location = "login.php";
    </script>
    <?php
    exit;
}
$uid = $_SESSION['uid'];
$fetch_orders = "SELECT *, o.id as orderid FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and status IS NOT NULL";
$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT sum(p.product_price) as total FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and status IS NOT NULL";
$total_amount = $conn->query($total_amount_query);
$total = 50;
while($row = $total_amount->fetch_assoc()){
    $total = $row['total'];
}
?>
    <script>
        function removefromcart(oid){
            $.post("addtocart.php", {
                cancelorder:1,
                oid:oid
            }, function(data, status){
                if(data == 1){
                    window.location = "orders.php";
                }else{
                    alert(date_add);
                }
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
                        <!-- <a href="./shop.html">Shop</a> -->
                        <span>Pesan</span>
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
                                    <th>Tagihan</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row = $orders->fetch_assoc()){
                                ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="<?php echo 'admin/'.$row['image'] ?>" alt=""></td>
                                    <td class="first-row">
                                        <h5><?php echo $row['product_name'] ?></h5>
                                    </td>
                                    <td class="p-price first-row"><?php echo $row['product_price'] ?></td>
                                    <td class="p-price first-row">
                                        <?php 
                                        $status = $row['status'];
                                        if($status == NULL){
                                            echo "In the cart";
                                        }elseif($status == 0){
                                            echo "Sudah Bayar";
                                        }elseif($status == 1){
                                            echo "Mobil Diambil";
                                        }elseif($status == 2){
                                            echo "Mobil Dikembalikan";
                                        }elseif($status == 3){
                                            echo "Dibatalkan";
                                        }elseif($status == 4){
                                            echo "Ditinjau";
                                        } 
                                        ?></td>
                                        <?php
                                        if($status == 4){
                                            ?>
                                            <td><a href="generate_invoice.php?oid=<?php echo $row['orderid'];?>"><i style="color:black;" class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td>NA</td>
                                            <?php
                                        }
                                        ?>
                                    <td class="close-td first-row"><i class="ti-close" onclick="removefromcart('<?php echo $row['orderid'];?>');"></i></td>
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
    <!-- Shopping Cart Section End -->

    <?php include 'footer.php' ?>