<?php include 'header.php';
$fetch_product = "select * from products";
$result = $conn->query($fetch_product);
?>
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <div class="single-hero-items set-bg" data-setbg="img/BerandaUSer.png">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span>jasa rental mobil</span>
                        <h1>SIDA RENTCAR</h1>
                        <p>
                            Sida Rent Car, spesialis layanan transpotasi komersil untuk berbagai kebutuhan perjalanan
                            anda.
                            Berpengalaman menyediakan armada mobil terbaik di Yogyakarta, siap melayani semua kebutuhan
                            anda.
                        </p>
                        <a href="shop.php" class="primary-btn">Pesan Sekarang</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="single-hero-items set-bg" data-setbg="img/BerandaUser2.png">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span style="color:black;">jasa rental mobil</span>
                        <h1 style="color:black;">SIDA RENTCAR</h1>
                        <p style="color:black;">
                            Sida rent car memiliki berbagai pilihan kendaraan yang bisa anda sewa sesuai dengan
                            kebutuhan anda.
                            Mulai dari lcgc, mpv, suv, komersil, ataupun mobil mewah.</p>
                        <a href="shop.php" class="primary-btn">Pesan Sekarang</a>
                    </div>
                </div>
                <!-- <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div> -->
            </div>
        </div>
    </div>
</section>





</div>
</section>
<!-- Latest Blog Section End -->

<?php include 'footer.php'; ?>