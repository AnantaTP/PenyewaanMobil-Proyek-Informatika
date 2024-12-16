<?php include 'header.php';
if(isset($_POST['register'])){
    // print_r($_FILES);exit;
    if($_POST['pass'] != NULL && $_POST['con-pass'] != NULL && $_POST['fname'] != NULL && $_POST['lname'] != NULL && $_POST['address'] != NULL && $_POST['contact_no'] != NULL ){
        if($_POST['pass'] == $_POST['con-pass']){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $contactno = $_POST['contact_no'];
            $address = $_POST['address'];
            $target_dir = "admin/uploads/profiles/";
            $date=date_create();
            $target_file = $target_dir.date_timestamp_get($date).'_'.basename($_FILES["profilephoto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            
            $check = getimagesize($_FILES["profilephoto"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            // if ($_FILES["fileToUpload"]["size"] > 500000) {
            //     echo "Sorry, your file is too large.";
            //     $uploadOk = 0;
            // }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["profilephoto"]["tmp_name"], $target_file)) {
                    // echo "The file ". basename( $_FILES["pet_image"]["name"]). " has been uploaded.";
                    $register_user = "insert into user_details (first_name, last_name, email, password, contact_no, address, image) VALUES('$fname', '$lname', '$email', '$pass', '$contactno', '$address', '$target_file')";
                    $result = $conn->query($register_user);
                    if($result === TRUE){
                        ?>
                        <script>
                        alert("Registration Done Successfully !");
                        </script>
                        <?php
                    }else{
                        ?>
                        <script>
                        alert("Some error occurred !");
                        </script>
                        <?php
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

        }else{
            ?>
            <script>
            alert("Passwords does not match !");
            </script>
            <?php
        }
    }else{
        ?>
        <script>
        alert("Required fields are missing !");
        </script>
        <?php
    }
    // exit;
}
if(isset($_SESSION['contactno']) && $_SESSION['contactno'] != NULL){
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
                        <a href="#"><i class="fa fa-home"></i> Home</a>
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
                                <label for="username">First Name *</label>
                                <input type="text" id="fname" name="fname">
                            </div>
                            <div class="group-input">
                                <label for="username">Last Name *</label>
                                <input type="text" id="lname" name="lname">
                            </div>
                            <div class="group-input">
                                <label for="username">Address *</label>
                                <input type="text" id="address" name="address">
                            </div>
                            <div class="group-input">
                                <label for="username">Contact No *</label>
                                <input type="text" id="contact_no" name="contact_no">
                            </div>
                            <div class="group-input">
                                <label for="username">Email address *</label>
                                <input type="text" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="text" id="pass"name="pass">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input type="text" id="con-pass" name="con-pass">
                            </div>
                            <div class="group-input">
                                <label for="profilephoto">Profile Photo *</label>
                                <input type="file" id="profilephoto" name="profilephoto" required>
                            </div>
                            <button type="submit" class="site-btn register-btn" name="register">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="./login.php" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    <?php include 'footer.php'; 

    
    ?>