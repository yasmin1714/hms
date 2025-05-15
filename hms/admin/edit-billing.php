<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

    $billingId = intval($_GET['id']); // get billing id
    if (isset($_POST['submit'])) {
        $appointmentId = $_POST['appointmentId'];
        $surgeryId = $_POST['surgeryId'];
        $totalAmount = $_POST['total_amount'];
        $paidAmount = $_POST['paid_amount'];
        $paymentStatus = $_POST['payment_status'];

        $sql = mysqli_query($con, "update billing set appointmentId='$appointmentId', surgeryId='$surgeryId', total_amount='$totalAmount', paid_amount='$paidAmount', payment_status='$paymentStatus' where id='$billingId'");
        if ($sql) {
            $msg = "Billing Details updated Successfully";
        } else {
            $msg = "Failed to update Billing Details";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | Edit Billing Details</title>
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
                                <h1 class="mainTitle">Admin | Edit Billing Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Billing Details</span>
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
                                                <h5 class="panel-title">Edit Billing Info</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql = mysqli_query($con, "select * from billing where id='$billingId'");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                    <h4>Billing ID: <?php echo htmlentities($data['id']); ?></h4>
                                                    <form role="form" name="editbilling" method="post"
                                                          onSubmit="return valid();" class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Appointment ID <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <select name="appointmentId" class="form-control"
                                                                        required="true">
                                                                    <option value="<?php echo htmlentities($data['appointmentId']); ?>">
                                                                        <?php echo htmlentities($data['appointmentId']); ?>
                                                                    </option>
                                                                    <?php
                                                                    $ret = mysqli_query($con, "select id from appointment");
                                                                    while ($row = mysqli_fetch_array($ret)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Surgery ID <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <select name="surgeryId" class="form-control"
                                                                        required="true">
                                                                    <option value="<?php echo htmlentities($data['surgeryId']); ?>">
                                                                        <?php echo htmlentities($data['surgeryId']); ?>
                                                                    </option>
                                                                    <?php
                                                                    $ret = mysqli_query($con, "select id from surgery");
                                                                    while ($row = mysqli_fetch_array($ret)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Total Amount <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="total_amount"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($data['total_amount']); ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Paid Amount <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="paid_amount"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($data['paid_amount']); ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Payment Status <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <select name="payment_status" class="form-control"
                                                                        required="true">
                                                                    <option value="<?php echo htmlentities($data['payment_status']); ?>">
                                                                        <?php echo htmlentities($data['payment_status']); ?>
                                                                    </option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Paid">Paid</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                </select>
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