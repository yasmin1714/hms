<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        // Fetching form inputs
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];

        // SQL query to fetch lab reports between the selected dates
        $sql = "SELECT lr.*, p.PatientName, p.PatientContno
                FROM lab_reports lr
                LEFT JOIN tblpatient p ON lr.patient_id = p.ID
                WHERE lr.report_date BETWEEN ? AND ?";

        // Prepare and execute the query
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $fromdate, $todate);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>B/w Dates Reports | Admin</title>
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
    <div id="app">          <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Between Dates | Reports</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Between Dates</span></li>
                                <li class="active"><span>Reports</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Between Dates Reports</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" method="POST" action="betweendates-detailsreports.php">
                                                    <div class="form-group">
                                                        <label for="fromdate">From Date:</label>
                                                        <input type="date" class="form-control" name="fromdate" id="fromdate" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="todate">To Date:</label>
                                                        <input type="date" class="form-control" name="todate" id="todate" value="" required>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($result) && $result->num_rows > 0) {
                                    echo "<div class='col-lg-12 col-md-12'>
                                            <div class='panel panel-white'>
                                                <div class='panel-heading'>
                                                    <h5 class='panel-title'>Reports Between Dates</h5>
                                                </div>
                                                <div class='panel-body'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Patient Name</th>
                                                                <th>Contact</th>
                                                                <th>Report Type</th>
                                                                <th>Result</th>
                                                                <th>Report Date</th>
                                                                <th>Created By Lab</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>";

                                    $cnt = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $cnt++ . "</td>
                                                <td>" . $row['PatientName'] . "</td>
                                                <td>" . $row['PatientContno'] . "</td>
                                                <td>" . $row['report_type'] . "</td>
                                                <td>" . $row['result'] . "</td>
                                                <td>" . $row['report_date'] . "</td>
                                                <td>" . $row['created_by_lab'] . "</td>
                                            </tr>";
                                    }
                                    echo "</tbody></table>
                                                </div>
                                            </div>
                                        </div>";
                                } elseif (isset($result) && $result->num_rows == 0) { // added condition to check number of rows
                                    echo "<div class='alert alert-warning'>No lab reports found for the selected dates.</div>";
                                }
                                ?>
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

<?php } ?>
