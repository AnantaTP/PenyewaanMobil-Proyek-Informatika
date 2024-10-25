<?php include 'header.php';
$fetch_product = "select * from products";
$result = $conn->query($fetch_product);
?>
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="img/BerandaUser.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Produk, Accessories</span>
                            <h1>ZOEPY PET SHOP</h1>
                            <p>
                                Teman terbaik untuk hewan anda.
                                
                                </p>
                            <a href="shop.php" class="primary-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/hero-2.jpg">s
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span style="color:white;">Produk, Accessories</span>
                            <h1 style="color:white;">PET SHOP</h1>
                            <p style="color:white;">
                                Temukan daftar Produk hewann mulai dari mainan hingga Accessories yang menarik. Salah satu koleksi produk hewan peliharaan terlengkap di negara ini. 
                                Zoepy akan melayani setiap produk yang diajukan hewan peliharaan mereka kepada mereka.</p>
                            <a href="shop.php" class="primary-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                    <!-- <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Deal Of The Week Section Begin-->
    <section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Temukan Produk Yang Baik Untuk Hewan Peliharaan Anda</h2>
                    <p>
                       Zoepy Pet Shop adalah satu-satunya toko dan situs web yang menawarkan rangkaian produk yang dapat disesuaikan dengan tujuan Anda. Kami menyediakan makanan hewan dengan harga yang sangat kompetitif. 
                       Penting untuk mempertimbangkan kebutuhan hewan peliharaan Anda dan Hewan Peliharaan Premium selalu tersedia di layanan pemilik hewan peliharaan. </p>
                </div>
                </div>
                <a href="shop.php" class="primary-btn">Belanja Sekarang</a>
            </div>
        </div>
    </section>
    <!-- Deal Of The Week Section End -->

    
    
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Gratis Ongkir</h6>
                                <p>Semua Jenis Orderan </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Pengiriman Tepat Waktu</h6>
                                <p>Aman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

    <?php include 'footer.php'; ?>