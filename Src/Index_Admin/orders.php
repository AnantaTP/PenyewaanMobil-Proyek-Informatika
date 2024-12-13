<?php
include 'header.php';
if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];
}

$fetch_orders = "SELECT p.plat_nomor, p.product_name, p.product_details, p.product_price, p.image, 
                         o.id AS orderid, o.plat_nomor AS order_plat_nomor, o.user_id, o.address, 
                         o.date, o.tanggal_kembali, o.lama_sewa, o.total_bayar, o.foto_ktp, o.status, 
                         concat(ifnull(ud.first_name, ''),' ',ifnull(ud.last_name, '')) AS user_name 
                  FROM products p 
                  INNER JOIN orders o ON o.plat_nomor = p.plat_nomor 
                  INNER JOIN user_details ud ON o.user_id = ud.id
                  WHERE o.status IS NOT NULL";

$orders = $conn->query($fetch_orders);

// Update status based on admin selection
if (isset($_POST['statusvalue']) && isset($_POST['orderid'])) {
  $statusvalue = $_POST['statusvalue'];
  $orderid = $_POST['orderid'];
  $updatestatus = "UPDATE orders SET status = '$statusvalue' WHERE id = '$orderid'";
  $result = $conn->query($updatestatus);
  if ($result === TRUE) {
    echo 1;
  } else {
    echo 0;
  }
  exit;
}

if (isset($_REQUEST['orderdelete'])) {
  $orderid = $_REQUEST['orderdelete'];
  $deleteorder = "DELETE FROM orders WHERE id = '$orderid'";
  $result = $conn->query($deleteorder);
  if ($result === TRUE) {
    ?>
    <script>
      window.location = "orders.php";
    </script>
    <?php
  } else {
    echo "Something went wrong!";
  }
}
?>

<!-- Begin Page Content -->
<script>
  function updatestatus(ref_obj, orderid) {
    statusvalue = ref_obj.value;
    $.post("", { statusvalue: statusvalue, orderid: orderid }, function (data, status) {
      if (data == 0) {
        alert("Some issue occurred!");
      } else {
        location.reload();
      }
    });
  }
</script>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tables</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Pesanan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id Sewa</th>
              <th>Nama Customer</th>
              <th>Mobil yang Disewa</th>
              <th>Plat Nomor</th>
              <th>Alamat</th>
              <th>Lama Sewa</th>
              <th>Total Bayar</th>
              <th>Foto KTP</th>
              <th>Status</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($orders->num_rows > 0) {
              while ($row = $orders->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row['orderid'] ?></td>
                  <td><?php echo $row['user_name'] ?></td>
                  <td><?php echo $row['product_name'] ?></td>
                  <td><?php echo $row['plat_nomor'] ?></td>
                  <td><?php echo $row['address'] ?></td>
                  <td><?php echo $row['lama_sewa'] ?> hari</td>
                  <td><?php echo number_format($row['total_bayar'], 2) ?></td>
                  <td><img src="<?php echo $row['foto_ktp'] ?>" style="width:100px; height:100px;" class="img-thumbnail">
                  </td>
                  <td>
                    <?php
                    $status = $row['status'];
                    switch ($status) {
                      case 0:
                        echo "Belum Bayar";
                        break;
                      case 1:
                        echo "Sudah Bayar";
                        break;
                      case 2:
                        echo "Mobil Diambil";
                        break;
                      case 3:
                        echo "Mobil Dikembalikan";
                        break;
                      case 4:
                        echo "Dibatalkan";
                        break;
                      case 5:
                        echo "Selesai";
                        break;
                    }
                    ?>
                    <form method="post">
                      <select name="statusvalue" onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')"
                        class="form-control">
                        <option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Belum Bayar</option>
                        <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Sudah Bayar</option>
                        <option value="2" <?php echo ($status == 2) ? 'selected' : ''; ?>>Mobil Diambil</option>
                        <option value="3" <?php echo ($status == 3) ? 'selected' : ''; ?>>Mobil Dikembalikan</option>
                        <option value="4" <?php echo ($status == 4) ? 'selected' : ''; ?>>Dibatalkan</option>
                        <option value="5" <?php echo ($status == 5) ? 'selected' : ''; ?>>Selesai</option>
                      </select>
                    </form>
                  </td>
                  <td>
                    <a href="orders.php?orderdelete=<?php echo $row['orderid']; ?>" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
                <?php
              }
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