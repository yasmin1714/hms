<?php
// patient_lab_reports.php
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

// Function to fetch lab reports for the patient
function getLabReports($con, $patientId) {
    // Use the table structure provided by the user
    $query = $con->prepare("SELECT id, patient_id, report_type, result, report_date, created_by_lab, created_by_admin, updated_by_admin FROM lab_reports WHERE patient_id = ?");
    if (!$query) {
        error_log("Error preparing statement: " . $con->error);
        return false;
    }
    $query->bind_param('i', $patientId);
    $query->execute();
    $result = $query->get_result();

    if (!$result) {
        return false;
    }
    $labReports = $result->fetch_all(MYSQLI_ASSOC);
    $query->close();
    return $labReports;
}

$patientDetails = getPatientDetails($con, $patientId);
if (!$patientDetails) {
        echo "Patient not found or database error.";
        exit();
}
$patientName = $patientDetails['fullName'];

$labReports = getLabReports($con, $patientId);
if (!$labReports) {
    $labReports = array(); // Ensure $labReports is always an array
}

// Function to generate and download PNG image
function generatePNG($reportData, $reportName) {
    // Check if the GD extension is loaded
    if (!extension_loaded('gd')) {
        die('GD extension is not loaded.  Please enable it in your PHP configuration.');
    }

    // Create a blank image (you'll need to adapt this to your report data)
    $width = 400;  // Example width
    $height = 300; // Example height
    $image = imagecreatetruecolor($width, $height);
    $bgColor = imagecolorallocate($image, 255, 255, 255); // White background
    imagefill($image, 0, 0, $bgColor);

    // Add report data to the image (this is a simplified example)
    $textColor = imagecolorallocate($image, 0, 0, 0); // Black text

    // Use image string instead of image ttf text
    imagestring($image, 3, 10, 20, "Report: " . $reportName, $textColor);
    imagestring($image, 3, 10, 40, "Data: " . $reportData, $textColor);  // simplified data

    // Output the image as a PNG for download
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="' . $reportName . '.png"'); // Force download
    imagepng($image);
    imagedestroy($image);
    exit;
}

// Handle download request
if (isset($_GET['report_id'])) {
    $reportIdToDownload = $_GET['report_id'];
    // Fetch the report data and name.
    $reportToDownload = null;
    foreach ($labReports as $report) {
        if ($report['id'] == $reportIdToDownload) {
            $reportToDownload = $report;
            break;
        }
    }

    if ($reportToDownload) {
        $reportData = $reportToDownload['result'];
        $reportName = $reportToDownload['report_type'];
        generatePNG($reportData, $reportName);
    } else {
        echo "Report not found.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Lab Reports</title>
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
        .report-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space items evenly */
            align-items: center; /* Vertically center items */
        }
        .report-date {
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
                                <h1 class="mainTitle">Patient Lab Reports</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li><span>Lab Reports</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Lab Reports for <?php echo htmlspecialchars($patientName); ?></h2>
                                <?php if (empty($labReports)) { ?>
                                    <p>No lab reports found.</p>
                                <?php } else { ?>
                                    <?php foreach ($labReports as $report) { ?>
                                        <div class="report-item">
                                            <div>
                                                <p><span style="font-weight:bold;"><?php echo htmlspecialchars($report['report_type']); ?></span></p>
                                                <p class="report-date">Date: <?php echo date('F j, Y', strtotime($report['report_date'])); ?></p>
                                            </div>
                                            <a href="?report_id=<?php echo $report['id']; ?>" class="btn btn-primary">Download Report</a>
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
