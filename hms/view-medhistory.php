<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// Logout handling
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient | View Medical History</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
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
                            <h1 class="mainTitle">Patient | View Medical History</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Patient</span></li>
                            <li class="active"><span>View Medical History</span></li>
                        </ol>
                    </div>
                </section>

                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="over-title margin-bottom-15">View <span class="text-bold">Medical History</span></h5>

                            <?php
                            $patientid = $_SESSION['id'];

                            // Fetch patient details
                            $query = "SELECT PatientName, PatientContno, PatientGender, PatientAge FROM tblpatient WHERE ID='$patientid'";
                            $result = mysqli_query($con, $query) or die("Patient Query Error: " . mysqli_error($con));

                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <table border="1" class="table table-bordered">
                                    <tr align="center">
                                        <td colspan="4" style="font-size:20px;color:blue">Patient Details</td>
                                    </tr>
                                    <tr>
                                        <th>Patient Name</th>
                                        <td><?php echo $row['PatientName']; ?></td>
                                        <th>Patient Contact No</th>
                                        <td><?php echo $row['PatientContno']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Patient Gender</th>
                                        <td><?php echo $row['PatientGender']; ?></td>
                                        <th>Patient Age</th>
                                        <td><?php echo $row['PatientAge']; ?></td>
                                    </tr>
                                </table>
                                <p>&nbsp;</p>
                            <?php } else {
                                echo "<p class='text-danger'>No patient details found.</p>";
                            } ?>

                            <?php
                            // Fetch medical history
                            $historyQuery = "SELECT id, userId, bloodPressure, bloodSugar, weight, temperature, medicalPres, creationDate FROM tblmedicalhistory WHERE userId='$patientid'";
                            $historyResult = mysqli_query($con, $historyQuery) or die("Medical History Query Error: " . mysqli_error($con));

                            if (mysqli_num_rows($historyResult) > 0) {
                                ?>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%;">
                                    <tr align="center">
                                        <th colspan="7">Medical History</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Blood Pressure</th>
                                        <th>Blood Sugar</th>
                                        <th>Weight</th>
                                        <th>Temperature</th>
                                        <th>Medical Prescription</th>
                                        <th>Visit Date</th>
                                    </tr>
                                    <?php
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_assoc($historyResult)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['bloodPressure']; ?></td>
                                            <td><?php echo $row['bloodSugar']; ?></td>
                                            <td><?php echo $row['weight']; ?></td>
                                            <td><?php echo $row['temperature']; ?></td>
                                            <td><?php echo $row['medicalPres']; ?></td>
                                            <td><?php echo $row['creationDate']; ?></td>
                                        </tr>
                                        <?php $cnt++;
                                    } ?>
                                </table>
                            <?php } else {
                                echo "<p class='text-warning'>No medical history records found for this patient.</p>";
                            } ?>
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
    jQuery(document).ready(function () {
        Main.init();
        FormElements.init();
    });
</script>
</body>
</html>
