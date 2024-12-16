<?php include 'header.php';
if (isset($_POST['register'])) {
    if ($_POST['pass'] != NULL && $_POST['con-pass'] != NULL && $_POST['fname'] != NULL && $_POST['lname'] != NULL && $_POST['address'] != NULL && $_POST['contact_no'] != NULL) {
        if ($_POST['pass'] == $_POST['con-pass']) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $contactno = $_POST['contact_no'];
            $address = $_POST['address'];

            // Direktori utama
            $target_dir = "admin/uploads/profiles/";
            // Direktori tambahan
            $additional_dir = "../../Admin/Index_Admin/admin/uploads/profiles/";

            $date = date_create();
            $file_name = date_timestamp_get($date) . '_' . basename($_FILES["profilephoto"]["name"]);
            $target_file = $target_dir . $file_name;
            $additional_file = $additional_dir . $file_name;

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Periksa apakah file yang diunggah adalah gambar
            $check = getimagesize($_FILES["profilephoto"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Periksa ekstensi file
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Jika validasi berhasil
            if ($uploadOk == 1) {
                // Pastikan folder utama ada
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                // Pastikan folder tambahan ada
                if (!file_exists($additional_dir)) {
                    mkdir($additional_dir, 0777, true);
                }

                // Simpan file ke direktori utama
                if (move_uploaded_file($_FILES["profilephoto"]["tmp_name"], $target_file)) {
                    // Salin file ke direktori tambahan
                    copy($target_file, $additional_file);

                    // Simpan data ke database
                    $register_user = "INSERT INTO user_details (first_name, last_name, email, password, contact_no, address, image) 
                                      VALUES ('$fname', '$lname', '$email', '$pass', '$contactno', '$address', '$target_file')";
                    $result = $conn->query($register_user);

                    if ($result === TRUE) {
                        ?>
                        <script>
                        alert("Registration Done Successfully!");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                        alert("Some error occurred!");
                        </script>
                        <?php
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            ?>
            <script>
            alert("Passwords do not match!");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
        alert("Required fields are missing!");
        </script>
        <?php
    }
}
if (isset($_SESSION['contactno']) && $_SESSION['contactno'] != NULL) {
    ?>
    <script>
    window.location = 'index.php';
    </script>
    <?php
}
?>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Menu</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        <form method="post" enctype="multipart/form-data">
                        <div class="group-input">
                                <label for="username">Nama Depan *</label>
                                <input type="text" id="fname" name="fname">
                            </div>
                            <div class="group-input">
                                <label for="username">Nama Akhir *</label>
                                <input type="text" id="lname" name="lname">
                            </div>
                            <div class="group-input">
                                <label for="username">Alamat *</label>
                                <input type="text" id="address" name="address">
                            </div>
                            <div class="group-input">
                                <label for="username">No Hp *</label>
                                <input type="text" id="contact_no" name="contact_no">
                            </div>
                            <div class="group-input">
                                <label for="username">Email  *</label>
                                <input type="text" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="text" id="pass"name="pass">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Konfirmasi Password *</label>
                                <input type="text" id="con-pass" name="con-pass">
                            </div>
                            <div class="group-input">
                                <label for="profilephoto">Foto Profil *</label>
                                <input type="file" id="profilephoto" name="profilephoto" required>
                            </div>
                            <button type="submit" class="site-btn register-btn" name="register">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="./login.php" class="or-login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
<?php include 'footer.php'; ?>
