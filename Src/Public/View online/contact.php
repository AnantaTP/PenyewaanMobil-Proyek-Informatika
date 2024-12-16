<?php include 'header.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];




    require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                    // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'axkharwar@gmail.com';                 // SMTP username
$mail->Password = 'anupkharwar8055';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('axkharwar@gmail.com', 'Mailer');
$mail->addAddress('askharwar@gmail.com');     // Add a recipient               // Name is optional


   // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'PET SHOP';
$mail->Body    =  '<p> EMAIL : ' . $email .  '</p><br /><h1>' . $msg . '</h1>';
$mail->AltBody = $msg;

if(!$mail->send()) {
    echo '<script> alert("Message could not be sent."); </script>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script>alert("Message has been sent."); </script>';
}

}



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
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15813.21865487581!2d110.4228276!3d-7.7574771!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59766a84daa7%3A0x8940d7441ba5e2ad!2sZoepy%20petshop%20krodan!5e0!3m2!1sid!2sid!4v1717127695562!5m2!1sid!2sid"
                    height="610" style="border:0" allowfullscreen="">
                </iframe>
                <div class="icon">
                </div>
            </div>
        </div>
    </div>
    <!-- Map Section Begin -->

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
                                <p>Jl. Krodan No.7, Krodan, Maguwoharjo, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Nomor:</span>
                                <p>0819-1158-4099</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>Zoepy@gmail.com</p>
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