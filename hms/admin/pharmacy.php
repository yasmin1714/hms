<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | Pharmacy Management</title>
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
                                <h1 class="mainTitle">Admin | Pharmacy Management</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Pharmacy Management</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Pharmacy <span class="text-bold">Inventory</span></h5>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Medicine Name</th>
                                        <th>Quantity</th>
                                        <th>Price Per Unit</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = mysqli_query($con, "select * from pharmacy");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td class="center"><?php echo $cnt; ?>.</td>
                                            <td><?php echo $row['medicine_name']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><?php echo $row['price_per_unit']; ?></td>
                                            <td><?php echo $row['expiry_date']; ?></td>
                                            <td>
                                                <a href="edit-medicine.php?id=<?php echo $row['id']; ?>"
                                                   class="btn btn-transparent btn-xs" tooltip-placement="top"
                                                   tooltip="Edit Medicine Details"><i class="fa fa-pencil"></i></a>
                                                <a href="pharmacy.php?id=<?php echo $row['id'] ?>&del=delete"
                                                   onClick="return confirm('Are you sure you want to delete this medicine?')"
                                                   class="btn btn-transparent btn-xs tooltips"
                                                   tooltip-placement="top" tooltip="Remove Medicine"><i
                                                        class="fa fa-times fa fa-white"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $cnt = $cnt + 1;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Create <span class="text-bold">Purchase Order</span></h5>
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <form role="form" name="purchaseOrder" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Medicine Name <span
                                                        class="text-red">*</span></label>
                                                <div class="col-sm-10">
                                                    <select name="medicine_name" class="form-control" required="true">
                                                        <option value="">Select Medicine</option>
                                                        <?php
                                                        $medicines = mysqli_query($con, "select medicine_name from pharmacy");
                                                        while ($row = mysqli_fetch_array($medicines)) {
                                                            echo '<option value="' . $row['medicine_name'] . '">' . $row['medicine_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Quantity to Order <span
                                                        class="text-red">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="quantity" class="form-control"
                                                           required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="order_medicine" class="btn btn-o btn-primary">
                                                        Generate Purchase Order
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['order_medicine'])) {
                                            $medicineName = $_POST['medicine_name'];
                                            $quantity = $_POST['quantity'];

                                            // Fetch price per unit from pharmacy table
                                            $priceQuery = mysqli_query($con, "SELECT price_per_unit FROM pharmacy WHERE medicine_name = '$medicineName'");
                                            $priceRow = mysqli_fetch_assoc($priceQuery);
                                            $pricePerUnit = $priceRow['price_per_unit'];
                                            if ($pricePerUnit) {
                                                $totalCost = $quantity * $pricePerUnit;
                                                echo "<div class='alert alert-success'>Purchase Order Generated for $quantity units of $medicineName.  Total Cost: $" . $totalCost . "</div>";
                                            } else {
                                                echo "<div class='alert alert-danger'>Error: Could not retrieve price for the selected medicine.  Please check the medicine name.</div>";
                                            }


                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Pricing</span></h5>
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <form role="form" name="updatePrice" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Medicine Name <span
                                                        class="text-red">*</span></label>
                                                <div class="col-sm-10">
                                                    <select name="medicine_name" class="form-control" required="true">
                                                        <option value="">Select Medicine</option>
                                                        <?php
                                                        $medicines = mysqli_query($con, "select medicine_name from pharmacy");
                                                        while ($row = mysqli_fetch_array($medicines)) {
                                                            echo '<option value="' . $row['medicine_name'] . '">' . $row['medicine_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">New Price <span
                                                        class="text-red">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="new_price" class="form-control"
                                                           required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="update_price" class="btn btn-o btn-primary">
                                                        Update Price
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['update_price'])) {
                                            $medicineName = $_POST['medicine_name'];
                                            $newPrice = $_POST['new_price'];
                                            $updatePriceQuery = mysqli_query($con, "UPDATE pharmacy SET price_per_unit = '$newPrice' WHERE medicine_name = '$medicineName'");
                                            if ($updatePriceQuery) {
                                                echo "<div class='alert alert-success'>Price for $medicineName updated successfully to $" . $newPrice . "</div>";
                                            } else {
                                                echo "<div class='alert alert-danger'>Error updating price.  Please check the medicine name and new price.</div>";
                                            }
                                        }
                                        ?>
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
