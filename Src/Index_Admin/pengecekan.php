<?php
include 'header.php';

// Fetch all products (id, product_name)
$fetch_products = "SELECT id, product_name FROM products";
$products = $conn->query($fetch_products);

// Fetch all maintenance data (id_mobil, tanggal_service_rutin, tanggal_ganti_ban, tanggal_ganti_oli)
$fetch_maintenance = "SELECT * FROM pengecekan";
$maintenance = $conn->query($fetch_maintenance);

// Handling the update request
if (isset($_POST['update_maintenance'])) {
    $id_mobil = $_POST['id_mobil'];
    $tanggal_service_rutin = $_POST['tanggal_service_rutin'];
    $tanggal_ganti_ban = $_POST['tanggal_ganti_ban'];
    $tanggal_ganti_oli = $_POST['tanggal_ganti_oli'];

    // Build the update query dynamically
    $update_query = "UPDATE pengecekan SET ";
    $fields_to_update = [];

    // Check if tanggal_service_rutin was changed
    if (!empty($tanggal_service_rutin)) {
        $fields_to_update[] = "tanggal_service_rutin = '$tanggal_service_rutin'";
    }

    // Check if tanggal_ganti_ban was changed
    if (!empty($tanggal_ganti_ban)) {
        $fields_to_update[] = "tanggal_ganti_ban = '$tanggal_ganti_ban'";
    }

    // Check if tanggal_ganti_oli was changed
    if (!empty($tanggal_ganti_oli)) {
        $fields_to_update[] = "tanggal_ganti_oli = '$tanggal_ganti_oli'";
    }

    // If there are fields to update, join them to the query
    if (!empty($fields_to_update)) {
        $update_query .= implode(", ", $fields_to_update);
        $update_query .= " WHERE id_mobil = '$id_mobil'";

        if ($conn->query($update_query) === TRUE) {
            echo "<script>alert('Data perawatan berhasil diperbarui'); window.location.href='pengecekan.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat memperbarui data perawatan');</script>";
        }
    } else {
        echo "<script>alert('Tidak ada perubahan yang dilakukan.');</script>";
    }
    exit;
}
?>

<!-- Begin Page Content -->
<script>
    // Function to confirm the update before submitting
    function confirmUpdate(form, field) {
        let fieldName = '';
        if (field === 'tanggal_service_rutin') {
            fieldName = 'tanggal service rutin';
        } else if (field === 'tanggal_ganti_ban') {
            fieldName = 'tanggal ganti ban';
        } else if (field === 'tanggal_ganti_oli') {
            fieldName = 'tanggal ganti oli';
        }

        // Display a confirmation prompt before updating
        if (confirm("Apakah Anda yakin ingin memperbarui " + fieldName + "?")) {
            form.submit();
        } else {
            return false;
        }
    }
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Daftar Perawatan Mobil</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perawatan Mobil</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Mobil</th>
                            <th>Nama Mobil</th>
                            <th>Tanggal Service Rutin</th>
                            <th>Tanggal Ganti Ban</th>
                            <th>Tanggal Ganti Oli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($maintenance->num_rows > 0) {
                            while ($row = $maintenance->fetch_assoc()) {
                                // Get the product name using the id_mobil
                                $product_name = "";
                                if ($products->num_rows > 0) {
                                    $products->data_seek(0); // Reset the pointer to start from the beginning of the products
                                    while ($product_row = $products->fetch_assoc()) {
                                        if ($product_row['id'] == $row['id_mobil']) {
                                            $product_name = $product_row['product_name'];
                                            break;
                                        }
                                    }
                                }
                                ?>
                                <form method="POST" action="pengecekan.php">
                                    <tr>
                                        <td><?php echo $row['id_mobil']; ?></td>
                                        <td><?php echo $product_name; ?></td>
                                        <td>
                                            <input type="date" name="tanggal_service_rutin"
                                                value="<?php echo $row['tanggal_service_rutin']; ?>"
                                                onchange="confirmUpdate(this.form, 'tanggal_service_rutin');">
                                        </td>
                                        <td>
                                            <input type="date" name="tanggal_ganti_ban"
                                                value="<?php echo $row['tanggal_ganti_ban']; ?>"
                                                onchange="confirmUpdate(this.form, 'tanggal_ganti_ban');">
                                        </td>
                                        <td>
                                            <input type="date" name="tanggal_ganti_oli"
                                                value="<?php echo $row['tanggal_ganti_oli']; ?>"
                                                onchange="confirmUpdate(this.form, 'tanggal_ganti_oli');">
                                        </td>
                                        <td>
                                            <input type="hidden" name="id_mobil" value="<?php echo $row['id_mobil']; ?>">
                                        </td>
                                    </tr>
                                </form>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>No maintenance records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script