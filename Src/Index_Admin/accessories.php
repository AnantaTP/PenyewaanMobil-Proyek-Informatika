<?php include 'header.php';

// Mengambil data dari tabel products untuk tipe mobil MPV
$fetch_data = "SELECT * FROM products WHERE type = 1";
$result = $conn->query($fetch_data);

// Array simulasi status (tidak disimpan di database)
$status_simulasi = [];

// Menangani perubahan status melalui form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plat_nomor'], $_POST['status'])) {
    $plat_nomor = $_POST['plat_nomor'];
    $status = $_POST['status'];

    // Simpan status ke dalam array simulasi
    $status_simulasi[$plat_nomor] = $status;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tables</h1>
  <a href='manage_accessories.php' class='btn btn-success' style="float: right;">Tambah <span class='fa fa-plus'></span></a>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Daftar Mobil MPV</h6>
    </div>
    <div class="card-body">
      <?php if (isset($message)) { ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
      <?php } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Plat Nomor</th>
              <th>Nama</th>
              <th>Gambar</th>
              <th>Deskripsi</th>
              <th>Harga</th>
              <th>Status</th> <!-- Kolom untuk dropdown status -->
              <th>Edit</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              // Output setiap baris data
              while ($row = $result->fetch_assoc()) {
                // Tentukan status default (jika belum ada dalam simulasi)
                $current_status = isset($status_simulasi[$row['plat_nomor']]) ? $status_simulasi[$row['plat_nomor']] : 'Available';
                ?>
                <tr>
                  <td><?php echo $row['plat_nomor']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><img src="<?php echo $row['image']; ?>" style="width:100px; height:100px;" class="img-circle"></td>
                  <td><?php echo $row['product_details']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <!-- Dropdown untuk Status -->
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="plat_nomor" value="<?php echo $row['plat_nomor']; ?>">
                      <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="Available" <?php echo $current_status == 'Available' ? 'selected' : ''; ?>>Available</option>
                        <option value="Not Available" <?php echo $current_status == 'Not Available' ? 'selected' : ''; ?>>Not Available</option>
                      </select>
                    </form>
                  </td>
                  <td><a class='btn btn-success'
                      href="manage_accessories.php?editid=<?php echo $row['plat_nomor']; ?>"><span class="fa fa-pen"></span></a></td>
                  <td><a class='btn btn-danger'
                      href="manage_accessories.php?deleteid=<?php echo $row['plat_nomor']; ?>"><span class="fa fa-trash"></span></a></td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='8'>No results found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

