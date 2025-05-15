<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $medicineId = $_GET['id'];
        $medicineName = $_POST['medicine_name'];
        $quantity = $_POST['quantity'];
        $pricePerUnit = $_POST['price_per_unit'];
        $expiryDate = $_POST['expiry_date'];

        $sql = mysqli_query($con, "update pharmacy set medicine_name='$medicineName', quantity='$quantity', price_per_unit='$pricePerUnit', expiry_date='$expiryDate' where id='$medicineId'");
        if ($sql) {
            $msg = "Medicine details updated successfully !!";
        } else {
            $msg = "Failed to update medicine details !!";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | Edit Medicine</title>
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
                                <h1 class="mainTitle">Admin | Edit Medicine</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Medicine</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Edit <span class="text-bold">Medicine</span></h5>
                                <?php if (isset($msg)) {
                                    echo "<p style='color:red;'>" . $msg . "</p>";
                                } ?>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Medicine Details</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="editmedicine" method="post" class="form-horizontal">
                                                    <?php
                                                    $medicineId = $_GET['id'];
                                                    $sql = mysqli_query($con, "select * from pharmacy where id='$medicineId'");
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Medicine Name <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="medicine_name"
                                                                       class="form-control"
                                                                       value="<?php echo $row['medicine_name']; ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Quantity <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="number" name="quantity"
                                                                       class="form-control"
                                                                       value="<?php echo $row['quantity']; ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Price Per Unit <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="price_per_unit"
                                                                       class="form-control"
                                                                       value="<?php echo $row['price_per_unit']; ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Expiry Date <span
                                                                    class="text-red">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="date" name="expiry_date"
                                                                       class="form-control"
                                                                       value="<?php echo $row['expiry_date']; ?>"
                                                                       required="true">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                                Update Medicine
                                                            </button>
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
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/login.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            Login.init();
        });
    </script>
    </body>
    </html>
<?php } ?>
