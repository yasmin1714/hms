<?php
session_start();
include('include/config.php');

if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
    header('location:logout.php');
    exit();
}

// Fetch patient details
$patientId = $_SESSION['id'];
$query = $con->prepare("SELECT id, fullName FROM users WHERE id = ?");
$query->bind_param('i', $patientId);
$query->execute();
$patientResult = $query->get_result();

if ($patientResult->num_rows == 0) {
    echo "Patient not found.";
    exit();
}
$patient = $patientResult->fetch_assoc();
$patientName = $patient['fullName'];
$query->close();

if (isset($_POST['submit'])) {
    $surgerytype = $_POST['surgerytype'];
    $doctorid = $_POST['doctorid'];
    $surgerydate = $_POST['surgerydate'];
    $recovery_status = $_POST['recovery_status'];
    $surgerynotes = $_POST['surgerynotes'];

    $query = $con->prepare("INSERT INTO surgery (patientId, surgery_type, doctorId, surgery_date, surgery_notes, recovery_status) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param('isisss', $patientId, $surgerytype, $doctorid, $surgerydate, $surgerynotes, $recovery_status);

    if ($query->execute()) {
        $_SESSION['msg'] = "Surgery details added successfully!";
        header('location:manage-surgery.php');
        exit();
    } else {
        $_SESSION['msg'] = "Failed to add surgery details.";
        header('location:surgery.php');
        exit();
    }
    $query->close();
}

// Fetch doctors for dropdown
$query = $con->prepare("SELECT * FROM doctors");
$query->execute();
$doctors = $query->get_result();
$query->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Surgery</title>
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
        .error {
            color: red;
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
                                <h1 class="mainTitle">Add Surgery</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li><span>Surgeries</span></li>
                                <li class="active"><span>Add Surgery</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="margin-bottom-20">Surgery Details</h2>
                                <form method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Patient Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $patientName; ?>" readonly>
                                            <input type="hidden" name="patientid" value="<?php echo $patientId; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Surgery Type <span class="text-red">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="surgerytype" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Surgeon <span class="text-red">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="doctorid" class="form-control" required>
                                                <option value="">Select Doctor</option>
                                                <?php while ($row = $doctors->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['doctorName']; ?></option>
                                                <?php } $doctors->free(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Date <span class="text-red">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" name="surgerydate" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Recovery Status <span class="text-red">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="recovery_status" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Surgery Notes <span class="text-red">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea name="surgerynotes" class="form-control" rows="4" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-9">
                                            <button type="submit" name="submit" class="btn btn-primary">Add Surgery</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
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
            // Form validation
            $('form').validate({
                rules: {
                    surgerytype: {
                        required: true
                    },
                    doctorid: {
                        required: true
                    },
                    surgerydate: {
                        required: true
                    },
                    recovery_status: {
                        required: true
                    },
                    surgerynotes: {
                        required: true
                    },
                    anesthesia_type: {
                        required: true
                    },
                    duration: {
                        required: true
                    },
                    pre_op_instructions: {
                        required: true
                    },
                    post_op_instructions: {
                        required: true
                    },
                    complications: {
                        required: true
                    },
                    report: {
                        required: true
                    }
                },
                messages: {
                    surgerytype: {
                        required: "Please enter surgery type"
                    },
                    doctorid: {
                        required: "Please select a doctor"
                    },
                    surgerydate: {
                        required: "Please enter surgery date"
                    },
                    recovery_status: {
                        required: "Please enter recovery status"
                    },
                    surgerynotes: {
                        required: "Please enter surgery notes"
                    },
                    anesthesia_type: {
                        required: "Please enter anesthesia type"
                    },
                    duration: {
                        required: "Please enter duration"
                    },
                    pre_op_instructions: {
                        required: "Please enter pre-op instructions"
                    },
                    post_op_instructions: {
                        required: "Please enter post-op instructions"
                    },
                    complications: {
                        required: "Please enter complications"
                    },
                    report: {
                        required: "Please upload a report"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
