<?php include 'header.php';
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i>Menu</a>
                    <span>Kontak</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Map Section Begin -->
<div class="map spad">
    <div class="container">
        <div class="map-inner">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.427291726262!2d110.42412751744384!3d-7.755051599999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a594c21734911%3A0x3112e0b9f484d57b!2sSidadolog%20RentCar!5e0!3m2!1sid!2sid!4v1699861234567!5m2!1sid!2sid"
                width="100%" height="610" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
<!-- Map Section End -->

<style>
.map-inner {
    position: relative;
    width: 100%;
}

.map.spad {
    padding: 50px 0;
}

.container {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}

.map-inner iframe {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
}
</style>

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-title">
                    <h4>hubungi kami</h4>
                    <p>Salah Satu Petshop terlengkap di yogyakarta</p>
                </div>
                <div class="contact-widget">
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-location-pin"></i>
                        </div>
                        <div class="ci-text">
                            <span>Alamat :</span>
                            <p>Jl kanigoro no 232 krodan, maguwoharjo, depok sleman, jogja 55282, Sleman 55282</p>
                        </div>
                    </div>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-mobile"></i>
                        </div>
                        <div class="ci-text">
                            <span>Nomor:</span>
                            <p>+6281375471934</p>
                        </div>
                    </div>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-email"></i>
                        </div>
                        <div class="ci-text">
                            <span>Email:</span>
                            <p>sidarentcar@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="contact-form">
                    <div class="leave-comment">
                        <h4>Silahkan tinggalkan Pesan anda</h4>
                        <p>Staf kami akan menjawab pertanyaan anda</p>
                        <form action="" method="post" class="comment-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" required placeholder="Nama">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" required placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="msg" placeholder="Pesan"></textarea>
                                    <button type="submit" name="submit" class="site-btn">Kirim pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php include 'footer.php'; ?>