<?php
include 'header.php';
if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];
}

$fetch_orders = "SELECT p.plat_nomor, p.product_name, p.product_details, p.product_price, p.image, 
                         o.id AS orderid, o.plat_nomor AS order_plat_nomor, o.user_id, o.address, 
                         o.date, o.tanggal_kembali, o.lama_sewa, o.total_bayar, o.status, 
                         concat(ifnull(ud.first_name, ''),' ',ifnull(ud.last_name, '')) AS user_name 
                  FROM products p 
                  INNER JOIN orders o ON o.plat_nomor = p.plat_nomor 
                  INNER JOIN user_details ud ON o.user_id = ud.id
                  WHERE o.status IS NOT NULL";

$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT sum(p.product_price) AS total FROM products p INNER JOIN orders o ON o.plat_nomor = p.plat_nomor";
$total_amount = $conn->query($total_amount_query);
$total = 50;

while ($row = $total_amount->fetch_assoc()) {
  $total = $row['total'];
}

if (isset($_POST['statusvalue']) && isset($_POST['orderid'])) {
  $statusvalue = $_POST['statusvalue'];
  $orderid = $_POST['orderid'];
  $updatestatus = ($statusvalue != NULL ? "UPDATE orders SET status = '$statusvalue' WHERE id = '$orderid'" : "UPDATE orders SET status = NULL WHERE id = '$orderid'");
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
      // alert(data);
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

  <a href='add_pet.php' class='btn btn-primary' style="float: right;">Tambah<span class='fa fa-plus'></span></a>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id Sewa</th>
              <th>Nama</th>
              <th>Gambar</th>
              <th>Lama Sewa</th>
              <th>Harga</th>
              <th>Nama Customer</th>
              <th>Alamat</th>
              <th>Plat Nomor</th> <!-- New column for Plat Nomor -->
              <th>Status</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($orders->num_rows > 0) {
              // output data of each row
              while ($row = $orders->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row['orderid'] ?></td>
                  <td><?php echo $row['product_name'] ?></td>
                  <td><img src="<?php echo $row['image'] ?>" style="width:100px; height:100px;" class="img-circle"></td>
                  <td><?php echo $row['lama_sewa'] ?> hari</td>
                  <td><?php echo $row['total_bayar'] ?></td>
                  <td><?php echo $row['user_name'] ?></td>
                  <td><?php echo $row['address'] ?></td>
                  <td><?php echo $row['order_plat_nomor'] ?></td> <!-- Display Plat Nomor from Orders -->
                  <td><?php
                  $status = $row['status'];
                  if ($status == NULL) {
                    echo "In Cart";
                    ?>
                      <form method="post">
                        <select name="order_status_<?php echo $row['orderid']; ?>"
                          id="order_status_<?php echo $row['orderid']; ?>"
                          onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                        </select>
                      </form>
                      <?php
                  } elseif ($status == 0) {
                    echo "Sudah Bayar";
                    ?>
                      <form method="post">
                        <select name="order_status_<?php echo $row['orderid']; ?>"
                          id="order_status_<?php echo $row['orderid']; ?>"
                          onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                        </select>
                      </form>
                      <?php
                  } elseif ($status == 1) {
                    echo "Mobil Diambil";
                    ?>
                      <form method="post">
                        <select name="order_status_<?php echo $row['orderid']; ?>"
                          id="order_status_<?php echo $row['orderid']; ?>"
                          onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                        </select>
                      </form>
                      <?php
                  } elseif ($status == 2) {
                    echo "Mobil Dikembalikan";
                    ?>
                      <form method="post">
                        <select name="order_status_<?php echo $row['orderid']; ?>"
                          id="order_status_<?php echo $row['orderid']; ?>"
                          onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                        </select>
                      </form>
                      <?php
                  } elseif ($status == 3) {
                    echo "Dibatalkan";
                    ?>
                      <form method="post">
                        <select name="order_status_<?php echo $row['orderid']; ?>"
                          id="order_status_<?php echo $row['orderid']; ?>"
                          onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                        </select>
                      </form>
                      <?php
                  } elseif ($status == 4) {
                    echo "Selesai";
                    ?>
                      <form method="post">
                        <select name="order_status_<?php echo $row['orderid']; ?>"
                          id="order_status_<?php echo $row['orderid']; ?>"
                          onchange="updatestatus(this, '<?php echo $row['orderid']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                        </select>
                      </form>
                      <?php
                  }
                  ?>
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