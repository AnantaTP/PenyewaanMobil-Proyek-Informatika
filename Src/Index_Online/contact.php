<?php include 'header.php'; ?>

<!-- Link to checked.css for animation and styling -->
<link rel="stylesheet" href="css/ratingContact.css">

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Menu</a>
                    <span>Kontak</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

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

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-title">
                    <h4>Hubungi Kami</h4>
                    <p>Salah Satu Petshop terlengkap di Yogyakarta</p>
                </div>
                <div class="contact-widget">
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-location-pin"></i>
                        </div>
                        <div class="ci-text">
                            <span>Alamat :</span>
                            <p>Jl Kanigoro No 232 Krodan, Maguwoharjo, Depok Sleman, Jogja 55282, Sleman 55282</p>
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
                    <div class="leave-comment rating-list">
                        <h4>Rating Pelanggan</h4>
                        <p>Berikut adalah ulasan dari pelanggan kami</p>

                        <?php
                        // Query untuk mengambil rating dan nama pengguna dari database
                        $query = "SELECT r.rating_value, r.tanggal_rating, r.review, CONCAT(u.first_name, ' ', u.last_name) AS user_name 
                                  FROM rating r 
                                  JOIN user_details u ON r.id_user = u.id 
                                  ORDER BY r.tanggal_rating DESC";
                        $result = $conn->query($query);

                        // Cek apakah ada rating yang tersedia
                        if ($result->num_rows > 0):
                            while ($row = $result->fetch_assoc()):
                        ?>
                        <div class="rating-item">
                            <div class="rating-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="rating-stars">
                                <!-- Display stars based on rating_value -->
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa fa-star<?= $i <= $row['rating_value'] ? ' checked' : '-o' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="rating-text">
                                <small><?= date('F j, Y, g:i a', strtotime($row['tanggal_rating'])); ?> - <strong><?= htmlspecialchars($row['user_name']); ?></strong></small>
                                <p>"<?= htmlspecialchars($row['review']); ?>"</p>
                            </div>
                        </div>
                        <?php
                            endwhile;
                        else:
                            echo "<p>No ratings available.</p>";
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php include 'footer.php'; ?>
