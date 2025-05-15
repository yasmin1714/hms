<?php
// get_doctor.php
include('include/config.php');
if (!empty($_POST["specilizationid"])) {
    $specilizationid = intval($_POST['specilizationid']);
    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($con, "SELECT id, doctorName FROM doctors WHERE specialization = ?");
    mysqli_stmt_bind_param($stmt, "i", $specilizationid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    ?>
    <option value="">Select Doctor</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) { // Use mysqli_fetch_assoc
        ?>
        <option value="<?php echo $row["id"]; ?>"><?php echo $row["doctorName"]; ?></option>
        <?php
    }
    mysqli_stmt_close($stmt); // Close the statement
}
?>