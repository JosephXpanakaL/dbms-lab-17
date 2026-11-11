<?php
include "db.php";

$sql = "SELECT customer.name, car.model, car.reg_no, rental.start_date, rental.end_date
        FROM rental
        INNER JOIN customer ON rental.customer_id = customer.customer_id
        INNER JOIN car ON rental.car_id = car.car_id";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head><title>Rental Report</title></head>
<body>
<h2>Car Rental Report</h2>
<table border="1" cellpadding="8">
<tr>
    <th>Customer Name</th><th>Car Model</th><th>Registration No</th>
    <th>Start Date</th><th>End Date</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo htmlspecialchars($row["name"]); ?></td>
    <td><?php echo htmlspecialchars($row["model"]); ?></td>
    <td><?php echo htmlspecialchars($row["reg_no"]); ?></td>
    <td><?php echo htmlspecialchars($row["start_date"]); ?></td>
    <td><?php echo htmlspecialchars($row["end_date"]); ?></td>
</tr>
<?php } ?>
</table>
<br><a href="rental.php">Back to Rental Form</a>
</body>
</html>
