<?php
// payment.php
session_start();
include('include/config.php');

// Enable error reporting during development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Validate session
if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
    header('location:logout.php');
    exit();
}

$patientId = $_SESSION['id'];

// Function to fetch patient details
function getPatientDetails($con, $patientId) {
    $query = $con->prepare("SELECT id, fullName FROM users WHERE id = ?");
    if (!$query) {
        error_log("Error preparing statement: " . $con->error);
        return false; // Indicate failure
    }
    $query->bind_param('i', $patientId);
    $query->execute();
    $patientResult = $query->get_result();

    if (!$patientResult || $patientResult->num_rows == 0) {
        return false; // Indicate failure
    }
    $patient = $patientResult->fetch_assoc();
    $query->close();
    return $patient;
}

$patientDetails = getPatientDetails($con, $patientId);
if (!$patientDetails) {
    echo "Patient not found or database error.";
    exit();
}
$patientName = $patientDetails['fullName'];

// Fetch billing information for the patient to make payment
if (isset($_GET['bill_id']) && is_numeric($_GET['bill_id'])) {
    $billId = $_GET['bill_id'];

    $query = $con->prepare("SELECT * FROM billing WHERE id = ?");
    if (!$query) {
        error_log("Error preparing statement: " . $con->error);
        echo "Database error: " . $con->error;
        exit();
    }
    $query->bind_param('i', $billId);
    $query->execute();
    $billingResult = $query->get_result();

    if (!$billingResult || $billingResult->num_rows == 0) {
        echo "Bill not found.";
        exit();
    }
    $bill = $billingResult->fetch_assoc();
    $query->close();
} else {
    echo "Invalid bill ID.";
    exit();
}

// Handle payment submission
if (isset($_POST['submit'])) {
    // Validate the payment amount.
    $paymentAmount = $_POST['payment_amount'];
    if (!is_numeric($paymentAmount) || $paymentAmount <= 0) {
        $error = "Invalid payment amount.";
    } else if ($paymentAmount > ($bill['total_amount'] - $bill['paid_amount'])) {
        $error = "Payment amount exceeds the outstanding balance.";
    } else {
        // Update the billing table with the payment information
        $newPaidAmount = $bill['paid_amount'] + $paymentAmount;
        $paymentStatus = ($newPaidAmount >= $bill['total_amount']) ? 'Paid' : 'Partial';

        $query = $con->prepare("UPDATE billing SET paid_amount = ?, payment_status = ? WHERE id = ?");
        if (!$query) {
            error_log("Error preparing statement: " . $con->error);
            echo "Database error: " . $con->error;
            exit();
        }
        $query->bind_param('dsi', $newPaidAmount, $paymentStatus, $billId);
        $query->execute();

        if ($query->affected_rows > 0) {
            $msg = "Payment of $" . htmlspecialchars($paymentAmount) . " successfully recorded.";
            // Redirect to billing.php to show updated information
            header("Location: billing.php");
            exit;
        } else {
            $error = "Failed to update payment information.";
        }
        $query->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Make Payment</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="vendor/switchery/switchery.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Make Payment</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li><span>Billing</span></li>
                                <li class="active"><span>Make Payment</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Payment for Bill ID: <?php echo htmlspecialchars($bill['id']); ?></h2>
                                <?php if (isset($msg)) {
                                    echo '<div class="alert alert-success">' . htmlspecialchars($msg) . '</div>';
                                }
                                if (isset($error)) {
                                    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
                                }
                                ?>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="total_amount">Total Amount:</label>
                                        <input type="text" class="form-control" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($bill['total_amount']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paid_amount">Paid Amount:</label>
                                        <input type="text" class="form-control" id="paid_amount" name="paid_amount" value="<?php echo htmlspecialchars($bill['paid_amount']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="outstanding_balance">Outstanding Balance:</label>
                                        <input type="text" class="form-control" id="outstanding_balance" name="outstanding_balance" value="<?php echo htmlspecialchars($bill['total_amount'] - $bill['paid_amount']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_amount">Payment Amount:</label>
                                        <input type="text" class="form-control" id="payment_amount" name="payment_amount" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit Payment</button>
                                    <a href="billing.php" class="btn btn-default">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?><?php include('include/setting.php'); ?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>
