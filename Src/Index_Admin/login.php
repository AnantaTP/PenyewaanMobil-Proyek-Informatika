<?php 

// Include config.php untuk koneksi database
include 'config.php';

// Jika admin sudah login, arahkan ke index.php
if (isset($_SESSION['admin']) && $_SESSION['admin'] != NULL) {
  ?>
  <script>
    window.location = "index.php"; // Jika sudah login, arahkan ke index.php
  </script>
  <?php
}

// Proses login saat form disubmit
if (isset($_POST['adminlogin'])) {  // Pastikan tombolnya adalah 'adminlogin'
  if ($_POST['email'] != NULL && $_POST['pass'] != NULL) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Periksa kecocokan admin berdasarkan email dan password
    $check_admin = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password = '$pass'";
    $result = $conn->query($check_admin);

    if ($result->num_rows > 0) {
      // Jika data cocok, set session admin
      while ($row = $result->fetch_assoc()) {
        $_SESSION['admin'] = $row['admin_email']; // Menyimpan email admin di session
      }
      ?>
      <script>
        window.location = "index.php"; // Setelah login, redirect ke index.php
      </script>
      <?php
    } else {
      ?>
      <script>
        alert("No match found!"); // Menampilkan pesan jika tidak ada kecocokan
      </script>
      <?php
    }
  } else {
    ?>
    <script>
      alert("Fill all the fields!"); // Menampilkan pesan jika form tidak lengkap
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - AutoHub</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom style overrides -->
  <style>
    body {
      background-color: #d4edda; /* Light green background */
    }
    .bg-gradient-primary {
      background: linear-gradient(180deg, #a8e6a3, #81c784); /* Gradient green */
    }
    .btn-primary {
      background-color: #4CAF50; /* Custom green for login button */
      border-color: #4CAF50;
    }
    .btn-primary:hover {
      background-color: #45a049;
      border-color: #45a049;
    }
    .text-gray-900 {
      color: #2e7d32 !important; /* Darker green for text */
    }
    .card {
      border-radius: 15px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .bg-login-image {
      background-image: url('images/car-login-bg.jpg'); /* Add a relevant car background image */
      background-size: cover;
      background-position: center;
    }
    .form-control-user {
      border-radius: 20px;
      padding: 15px;
    }
  </style>

</head>

<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-car"></i> Welcome to Sida Rentcar!</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="pass" required>
                    </div>
                    <button type="submit" name="adminlogin" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="register.php">Don't have an account? Register here!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
