<?php include 'header.php';

// Update query untuk join tabel rating dan user_details
$fetch_data = "SELECT r.id_rating, r.rating_value, r.tanggal_rating, r.review, 
                      CONCAT(u.first_name, ' ', u.last_name) AS user_name 
               FROM rating r 
               JOIN user_details u ON r.id_user = u.id";
$result = $conn->query($fetch_data);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style='display: inline-block;'>Tabel Rating</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Rating Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id_rating</th>
                            <th>Nama Pengguna</th>
                            <th>Rating</th>
                            <th>Tanggal Rating</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $rating_value = $row['rating_value']; // Mendapatkan rating_value
                                ?>
                                <tr>
                                    <td><?php echo $row['id_rating'] ?></td>
                                    <td><?php echo $row['user_name'] ?></td> <!-- Menampilkan Nama Pengguna -->
                                    <td>
                                        <!-- Menampilkan bintang berdasarkan rating_value -->
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating_value) {
                                                echo '<i class="fas fa-star filled-star"></i>'; // Bintang penuh
                                            } else {
                                                echo '<i class="far fa-star empty-star"></i>'; // Bintang kosong
                                            }
                                        }
                                        ?>
                                        (<?php echo $rating_value; ?>/5)
                                    </td>
                                    <td><?php echo $row['tanggal_rating'] ?></td>
                                    <td><?php echo $row['review'] ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada rating</td></tr>";
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

<style>
    .filled-star {
        color: gold;
        /* Warna bintang terisi */
    }

    .empty-star {
        color: lightgray;
        /* Warna bintang kosong */
    }
</style>