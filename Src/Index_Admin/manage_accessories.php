<?php
include 'header.php';

$accessory_name = "";
$accessory_desc = "";
$accessory_price = "";
$accessory_image = "";
$plat_nomor = "";

// Mode Edit
if (isset($_REQUEST['editid']) && !empty($_REQUEST['editid'])) {
    $editid = $_REQUEST['editid']; // Pastikan plat_nomor adalah string
    $fetch_accessory = $conn->prepare("SELECT * FROM products WHERE plat_nomor = ?");
    $fetch_accessory->bind_param("s", $editid);
    $fetch_accessory->execute();
    $result = $fetch_accessory->get_result();

    if ($row = $result->fetch_assoc()) {
        $accessory_name = $row['product_name'];
        $accessory_desc = $row['product_details'];
        $accessory_price = $row['product_price'];
        $accessory_image = $row['image'];
        $plat_nomor = $row['plat_nomor'];
    } else {
        echo "Data not found.";
    }
}

// Mode Hapus
if (isset($_REQUEST['deleteid']) && !empty($_REQUEST['deleteid'])) {
    $deleteid = $_REQUEST['deleteid']; // Pastikan plat_nomor adalah string
    $fetch_image = $conn->prepare("SELECT image FROM products WHERE plat_nomor = ?");
    $fetch_image->bind_param("s", $deleteid);
    $fetch_image->execute();
    $result = $fetch_image->get_result();

    if ($row = $result->fetch_assoc()) {
        $accessory_image = $row['image'];
        $delete_accessory_query = $conn->prepare("DELETE FROM products WHERE plat_nomor = ?");
        $delete_accessory_query->bind_param("s", $deleteid);

        if ($delete_accessory_query->execute()) {
            if (file_exists($accessory_image)) {
                unlink($accessory_image); // Hapus file gambar
            }
            echo "<script>window.location = 'accessories.php';</script>";
        } else {
            echo "Error deleting data: " . $conn->error;
        }
    }
    exit;
}

// Tambahkan atau Edit Data
if (isset($_POST['addaccessory'])) {
    $accessory_name = $_POST['accessory_name'];
    $accessory_desc = $_POST['accessory_desc'];
    $accessory_price = $_POST['accessory_price'];
    $plat_nomor = $_POST['plat_nomor'];

    if (!empty($_POST['edit_accessory'])) {
        // Mode Edit
        $editid = $_POST['edit_accessory'];
        $update_accessory = $conn->prepare("UPDATE products SET product_name = ?, product_details = ?, product_price = ? WHERE plat_nomor = ?");
        $update_accessory->bind_param("ssss", $accessory_name, $accessory_desc, $accessory_price, $editid);

        if ($update_accessory->execute()) {
            echo "<script>window.location = 'accessories.php';</script>";
        } else {
            echo "Error updating data: " . $conn->error;
        }
    } else {
        // Mode Tambahkan
        $target_dir = "uploads/accessories/";
        $date = date_create();
        $target_file = $target_dir . date_timestamp_get($date) . '_' . basename($_FILES["accessory_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi Gambar
        $check = getimagesize($_FILES["accessory_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Validasi Format File
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["accessory_image"]["tmp_name"], $target_file)) {
                $insert_pet = $conn->prepare("INSERT INTO products (plat_nomor, product_name, type, product_details, product_price, image) VALUES (?, ?, 1, ?, ?, ?)");
                $insert_pet->bind_param("sssss", $plat_nomor, $accessory_name, $accessory_desc, $accessory_price, $target_file);

                if ($insert_pet->execute()) {
                    echo "<script>window.location = 'accessories.php';</script>";
                } else {
                    echo "Error inserting data: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <?php echo isset($_REQUEST['editid']) ? "Edit Data" : "Tambah Data"; ?>
    </h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="plat_nomor">Plat Nomor:</label>
            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="<?php echo $plat_nomor ?? ''; ?>" <?php echo isset($_REQUEST['editid']) ? 'readonly' : ''; ?>>
        </div>
        <div class="form-group">
            <label for="accessory_name">Nama:</label>
            <input type="text" class="form-control" id="accessory_name" name="accessory_name" value="<?php echo $accessory_name; ?>">
        </div>
        <div class="form-group">
            <label for="accessory_desc">Deskripsi:</label>
            <input type="text" class="form-control" id="accessory_desc" name="accessory_desc" value="<?php echo $accessory_desc; ?>">
        </div>
        <div class="form-group">
            <label for="accessory_price">Harga:</label>
            <input type="text" class="form-control" id="accessory_price" name="accessory_price" value="<?php echo $accessory_price; ?>">
        </div>
        <?php if (!isset($_REQUEST['editid'])): ?>
            <div class="form-group">
                <label for="accessory_image">Gambar:</label>
                <input type="file" class="form-control" id="accessory_image" name="accessory_image">
            </div>
        <?php endif; ?>
        <input type="hidden" name="edit_accessory" value="<?php echo $_REQUEST['editid'] ?? ''; ?>">
        <button type="submit" class="btn btn-success" name="addaccessory">Simpan</button>
    </form>
</div>
<!-- End Page Content -->
