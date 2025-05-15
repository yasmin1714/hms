<?php
// get_doctor_fees.php
include('include/config.php');
if (!empty($_POST["doctor"])) {
    $doctorid = intval($_POST['doctor']);
    // Use prepared statements
    $stmt = mysqli_prepare($con, "SELECT docFees FROM doctors WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $doctorid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    ?>
    <option value="">Select Fees</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) { // Use mysqli_fetch_assoc
        ?>
        <option value="<?php echo $row["docFees"]; ?>"><?php echo $row["docFees"]; ?></option>
        <?php
    }
    mysqli_stmt_close($stmt); // Close the statement
}
?>