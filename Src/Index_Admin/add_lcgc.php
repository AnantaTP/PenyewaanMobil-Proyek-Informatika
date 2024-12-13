<?php
include 'header.php';

if (isset($_POST['addpet'])) {
  $plat_nomor = $_POST['plat_nomor'];
  $pet_name = $_POST['pet_name'];
  $pet_desc = $_POST['pet_desc'];
  $pet_price = $_POST['pet_price'];

  if (isset($_POST['edit_pet'])) {
    $edit_plat = $_POST['edit_pet'];
    $update_pet = "UPDATE products SET plat_nomor = '$plat_nomor', type = 0, product_name = '$pet_name', product_details = '$pet_desc', product_price = '$pet_price' WHERE plat_nomor = '$edit_plat'";
    $result = $conn->query($update_pet);
    if ($result === TRUE) {
      ?>
      <script>
        window.location = "table_lcgc.php";
      </script>
      <?php
    }
    exit;
  }

  if ($plat_nomor != NULL && $pet_name != NULL && $pet_desc != NULL && $pet_price != NULL) {
    $target_dir = "uploads/mobil/LCGC";
    $additional_target_dir = "../Index_Online/admin/uploads/mobil/LCGC";
    $date = date_create();
    $target_file = $target_dir . date_timestamp_get($date) . '_' . basename($_FILES["pet_image"]["name"]);
    $additional_target_file = $additional_target_dir . date_timestamp_get($date) . '_' . basename($_FILES["pet_image"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["pet_image"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["pet_image"]["tmp_name"], $target_file)) {
        // Tambahkan logika untuk menyalin file ke direktori tambahan
        if (!is_dir($additional_target_dir)) {
          mkdir($additional_target_dir, 0777, true); // Buat direktori jika belum ada
        }

        if (copy($target_file, $additional_target_file)) {
          // File berhasil disalin ke direktori tambahan
        } else {
          echo "Gagal menyalin file ke direktori tambahan.";
        }

        $insert_pet = "INSERT INTO products (plat_nomor, type, product_name, product_details, product_price, image) 
                       VALUES ('$plat_nomor', 0, '$pet_name', '$pet_desc', '$pet_price', '$target_file')";
        if ($conn->query($insert_pet) === TRUE) {
          ?>
          <script>
            window.location = 'add_lcgc.php'; 
          </script>
          <?php
        } else {
          echo "Error: " . $insert_pet . "<br>" . $conn->error;
        }
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
  exit;
}

$plat_nomor = "";
$pet_name = "";
$pet_desc = "";
$pet_price = "";

if (isset($_REQUEST['editid']) && $_REQUEST['editid'] != NULL) {
  $editid = $_REQUEST['editid'];
  $fetch_pet = "SELECT * FROM products WHERE plat_nomor = '$editid'";
  $result = $conn->query($fetch_pet);
  while ($row = $result->fetch_assoc()) {
    $plat_nomor = $row['plat_nomor'];
    $pet_image = $row['image'];
    $pet_name = $row['product_name'];
    $pet_desc = $row['product_details'];
    $pet_price = $row['product_price'];
  }
}

if (isset($_REQUEST['deleteid']) && $_REQUEST['deleteid'] != NULL) {
  $delete_plat = $_REQUEST['deleteid'];
  $fetch_image = "SELECT image FROM products WHERE plat_nomor = '$delete_plat'";
  $result = $conn->query($fetch_image);
  while ($row = $result->fetch_assoc()) {
    $pet_image = $row['image'];
  }
  $delete_pet_query = "DELETE FROM products WHERE plat_nomor = '$delete_plat'";
  $result = $conn->query($delete_pet_query);
  if ($result === TRUE) {
    unlink($pet_image);
    ?>
    <script>
      window.location = 'table_lcgc.php';
    </script>
    <?php
  }
  exit;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">
    <?php echo isset($_REQUEST['editid']) ? "Edit" : "Tambah"; ?>
  </h1>
  <form method='post' enctype="multipart/form-data">
    <div class="form-group">
      <label for="plat_nomor">Plat Nomor:</label>
      <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="<?php echo $plat_nomor; ?>" <?php echo isset($_REQUEST['editid']) ? "readonly" : ""; ?>>
    </div>
    <div class="form-group">
      <label for="pet_name">Nama Mobil:</label>
      <input type="text" class="form-control" id="pet_name" name="pet_name" value="<?php echo $pet_name; ?>">
    </div>
    <div class="form-group">
      <label for="pet_desc">Deskripsi:</label>
      <input type="text" class="form-control" id="pet_desc" name="pet_desc" value="<?php echo $pet_desc; ?>">
    </div>
    <div class="form-group">
      <label for="pet_price">Harga:</label>
      <input type="text" class="form-control" id="pet_price" name="pet_price" value="<?php echo $pet_price; ?>">
    </div>
    <?php if (!isset($_REQUEST['editid'])) { ?>
      <div class="form-group">
        <label for="pet_image">Gambar:</label>
        <input type="file" class="form-control" id="pet_image" name="pet_image">
      </div>
    <?php } else { ?>
      <input type="hidden" name="edit_pet" value="<?php echo $_REQUEST['editid']; ?>">
    <?php } ?>
    <button type="submit" class="btn btn-primary" name='addpet'>Simpan</button>
  </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Logout" untuk mengakhiri sesi.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="login.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>

</html>
