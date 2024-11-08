<?php include 'header.php'; 
if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
}
$fetch_orders = "SELECT p.*,o.*, o.id as orderid, 
concat(ifnull(ud.first_name, ''),' ',ifnull(ud.last_name, '')) as user_name 
FROM products p 
inner join orders o on o.product_id = p.id 
inner join user_details ud on o.user_id = ud.id
where o.status IS NOT NULL";
$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT sum(p.product_price) as total FROM products p inner join orders o on o.product_id = p.id";
$total_amount = $conn->query($total_amount_query);
$total = 50;
while($row = $total_amount->fetch_assoc()){
    $total = $row['total'];
}
if(isset($_POST['statusvalue']) && isset($_POST['orderid'])){
  $statusvalue = $_POST['statusvalue'];
  $orderid = $_POST['orderid'];
  $updatestatus = ($statusvalue != NULL ? "update orders set status = '$statusvalue' where id = '$orderid'":"update orders set status = NULL where id = '$orderid'");
  $result = $conn->query($updatestatus);
  if($result === TRUE){
    echo 1;
  }else{
    echo 0;
  }
  exit;
}

if(isset($_REQUEST['orderdelete'])){
  $orderid = $_REQUEST['orderdelete'];
  $deleteorder = "delete from orders where id = '$orderid'";
  $result = $conn->query($deleteorder);
  if($result === TRUE){
    ?>
    <script>
      window.location = "orders.php";
      </script>
    <?php
  }else{
    echo "Something went wrong !";
  }
}
?>

        <!-- Begin Page Content -->
        <script>
          function updatestatus(ref_obj, orderid){
            statusvalue = ref_obj.value;
            $.post("", {statusvalue:statusvalue, orderid:orderid}, function(data, status){
              // alert(data);
              if(data == 0){
                alert("Some issue occurred !");
              }else{
                location.reload();
              }
            });
          }
        </script>
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tables</h1>
          <!-- <p class="mb-4" style='display: inline-block;'>DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
          
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
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Gambar</th>
                      <th>Tipe</th>
                      <th>Harga</th>
                      <th>User</th>
                      <th>Pengguna</th>
                      <th>Status</th>
                      <th>Hapus</th>
                    </tr>
                  </thead><tbody>
                  <?php
                  if ($orders->num_rows > 0) {
                    // output data of each row
                    while($row = $orders->fetch_assoc()) {
                      ?>
                      <tr>
                      <td><?php echo $row['id'] ?></td>
                      <td><?php echo $row['product_name'] ?></td>
                      <td><img src="<?php echo $row['image'] ?>" style="width:100px; height:100px;" class="img-circle"></td>
                      <td><?php echo ($row['type'] == 0?"Pet":"Accessory");  ?></td>
                      <td><?php echo $row['product_price'] ?></td>
                      <td><?php echo $row['user_name'] ?></td>
                      <td><?php echo $row['address'] ?></td>
                      <td><?php
                      $status = $row['status']; 
                      if($status == NULL){
                        echo "In Cart";
                        ?>
                        <form method="post">
                          <select name="order_status_<?php echo $row['id']; ?>" id="order_status_<?php echo $row['id']; ?>" onchange="updatestatus(this, '<?php echo $row['id']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                          </select>
                        </form>
                        <?php
                      }elseif($status == 0){
                        echo "Sudah Bayar";
                        ?>
                        <form method="post">
                          <select name="order_status_<?php echo $row['id']; ?>" id="order_status_<?php echo $row['id']; ?>" onchange="updatestatus(this, '<?php echo $row['id']; ?>')" class="form-control">
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
                      elseif($status == 1){
                        echo "Mobil Diambil";
                        ?>
                        <form method="post">
                          <select name="order_status_<?php echo $row['id']; ?>" id="order_status_<?php echo $row['id']; ?>" onchange="updatestatus(this, '<?php echo $row['id']; ?>')" class="form-control">
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
                      elseif($status == 2){
                        echo "Mobil Dikembalikan";
                        ?>
                        <form method="post">
                          <select name="order_status_<?php echo $row['id']; ?>" id="order_status_<?php echo $row['id']; ?>" onchange="updatestatus(this, '<?php echo $row['id']; ?>')" class="form-control">
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
                      elseif($status == 3){
                        echo "Dibatalkan";
                        ?>
                        <form method="post">
                          <select name="order_status_<?php echo $row['id']; ?>" id="order_status_<?php echo $row['id']; ?>" onchange="updatestatus(this, '<?php echo $row['id']; ?>')" class="form-control">
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
                      elseif($status == 4){
                        echo "Selesai";
                        ?>
                        <form method="post">
                          <select name="order_status_<?php echo $row['id']; ?>" id="order_status_<?php echo $row['id']; ?>" onchange="updatestatus(this, '<?php echo $row['id']; ?>')" class="form-control">
                          <option>select</option>
                          <option value="0">Sudah Bayar</option>
                          <option value="1">Mobil Diambil</option>
                          <option value="2">Mobil Dikembalikan</option>
                          <option value="3">Dibatalkan</option>
                          <option value="4">Selesai</option>
                          </select>
                        </form>
                        <?php
                      } ?></td>
                      <td><a class='btn btn-danger' href="orders.php?orderdelete=<?php echo $row['id']; ?>"><span class="fa fa-trash"></span></a></td>
                    </tr>
                      <?php
                    }
                } else {
                    echo "0 results";
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
