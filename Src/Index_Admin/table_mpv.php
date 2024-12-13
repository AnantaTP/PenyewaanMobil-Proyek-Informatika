<?php
include 'header.php';

// Cek apakah status sudah disimpan di session
if (!isset($_SESSION['status_simulasi'])) {
    $_SESSION['status_simulasi'] = [];
}

// Mengambil data dari tabel products dengan filter type = 1 (MPV)
$fetch_data = "SELECT plat_nomor, product_name, image, product_details, product_price FROM products WHERE type = 1";
$result = $conn->query($fetch_data);

// Proses perubahan status kendaraan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plat_nomor'], $_POST['status'])) {
    $plat_nomor = $_POST['plat_nomor'];
    $status = $_POST['status'];

    // Simpan status di session
    $_SESSION['status_simulasi'][$plat_nomor] = $status;
}
?>

<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tables</h1>
  <a href='add_mpv.php' class='btn btn-success' style="float: right;">Tambah <span class='fa fa-plus'></span></a>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Daftar Mobil MPV</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Plat Nomor</th>
              <th>Nama Mobil</th>
              <th>Gambar</th>
              <th>Deskripsi</th>
              <th>Harga</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                // Ambil status kendaraan dari session, jika ada
                $current_status = isset($_SESSION['status_simulasi'][$row['plat_nomor']]) ? $_SESSION['status_simulasi'][$row['plat_nomor']] : 'Available';
                ?>
                <tr class="<?php echo ($current_status == 'Not Available') ? 'text-muted' : ''; ?>">
                  <td><?php echo $row['plat_nomor']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><img src="<?php echo $row['image']; ?>" style="width:100px; height:100px;" class="img-circle"></td>
                  <td><?php echo $row['product_details']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="plat_nomor" value="<?php echo $row['plat_nomor']; ?>">
                      <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="Available" <?php echo $current_status == 'Available' ? 'selected' : ''; ?>>Available</option>
                        <option value="Not Available" <?php echo $current_status == 'Not Available' ? 'selected' : ''; ?>>Not Available</option>
                      </select>
                    </form>
                  </td>
                  <td><a class='btn btn-success' href="add_mpv.php?editid=<?php echo $row['plat_nomor']; ?>"><span class="fa fa-pen"></span></a></td>
                  <td><a class='btn btn-danger' href="add_mpv.php?deleteid=<?php echo $row['plat_nomor']; ?>"><span class="fa fa-trash"></span></a></td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='8'>Tidak ada data ditemukan.</td></tr>";
            }
            ?>
          </tbody>
        </table>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
