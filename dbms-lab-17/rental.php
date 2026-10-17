<?php
require 'db.php';
$message = '';
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
    $car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $start = DateTimeImmutable::createFromFormat('!Y-m-d', $start_date);
    $end = DateTimeImmutable::createFromFormat('!Y-m-d', $end_date);
    if (!$customer_id || !$car_id || !$start || !$end || $start->format('Y-m-d') !== $start_date || $end->format('Y-m-d') !== $end_date || $end < $start) {
        $message = 'Please select a customer and car, and enter valid dates (end date must not be earlier than start date).';
    } else {
        $stmt = mysqli_prepare($conn, 'INSERT INTO rental (customer_id, car_id, start_date, end_date) VALUES (?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'iiss', $customer_id, $car_id, $start_date, $end_date);
        if (mysqli_stmt_execute($stmt)) { $message = 'Rental saved successfully!'; $success = true; }
        else { $message = 'Could not save rental: ' . mysqli_stmt_error($stmt); }
        mysqli_stmt_close($stmt);
    }
}
$customers = mysqli_query($conn, 'SELECT customer_id, name FROM customer ORDER BY name');
$cars = mysqli_query($conn, 'SELECT car_id, model, reg_no FROM car ORDER BY model');
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Car Rental Entry</title><link rel="stylesheet" href="style.css"></head><body><main><h1>Car Rental System</h1><p class="sub">New rental entry</p>
<?php if ($message): ?><p class="notice <?= $success ? 'ok' : 'error' ?>"><?= htmlspecialchars($message) ?></p><?php endif; ?>
<form method="post"><label for="customer_id">Customer</label><select name="customer_id" id="customer_id" required><option value="">Select customer</option><?php while ($c = mysqli_fetch_assoc($customers)): ?><option value="<?= (int)$c['customer_id'] ?>"><?= htmlspecialchars($c['name']) ?></option><?php endwhile; ?></select>
<label for="car_id">Car</label><select name="car_id" id="car_id" required><option value="">Select car</option><?php while ($c = mysqli_fetch_assoc($cars)): ?><option value="<?= (int)$c['car_id'] ?>"><?= htmlspecialchars($c['model'].' — '.$c['reg_no']) ?></option><?php endwhile; ?></select>
<label for="start_date">Start Date</label><input type="date" id="start_date" name="start_date" required><label for="end_date">End Date</label><input type="date" id="end_date" name="end_date" required><button type="submit">Save Rental</button></form><a href="report.php">View Rental Report →</a></main></body></html>
