<?php
include "db.php";
$message = "";

if (isset($_POST["submit"])) {
    // Use the typed ID if entered; otherwise use the dropdown selection.
    $customer_id = !empty($_POST["typed_customer_id"])
        ? $_POST["typed_customer_id"] : $_POST["customer_id"];

    $car_id = !empty($_POST["typed_car_id"])
        ? $_POST["typed_car_id"] : $_POST["car_id"];

    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $stmt = mysqli_prepare($conn, "INSERT INTO rental (customer_id, car_id, start_date, end_date) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiss", $customer_id, $car_id, $start_date, $end_date);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Rental saved successfully!";
    } else {
        $message = "Error: Please check the customer ID and car ID. " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

$customers = mysqli_query($conn, "SELECT * FROM customer");
$cars = mysqli_query($conn, "SELECT * FROM car");
?>
<!DOCTYPE html>
<html>
<head><title>Car Rental</title></head>
<body>
<h2>Car Rental Form</h2>
<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST" action="">
    <h3>Select or Enter Customer</h3>
    Customer:
    <select name="customer_id">
        <option value="">Select Customer</option>
        <?php while ($row = mysqli_fetch_assoc($customers)) { ?>
            <option value="<?php echo $row["customer_id"]; ?>">
                <?php echo htmlspecialchars($row["name"]); ?>
            </option>
        <?php } ?>
    </select>
    <br><br>
    Or enter Customer ID:
    <input type="number" name="typed_customer_id" min="1">
    <br><br>

    <h3>Select or Enter Car</h3>
    Car:
    <select name="car_id">
        <option value="">Select Car</option>
        <?php while ($row = mysqli_fetch_assoc($cars)) { ?>
            <option value="<?php echo $row["car_id"]; ?>">
                <?php echo htmlspecialchars($row["model"] . " - " . $row["reg_no"]); ?>
            </option>
        <?php } ?>
    </select>
    <br><br>
    Or enter Car ID:
    <input type="number" name="typed_car_id" min="1">
    <br><br>

    Start Date: <input type="date" name="start_date" required><br><br>
    End Date: <input type="date" name="end_date" required><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<p>Choose from the dropdown OR enter the ID manually. If both are provided, the typed ID is used.</p>
<br><a href="report.php">View Rental Report</a>
</body>
</html>
