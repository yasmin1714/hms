<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

    $insuranceId = intval($_GET['id']); // Get insurance id
    if (isset($_POST['submit'])) {
        $userId = $_POST['userId'];
        $providerName = $_POST['provider_name'];
        $policyNumber = $_POST['policy_number'];
        $coverageDetails = $_POST['coverage_details'];
        $validTill = $_POST['valid_till'];

        $sql = mysqli_query($con, "update insurance set userId='$userId', provider_name='$providerName', policy_number='$policyNumber', coverage_details='$coverageDetails', valid_till='$validTill' where id='$insuranceId'");
        if ($sql) {
            $msg = "Insurance Details updated Successfully";
        } else {
            $msg = "Failed to update Insurance Details";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | Edit Insurance Details</title>
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
                                <h1 class="mainTitle">Admin | Edit Insurance Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Insurance Details</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px; ">
                                    <?php if (isset($msg)) {
                                        echo htmlentities($msg);
                                    } ?> </h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Insurance Info</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql = mysqli_query($con, "select * from insurance where id='$insuranceId'");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                    <h4>Insurance ID: <?php echo htmlentities($data['id']); ?></h4>
                                                    <form role="form" name="editinsurance" method="post"
                                                          onSubmit="return valid();" class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">User ID <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <select name="userId" class="form-control" required="true">
                                                                    <option value="<?php echo htmlentities($data['userId']); ?>">
                                                                        <?php
                                                                        $user_name_query = mysqli_query($con, "SELECT fullName FROM users WHERE id = " . $data['userId']);
                                                                        $user_name_row = mysqli_fetch_assoc($user_name_query);
                                                                        echo htmlentities($user_name_row['fullName']);
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                    $ret = mysqli_query($con, "select id, fullName from users");
                                                                    while ($row = mysqli_fetch_array($ret)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fullName']; ?>
                                                                            (<?php echo $row['id']; ?>)</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Provider Name <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="provider_name"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($data['provider_name']); ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Policy Number <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="policy_number"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($data['policy_number']); ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Coverage Details <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <textarea name="coverage_details" class="form-control"
                                                                          required="true"><?php echo htmlentities($data['coverage_details']); ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Valid Till <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="date" name="valid_till"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($data['valid_till']); ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button type="submit" name="submit"
                                                                        class="btn btn-o btn-primary">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div>
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
        <?php include('include/footer.php'); ?>
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
