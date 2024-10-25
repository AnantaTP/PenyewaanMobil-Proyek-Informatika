<?php 
include 'header.php';
if(isset($_POST['signin'])){
    if($_POST['email'] != NULL && $_POST['pass'] != NULL){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $check_user = "select * from user_details where email = '$email' and password = '$pass'";
        $result = $conn->query($check_user);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $_SESSION['uid'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_name'] = $row['first_name'].' '.$row['last_name'];
                $_SESSION['contactno'] = $row['contact_no'];
                $_SESSION['profilephoto'] = $row['image'];
            }
            ?>
            <script>
            alert("Successfully logged in !");
            </script>
            <?php
        }else{
            ?>
            <script>
            alert("Wrong info provided !");
            </script>
            <?php
        }
    }else{
        ?>
            <script>
            alert("Fields are missing !");
            </script>
            <?php
    }
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
                        <a href="#"><i class="fa fa-home"></i> Menu</a>
                        <span>Login</span>
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
                    <div class="login-form">
                        <h2>Login</h2>
                        <form method="post">
                            <div class="group-input">
                                <label for="username">Email *</label>
                                <input type="text" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="pass" name="pass">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <a href="#" class="forget-pass">Lupa Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn" name="signin">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="./register.php" class="or-login">Buat akun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

   <?php
   include 'footer.php';
   ?>