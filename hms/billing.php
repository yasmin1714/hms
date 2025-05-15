<?php
//billing.php
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

// Fetch billing information for the patient
$query = $con->prepare("SELECT b.*,
                         a.appointmentDate, a.appointmentTime,
                         s.surgery_type, s.surgery_date
                         FROM billing b
                         LEFT JOIN appointment a ON b.appointmentId = a.id
                         LEFT JOIN surgery s ON b.surgeryId = s.id
                         LEFT JOIN users u ON a.userId = u.id OR s.patientId = u.id
                         WHERE u.id = ?
                         ORDER BY b.billing_date DESC");

if (!$query) {
        error_log("Error preparing statement: " . $con->error);
        echo "Database error: " . $con->error;
        exit();
}

$query->bind_param('i', $patientId);
$query->execute();
$billingResult = $query->get_result();

if (!$billingResult) {
    error_log("Error executing query: " . $con->error);
    echo "Database error: " . $con->error;
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Billing</title>
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
                                <h1 class="mainTitle">Billing Information</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li><span>Billing</span></li>
                                <li class="active"><span>My Bills</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Billing Details for <?php echo htmlspecialchars($patientName); ?></h2>
                                <?php if ($billingResult->num_rows > 0) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Bill ID</th>
                                                    <th>Appointment Date</th>
                                                    <th>Appointment Time</th>
                                                    <th>Surgery Type</th>
                                                    <th>Surgery Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th>Billing Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($bill = $billingResult->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($bill['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['appointmentDate']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['appointmentTime']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['surgery_type']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['surgery_date']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['total_amount']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['paid_amount']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['payment_status']); ?></td>
                                                        <td><?php echo htmlspecialchars($bill['billing_date']); ?></td>
                                                        <td>
                                                            <?php if ($bill['payment_status'] != 'Paid') { ?>
                                                                <a href="payment.php?bill_id=<?php echo htmlspecialchars($bill['id']); ?>" class="btn btn-primary btn-sm">Pay Now</a>
                                                            <?php } else { ?>
                                                                Paid
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                $query->close();
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <p>No billing information found for <?php echo htmlspecialchars($patientName); ?>.</p>
                                <?php } ?>
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