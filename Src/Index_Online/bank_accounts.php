<?php include 'header.php'; ?>

<?php
// Memastikan pengguna telah login
session_start();
if (!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL) {
    ?>
    <script>
        window.location = "shop.php";
    </script>
    <?php
    exit;
}

$bank = isset($_GET['bank']) ? $_GET['bank'] : '';

switch ($bank) {
    case 'bri':
        $bank_name = 'Bank BRI';
        $account_number = '123-456-7890';
        break;
    case 'bca':
        $bank_name = 'Bank BCA';
        $account_number = '987-654-3210';
        break;
    case 'mandiri':
        $bank_name = 'Bank Mandiri';
        $account_number = '456-789-0123';
        break;
    default:
        $bank_name = 'Tidak Diketahui';
        $account_number = 'N/A';
        break;
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3>Nomor Rekening untuk Pembayaran Melalui Transfer Bank</h3>
            <p>Silakan transfer ke nomor rekening berikut untuk pembayaran melalui <?php echo $bank_name; ?>:</p>
            <p><strong>Nomor Rekening: <?php echo $account_number; ?></strong></p>
            <p>Harap konfirmasi pembayaran setelah transfer selesai.</p>
            <a href="orders.php" class="btn btn-primary">Kembali ke Orders</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>