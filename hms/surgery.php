<?php
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

// Fetch patient details
$query = $con->prepare("SELECT id, fullName FROM users WHERE id = ?");
if (!$query) {
    error_log("Error preparing statement: " . $con->error);
    echo "Database error: " . $con->error;
    exit();
}
$query->bind_param('i', $patientId);
$query->execute();
$patientResult = $query->get_result();

if (!$patientResult || $patientResult->num_rows == 0) {
    echo "Patient not found.";
    exit();
}
$patient = $patientResult->fetch_assoc();
$patientName = $patient['fullName'];
$query->close();

// Fetch surgeries (both past and upcoming)
$query = $con->prepare("SELECT s.*, d.doctorName
                         FROM surgery s
                         JOIN doctors d ON s.doctorId = d.id
                         WHERE s.patientId = ?
                         ORDER BY s.surgery_date DESC"); // Order by date, newest first

if (!$query) {
    error_log("Error preparing statement: " . $con->error);
    echo "Database error: " . $con->error;
    exit();
}

$query->bind_param('i', $patientId);
$query->execute();
$surgeries = $query->get_result();

if (!$surgeries) {
    error_log("Error executing query: " . $con->error);
    echo "Database error: " . $con->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Surgeries</title>
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
                                <h1 class="mainTitle">Patient Surgeries</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li><span>Surgeries</span></li>
                                <li class="active"><span>All Surgeries</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Surgeries for <?php echo htmlspecialchars($patientName); ?></h2>

                                <?php if ($surgeries->num_rows > 0) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Surgery Type</th>
                                                    <th>Surgeon</th>
                                                    <th>Date</th>
                                                    <th>Surgery Notes</th>
                                                    <th>Recovery Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($surgery = $surgeries->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($surgery['surgery_type']); ?></td>
                                                        <td><?php echo htmlspecialchars($surgery['doctorName']); ?></td>
                                                        <td><?php echo htmlspecialchars($surgery['surgery_date']); ?></td>
                                                        <td><?php echo htmlspecialchars($surgery['surgery_notes']); ?></td>
                                                        <td><?php echo htmlspecialchars($surgery['recovery_status']); ?></td>
                                                    </tr>
                                                <?php }
                                                $query->close(); // Close the surgery query
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <p>No surgeries found for <?php echo htmlspecialchars($patientName); ?>.</p>
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
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>