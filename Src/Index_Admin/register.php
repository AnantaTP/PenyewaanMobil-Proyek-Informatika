<?php
// Include config.php untuk koneksi database
include 'config.php';

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $image = $_FILES['image'];

    // Validasi input
    if (empty($admin_name) || empty($admin_email) || empty($admin_password)) {
        $error = "All fields are required!";
    } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (!empty($image['name']) && $image['error'] === 0) {
        // Validasi unggahan gambar
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowed_types)) {
            $error = "Invalid image format! Only JPG, PNG, and GIF are allowed.";
        } elseif ($image['size'] > 2 * 1024 * 1024) { // Maksimum 2MB
            $error = "Image size exceeds 2MB!";
        } else {
            // Pindahkan gambar ke folder uploads/admin/
            $upload_dir = 'uploads/admin/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Buat folder jika belum ada
            }
            $image_path = $upload_dir . time() . '_' . basename($image['name']);
            if (!move_uploaded_file($image['tmp_name'], $image_path)) {
                $error = "Failed to upload image.";
            }
        }
    }

    if (!isset($error)) {
        // Insert data ke database (tanpa hashing password)
        $sql = "INSERT INTO admin (admin_name, admin_email, admin_password, image) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $admin_name, $admin_email, $admin_password, $image_path);

        if ($stmt->execute()) {
            $success = "Admin account created successfully! Please login.";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
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

    <title>Register Admin - AutoHub</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <!-- Sisi gambar -->
                    <div class="col-lg-5 d-none d-lg-block">
                        <img src="img/f.png" alt="Admin Registration" class="img-fluid"
                            style="height: 100%; object-fit: cover;">
                    </div>

                    <!-- Sisi form -->
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create Admin Account</h1>
                            </div>

                            <!-- Tampilkan pesan error atau sukses -->
                            <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php elseif (!empty($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                            <?php endif; ?>

                            <form class="user" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="admin_name"
                                        placeholder="Admin Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="admin_email"
                                        placeholder="Admin Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="admin_password"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Register Admin Account</button>
                            </form>

                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
