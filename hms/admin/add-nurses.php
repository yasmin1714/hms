<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $shift_time = $_POST['shift_time'];
        $assigned_doctor_id = $_POST['assigned_doctor_id'];


        $sql = mysqli_query($con, "insert into nurses(name, email, contact_no, shift_time, assigned_doctor_id, creation_date) values('$name','$email','$contact_no','$shift_time','$assigned_doctor_id', CURRENT_TIMESTAMP)");
        if ($sql) {
            echo "<script>alert('Nurse info added Successfully');</script>";
            echo "<script>window.location.href ='manage-nurses.php'</script>";
        } else {
            echo "<script>alert('Failed to add nurse info');</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | Add Nurse</title>
        <link
            href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
            rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
        <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
        <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet"
              media="screen">
        <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/plugins.css">
        <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color"/>
        <script type="text/javascript">
            function valid() {
                if (document.addnurse.npass.value != document.addnurse.cfpass.value) {
                    alert("Password and Confirm Password Field do not match  !!");
                    document.addnurse.cfpass.focus();
                    return false;
                }
                return true;
            }
        </script>

        <script>
            function checkemailAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data: 'emailid=' + $("#email").val(), //changed id
                    type: "POST",
                    success: function (data) {
                        $("#email-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {
                    }
                });
            }
        </script>
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
                                <h1 class="mainTitle">Admin | Add Nurse</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Add Nurse</span>
                                </li>
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
                                                <h5 class="panel-title">Add Nurse</h5>
                                            </div>
                                            <div class="panel-body">

                                                <form role="form" name="addnurse" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="name">
                                                            Name
                                                        </label>
                                                        <input type="text" name="name" class="form-control"
                                                               placeholder="Enter Nurse Name" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">
                                                            Email
                                                        </label>
                                                        <input type="email" id="email" name="email" class="form-control"
                                                               placeholder="Enter Nurse Email id" required="true"
                                                               onBlur="checkemailAvailability()">
                                                        <span id="email-availability-status"></span>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="contact_no">
                                                            Contact Number
                                                        </label>
                                                        <input type="text" name="contact_no" class="form-control"
                                                               placeholder="Enter Nurse Contact number" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shift_time">
                                                            Shift Time
                                                        </label>
                                                        <input type="text" name="shift_time" class="form-control"
                                                               placeholder="Enter Nurse Shift Time" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="assigned_doctor_id">
                                                            Assigned Doctor ID
                                                        </label>
                                                        <select name="assigned_doctor_id" class="form-control" required="true">
                                                            <option value="">Select Doctor</option>
                                                            <?php
                                                            $ret = mysqli_query($con, "select id, doctorName from doctors"); // Assuming you want to use ID and Name
                                                            while ($row = mysqli_fetch_array($ret)) {
                                                                ?>
                                                                <option value="<?php echo htmlentities($row['id']); ?>">
                                                                    <?php echo htmlentities($row['doctorName']); ?>
                                                                    (<?php echo htmlentities($row['id']); ?>)
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>


                                                    <button type="submit" name="submit" id="submit"
                                                            class="btn btn-o btn-primary">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
    <?php include('include/setting.php'); ?>
    </div>
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
<?php } ?>
