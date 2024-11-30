<?php
include 'header.php';

// Mengambil data dari tabel products dengan filter type = 0 (LCGC)
$fetch_data = "SELECT plat_nomor, product_name, image, product_details, product_price FROM products WHERE type = 0";
$result = $conn->query($fetch_data);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tables</h1>

  <a href='add_pet.php' class='btn btn-primary' style="float: right;">Tambah <span class='fa fa-plus'></span></a>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Mobil LCGC</h6>
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
              <th>Edit</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              // Output setiap baris data
              while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row['plat_nomor']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><img src="<?php echo $row['image']; ?>" style="width:100px; height:100px;" class="img-circle"></td>
                  <td><?php echo $row['product_details']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td><a class='btn btn-primary' href="add_pet.php?editid=<?php echo $row['plat_nomor']; ?>"><span
                        class="fa fa-pen"></span></a></td>
                  <td><a class='btn btn-danger' href="add_pet.php?deleteid=<?php echo $row['plat_nomor']; ?>"><span
                        class="fa fa-trash"></span></a></td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='7'>Tidak ada data ditemukan.</td></tr>";
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

<!-- Footer -->

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
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
      <div class="modal-body">Pilih "Logout" di bawah jika Anda ingin mengakhiri sesi ini.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="login.php">Logout</a>
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