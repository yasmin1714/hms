<?php
// prescription.php
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

// Function to fetch prescription details with medicine names, dosage, quantity, and notes
function getPrescriptionDetails($con, $patientId) {
    $query = $con->prepare("SELECT id, medicine_name, dosage, quantity, notes, prescription_date 
                            FROM prescription 
                            WHERE patientId = ? 
                            ORDER BY prescription_date DESC");
    if (!$query) {
        error_log("Error preparing statement: " . $con->error);
        return false;
    }
    $query->bind_param('i', $patientId);
    $query->execute();
    $prescriptionResult = $query->get_result();

    if (!$prescriptionResult) {
        return false;
    }
    $prescriptions = $prescriptionResult->fetch_all(MYSQLI_ASSOC);
    $query->close();
    return $prescriptions;
}

$patientDetails = getPatientDetails($con, $patientId);
if (!$patientDetails) {
    echo "Patient not found or database error.";
    exit();
}
$patientName = $patientDetails['fullName'];

$prescriptions = getPrescriptionDetails($con, $patientId);
if (!$prescriptions) {
    $prescriptions = array(); // Ensure $prescriptions is always an array
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Prescription</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="vendor/switchery/switchery.min.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <style>
        .prescription-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .prescription-date {
            font-size: 0.9em;
            color: #888;
            margin-top: 5px;
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
                                <h1 class="mainTitle">Patient Prescription</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li class="active"><span>Prescription</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Prescription for <?php echo htmlspecialchars($patientName); ?></h2>
                                <?php if (empty($prescriptions)) { ?>
                                    <p>No prescriptions found.</p>
                                <?php } else { ?>
                                    <?php foreach ($prescriptions as $prescription) { ?>
                                        <div class="prescription-item">
                                            <p>Medicine: <?php echo htmlspecialchars($prescription['medicine_name']); ?></p>
                                            <p>Dosage: <?php echo htmlspecialchars($prescription['dosage']); ?></p>
                                            <p>Quantity: <?php echo htmlspecialchars($prescription['quantity']); ?></p>
                                            <p>Notes: <?php echo htmlspecialchars($prescription['notes']); ?></p>
                                            <p class="prescription-date">Date: <?php echo date('F j, Y, g:i a', strtotime($prescription['prescription_date'])); ?></p>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Similar Links</h3>
                                <a href="dashboard.php" class="btn btn-primary">Dashboard</a><br>
                                <a href="appointment-history.php" class="btn btn-primary">Appointment History</a><br>
                                <a href="view-medhistory.php" class="btn btn-primary">Medical History</a>
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
    <script src="assets/js/form-elements.js"></script><script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>
