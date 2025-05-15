<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

    $nurseId = intval($_GET['id']); // get nurse id
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $shift_time = $_POST['shift_time'];
        $assigned_doctor_id = $_POST['assigned_doctor_id'];

        $sql = mysqli_query($con, "Update nurses set name='$name', email='$email', contact_no='$contact_no', shift_time='$shift_time', assigned_doctor_id='$assigned_doctor_id' where id='$nurseId'");
        if ($sql) {
            $msg = "Nurse Details updated Successfully";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | Edit Nurse Details</title>
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
                                <h1 class="mainTitle">Admin | Edit Nurse Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Nurse Details</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px; ">
                                    <?php if ($msg) {
                                        echo htmlentities($msg);
                                    } ?> </h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Nurse Info</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql = mysqli_query($con, "select * from nurses where id='$nurseId'");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                    <h4><?php echo htmlentities($data['name']); ?>'s Profile</h4>
                                                    <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creation_date']); ?></p>
                                                    <hr/>
                                                    <form role="form" name="editnurse" method="post"
                                                          onSubmit="return valid();">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Name
                                                            </label>
                                                            <input type="text" name="name" class="form-control"
                                                                   value="<?php echo htmlentities($data['name']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">
                                                                Email
                                                            </label>
                                                            <input type="email" name="email" class="form-control"
                                                                   value="<?php echo htmlentities($data['email']); ?>" >
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="contact_no">
                                                                Contact Number
                                                            </label>
                                                            <input type="text" name="contact_no" class="form-control"
                                                                   value="<?php echo htmlentities($data['contact_no']); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shift_time">
                                                                Shift Time
                                                            </label>
                                                            <input type="text" name="shift_time" class="form-control"
                                                                   value="<?php echo htmlentities($data['shift_time']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="assigned_doctor_id">
                                                                Assigned Doctor ID
                                                            </label>
                                                            <select name="assigned_doctor_id" class="form-control" required="required">
                                                                <option value="<?php echo htmlentities($data['assigned_doctor_id']); ?>">
                                                                    <?php
                                                                    $doctor_name_query = mysqli_query($con, "SELECT doctorName FROM doctors WHERE id = " . $data['assigned_doctor_id']);
                                                                    $doctor_name_row = mysqli_fetch_assoc($doctor_name_query);
                                                                    echo htmlentities($doctor_name_row['doctorName']);
                                                                    ?>
                                                                </option>
                                                                <?php
                                                                $ret = mysqli_query($con, "select id, doctorName from doctors");
                                                                while ($row = mysqli_fetch_array($ret)) {
                                                                    ?>
                                                                    <option value="<?php echo htmlentities($row['id']); ?>">
                                                                        <?php echo htmlentities($row['doctorName']); ?>
                                                                        (<?php echo htmlentities($row['id']); ?>)
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>


                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                            Update
                                                        </button>
                                                    </form>
                                                <?php } ?>
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
