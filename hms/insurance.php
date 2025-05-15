<?php
// patient_insurance.php
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
        return false;
    }
    $query->bind_param('i', $patientId);
    $query->execute();
    $patientResult = $query->get_result();

    if (!$patientResult || $patientResult->num_rows == 0) {
        return false;
    }
    $patient = $patientResult->fetch_assoc();
    $query->close();
    return $patient;
}

// Function to fetch patient insurance details
function getPatientInsuranceDetails($con, $patientId) {
    $query = $con->prepare("SELECT * FROM Insurance WHERE userId = ?");
    if (!$query) {
        error_log("Error preparing statement: " . $con->error);
        return false;
    }
    $query->bind_param('i', $patientId);
    $query->execute();
    $insuranceResult = $query->get_result();

    if (!$insuranceResult) {
        return false;
    }
    $insuranceDetails = $insuranceResult->fetch_assoc();
    $query->close();
    return $insuranceDetails;
}

$patientDetails = getPatientDetails($con, $patientId);
if (!$patientDetails) {
    echo "Patient not found or database error.";
    exit();
}
$patientName = $patientDetails['fullName'];

$insuranceDetails = getPatientInsuranceDetails($con, $patientId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Insurance Details</title>
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
        .detail-label {
            font-weight: bold;
            margin-right: 5px;
        }
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
                                <h1 class="mainTitle">Patient Insurance Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li class="active"><span>Insurance Details</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Insurance Details for <?php echo htmlspecialchars($patientName); ?></h2>
                                <?php if ($insuranceDetails) { ?>
                                    <div class="panel panel-white">
                                        <div class="panel-body">
                                            <p><span class="detail-label">Provider Name:</span><?php echo htmlspecialchars($insuranceDetails['provider_name']); ?></p>
                                            <p><span class="detail-label">Policy Number:</span><?php echo htmlspecialchars($insuranceDetails['policy_number']); ?></p>
                                            <p><span class="detail-label">Coverage Details:</span><?php echo htmlspecialchars($insuranceDetails['coverage_details']); ?></p>
                                            <p><span class="detail-label">Valid Till:</span><?php echo htmlspecialchars($insuranceDetails['valid_till']); ?></p>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        No insurance details found.  <a href="add-insurance.php" class="btn btn-primary">Add Insurance Details</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
<?php include('include/setting.php'); ?>
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
    <script src="assets/js/form-elements.js"></script><script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>
