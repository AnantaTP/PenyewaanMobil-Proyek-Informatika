<?php include 'header.php';
$fetch_data = "SELECT * FROM products WHERE type = 1";
$result = $conn->query($fetch_data);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tables</h1>
  <a href='manage_accessories.php' class='btn btn-success' style="float: right;">Tambah <span
      class='fa fa-plus'></span></a>

  <!-- DataTales Example -->
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
              <th>Nama</th>
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
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row['plat_nomor']; ?></td> <!-- Kolom Plat Nomor -->
                  <td><?php echo $row['product_name']; ?></td>
                  <td><img src="<?php echo $row['image']; ?>" style="width:100px; height:100px;" class="img-circle"></td>
                  <td><?php echo $row['product_details']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td><a class='btn btn-success'
                      href="manage_accessories.php?editid=<?php echo $row['plat_nomor']; ?>"><span
                        class="fa fa-pen"></span></a></td>
                  <td><a class='btn btn-danger'
                      href="manage_accessories.php?deleteid=<?php echo $row['plat_nomor']; ?>"><span
                        class="fa fa-trash"></span></a></td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='7'>No results found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->